<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gudang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gudang')->unique();
            $table->string('lokasi');
            $table->text('alamat');
            $table->string('telepon')->nullable();
            $table->enum('tipe', ['pusat', 'regional', 'distribusi'])->default('regional');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gudang');
    }
};
