<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratJalan extends Model
{
    protected $table = 'surat_jalan';

    protected $fillable = [
        'pengiriman_id',
        'no_surat_jalan',
        'tanggal_surat',
        'alamat_pengiriman',
        'penerima_nama',
        'penerima_ttd',
        'waktu_penerimaan',
        'catatan_khusus',
        'status',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'waktu_penerimaan' => 'datetime',
    ];

    public function pengiriman(): BelongsTo
    {
        return $this->belongsTo(Pengiriman::class);
    }
}
