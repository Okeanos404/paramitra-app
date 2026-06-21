<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'kategori',
        'harga',
        'stok',
        'sku',
        'harga_pokok',
        'reorder_level',
        'deskripsi',
        'image',
    ];

    public function detailPesanan(): HasMany
    {
        return $this->hasMany(DetailPesanan::class);
    }

    public function supplierProducts(): HasMany
    {
        return $this->hasMany(SupplierProduct::class);
    }

    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class, 'supplier_products')
            ->withPivot('harga_supplier', 'lead_time_hari', 'minimum_order')
            ->withTimestamps();
    }

    public function gudang(): BelongsToMany
    {
        return $this->belongsToMany(Gudang::class, 'produk_gudang')
            ->withPivot('stok')
            ->withTimestamps();
    }

    public function stokMovements(): HasMany
    {
        return $this->hasMany(StokMovement::class);
    }

    public function transferBarangItems(): HasMany
    {
        return $this->hasMany(TransferBarangItem::class);
    }

    public function purchaseOrderItems(): HasMany
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function getTotalStok()
    {
        return $this->gudang()->sum('stok');
    }

    public function getStokByGudang($gudangId)
    {
        return $this->gudang()
            ->where('gudang.id', $gudangId)
            ->first()
            ?->pivot->stok ?? 0;
    }
}
