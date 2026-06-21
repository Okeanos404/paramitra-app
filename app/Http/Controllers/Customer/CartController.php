<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $paymentMethods = \App\Models\PaymentMethod::where('is_active', true)->get();
        return view('customer.cart', compact('cart', 'paymentMethods'));
    }

    public function products(Request $request)
    {
        $query = Produk::where('stok', '>', 0);

        // Advanced Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        // Logical Category Grouping
        if ($request->filled('category')) {
            if ($request->category === 'pigmen') {
                $query->whereIn('kategori', ['Pigmen Organik', 'Pigmen Anorganik']);
            } elseif ($request->category === 'kimia') {
                $query->whereIn('kategori', ['Solvent', 'Resin Industri']);
            }
        }

        $products = $query->get();
        return view('customer.products', compact('products'));
    }

    public function add(Produk $produk)
    {
        $cart = session('cart', []);

        if (isset($cart[$produk->id])) {
            $cart[$produk->id]['quantity']++;
        } else {
            $cart[$produk->id] = [
                "name" => $produk->nama_produk,
                "quantity" => 1,
                "price" => $produk->harga,
                "category" => $produk->kategori
            ];
        }

        session(['cart' => $cart]);
        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function remove($id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id'
        ], [
            'payment_method_id.required' => 'Pilih metode pembayaran terlebih dahulu.'
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang masih kosong!');
        }

        try {
            DB::beginTransaction();

            $total_harga = 0;
            foreach ($cart as $id => $details) {
                $total_harga += $details['price'] * $details['quantity'];
            }

            $pesanan = Pesanan::create([
                'user_id' => Auth::id(),
                'payment_method_id' => $request->payment_method_id,
                'tanggal_pesanan' => now(),
                'total_harga' => $total_harga,
                'status' => 'pending',
                'payment_status' => 'pending_payment',
            ]);

            \App\Models\PaymentTransaction::create([
                'pesanan_id' => $pesanan->id,
                'payment_method_id' => $request->payment_method_id,
                'transaction_id' => 'TRX-' . strtoupper(\Illuminate\Support\Str::random(12)),
                'amount' => $total_harga,
                'status' => 'pending',
            ]);

            foreach ($cart as $id => $details) {
                $produk = Produk::lockForUpdate()->find($id);
                
                if ($produk->stok < $details['quantity']) {
                    throw new \Exception("Stok {$produk->nama_produk} tidak mencukupi.");
                }

                $produk->decrement('stok', $details['quantity']);

                $pesanan->detailPesanan()->create([
                    'produk_id' => $id,
                    'jumlah' => $details['quantity'],
                    'subtotal' => $details['price'] * $details['quantity'],
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('customer.payments.index')->with('success', 'Pesanan berhasil dibuat! Silakan tunggu konfirmasi (ACC) pembayaran dari admin.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }
}
