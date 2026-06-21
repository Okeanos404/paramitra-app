<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_gudang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produk')->cascadeOnDelete();
            $table->foreignId('gudang_id')->constrained('gudang')->cascadeOnDelete();
            $table->integer('stok')->default(0);
            $table->timestamps();
            $table->unique(['produk_id', 'gudang_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_gudang');
    }
};
