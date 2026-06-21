<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransferBarang extends Model
{
    protected $table = 'transfer_barang';

    protected $fillable = [
        'no_transfer',
        'dari_gudang_id',
        'ke_gudang_id',
        'tanggal_transfer',
        'status',
        'penerima_nama',
        'penerima_ttd',
        'catatan',
    ];

    protected $casts = [
        'tanggal_transfer' => 'date',
    ];

    public function dariGudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'dari_gudang_id');
    }

    public function keGudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'ke_gudang_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(TransferBarangItem::class, 'transfer_barang_id');
    }
}
