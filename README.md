<div align="center">
  <h1>🏢 Paramitra ERP System</h1>
  <p>Sistem Manajemen Perusahaan Terpadu yang Dirancang Otomatis & Mudah Digunakan</p>
  
  <p>
    <img src="https://img.shields.io/badge/Status-Siap%20Pakai-brightgreen?style=for-the-badge" alt="Status" />
    <img src="https://img.shields.io/badge/Lisensi-MIT-blue?style=for-the-badge" alt="License" />
    <img src="https://img.shields.io/badge/Bahasa-Indonesia-orange?style=for-the-badge" alt="Language" />
  </p>
</div>

---

## 👋 Tentang Aplikasi Ini
Selamat datang di repositori resmi **Sistem Aplikasi PT Paramitra Praya Prawatya**. 
Aplikasi ini dibuat khusus untuk mengubah cara kerja kantor yang tadinya manual (pakai buku/kertas) menjadi serba otomatis di dalam komputer. Mulai dari urusan pesanan pelanggan, kirim-mengirim barang, belanja ke pabrik, sampai menghitung keuntungan bersih bulanan—semuanya dikerjakan oleh sistem.

Meski punya fitur kelas kakap, sistem ini sengaja dirancang agar **sangat mudah dipahami** oleh siapa saja, bahkan oleh staf yang jarang memakai komputer.

---

## ✨ Keunggulan & Fitur Utama

Sistem ini melayani 3 kelompok orang sekaligus: **Pimpinan (Bos)**, **Staf Kantor (Admin)**, dan **Pelanggan**.

### 🛒 1. Belanja & Pemesanan yang Bebas Repot
- **Katalog Online untuk Pelanggan**: Pelanggan bisa melihat daftar barang, harga, sisa stok, dan memesan langsung lewat keranjang belanja.
- **Formulir Kilat untuk Staf**: Kalau ada pelanggan yang pesan lewat telepon, Staf punya formulir khusus. Staf bisa memasukkan puluhan jenis barang sekaligus dengan sangat cepat tanpa perlu memuat ulang halaman.

### 🧾 2. Surat Jalan Pintar (Pakai Kode QR) & Tagihan Otomatis
- **Tagihan (Invoice) Sekali Klik**: Begitu Staf mengonfirmasi pembayaran pelanggan, sistem langsung mencetak Surat Tagihan PDF yang sangat rapi.
- **Konfirmasi Surat Jalan via HP**: Ketika barang dikirim, surat jalannya dilengkapi dengan **Kode QR** (kotak-kotak *barcode*). Setiba di lokasi, pelanggan cukup menyorot Kode QR itu pakai kamera HP untuk mengonfirmasi tanda terima. Tidak perlu lagi tanda tangan di kertas! Komputer di kantor akan langsung tahu bahwa barang sudah selamat sampai tujuan.

### 🏭 3. Mengatur Gudang & Belanja ke Pabrik
- **Pesan ke Pabrik (Purchase Order)**: Staf bisa membuat surat pesanan resmi ke pabrik penyedia barang dan mencatatnya.
- **Stok Tiga Gudang**: Mendukung pencatatan untuk Gudang Pusat (Jakarta), Gudang Regional (Surabaya), dan Gudang Distribusi (Medan). Kita juga bisa memindahkan barang antar gudang tanpa takut stoknya selisih.
- **Otomatis Masuk Gudang**: Begitu kiriman pabrik tiba, staf tinggal tekan "Terima", dan angka persediaan barang di gudang langsung bertambah sendiri.

### 📊 4. Papan Laporan Khusus Pimpinan
- **Grafik Warna-Warni**: Pimpinan bisa melihat perbandingan Uang Masuk dan Uang Keluar lewat grafik tiang yang bergerak indah.
- **Hitung Untung Rugi Sendiri**: Sistem otomatis mengurangi total hasil penjualan dengan total biaya belanja, sehingga angka Keuntungan Bersih (Laba/Rugi) langsung terpampang jelas di layar.
- **Hemat Tinta Printer**: Kalau pimpinan mau mencetak laporan keuangan ke kertas, tampilan gelap di layar akan otomatis berubah jadi latar putih dengan tulisan hitam pekat. Sangat menghemat tinta!

---

## 🚀 Cara Menjalankan Sistem di Komputer Anda

Sistem ini sangat mudah dipasang. Ikuti langkah sederhana berikut:

1. Pastikan Anda sudah menginstal aplikasi server lokal seperti **Laragon** atau **XAMPP**.
2. Masukkan folder proyek ini ke dalam folder `www` (kalau pakai Laragon) atau `htdocs` (kalau pakai XAMPP).
3. Buka aplikasi Laragon/XAMPP, lalu klik tombol **Mulai** (Start All).
4. Buka penjelajah internet (Google Chrome / Edge) dan ketik alamat ini di bagian atas:
   ```text
   http://localhost/paramitra-app/public
   ```

### 🔑 Akun Uji Coba Tersedia
Anda bisa mencoba masuk ke dalam sistem menggunakan akun-akun berikut (Semua kata sandinya adalah: **password**):
- **Staf Kantor (Admin)**: `admin@paramitra.com`
- **Pimpinan (Manajemen)**: `management@paramitra.com`
- **Pelanggan Umum**: `customer@example.com`

---

## 📂 Dokumen Panduan Lainnya
Jika Anda ingin membaca lebih jauh tentang bagaimana cara kerja sistem ini, silakan klik dokumen berikut yang sudah kami siapkan:
- 📖 [Alur Kerja Sistem (Lengkap)](ALUR_SISTEM_LENGKAP.md)
- 📖 [Panduan Penerapan di Kantor](ERP_IMPLEMENTATION_GUIDE.md)
- 📖 [Rangkuman Hasil Pekerjaan](IMPLEMENTATION_SUMMARY.md)

---
*Dibuat dengan komitmen tinggi untuk kemajuan bisnis PT Paramitra Praya Prawatya.* 🚀
