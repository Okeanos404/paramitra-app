<?php

namespace App\Services;

use App\Models\GoodsReceipt;
use App\Models\GoodsReceiptItem;
use App\Models\StokMovement;
use App\Models\ProdukGudang;
use App\Models\Produk;

class GoodsReceiptService
{
    public function receiveGoods(GoodsReceipt $goodsReceipt, array $items): void
    {
        foreach ($items as $item) {
            $receiptItem = GoodsReceiptItem::create([
                'goods_receipt_id' => $goodsReceipt->id,
                'purchase_order_item_id' => $item['purchase_order_item_id'],
                'jumlah_terima' => $item['jumlah_terima'],
                'jumlah_reject' => $item['jumlah_reject'] ?? 0,
                'catatan' => $item['catatan'] ?? null,
            ]);

            // Update stock di gudang
            $poItem = $receiptItem->purchaseOrderItem;
            $this->updateWarehouseStock(
                $goodsReceipt->gudang_id,
                $poItem->produk_id,
                $item['jumlah_terima'],
                'masuk',
                'GoodsReceipt',
                $goodsReceipt->id
            );
        }

        $goodsReceipt->update(['status' => 'confirmed']);

        // Check if fully received
        $po = $goodsReceipt->purchaseOrder;
        $isFullyReceived = true;
        foreach ($po->items as $poItem) {
            $totalReceived = $poItem->goodsReceiptItems()->sum('jumlah_terima');
            if ($totalReceived < $poItem->jumlah) {
                $isFullyReceived = false;
                break;
            }
        }

        $po->update(['status' => $isFullyReceived ? 'received' : 'partial_received']);
    }

    public function updateWarehouseStock($gudangId, $produkId, $jumlah, $tipeMovement, $refType, $refId): void
    {
        $produkGudang = ProdukGudang::where('gudang_id', $gudangId)
            ->where('produk_id', $produkId)
            ->first();

        if (!$produkGudang) {
            $produkGudang = ProdukGudang::create([
                'gudang_id' => $gudangId,
                'produk_id' => $produkId,
                'stok' => 0,
            ]);
        }

        $novalumlah = ($tipeMovement === 'keluar' || $tipeMovement === 'transfer_out') ? -$jumlah : $jumlah;
        $saldoAkhir = $produkGudang->stok + $novalumlah;

        $produkGudang->increment('stok', $novalumlah);

        StokMovement::create([
            'gudang_id' => $gudangId,
            'produk_id' => $produkId,
            'tipe_movement' => $tipeMovement,
            'jumlah' => $novalumlah,
            'saldo_akhir' => $saldoAkhir,
            'referensi_tipe' => $refType,
            'referensi_id' => $refId,
        ]);

        // Update total stok in main Produk table to keep it in sync
        Produk::where('id', $produkId)->increment('stok', $novalumlah);
    }
}
