<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gudang extends Model
{
    protected $table = 'gudang';

    protected $fillable = [
        'nama_gudang',
        'lokasi',
        'alamat',
        'telepon',
        'tipe',
        'status',
    ];

    public function stokMovements(): HasMany
    {
        return $this->hasMany(StokMovement::class);
    }

    public function transferBarangDari(): HasMany
    {
        return $this->hasMany(TransferBarang::class, 'dari_gudang_id');
    }

    public function transferBarangKe(): HasMany
    {
        return $this->hasMany(TransferBarang::class, 'ke_gudang_id');
    }

    public function produkGudang(): HasMany
    {
        return $this->hasMany(ProdukGudang::class);
    }

    public function produk(): BelongsToMany
    {
        return $this->belongsToMany(Produk::class, 'produk_gudang')
            ->withPivot('stok')
            ->withTimestamps();
    }

    public function goodsReceipts(): HasMany
    {
        return $this->hasMany(GoodsReceipt::class);
    }
}
