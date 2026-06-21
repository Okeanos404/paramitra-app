<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->cascadeOnDelete();
            $table->string('invoice_number')->nullable()->unique();
            $table->enum('payment_status', ['pending_payment', 'paid', 'overdue', 'cancelled'])->default('pending_payment');
            $table->date('due_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropForeignIdFor('payment_methods');
            $table->dropColumn(['payment_method_id', 'invoice_number', 'payment_status', 'due_date']);
        });
    }
};
