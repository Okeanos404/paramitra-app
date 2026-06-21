<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';

    protected $fillable = [
        'pesanan_id',
        'no_resi',
        'kurir',
        'status_kirim',
    ];

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function distribusi(): HasMany
    {
        return $this->hasMany(Distribusi::class);
    }

    public function suratJalan(): HasOne
    {
        return $this->hasOne(SuratJalan::class);
    }
}
