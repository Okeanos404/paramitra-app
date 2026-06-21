<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokMovement extends Model
{
    protected $table = 'stok_movement';

    protected $fillable = [
        'gudang_id',
        'produk_id',
        'tipe_movement',
        'jumlah',
        'saldo_akhir',
        'referensi_tipe',
        'referensi_id',
        'catatan',
    ];

    public function gudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class);
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}
