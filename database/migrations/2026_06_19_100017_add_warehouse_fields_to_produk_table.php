<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->string('sku')->nullable()->unique();
            $table->decimal('harga_pokok', 15, 2)->nullable();
            $table->integer('reorder_level')->default(10);
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn(['sku', 'harga_pokok', 'reorder_level']);
        });
    }
};
