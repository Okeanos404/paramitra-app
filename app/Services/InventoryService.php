<?php

namespace App\Services;

use App\Models\Produk;
use App\Models\Gudang;
use App\Models\ProdukGudang;

class InventoryService
{
    public function getTotalStock(Produk $produk): int
    {
        return $produk->gudang()->sum('stok');
    }

    public function getStockByGudang(Produk $produk, Gudang $gudang): int
    {
        return $produk->gudang()
            ->where('gudang_id', $gudang->id)
            ->value('stok') ?? 0;
    }

    public function hasEnoughStock(Produk $produk, int $quantity, Gudang $gudang = null): bool
    {
        if ($gudang) {
            return $this->getStockByGudang($produk, $gudang) >= $quantity;
        }

        return $this->getTotalStock($produk) >= $quantity;
    }

    public function needsReorder(Produk $produk): bool
    {
        return $this->getTotalStock($produk) <= $produk->reorder_level;
    }

    public function getLowStockProducts(): \Illuminate\Database\Eloquent\Collection
    {
        return Produk::all()->filter(function ($produk) {
            return $this->needsReorder($produk);
        });
    }

    public function getStockByWarehouse(Gudang $gudang)
    {
        return $gudang->produk()
            ->withPivot('stok')
            ->get()
            ->map(function ($produk) {
                return [
                    'produk_id' => $produk->id,
                    'nama_produk' => $produk->nama_produk,
                    'stok' => $produk->pivot->stok,
                    'reorder_level' => $produk->reorder_level,
                    'status' => $produk->pivot->stok <= $produk->reorder_level ? 'low' : 'normal',
                ];
            });
    }
}
