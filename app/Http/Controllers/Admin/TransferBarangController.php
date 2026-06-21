<?php

namespace App\Http\Controllers\Admin;

use App\Models\TransferBarang;
use App\Models\TransferBarangItem;
use App\Models\Gudang;
use App\Models\Produk;
use App\Models\StokMovement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransferBarangController extends Controller
{
    public function index()
    {
        $transfers = TransferBarang::with('dariGudang', 'keGudang', 'items.produk')->paginate(15);
        return view('admin.transfer-barang.index', compact('transfers'));
    }

    public function create()
    {
        $gudangs = Gudang::where('status', 'active')->get();
        $produk = Produk::all();
        return view('admin.transfer-barang.create', compact('gudangs', 'produk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dari_gudang_id' => 'required|exists:gudang,id',
            'ke_gudang_id' => 'required|exists:gudang,id',
            'items' => 'required|array',
            'items.*.produk_id' => 'required|exists:produk,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'catatan' => 'nullable',
        ]);

        $noTransfer = $this->generateNoTransfer();

        $transfer = TransferBarang::create([
            'no_transfer' => $noTransfer,
            'dari_gudang_id' => $validated['dari_gudang_id'],
            'ke_gudang_id' => $validated['ke_gudang_id'],
            'tanggal_transfer' => now(),
            'status' => 'draft',
            'catatan' => $validated['catatan'] ?? null,
        ]);

        foreach ($validated['items'] as $item) {
            TransferBarangItem::create([
                'transfer_barang_id' => $transfer->id,
                'produk_id' => $item['produk_id'],
                'jumlah' => $item['jumlah'],
            ]);
        }

        return redirect()->route('transfer-barang.show', $transfer)->with('success', 'Transfer created successfully');
    }

    public function show(TransferBarang $transferBarang)
    {
        $transferBarang->load(['dariGudang', 'keGudang', 'items.produk']);
        return view('admin.transfer-barang.show', compact('transferBarang'));
    }

    public function approve(TransferBarang $transferBarang)
    {
        if ($transferBarang->status !== 'draft') {
            return redirect()->back()->with('error', 'Transfer cannot be approved');
        }

        // Record stock movements untuk keluar dari gudang asal
        foreach ($transferBarang->items as $item) {
            StokMovement::create([
                'gudang_id' => $transferBarang->dari_gudang_id,
                'produk_id' => $item->produk_id,
                'tipe_movement' => 'transfer_out',
                'jumlah' => -$item->jumlah,
                'saldo_akhir' => $this->getGudangStock($transferBarang->dari_gudang_id, $item->produk_id),
                'referensi_tipe' => 'TransferBarang',
                'referensi_id' => $transferBarang->id,
            ]);
        }

        $transferBarang->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Transfer approved');
    }

    public function markReceived(Request $request, TransferBarang $transferBarang)
    {
        $validated = $request->validate([
            'items.*.id' => 'required|exists:transfer_barang_items,id',
            'items.*.jumlah_diterima' => 'required|integer|min:0',
            'penerima_nama' => 'required',
        ]);

        foreach ($validated['items'] as $item) {
            $transferItem = TransferBarangItem::find($item['id']);
            $transferItem->update(['jumlah_diterima' => $item['jumlah_diterima']]);

            // Record stock movements untuk masuk ke gudang tujuan
            StokMovement::create([
                'gudang_id' => $transferBarang->ke_gudang_id,
                'produk_id' => $transferItem->produk_id,
                'tipe_movement' => 'transfer_in',
                'jumlah' => $item['jumlah_diterima'],
                'saldo_akhir' => $this->getGudangStock($transferBarang->ke_gudang_id, $transferItem->produk_id),
                'referensi_tipe' => 'TransferBarang',
                'referensi_id' => $transferBarang->id,
            ]);
        }

        $transferBarang->update([
            'status' => 'received',
            'penerima_nama' => $validated['penerima_nama'],
        ]);

        return redirect()->back()->with('success', 'Transfer received');
    }

    protected function generateNoTransfer()
    {
        $count = TransferBarang::whereDate('created_at', today())->count() + 1;
        return 'TRF-' . date('Ymd') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    protected function getGudangStock($gudangId, $produkId)
    {
        return \DB::table('produk_gudang')
            ->where('gudang_id', $gudangId)
            ->where('produk_id', $produkId)
            ->value('stok') ?? 0;
    }
}
