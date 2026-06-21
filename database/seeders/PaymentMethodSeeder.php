<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            // Bank Transfer / VA
            [
                'nama_metode' => 'Virtual Account BCA',
                'tipe' => 'bank_transfer',
                'deskripsi' => '8077-8899-0011-2233',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_metode' => 'Virtual Account Bank Mandiri',
                'tipe' => 'bank_transfer',
                'deskripsi' => '89021-4455-6677-8899',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_metode' => 'Virtual Account BRI',
                'tipe' => 'bank_transfer',
                'deskripsi' => '1234-5678-9012-3456',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // E-Wallet
            [
                'nama_metode' => 'DANA',
                'tipe' => 'e_wallet',
                'deskripsi' => '0812-3456-7890',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_metode' => 'OVO',
                'tipe' => 'e_wallet',
                'deskripsi' => '0812-3456-7890',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_metode' => 'Go-Pay',
                'tipe' => 'e_wallet',
                'deskripsi' => '0812-3456-7890',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_metode' => 'Shopee-Pay',
                'tipe' => 'e_wallet',
                'deskripsi' => '0812-3456-7890',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        if (Schema::hasTable('payment_methods')) {
            // Optional: Truncate existing defaults to avoid duplicates if user reruns
            // DB::table('payment_methods')->truncate(); 
            // Actually it's safer to just insert them if they don't exist
            
            foreach ($methods as $method) {
                DB::table('payment_methods')->updateOrInsert(
                    ['nama_metode' => $method['nama_metode']],
                    $method
                );
            }
        }
    }
}
