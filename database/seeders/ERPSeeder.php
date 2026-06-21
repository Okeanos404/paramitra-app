<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gudang;
use App\Models\Supplier;
use App\Models\SupplierContact;
use App\Models\Produk;
use App\Models\SupplierProduct;
use App\Models\PaymentMethod;

class ERPSeeder extends Seeder
{
    public function run(): void
    {
        // Create Warehouses
        $gudangPusat = Gudang::create([
            'nama_gudang' => 'Gudang Pusat Jakarta',
            'lokasi' => 'Jakarta Selatan',
            'alamat' => 'Jalan Merdeka No. 123, Jakarta Selatan',
            'telepon' => '(021) 123-4567',
            'tipe' => 'pusat',
            'status' => 'active',
        ]);

        $gudangRegional = Gudang::create([
            'nama_gudang' => 'Gudang Regional Surabaya',
            'lokasi' => 'Surabaya',
            'alamat' => 'Jalan Diponegoro No. 456, Surabaya',
            'telepon' => '(031) 234-5678',
            'tipe' => 'regional',
            'status' => 'active',
        ]);

        $gudangDistribusi = Gudang::create([
            'nama_gudang' => 'Gudang Distribusi Medan',
            'lokasi' => 'Medan',
            'alamat' => 'Jalan Katamso No. 789, Medan',
            'telepon' => '(061) 345-6789',
            'tipe' => 'distribusi',
            'status' => 'active',
        ]);

        // Create Payment Methods
        PaymentMethod::create([
            'nama_metode' => 'Tunai',
            'deskripsi' => 'Pembayaran tunai di tempat',
            'tipe' => 'cash',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'nama_metode' => 'Transfer Bank',
            'deskripsi' => 'Transfer melalui rekening bank',
            'tipe' => 'bank_transfer',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'nama_metode' => 'Giro',
            'deskripsi' => 'Pembayaran via giro',
            'tipe' => 'giro',
            'is_active' => true,
        ]);

        // Create Sudarshan Chemical Industries Ltd
        $sudarshan = Supplier::create([
            'nama_supplier' => 'Sudarshan Chemical Industries Ltd',
            'negara' => 'India',
            'alamat' => 'Sudarshan House, 23-B Akurdi, Pune 411035, India',
            'telepon' => '+91-20-27127000',
            'email' => 'info@sudarshan.com',
            'npwp' => 'N/A',
            'nama_bank' => 'ICICI Bank',
            'nomor_rekening' => '0123456789',
            'kategori_supplier' => 'raw_material',
            'status' => 'active',
            'catatan' => 'Supplier pigmen organik dan pewarna industri terkemuka dari India',
        ]);

        // Add supplier contacts
        SupplierContact::create([
            'supplier_id' => $sudarshan->id,
            'nama_kontak' => 'Rajesh Kumar',
            'posisi' => 'Sales Manager',
            'telepon' => '+91-9876543210',
            'email' => 'rajesh@sudarshan.com',
        ]);

        SupplierContact::create([
            'supplier_id' => $sudarshan->id,
            'nama_kontak' => 'Priya Sharma',
            'posisi' => 'Export Coordinator',
            'telepon' => '+91-9876543211',
            'email' => 'priya@sudarshan.com',
        ]);

        // Get existing products or create new ones
        $pigmentGreen = Produk::where('nama_produk', 'like', '%Pigment Green%')->first()
            ?? Produk::create([
                'nama_produk' => 'Pigment Green 7',
                'kategori' => 'Pigmen Organik',
                'harga' => 350000,
                'stok' => 0,
                'sku' => 'PG-007',
                'harga_pokok' => 250000,
                'reorder_level' => 50,
                'deskripsi' => 'Pigmen hijau organik untuk cat dan coating',
            ]);

        $sudacolour = Produk::where('nama_produk', 'like', '%Sudacolour%')->first()
            ?? Produk::create([
                'nama_produk' => 'Sudacolour Red',
                'kategori' => 'Pigmen Organik',
                'harga' => 400000,
                'stok' => 0,
                'sku' => 'SC-RED',
                'harga_pokok' => 280000,
                'reorder_level' => 50,
                'deskripsi' => 'Pigmen merah organik Sudacolour untuk tinta dan plastik',
            ]);

        $pigmenCat = Produk::where('nama_produk', 'like', '%Cat%Organik%')->first()
            ?? Produk::create([
                'nama_produk' => 'Pigmen Organik untuk Cat',
                'kategori' => 'Pigmen Organik',
                'harga' => 300000,
                'stok' => 0,
                'sku' => 'PO-CAT',
                'harga_pokok' => 220000,
                'reorder_level' => 100,
                'deskripsi' => 'Berbagai jenis pigmen organik untuk industry cat',
            ]);

        // Link products to supplier
        SupplierProduct::create([
            'supplier_id' => $sudarshan->id,
            'produk_id' => $pigmentGreen->id,
            'harga_supplier' => 250000,
            'satuan' => 'kg',
            'lead_time_hari' => 30,
            'minimum_order' => 100,
            'kode_supplier' => 'PG-007-IND',
        ]);

        SupplierProduct::create([
            'supplier_id' => $sudarshan->id,
            'produk_id' => $sudacolour->id,
            'harga_supplier' => 280000,
            'satuan' => 'kg',
            'lead_time_hari' => 30,
            'minimum_order' => 100,
            'kode_supplier' => 'SC-RED-IND',
        ]);

        SupplierProduct::create([
            'supplier_id' => $sudarshan->id,
            'produk_id' => $pigmenCat->id,
            'harga_supplier' => 220000,
            'satuan' => 'kg',
            'lead_time_hari' => 30,
            'minimum_order' => 200,
            'kode_supplier' => 'PO-CAT-IND',
        ]);

        // Initialize product stocks in warehouses
        $gudangPusat->produk()->attach($pigmentGreen->id, ['stok' => 500]);
        $gudangPusat->produk()->attach($sudacolour->id, ['stok' => 300]);
        $gudangPusat->produk()->attach($pigmenCat->id, ['stok' => 200]);

        $gudangRegional->produk()->attach($pigmentGreen->id, ['stok' => 200]);
        $gudangRegional->produk()->attach($sudacolour->id, ['stok' => 150]);
        $gudangRegional->produk()->attach($pigmenCat->id, ['stok' => 100]);

        $gudangDistribusi->produk()->attach($pigmentGreen->id, ['stok' => 100]);
        $gudangDistribusi->produk()->attach($sudacolour->id, ['stok' => 75]);
        $gudangDistribusi->produk()->attach($pigmenCat->id, ['stok' => 50]);

        // Update product stok field to total
        $pigmentGreen->update(['stok' => 800]);
        $sudacolour->update(['stok' => 525]);
        $pigmenCat->update(['stok' => 350]);
    }
}
