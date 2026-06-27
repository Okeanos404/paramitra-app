<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\DetailPesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Pesanan::with(['user', 'detailPesanan.produk'])->where('status', '!=', 'selesai')->latest()->get();
        $customers = User::where('role', 'pelanggan')->get();
        $products = Produk::where('stok', '>', 0)->get();
        
        return view('admin.orders.index', compact('orders', 'customers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'items' => 'required|array|min:1',
            'items.*.produk_id' => 'required|exists:produk,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $total_harga = 0;
            $items_to_save = [];

            foreach ($request->items as $item) {
                $produk = Produk::lockForUpdate()->find($item['produk_id']);

                if ($produk->stok < $item['jumlah']) {
                    throw new \Exception("Stok tidak mencukupi untuk produk: {$produk->nama_produk}");
                }

                $subtotal = $produk->harga * $item['jumlah'];
                $total_harga += $subtotal;

                // Decrement stock
                $produk->decrement('stok', $item['jumlah']);

                $items_to_save[] = [
                    'produk_id' => $produk->id,
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $subtotal
                ];
            }

            $pesanan = Pesanan::create([
                'user_id' => $request->user_id,
                'tanggal_pesanan' => now(),
                'total_harga' => $total_harga,
                'status' => 'pending',
            ]);

            foreach ($items_to_save as $item) {
                $pesanan->detailPesanan()->create($item);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Pesanan berhasil dibuat.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,kirim,selesai',
        ]);

        $pesanan->update(['status' => $request->status]);

        // Auto-create/update Shipping Record when status changes from the Orders screen
        if ($request->status === 'kirim') {
            if (!$pesanan->pengiriman) {
                $pengiriman = \App\Models\Pengiriman::create([
                    'pesanan_id' => $pesanan->id,
                    'no_resi' => 'PM-' . strtoupper(\Illuminate\Support\Str::random(10)),
                    'kurir' => 'Truck Hino Wingbox B 9021 PYA',
                    'status_kirim' => 'perjalanan',
                ]);

                $pengiriman->distribusi()->create([
                    'lokasi_terkini' => 'Dalam Perjalanan',
                    'catatan' => 'Pesanan dikirim dan sedang dalam perjalanan menuju lokasi Anda.',
                ]);

                \App\Models\SuratJalan::create([
                    'pengiriman_id' => $pengiriman->id,
                    'no_surat_jalan' => 'SJ-' . date('Ymd') . '-' . str_pad(\App\Models\SuratJalan::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT),
                    'tanggal_surat' => now(),
                    'alamat_pengiriman' => 'Alamat Pelanggan (Otomatis)',
                    'penerima_nama' => $pesanan->user->name,
                    'catatan_khusus' => 'Barang dikirim dari gudang PT Paramitra.',
                    'status' => 'terbit',
                ]);
            } else {
                $pesanan->pengiriman->update(['status_kirim' => 'perjalanan']);
                $pesanan->pengiriman->distribusi()->create([
                    'lokasi_terkini' => 'Dalam Perjalanan',
                    'catatan' => 'Status pesanan diperbarui menjadi sedang dikirim.',
                ]);
            }
        } elseif ($request->status === 'selesai') {
            if ($pesanan->pengiriman) {
                $pesanan->pengiriman->update(['status_kirim' => 'diterima']);
                $pesanan->pengiriman->distribusi()->create([
                    'lokasi_terkini' => 'Diterima Pelanggan',
                    'catatan' => 'Pesanan telah sampai dan diterima dengan baik oleh pelanggan.',
                ]);
                
                if ($pesanan->pengiriman->suratJalan && $pesanan->pengiriman->suratJalan->status !== 'diterima') {
                    $pesanan->pengiriman->suratJalan->update([
                        'status' => 'diterima',
                        'waktu_penerimaan' => now()
                    ]);
                }
            } else {
                $pengiriman = \App\Models\Pengiriman::create([
                    'pesanan_id' => $pesanan->id,
                    'no_resi' => 'PM-' . strtoupper(\Illuminate\Support\Str::random(10)),
                    'kurir' => 'Truck Hino Wingbox B 9021 PYA',
                    'status_kirim' => 'diterima',
                ]);

                $pengiriman->distribusi()->create([
                    'lokasi_terkini' => 'Diterima Pelanggan',
                    'catatan' => 'Pesanan selesai dan diterima oleh pelanggan.',
                ]);
            }
        } elseif ($request->status === 'proses') {
            // If downgraded to proses, clean up shipping if any so they can re-process it in Logistics page
            if ($pesanan->pengiriman) {
                if ($pesanan->pengiriman->suratJalan) {
                    $pesanan->pengiriman->suratJalan->delete();
                }
                $pesanan->pengiriman->distribusi()->delete();
                $pesanan->pengiriman->delete();
            }
        }

        return redirect()->back()->with('success', 'Status pesanan diperbarui.');
    }

    public function approvePayment(Pesanan $pesanan, \App\Services\InvoiceService $invoiceService)
    {
        try {
            DB::beginTransaction();

            // 1. Update Payment Transaction
            if ($pesanan->paymentTransaction) {
                $pesanan->paymentTransaction->update([
                    'status' => 'success',
                    'paid_at' => now(),
                ]);
            }

            // 2. Update Pesanan
            $pesanan->update([
                'payment_status' => 'paid',
                'status' => 'proses' // Otomatis masuk proses setelah bayar
            ]);

            // 3. Generate & Mark Invoice as Paid
            if (!$pesanan->invoice) {
                $invoice = $invoiceService->generateInvoice($pesanan);
                $invoiceService->markAsPaid($invoice);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Pembayaran berhasil di-ACC dan Resi/Invoice telah terbit.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses ACC pembayaran: ' . $e->getMessage());
        }
    }
}
