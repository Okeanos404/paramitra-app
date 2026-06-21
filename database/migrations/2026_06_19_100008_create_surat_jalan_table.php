<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_jalan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengiriman_id')->constrained('pengiriman')->cascadeOnDelete();
            $table->string('no_surat_jalan')->unique();
            $table->date('tanggal_surat');
            $table->text('alamat_pengiriman');
            $table->string('penerima_nama');
            $table->string('penerima_ttd')->nullable();
            $table->datetime('waktu_penerimaan')->nullable();
            $table->text('catatan_khusus')->nullable();
            $table->enum('status', ['draft', 'terbit', 'diterima'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_jalan');
    }
};
