<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupplierProduct extends Model
{
    protected $table = 'supplier_products';

    protected $fillable = [
        'supplier_id',
        'produk_id',
        'harga_supplier',
        'satuan',
        'lead_time_hari',
        'minimum_order',
        'kode_supplier',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}
