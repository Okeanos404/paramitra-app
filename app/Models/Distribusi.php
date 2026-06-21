<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    protected $table = 'distribusi';

    protected $fillable = [
        'pengiriman_id',
        'lokasi_terkini',
        'catatan',
    ];

    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class);
    }
}
