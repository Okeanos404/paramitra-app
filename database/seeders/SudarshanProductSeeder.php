<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SudarshanProductSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan Supplier Sudarshan ada
        $supplier = Supplier::firstOrCreate(
            ['email' => 'contact@sudarshan.com'],
            [
                'nama_supplier' => 'Sudarshan Chemical Industries Ltd',
                'negara' => 'India',
                'alamat' => '162 Wellesley Road, Pune - 411001, Maharashtra, India',
                'telepon' => '+91-20-26226200',
                'kategori_supplier' => 'raw_material',
                'status' => 'active',
                'catatan' => 'Global Pigment Supplier untuk PT Paramitra'
            ]
        );

        // Tambahkan produk spesifik dari Sudarshan
        $products = [
            [
                'nama_produk' => 'Pigment Green 7',
                'kategori' => 'Pigmen Organik',
                'harga' => 125000.00,
                'stok' => 500,
                'deskripsi' => 'Pigmen hijau organik kualitas tinggi dari Sudarshan Chemical. Sangat cocok untuk industri cat tembok, tinta cetak, dan pewarnaan plastik. Memiliki daya tahan cuaca yang sangat baik.',
            ],
            [
                'nama_produk' => 'Sudacolour Red',
                'kategori' => 'Pigmen Organik',
                'harga' => 180000.00,
                'stok' => 300,
                'deskripsi' => 'Seri Sudacolour merah premium. Memberikan warna merah cerah yang tahan lama dengan stabilitas dispersi tinggi, ideal untuk aplikasi cat otomotif dan tinta.',
            ],
            [
                'nama_produk' => 'SudaPerm Yellow',
                'kategori' => 'Pigmen Organik',
                'harga' => 150000.00,
                'stok' => 450,
                'deskripsi' => 'Pigmen kuning organik untuk cat dan plastik. Memiliki kekuatan warna (tinting strength) yang tinggi dan opacity yang baik.',
            ],
            [
                'nama_produk' => 'SudaFast Blue',
                'kategori' => 'Pigmen untuk Tinta dan Plastik',
                'harga' => 140000.00,
                'stok' => 600,
                'deskripsi' => 'Pigmen biru organik yang didesain khusus untuk pewarnaan masterbatch plastik dan tinta packaging.',
            ]
        ];

        foreach ($products as $prod) {
            $createdProduct = Produk::firstOrCreate(
                ['nama_produk' => $prod['nama_produk']],
                $prod
            );

            // Hubungkan ke supplier_products jika tabelnya ada
            if (Schema::hasTable('supplier_products')) {
                DB::table('supplier_products')->updateOrInsert(
                    ['supplier_id' => $supplier->id, 'produk_id' => $createdProduct->id],
                    ['harga_supplier' => $prod['harga'] * 0.8, 'lead_time_hari' => 30, 'minimum_order' => 100]
                );
            }
        }
    }
}
