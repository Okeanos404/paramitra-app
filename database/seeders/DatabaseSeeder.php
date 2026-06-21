<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Paramitra',
            'email' => 'admin@paramitra.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Management
        User::create([
            'name' => 'Manager Paramitra',
            'email' => 'manager@paramitra.com',
            'password' => Hash::make('password'),
            'role' => 'manajemen',
        ]);

        // Customer
        $customer = User::create([
            'name' => 'Mitra Industri Utama',
            'email' => 'customer@paramitra.com',
            'password' => Hash::make('password'),
            'role' => 'pelanggan',
        ]);

        $customer->profile()->create([
            'nama_perusahaan' => 'PT Manufaktur Warna Abadi',
            'alamat' => 'Kawasan Industri Jababeka, Cikarang',
            'telepon' => '021-29368791',
        ]);

        // 1. Pigmen Organik
        $organik = [
            ['name' => 'Pigment Red 122', 'price' => 3500000],
            ['name' => 'Pigment Yellow 151', 'price' => 3200000],
            ['name' => 'Pigment Blue 15:3', 'price' => 2800000],
            ['name' => 'Pigment Green 7', 'price' => 3000000],
        ];
        foreach ($organik as $p) {
            Produk::create([
                'nama_produk' => $p['name'],
                'kategori' => 'Pigmen Organik',
                'harga' => $p['price'],
                'stok' => rand(50, 200),
                'deskripsi' => 'Bahan pewarna cerah dengan daya sebar tinggi untuk industri plastik dan tinta.',
                'image' => 'images/products/organic.png'
            ]);
        }

        // 2. Pigmen Anorganik
        $anorganik = [
            ['name' => 'Titanium Dioxide (TiO₂)', 'price' => 4500000],
            ['name' => 'Iron Oxide Red 130', 'price' => 1500000],
            ['name' => 'Iron Oxide Black 318', 'price' => 1600000],
            ['name' => 'Chrome Yellow', 'price' => 2200000],
        ];
        foreach ($anorganik as $p) {
            Produk::create([
                'nama_produk' => $p['name'],
                'kategori' => 'Pigmen Anorganik',
                'harga' => $p['price'],
                'stok' => rand(100, 500),
                'deskripsi' => 'Pigmen dengan ketahanan suhu dan cuaca ekstrem untuk industri cat dan bangunan.',
                'image' => 'images/products/inorganic.png'
            ]);
        }

        // 3. Solvent (Pelarut Industri)
        $solvent = [
            ['name' => 'Toluene Premium', 'price' => 1800000],
            ['name' => 'Xylene Industrial', 'price' => 1900000],
            ['name' => 'Ethyl Acetate', 'price' => 2100000],
            ['name' => 'Butyl Acetate', 'price' => 2300000],
        ];
        foreach ($solvent as $p) {
            Produk::create([
                'nama_produk' => $p['name'],
                'kategori' => 'Solvent',
                'harga' => $p['price'],
                'stok' => rand(200, 1000),
                'deskripsi' => 'Pelarut kimia industri berkualitas tinggi untuk pengencer cat dan coating.',
                'image' => 'images/products/solvent.png'
            ]);
        }

        // 4. Resin Industri
        $resin = [
            ['name' => 'Epoxy Resin Clear', 'price' => 5500000],
            ['name' => 'Polyester Resin', 'price' => 4200000],
            ['name' => 'Acrylic Resin Solution', 'price' => 4800000],
        ];
        foreach ($resin as $p) {
            Produk::create([
                'nama_produk' => $p['name'],
                'kategori' => 'Resin Industri',
                'harga' => $p['price'],
                'stok' => rand(30, 150),
                'deskripsi' => 'Bahan dasar perekat dan pelapis dengan daya rekat tinggi serta tahan kimia.',
                'image' => 'images/products/resin.png'
            ]);
        }
    }
}
