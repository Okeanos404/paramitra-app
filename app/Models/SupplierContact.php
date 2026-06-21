<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupplierContact extends Model
{
    protected $table = 'supplier_contacts';

    protected $fillable = [
        'supplier_id',
        'nama_kontak',
        'posisi',
        'telepon',
        'email',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
