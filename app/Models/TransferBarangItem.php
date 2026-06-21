<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransferBarangItem extends Model
{
    protected $table = 'transfer_barang_items';

    protected $fillable = [
        'transfer_barang_id',
        'produk_id',
        'jumlah',
        'jumlah_diterima',
    ];

    public function transferBarang(): BelongsTo
    {
        return $this->belongsTo(TransferBarang::class);
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}
