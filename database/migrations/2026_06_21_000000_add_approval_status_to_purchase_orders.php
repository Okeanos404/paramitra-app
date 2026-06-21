<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE purchase_orders MODIFY COLUMN status ENUM('pending_approval', 'approved', 'rejected', 'draft', 'sent', 'confirmed', 'partial_received', 'received', 'closed') DEFAULT 'pending_approval'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE purchase_orders MODIFY COLUMN status ENUM('draft', 'sent', 'confirmed', 'partial_received', 'received', 'closed') DEFAULT 'draft'");
    }
};
