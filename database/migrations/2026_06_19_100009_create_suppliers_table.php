<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_supplier')->unique();
            $table->string('negara');
            $table->text('alamat');
            $table->string('telepon');
            $table->string('email')->unique();
            $table->string('npwp')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->enum('kategori_supplier', ['raw_material', 'equipment', 'service', 'lainnya'])->default('raw_material');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
