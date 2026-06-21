<?php

namespace App\Http\Controllers\Admin;

use App\Models\GoodsReceipt;
use App\Models\PurchaseOrder;
use App\Models\Gudang;
use App\Services\GoodsReceiptService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsReceiptController extends Controller
{
    protected $goodsReceiptService;

    public function __construct(GoodsReceiptService $goodsReceiptService)
    {
        $this->goodsReceiptService = $goodsReceiptService;
    }

    public function create(PurchaseOrder $purchaseOrder)
    {
        if (!in_array($purchaseOrder->status, ['confirmed', 'partial_received'])) {
            return redirect()->back()->with('error', 'PO must be confirmed or partially received first');
        }

        $gudang = Gudang::firstOrCreate(
            ['status' => 'active'],
            [
                'nama_gudang' => 'Gudang Pusat',
                'lokasi' => 'Pabrik Utama',
                'alamat' => 'Jl. Raya Bekasi KM. 21',
                'tipe' => 'pusat'
            ]
        );
        $gudangs = collect([$gudang]);
        $purchaseOrder->load('items.produk');

        return view('admin.goods-receipt.create', compact('purchaseOrder', 'gudangs'));
    }

    public function store(Request $request, PurchaseOrder $purchaseOrder)
    {
        $validated = $request->validate([
            'gudang_id' => 'required|exists:gudang,id',
            'items' => 'required|array',
            'items.*.purchase_order_item_id' => 'required|exists:purchase_order_items,id',
            'items.*.jumlah_terima' => 'required|integer|min:0',
            'items.*.jumlah_reject' => 'integer|min:0',
            'catatan' => 'nullable',
        ]);

        $nomorPenerimaan = $this->generateNomorPenerimaan();

        $goodsReceipt = GoodsReceipt::create([
            'purchase_order_id' => $purchaseOrder->id,
            'gudang_id' => $validated['gudang_id'],
            'nomor_penerimaan' => $nomorPenerimaan,
            'tanggal_terima' => now(),
            'status' => 'draft',
            'catatan' => $validated['catatan'] ?? null,
        ]);

        $this->goodsReceiptService->receiveGoods($goodsReceipt, $validated['items']);

        return redirect()->route('purchase-orders.show', $purchaseOrder)->with('success', 'Goods received successfully');
    }

    protected function generateNomorPenerimaan()
    {
        $count = GoodsReceipt::whereDate('created_at', today())->count() + 1;
        return 'GR-' . date('Ymd') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
}
