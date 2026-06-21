<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transfer_barang', function (Blueprint $table) {
            $table->id();
            $table->string('no_transfer')->unique();
            $table->foreignId('dari_gudang_id')->constrained('gudang')->cascadeOnDelete();
            $table->foreignId('ke_gudang_id')->constrained('gudang')->cascadeOnDelete();
            $table->date('tanggal_transfer');
            $table->enum('status', ['draft', 'approved', 'sent', 'received'])->default('draft');
            $table->string('penerima_nama')->nullable();
            $table->string('penerima_ttd')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transfer_barang');
    }
};
