# 📚 BUKU PANDUAN LENGKAP SISTEM ERP PARAMITRA

Dokumen ini merupakan gabungan dari seluruh dokumentasi dan panduan yang ada di proyek ini agar lebih rapih dan tersentralisasi dalam satu file `README.md`.

## 📑 Daftar Isi

1. [Deskripsi Proyek (README)](#1-deskripsi-proyek-readme)
2. [Panduan Memulai Cepat](#2-panduan-memulai-cepat)
3. [Alur Sistem Lengkap](#3-alur-sistem-lengkap)
4. [Panduan Implementasi ERP](#4-panduan-implementasi-erp)
5. [Ringkasan Implementasi](#5-ringkasan-implementasi)
6. [Implementasi P400 Paramitra](#6-implementasi-p400-paramitra)
7. [Cara Pindah Device (Migrasi)](#7-cara-pindah-device-migrasi)
8. [Skenario Presentasi Dosen](#8-skenario-presentasi-dosen)


---

# 1. Deskripsi Proyek (README)

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
- **Otomatis Masuk Gudang**: Begitu kiriman pabrik tiba, staf tinggal mengeklik "Terima Barang Fisik", mengisi formulir pengecekan barang secara aktual, lalu menekan "Simpan". Angka persediaan barang di gudang dan laporan pengeluaran akan langsung diperbarui secara otomatis.

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


---

# 2. Panduan Memulai Cepat

Buku panduan singkat ini dibuat agar Anda bisa langsung mencoba sistem PT Paramitra tanpa kebingungan.

---

## 1️⃣ Menyalakan Sistem
1. Pastikan aplikasi komputer lokal seperti **Laragon** atau **XAMPP** sudah menyala (Klik **Start All**).
2. Pastikan Anda telah terhubung ke jaringan internet (jika ingin melihat ikon-ikon muncul dengan sempurna).
3. Buka jendela peramban (Google Chrome, Microsoft Edge, atau Safari).
4. Ketik alamat ini persis di bagian atas layar pencarian:  
   `http://localhost/paramitra-app/public`

---

## 2️⃣ Coba Masuk Sebagai Admin (Staf Kantor)
Silakan coba rasakan pengalaman menjadi Staf Operasional Perusahaan.
- Pada halaman masuk (Login), masukkan **Email**: `admin@paramitra.com`
- Masukkan **Kata Sandi**: `password`
- Tekan Masuk.

**Apa yang bisa Anda coba di sini?**
- Klik menu **"Transaksi"** di sebelah kiri.
- Tekan tombol **"Buat Pesanan"** yang berwarna biru di pojok kanan atas.
- Coba tekan tombol **"+ Tambah Produk Lain"** berkali-kali. Anda akan melihat seberapa ajaibnya formulir pesanan ini bisa bertambah ke bawah tanpa macet.
- Pilih barang dan jumlahnya, lalu tekan "Buat Pesanan".

---

## 3️⃣ Coba Proses Pengiriman Surat Jalan Pakai Kode QR
Masih menggunakan akun Admin:
1. Pergi ke menu **"Pengiriman"** di sebelah kiri.
2. Jika ada pesanan yang siap dikirim, tekan tombol **"Proses Pengiriman"**.
3. Sistem akan memunculkan nomor resi. 
4. Sekarang, klik menu **"Surat Jalan"** di sebelah kiri. 
5. Klik tombol **"Cetak DO / QR"** pada data surat jalan yang baru saja terbentuk. 
6. Anda akan melihat sebuah lembar dokumen resmi yang ada gambar kotak **Kode QR**-nya! (Inilah yang nantinya akan disorot oleh HP pelanggan saat barang tiba).

---

## 4️⃣ Coba Masuk Sebagai Pimpinan (Manajemen)
Sekarang, coba log out (keluar) dari akun Admin, lalu rasakan pengalaman menjadi Pimpinan Perusahaan.
- **Email**: `management@paramitra.com`
- **Kata Sandi**: `password`

**Apa yang bisa Anda lihat di sini?**
- Di halaman pertama, Anda akan disambut oleh **Grafik Batang Berwarna** yang memaparkan hasil kerja keras tim Anda bulan ini (Uang Masuk vs Uang Keluar).
- Beralihlah ke menu **"Laporan"** di sebelah kiri.
- Gulir layar ke paling bawah. Anda akan melihat hitungan **Total Laba Bersih** (Keuntungan murni perusahaan) yang sudah dihitung secara otomatis oleh mesin.
- Tekan tombol **"Cetak PDF"** atau "Ctrl + P" di komputer Anda, dan perhatikan bagaimana warna laporan berubah jadi hitam-putih ramah *printer*.

---
**Selesai!** Anda kini sudah menguasai cara-cara paling penting dalam menggunakan sistem Paramitra. Mudah, bukan? 🚀


---

# 3. Alur Sistem Lengkap

<div align="center">
  <p>Penjelasan langkah demi langkah bagaimana operasional PT Paramitra Praya Prawatya berjalan dari awal hingga akhir menggunakan sistem terpadu.</p>
</div>

---

## 🎯 Gambaran Umum

Aplikasi ini meniru siklus hidup bisnis yang sesungguhnya. Seluruh urusan saling menyambung seperti mata rantai: dari kita membeli barang ke pabrik, menyimpannya di gudang, sampai kita berhasil menjualnya ke pelanggan dan menghitung keuntungan.

Sistem dirancang untuk tiga kelompok pengguna utama:
1. **Staf Operasional (Admin)**: Mengurus persediaan barang, memproses pesanan, mengatur pengiriman, dan belanja ke pabrik.
2. **Pimpinan Perusahaan (Manajemen)**: Memantau ringkasan keuangan, melihat tingkat keuntungan, dan mengawasi kegiatan bisnis dari satu layar.
3. **Pelanggan**: Memiliki akses masuk sendiri untuk berbelanja layaknya di toko daring (*online shop*) dan melacak keberadaan paket mereka.

---

## 🔄 URUTAN CARA KERJA SISTEM

Berikut adalah urutan kegiatan harian dari hulu ke hilir:

### **TAHAP 1: BELI BARANG KE PABRIK** 
*(Dilakukan oleh: Staf Operasional)*

1. Staf membuka menu "Pesanan Pembelian" lalu memilih pabrik tujuan (Contoh: Pabrik Sudarshan).
2. Staf memasukkan jenis dan jumlah barang yang ingin dibeli, lalu menekan tombol "Kirim".
3. Setelah paket kiriman tiba di kantor, Staf menekan tombol **"Terima Barang Fisik"**.
4. **Wajib Isi Formulir:** Staf akan dihadapkan pada formulir pengecekan untuk mencocokkan jumlah barang fisik. Staf harus mengisi jumlah yang benar dan menekan **"Simpan & Update Stok"**.
5. **Proses Otomatis:** Detik itu juga, jumlah barang di dalam "Gudang Pusat" kita akan langsung bertambah. Di saat yang sama, uang perusahaan yang terpakai untuk beli barang itu akan sah tercatat dan langsung masuk ke Laporan Pengeluaran.

---

### **TAHAP 2: MENERIMA PESANAN PELANGGAN**
Ada dua cara pesanan bisa masuk ke sistem kita:

**Jalur Mandiri (Pelanggan berbelanja sendiri):**
1. Pelanggan masuk ke situs kita, memilih barang dari Katalog, lalu memasukkannya ke Keranjang Belanja.
2. Pelanggan memproses keranjangnya dan memilih cara bayar.

**Jalur Cepat (Staf yang tolong isikan):**
*(Sangat berguna untuk pelanggan yang memesan via telepon atau WhatsApp)*
1. Staf membuka menu Transaksi dan menekan tombol "Buat Pesanan Baru".
2. Staf akan dihadapkan pada formulir canggih. Staf bisa mengeklik **"Tambah Produk Lain"** berkali-kali untuk menyusun banyak barang sekaligus secara instan tanpa perlu repot.
3. Pesanan langsung tercatat dan masuk ke status "Menunggu Pembayaran".

---

### **TAHAP 3: MENERIMA UANG & MENCETAK TAGIHAN**
*(Dilakukan oleh: Staf Operasional)*

1. Begitu ada pelanggan yang mengabarkan sudah transfer uang, Staf akan mencari pesanan orang tersebut.
2. Staf cukup mengeklik satu tombol ajaib: **"ACC Bayar"**.
3. **Proses Otomatis:** Sistem akan seketika membuatkan **Surat Tagihan (Invoice) PDF Resmi** yang rapi. Status pesanan berubah menjadi "Lunas", dan uang dari hasil jualan itu otomatis masuk ke catatan Laporan Pemasukan.

---

### **TAHAP 4: MENGIRIM BARANG & SCAN KODE QR**
*(Dilakukan oleh: Staf Logistik & Pelanggan)*

1. Barang yang sudah lunas siap dikirim. Staf Gudang menekan tombol **"Proses Pengiriman"**.
2. **Proses Otomatis:** Sistem akan langsung mencetak dua hal: Nomor Pelacakan (Resi) dan **Surat Jalan Pengiriman Berformat PDF**.
3. **Kecanggihan Kode QR:** 
   - Di kertas Surat Jalan tersebut, sistem telah membuatkan gambar kotak Kode QR. 
   - Sopir membawa Surat Jalan beserta paket ke rumah pelanggan.
   - Setibanya di sana, pelanggan cukup membuka kamera HP mereka dan **menyorot (scan) Kode QR** tersebut.
   - Di HP pelanggan akan muncul tombol "Barang Diterima". Saat pelanggan mengekliknya, komputer di kantor pusat akan langsung tahu dan statusnya berubah jadi selesai. Sopir tidak perlu lapor via telepon lagi!

---

## 📈 FASILITAS MANAJEMEN & KEUANGAN (UNTUK PIMPINAN)

Pimpinan perusahaan (Bos) tidak perlu pusing melihat tabel yang panjang. Sistem ini menyuguhkan kemewahan berikut:

1. **Grafik Berwarna:** Di halaman awal Pimpinan, ada grafik balok tinggi rendah yang memperlihatkan perbandingan jumlah uang masuk melawan uang keluar.
2. **Hitung Untung/Rugi Sendiri:** Ada satu halaman khusus bernama Laporan Gabungan. Sistem otomatis mengumpulkan semua pendapatan, menguranginya dengan semua pengeluaran pabrik, dan menampilkan tulisan **Total Keuntungan Bersih** di paling bawah secara jujur.
3. **Cetak Tanpa Boros Tinta:** Kalau laporan keuangan itu mau diprint ke kertas, sistem akan menyesuaikan diri. Warna latar belakang gelap otomatis hilang, dan tulisan berubah jadi hitam pekat agar tinta *printer* kantor awet.
4. **Buku Arsip Digital:** Arsip bulan-bulan lalu tidak ditumpuk sembarangan. Tersedia halaman khusus di mana Pimpinan bisa berpindah dari ruangan "Arsip Uang Masuk" ke "Arsip Uang Keluar" semudah menekan tombol.

---

## 📦 PENGATURAN GUDANG TINGKAT LANJUT

1. **Pemindahan Barang:** Kita bisa memindahkan 50 sak barang dari Gudang Jakarta menuju Gudang Surabaya. Sistem akan mencatat barang keluar dan masuk dengan seimbang tanpa ada persediaan yang "menguap".
2. **Peringatan Stok Tipis:** Setiap barang punya batas minimal. Kalau stok hampir habis, sistem akan memberikan tanda peringatan agar Staf segera memesan lagi ke pabrik.

---

Dengan mengikuti alur di atas, seluruh rutinitas perusahaan menjadi sangat transparan, tercatat rapi, dan tak perlu lagi bergantung pada ingatan manual! 🚀


---

# 4. Panduan Implementasi ERP

<div align="center">
  <p>Panduan lengkap penerapan perangkat lunak terpadu untuk keseharian operasional PT Paramitra Praya Prawatya.</p>
</div>

---

## 🌟 KATA PENGANTAR

Buku panduan ini ditulis tanpa menggunakan istilah komputer yang rumit, agar seluruh lapisan karyawan dari direktur hingga staf gudang dapat memahami bagaimana cara kerja baru perusahaan kita.

Setiap alat dan tombol di dalam sistem ini saling berhubungan. Jika satu orang menyelesaikan tugasnya dengan benar, tugas orang berikutnya akan otomatis menjadi lebih ringan.

---

## 1. MENU PELAYANAN PELANGGAN (TRANSAKSI)

Ini adalah jantung dari kegiatan operasional. Di dalam menu **Transaksi**, kita mengurus semua orang yang ingin membeli barang.

### ✅ Pemesanan Lincah
Dulu kita menulis pesanan di kertas atau nota. Sekarang, ketika ada pelanggan menelepon, staf cukup membuka layar **"Buat Pesanan Baru"**.
Tombol **"Tambah Produk Lain"** adalah fitur ajaib. Staf bisa menekannya belasan kali tanpa membuat komputer lambat, sehingga ratusan pesanan dapat tercatat rapi dalam hitungan detik.

### ✅ Penagihan Pintar (Invoice Otomatis)
Staf tidak perlu lagi pusing menghitung total harga di kalkulator, menambah biaya pajak, lalu mengetiknya di Microsoft Word.
Ketika pelanggan menyatakan telah mentransfer pembayaran ke bank kita, staf cukup menekan tombol **"ACC Bayar"**. 
Tugas staf selesai! Komputer akan langsung mengetik lembar Surat Tagihan Resmi (Invoice PDF) dan merapikan catatan keuangan masuk secara otomatis.

---

## 2. MENU GUDANG & PENGIRIMAN BARANG

Barang yang sudah lunas siap untuk diantarkan oleh kurir ke alamat pelanggan. Di sinilah kehebatan menu **Logistik (Pengiriman)** bekerja.

### ✅ Pembuatan Surat Jalan Otomatis
Staf gudang tidak usah lagi menyalin ulang alamat pelanggan atau menulis daftar barang di buku besar.
Saat paket siap diberangkatkan, staf gudang menekan tombol **"Proses Pengiriman"**.
Komputer akan langsung mencetak lembar berharga bernama **Surat Jalan Pengiriman**. Lembaran ini sudah berisi data pelanggan lengkap, daftar rincian barang, dan sebuah gambar kotak **Kode QR** (Barcode) unik di sudut kertasnya.

### ✅ Penyelesaian Pengiriman Canggih (Kode QR)
Ini adalah fitur unggulan untuk mempermudah pekerjaan sopir/kurir. 
Sopir membawa kertas Surat Jalan tadi ke rumah pelanggan. Begitu paket diserahkan, pelanggan cukup memindai (menyorot) gambar Kode QR di kertas tersebut dengan kamera telepon genggam mereka.
Begitu pelanggan menekan tombol Setuju di layar HP mereka, detik itu juga warna status pengiriman di komputer kantor pusat akan berubah menjadi "Selesai" (Barang Telah Diterima).
Mulai saat ini, sopir tidak perlu membuang pulsa untuk menelepon kantor setiap kali barang sampai!

---

## 3. MENU PENGADAAN & BELANJA (SUPPLY CHAIN)

Sebuah perusahaan tidak hanya menjual, namun juga perlu membeli persediaan. Sistem kita menyediakan fitur **Pesanan Pembelian**.

### ✅ Catatan Kontak Pabrik
Kita tidak perlu lagi mencari kartu nama pabrik penyedia bahan baku. Sistem memiliki menu "Buku Catatan Pemasok" yang menyimpan rincian nama pabrik (Misalnya: Pabrik Sudarshan dari India), beserta nomor teleponnya.

### ✅ Barang Tiba, Otomatis Masuk Gudang
Staf membuat pesanan pembelian kepada pabrik menggunakan sistem.
Ketika kapal kargo atau truk pabrik tiba membawa barang yang kita pesan, Staf hanya perlu menekan tombol **"Terima Barang Fisik"** di sistem.
Ini akan memunculkan **Formulir Pengecekan Fisik**. Staf harus mengisi jumlah asli barang yang datang, lalu mengeklik tombol **"Simpan & Update Stok"**.
Kejadian ini akan memicu dua hal hebat sekaligus secara otomatis:
1. Jumlah persediaan barang kita di dalam "Gudang Pusat" seketika bertambah.
2. Uang pengeluaran perusahaan untuk membayar pabrik menjadi sah, dan langsung ditambahkan ke dalam buku Laporan Pengeluaran.

---

## 4. RUANG KEPEMIMPINAN (DASHBOARD BOS)

Bagi jajaran direksi dan manajemen tingkat atas, sistem ini adalah teropong bisnis yang paling canggih dan jujur.

### ✅ Dasbor yang Bergerak (Grafik Animasi)
Layar pertama yang menyambut Pimpinan adalah tiang-tiang grafik yang merangkum hasil kerja keras seluruh perusahaan secara waktu nyata (langsung saat itu juga). Uang masuk disandingkan dengan uang keluar agar arah perusahaan terlihat terang benderang.

### ✅ Kalkulator Laba Bersih
Sistem telah dilengkapi halaman "Laporan Gabungan". Di dasar tabel yang panjang, komputer telah memotong seluruh pendapatan kotor dengan biaya pengeluaran untuk memunculkan angka **Total Laba Bersih**. Sangat transparan dan akurat.

### ✅ Hemat Kertas & Tinta Cetak
Kami memahami dokumen keuangan terkadang harus diserahkan secara fisik di atas meja direksi. Jangan ragu menekan fungsi cetak *(Print)*. Sistem akan menonaktifkan seluruh warna gelap dan latar belakang dari komputer, menggantinya menjadi latar putih bening dan tinta hitam pekat agar ramah untuk semua jenis mesin *Printer* kantor.

---

**Selamat datang di era baru PT Paramitra Praya Prawatya yang sepenuhnya digital, tertib, dan lincah!** 🚀


---

# 5. Ringkasan Implementasi

<div align="center">
  <p>Laporan resmi mengenai seluruh pekerjaan pembaruan yang telah berhasil diselesaikan hingga tahap akhir (100% Selesai).</p>
</div>

---

## 📋 DAFTAR FITUR YANG BERHASIL DIBANGUN

### ✅ 1. Fitur Keranjang Belanja & Pesanan Praktis
- **Untuk Pelanggan**: Tersedia fitur keranjang belanja mandiri yang sangat mudah dipakai layaknya berbelanja di toko *online* pada umumnya.
- **Untuk Staf Operasional**: Kami merancang ulang formulir pesanan di sisi Staf. Kini staf dapat menekan tombol "Tambah Baris Barang" berkali-kali ke bawah, membuat pencatatan puluhan produk dalam satu pesanan menjadi urusan hitungan detik.
- **Persetujuan Pembayaran Sekali Klik**: Tombol "Setujui Pembayaran" kini mengambil alih tiga tugas berat: mengesahkan uang masuk, merubah status pesanan jadi lunas, dan menerbitkan Surat Tagihan berlogo perusahaan seketika itu juga.

### ✅ 2. Keajaiban Pengiriman & Kode QR
- Pekerjaan bagian pengiriman telah dirombak drastis. Ketika staf mengeklik "Proses Pengiriman", dua lembar penting langsung tercipta secara ajaib: Nomor Resi Pelacakan dan Dokumen Surat Jalan.
- **Pencapaian Besar (Kode QR):** Kertas Surat Jalan PDF perusahaan kini dilengkapi dengan Kode QR pintar. Kurir lapangan cukup meminta pelanggan mengarahkan kamera HP ke kertas tersebut saat paket tiba. Persetujuan lewat HP pelanggan akan langsung memberi sinyal ke komputer kantor pusat bahwa tugas pengiriman sukses dituntaskan hari itu juga.

### ✅ 3. Tata Kelola Belanja ke Pabrik
- Staf perusahaan memiliki buku daftar kontak pabrik secara rapi (contoh: Pabrik Sudarshan).
- Pemesanan penambahan stok barang baru kini didokumentasikan rapi. Dan yang terpenting, saat barang dari pabrik tiba, sistem akan langsung menuangkan angka stok barang tersebut ke "Gudang Pusat", lalu mendaftarkan biayanya ke buku pengeluaran perusahaan secara otomatis.

### ✅ 4. Fasilitas Laporan Keuangan Pimpinan
- **Grafik Interaktif**: Halaman pimpinan dipercantik dengan kehadiran grafik berbentuk tiang vertikal. Grafik ini membandingkan uang masuk dan uang keluar dengan sangat jelas.
- **Buku Keuangan Pintar**: Semua riwayat uang disatukan dalam sebuah tabel besar. Di bagian paling bawah, sistem sudah menghitung sendiri total laba bersih (keuntungan mutlak).
- **Penyesuaian Kertas Cetak**: Seluruh komponen desain warna-warni secara pintar akan menonaktifkan diri apabila pengguna ingin menge-print dokumen tersebut ke kertas HVS. Teks yang terang otomatis beralih menjadi tinta hitam yang tajam agar ramah mesin pencetak.
- **Laci Arsip Rapi**: Ruang untuk menyelam ke data masa lampau kini disusun seperti rak laci bertumpuk yang memisahkan sejarah uang masuk dan keluar dengan apik.

---

## 🎯 DAFTAR TARGET YANG TELAH DIKERJAKAN

Pekerjaan perbaikan yang tadinya sempat bermasalah kini telah dinyatakan bersih tanpa celah:
- [x] Perbaikan tampilan tombol bertumpuk pada layar staf telah dirapikan.
- [x] Masalah pembuatan Surat Jalan yang tadinya harus dibuat manual, kini sudah menyatu saat barang diproses.
- [x] Pembuatan formulir pesanan lincah tanpa perlu memuat ulang (*loading*) halaman web berkali-kali.
- [x] Tampilan Laporan Keuangan saat masuk mode mesin Printer sudah tidak lagi membingungkan dan boros tinta.
- [x] Pembuatan fasilitas Arsip Data dengan desain yang bersih.
- [x] Pemasangan ikon kecil (logo perusahaan) di tab paling atas *browser* penjelajah internet.

---

## 🔧 PEMBARUAN TEKNIS TERBARU (BUGFIXES & PENYEMPURNAAN)

Tim pengembang baru saja melakukan penyempurnaan besar-besaran untuk menambal kelemahan sistem sebelumnya:
- **Tahan Banting di Segala Folder (Smart URL Root):** Sebelumnya, sistem sering kebingungan (Error 404 Not Found) jika dipasang di dalam *sub-folder* Laragon (seperti `localhost/paramitra-app/public`). Kini, sistem telah ditanamkan detektor `REQUEST_URI` cerdas. Semua tombol dan tautan dijamin 100% patuh dan tidak akan lagi memotong nama folder Anda!
- **Pembersihan Tautan Kaku (*Hardcoded Links*):** Seluruh tombol di menu Purchase Order, Transfer Barang, Metode Pembayaran, Supplier, hingga Pelacakan Logistik telah dirombak. Tidak ada lagi tautan mati; semuanya menggunakan rute dinamis pintar dari Laravel.
- **Penyempurnaan Alur Akuntansi (Purchase Order):** Telah ditegaskan bahwa sebuah pengeluaran belanja (PO) HANYA akan masuk ke Laporan dan Arsip Keuangan apabila fisik barangnya telah benar-benar tiba di gudang. Staf harus menekan "Terima Barang Fisik", mengisi formulir, dan mengeklik "Simpan & Update Stok" agar sistem mengakuinya sebagai pengeluaran sah. Hal ini mencegah uang perusahaan tercatat keluar sebelum barang nyata diterima.

---

## 🎓 KATA PENUTUP

Perangkat lunak ini tidak hanya menjadi pajangan yang indah dilihat, namun benar-benar menjadi alat bantu operasional yang sangat cerdas, ramah pengguna, dan dapat diandalkan oleh siapa saja di PT Paramitra Praya Prawatya. 🚀


---

# 6. Implementasi P400 Paramitra

**Sistem Informasi ERP Penjualan, Distribusi, dan Rantai Pasok Berbasis Web untuk Meningkatkan Efisiensi Operasional pada PT Paramitra Praya Prawatya**

**Disusun Oleh:**
**KELOMPOK (K-01)**

Ketua :
Ari Sigit Purnomo (2370211007)

Anggota :
Riyan Samuel Harahap (2370211018)
Ahmad Daris Khoery (2370211024)

**PROGRAM STUDI SISTEM INFORMASI**
**FAKULTAS TEKNIK UNIVERSITAS KRISNADWIPAYANA**
**JAKARTA**
**Mei 2026**

---

## Data Dokumen
| | |
|---|---|
| **Topik Capstone** | Sistem Informasi ERP (Penjualan, Distribusi & Rantai Pasok) |
| **Siklus / Tahun** | Genap / 2025/2026 |
| **Judul Dokumen** | Implementasi Sistem Informasi ERP Berbasis Web pada PT Paramitra Praya Prawatya |
| **Jenis Dokumen** | IMPLEMENTASI |
| **Nomor Dokumen** | (P-400.[00][2025/2026].[K-01] |

*(Catatan: Salin tabel tanda tangan persetujuan dari format Word Anda).*

---

## Daftar Isi
1. Pendahuluan
   1.1 Ringkasan Isi Dokumen
2. Source Code Program Aplikasi
   2.1 routes\web.php
   2.2 app\Http\Controllers\AuthController.php
   2.3 app\Providers\AppServiceProvider.php
   2.4 app\Http\Controllers\Admin\ProductController.php
   2.5 app\Http\Controllers\Admin\SupplierController.php
   2.6 app\Http\Controllers\Admin\OrderController.php
   2.7 app\Http\Controllers\Admin\PurchaseOrderController.php
   2.8 app\Http\Controllers\Admin\GoodsReceiptController.php
   2.9 app\Http\Controllers\Admin\LogisticsController.php
   2.10 app\Http\Controllers\Management\ManagementController.php
   2.11 app\Http\Controllers\Admin\ArchiveController.php
   2.12 app\Http\Controllers\Customer\CustomerDashboardController.php
   2.13 app\Http\Controllers\Customer\CartController.php
3. Tampilan Menu dan Interface
   3.1 Halaman Portal Autentikasi (Login)
   3.2 Halaman Dashboard Pelanggan
   3.3 Halaman Katalog & Keranjang Belanja Pelanggan
   3.4 Halaman Detail Riwayat Pesanan Pelanggan
   3.5 Halaman Dashboard Staf Admin
   3.6 Halaman Manajemen Master Inventori
   3.7 Halaman Manajemen Supplier
   3.8 Halaman Transaksi Penjualan Admin
   3.9 Halaman Pembuatan Purchase Order (PO)
   3.10 Halaman Detail PO & Aksi Manajemen
   3.11 Halaman Penerimaan Barang Fisik (Goods Receipt)
   3.12 Halaman Pelacakan Ekspedisi Logistik (QR Code)
   3.13 Halaman Dashboard Utama Manajemen (Pimpinan)
   3.14 Halaman Laporan Keuangan Laba Bersih
   3.15 Halaman Arsip Digital Transaksi
4. Tampilan Input dan Output
   4.1 Input Autentikasi (Login Sistem)
   4.2 Input Pemesanan Barang (Checkout Pelanggan)
   4.3 Input Persetujuan Pembayaran & Tagihan (Admin)
   4.4 Input Pembuatan Pesanan Pabrik (Purchase Order)
   4.5 Input Penerimaan Barang Fisik (Stok Masuk)
   4.6 Input Pemrosesan Surat Jalan Logistik
   4.7 Output Laporan Laba Bersih Otomatis

---

## 1. Pendahuluan

### 1.1 Ringkasan Isi Dokumen
Sistem Informasi Layanan PT Paramitra Praya Prawatya merupakan aplikasi *Enterprise Resource Planning* (ERP) berbasis web yang dikembangkan untuk mengotomatisasi seluruh alur bisnis perusahaan. Sistem ini dibangun berdasarkan kebutuhan mendesak perusahaan dalam meningkatkan efektivitas penjualan, keakuratan data inventori gudang yang memiliki mobilitas tinggi, pelacakan armada distribusi di lapangan, serta mengontrol siklus pengadaan barang (pembelian ke pabrik) secara terpadu.

Pembahasan pada dokumen ini sangat komprehensif, mencakup hasil implementasi sistem skala *Enterprise* yang telah dikembangkan secara penuh. Di dalamnya merangkum baris *source code* program inti untuk memaparkan logika mesin, tampilan menu dan antarmuka pengguna (*user interface*), serta proses *input* dan *output* (I/O) yang dihasilkan oleh aplikasi. 

Sistem ini didesain untuk melayani tiga entitas pengguna utama sekaligus: **Pelanggan** (fasilitas *e-commerce* dan pelacakan transparan), **Administrator** (modul penjualan, pengiriman, dan belanja bahan baku pabrik), serta **Manajemen/Pimpinan** (modul intelijen bisnis yang menampilkan laporan keuangan laba/rugi, grafik statistik harian, serta pengarsipan transaksi secara *real-time*). Kehadiran *software* ini memangkas proses manual secara drastis, sehingga operasional perusahaan berjalan jauh lebih efisien, terukur, transparan, dan dapat diandalkan (*reliable*).

---

## 2. Source Code Program Aplikasi

*(Petunjuk: Sisipkan screenshot potongan kode pada ruang-ruang kosong)*

### 2.1 routes\web.php
Fungsi utama modul ini adalah mengatur lalu lintas data aplikasi dan menerapkan perlindungan Middleware (hak akses). Semua permintaan URL (*Uniform Resource Locator*) dicatat di sini sebelum diarahkan ke *Controller* yang bersangkutan.

### 2.2 app\Http\Controllers\AuthController.php
Fungsi utama modul ini adalah gerbang keamanan. Sistem menggunakan *Role-Based Access Control* (RBAC) yang cerdas. Berdasarkan jenis peran (*role*) yang tercantum di *database*, pengguna akan diarahkan (*redirect*) ke gerbang yang berbeda: Admin menuju operasional, Pelanggan menuju *e-commerce*, dan Manajemen menuju *dashboard* finansial.

### 2.3 app\Providers\AppServiceProvider.php
Kode revolusioner di dalam berkas ini bertugas sebagai detektor *Sub-Folder Server* (khususnya untuk *environment* Laragon). Fungsi `boot()` mendeteksi `$_SERVER['REQUEST_URI']` sehingga perutean rute (*Routing*) di dalam Laravel tidak akan pernah mengalami *Error 404 Not Found*. Ini membuat seluruh tautan menu dan fungsi aplikasi 100% stabil.

### 2.4 app\Http\Controllers\Admin\ProductController.php
Merupakan modul inti untuk menangani *Master Data* Produk (Pigmen, Resin, Solvent). Memiliki fungsi Validasi Input Terpusat yang mencegah administrator memasukkan angka harga (Price) atau stok di bawah nol, sehingga mencegah *database* dari kerusakan atau anomali kuantitas.

### 2.5 app\Http\Controllers\Admin\SupplierController.php
Menangani direktori pabrik penyedia barang (Pemasok). *Controller* ini memungkinkan administrator menyimpan alamat, nomor telepon, dan email setiap pabrik untuk keperluan transaksi *Supply Chain* tanpa harus mencari kontak fisik di buku alamat manual.

### 2.6 app\Http\Controllers\Admin\OrderController.php
*Controller* raksasa yang menangani alur penjualan. Metode unggulannya adalah `approvePayment()`. Selain mengubah status menjadi lunas, logika di dalam fungsi ini memerintahkan komputer untuk secara instan menerbitkan **Nomor Invoice Resmi** tanpa campur tangan manusia. *Database Transaction* dipakai untuk menjamin aliran dana tidak cacat di tengah eksekusi program.

### 2.7 app\Http\Controllers\Admin\PurchaseOrderController.php
Saraf utama dalam siklus Rantai Pasok (*Supply Chain*). Modul ini menangani pembuatan *draft* belanja barang, sebelum dilempar ke meja Manajer. Metode `approve()` secara khusus dikunci oleh sistem, dan **hanya Pimpinan (Manajemen)** yang memiliki otoritas untuk menekan persetujuan pencairan dana pembelian.

### 2.8 app\Http\Controllers\Admin\GoodsReceiptController.php
Menyempurnakan alur *Purchase Order*. Ketika barang tiba di dermaga kantor, metode `store()` akan dipanggil. Sistem akan melakukan validasi kualitatif kuantitas (*Bagus vs Cacat/Reject*), lalu secara ajaib menyuntikkan data tersebut untuk menambah *Stok Gudang Pusat*, dan pada saat bersamaan mendaftarkan transaksi tersebut ke buku **Laporan Pengeluaran Finansial Perusahaan**.

### 2.9 app\Http\Controllers\Admin\LogisticsController.php
Modul pemantauan armada. Fungsi termutakhirnya adalah `generateSuratJalan()`. Menggunakan perpustakaan (*library*) `SimpleSoftwareIO\QrCode`, mesin akan mencetak dokumen Surat Jalan Format PDF yang dilengkapi sebuah **Kotak Kode QR**. Proses penyelesaian pengiriman di rumah pelanggan cukup dilakukan menggunakan pindaian (*scanning*) kamera HP pada kode QR tersebut.

### 2.10 app\Http\Controllers\Management\ManagementController.php
Modul intelijen bisnis eksklusif untuk kalangan pimpinan. Pada metode `report()`, algoritma diformulasikan untuk menjumlahkan Pendapatan (*Uang Masuk dari Pesanan*) dan menguranginya dengan Pengeluaran Aktif (*Uang Keluar dari Purchase Order yang Barangnya Sudah Tiba*), sehingga menghasilkan angka **Total Laba Bersih (*Net Profit*)** yang absolut dan jujur.

### 2.11 app\Http\Controllers\Admin\ArchiveController.php
Berfungsi sebagai laci mesin waktu perusahaan. Modul ini melakukan kueri (*querying*) dan *pagination* data masif pada riwayat bulan-bulan lampau untuk uang masuk dan keluar, memastikannya dapat dipanggil ulang dalam fraksi detik tanpa membebani server.

### 2.12 app\Http\Controllers\Customer\CustomerDashboardController.php
Pusat navigasi khusus untuk *Point of View* (POV) Pelanggan. Modul ini memberikan informasi rangkuman status seluruh riwayat pesanan yang pernah dibuat oleh akun tersebut, sehingga pelanggan dapat dengan mudah melacak apakah pesanannya sedang diproses, dikirim, atau telah selesai tanpa harus menghubungi tim *Customer Service*.

### 2.13 app\Http\Controllers\Customer\CartController.php
Mesin utama transaksi pelanggan (*e-commerce*). Modul ini menggunakan mekanisme Sesi (*Session*) dinamis untuk menyimpan kumpulan barang ke dalam Keranjang Belanja sebelum *checkout*. Kode ini memiliki algoritma pencegahan stok minus yang memastikan pelanggan tidak dapat membayar barang apabila jumlah pesanan melebihi sisa batas di gudang.

---

## 3. Tampilan Menu dan Interface

### 3.1 Halaman Portal Autentikasi (Login)
**File View**: `resources\views\auth\login.blade.php`
**Instruksi Screenshot**: Buka halaman awal web (`http://localhost/paramitra-app/public`). Ambil tangkapan layar penuh (Full Screen) yang memperlihatkan kotak putih form Login di tengah dengan latar belakang (*background*) gedung PT Paramitra yang buram bergaya *glassmorphism*.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.1 Halaman Portal Autentikasi (Login)</b></div>

**Penjelasan**: Bertindak sebagai titik temu utama yang menjembatani staf, pimpinan, dan pelanggan dengan mesin. Desain *UI* menerapkan efek *glassmorphism* modern dengan latar belakang aktivitas kantor yang mencerminkan profesionalitas korporat. Antarmuka mendukung responsivitas *mobile*.

### 3.2 Halaman Dashboard Pelanggan
**File View**: `resources\views\customer\dashboard.blade.php`
**Instruksi Screenshot**: Login menggunakan akun Pelanggan. Pergi ke menu `Dashboard`. Ambil tangkapan layar penuh yang menampilkan kartu-kartu ringkasan (contoh: "Total Pesanan", "Menunggu Pembayaran", "Diproses") yang berderet di atas layar.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.2 Halaman Dashboard Pelanggan</b></div>

**Penjelasan**: Beranda bagi para pelanggan yang telah mendaftar. Menampilkan riwayat ringkas tentang pesanan apa saja yang pernah mereka beli dan sejauh mana perkembangannya, meminimalisasi pertanyaan pelanggan kepada *Customer Service*.

### 3.3 Halaman Katalog & Keranjang Belanja Pelanggan
**File View**: `resources\views\customer\products.blade.php` & `resources\views\customer\cart.blade.php`
**Instruksi Screenshot**: Di panel pelanggan, buka menu `Pesan Barang` atau `Keranjang`. Pastikan di layar terlihat daftar produk (Pigmen, Resin, dll.) beserta tabel keranjang belanja yang sudah terisi setidaknya 1 atau 2 produk untuk menunjukkan bahwa fitur interaktifnya berjalan.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.3 Halaman Katalog & Keranjang Belanja Pelanggan</b></div>

**Penjelasan**: Etalase daring (*e-commerce*) di mana pelanggan dapat menelusuri katalog bahan baku (Solvent, Pigmen). Tersedia tombol interaktif keranjang belanja yang lincah untuk memudahkan pemesanan barang berjumlah jamak.

### 3.4 Halaman Detail Riwayat Pesanan Pelanggan
**File View**: `resources\views\customer\dashboard.blade.php` & `resources\views\customer\track.blade.php`
**Instruksi Screenshot**: Buka halaman `Dashboard` Pelanggan, gulir ke tabel Riwayat Pesanan. Jika ada tombol "Lacak" atau "Detail" pada pesanan yang sedang diproses, klik tombol tersebut. Ambil *screenshot* pada saat detail atau *timeline* pelacakan pesanan dimunculkan di layar (baik berupa *modal* atau pindah halaman).
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.4 Halaman Detail Riwayat Pesanan Pelanggan</b></div>

**Penjelasan**: Layar terperinci bagi pelanggan untuk menelusuri status tagihan (*Invoice*), metode bayar yang harus dituju, atau riwayat langkah pergerakan ekspedisi truk tanpa harus bertanya ke admin.

### 3.5 Halaman Dashboard Staf Admin
**File View**: `resources\views\admin\dashboard.blade.php`
**Instruksi Screenshot**: Logout dari Pelanggan, lalu Login pakai akun Admin. Di halaman pertama (`Dashboard`), ambil screenshot yang menunjukkan kartu statistik warna-warni seperti "Produk Kritis", "Pesanan Masuk", dan "Pengiriman Aktif".
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.5 Halaman Dashboard Staf Admin</b></div>

**Penjelasan**: Pusat komando bagi staf operasional. *Cards Interface* memberikan informasi cepat mengenai berapa banyak pesanan yang butuh dikonfirmasi dan status batas persediaan gudang tanpa staf harus membaca tabel data mentah yang melelahkan mata.

### 3.6 Halaman Manajemen Master Inventori
**File View**: `resources\views\admin\products\index.blade.php`
**Instruksi Screenshot**: Masuk ke menu `Inventori`. Screenshot tabel yang memperlihatkan daftar bahan kimia. Jika memungkinkan, pastikan ada satu produk yang stoknya di bawah 20 agar indikator peringatan stok kritis (tulisan berwarna merah) terlihat menyala di layar.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.6 Halaman Manajemen Master Inventori</b></div>

**Penjelasan**: Daftar katalog gudang. Terdapat indikator warna (*UI Warning Indicator*), di mana angka sisa produk akan otomatis berubah mencolok saat kuantitasnya nyaris habis.

### 3.7 Halaman Manajemen Supplier
**File View**: `resources\views\admin\suppliers\index.blade.php`
**Instruksi Screenshot**: Masuk ke menu `Pemasok` (Supplier). Screenshot tabel rapi yang mendata nama-nama PT Pabrik (misal: PT Sudarshan, dll) lengkap dengan nomor telepon dan alamat emailnya.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.7 Halaman Manajemen Supplier</b></div>

**Penjelasan**: Tabel catatan pemasok (Pabrik). Memudahkan operasional untuk selalu ingat dari pabrik mana bahan baku tersebut bisa diisi ulang.

### 3.8 Halaman Transaksi Penjualan Admin
**File View**: `resources\views\admin\orders\index.blade.php`
**Instruksi Screenshot**: Buka menu `Transaksi` di bilah sisi (*sidebar*). Screenshot kotak informasi pesanan yang memperlihatkan rincian pesanan baru masuk dan tombol aksi (misalnya tombol hijau "ACC BAYAR" atau tombol hitam "LIHAT RESI").
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.8 Halaman Transaksi Penjualan Admin</b></div>

**Penjelasan**: Pusat pengolahan pesanan (*Sales Order*). Memuat informasi dari pesanan baru pelanggan yang meminta validasi pelunasan hingga eksekusi pengiriman. Memiliki integrasi tombol "Tandai Lunas" yang akan menerbitkan surat tagihan secara berantai.

### 3.9 Halaman Pembuatan Purchase Order (PO)
**File View**: `resources\views\admin\purchase-orders\create.blade.php`
**Instruksi Screenshot**: Buka menu `PO Supplier`, lalu klik `Buat PO Baru`. Isi sedikit formulir tersebut, klik tombol "+ Tambah Produk" agar terlihat dua baris (*Dynamic Rows*). Lalu ambil screenshot yang menunjukkan formulir pembuatan PO tersebut.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.9 Halaman Pembuatan Purchase Order (PO)</b></div>

**Penjelasan**: Tampilan formulir pembuatan *draft* belanja. Desainnya mendukung sistem tambah baris dinamis (*Dynamic Rows*), sehingga staf admin dapat menambahkan sepuluh jenis produk pesanan sekaligus hanya dari satu halaman web yang sama.

### 3.10 Halaman Detail PO & Aksi Manajemen
**File View**: `resources\views\admin\purchase-orders\show.blade.php`
**Instruksi Screenshot**: Login menggunakan akun Manajemen (Manager). Buka menu `PO Supplier`, lalu buka PO yang statusnya masih 'pending'. Screenshot layar tersebut yang menunjukkan dengan jelas adanya tombol "Setujui PO (Approve)".
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.10 Halaman Detail PO & Aksi Manajemen</b></div>

**Penjelasan**: Ini merupakan layar otorisasi dua pihak. Bila status *Menunggu Approval*, panel akan memunculkan tombol Setuju/Tolak untuk Manajemen. Bila status sudah *Dikirim*, antarmuka akan menyesuaikan diri memunculkan tombol pemantauan untuk Admin.

### 3.11 Halaman Penerimaan Barang Fisik (Goods Receipt)
**File View**: `resources\views\admin\purchase-orders\show.blade.php` *(Modal Pengecekan Fisik)*
**Instruksi Screenshot**: Login kembali sebagai Admin. Buka menu `PO Supplier`, cari PO yang berstatus 'approved', klik detail, lalu klik tombol "Terima Barang Fisik". Screenshot Kotak *Modal* (Formulir Pengecekan Fisik) yang muncul, di mana terdapat input angka "Diterima (Bagus)" dan "Ditolak (Reject)".
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.11 Halaman Penerimaan Barang Fisik (Goods Receipt)</b></div>

**Penjelasan**: Laman kunci dari Rantai Pasok. Tabel input kuantitatif yang mengharuskan admin menulis ulang hitungan jumlah barang secara fisik. Sangat krusial karena tanpa penyelesaian form ini, uang pengeluaran tidak sah dicatat.

### 3.12 Halaman Pelacakan Ekspedisi Logistik (QR Code)
**File View**: `resources\views\admin\logistics\surat_jalan.blade.php`
**Instruksi Screenshot**: Buka menu `Logistik`, klik "Cetak Surat Jalan" pada salah satu pengiriman yang aktif. PDF akan terbuka di *tab* baru browser Anda. Screenshot file PDF Surat Jalan tersebut secara penuh, pastikan Kotak Hitam Putih Kode QR di sudut kanan atas terlihat dengan sangat jelas.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.12 Halaman Pelacakan Ekspedisi Logistik (QR Code)</b></div>

**Penjelasan**: *Interface* cetak Surat Jalan PDF. Surat dicetak dalam desain minimalis beserta Kode QR unik yang dicetak tebal pada sudut kanan atas dokumen, yang ditujukan murni sebagai sarana pindaian pelanggan saat serah-terima fisik paket.

### 3.13 Halaman Dashboard Utama Manajemen (Pimpinan)
**File View**: `resources\views\management\dashboard.blade.php`
**Instruksi Screenshot**: Login menggunakan akun Manajemen (Manager). Di menu `Dashboard`, pastikan ada data transaksi masuk. Ambil screenshot penuh yang menunjukkan Diagram Grafik Batang berwarna-warni yang membandingkan "Uang Pemasukan vs Uang Pengeluaran".
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.13 Halaman Dashboard Utama Manajemen (Pimpinan)</b></div>

**Penjelasan**: Representasi grafik warna-warni yang merangkum kesehatan finansial. Diagram akan secara otomatis membandingkan rasio Laba versus Biaya pengeluaran harian, menjadikannya instrumen evaluasi paling mutakhir di level eksekutif.

### 3.14 Halaman Laporan Keuangan Laba Bersih
**File View**: `resources\views\management\report.blade.php`
**Instruksi Screenshot**: Di akun Manajemen, buka menu `Laporan Pemasukan & Pengeluaran`. Screenshot tabel ringkasan tersebut. Pastikan kartu yang bertuliskan "NET PROFIT (Laba Bersih)" dengan angka nominal Rupiah (Rp) tertangkap secara utuh.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.14 Halaman Laporan Keuangan Laba Bersih</b></div>

**Penjelasan**: Tampilan Laporan Keuangan dengan kemampuan *Print-Friendly UI*. Layar akan beradaptasi memutihkan latar dan menghitamkan seluruh teks bila sensor browser mendeteksi perintah Cetak (CTRL+P) ditekan, guna penyelamatan drastis cairan tinta mesin pencetak kantor.

### 3.15 Halaman Arsip Digital Transaksi
**File View**: `resources\views\management\archives.blade.php`
**Instruksi Screenshot**: Di akun Manajemen, buka menu `Arsip Digital`. Ubah filter "Bulan" dan "Tahun" ke waktu saat ini. Screenshot layar yang menunjukkan daftar sejarah transaksi yang rapi tanpa perlu gulir tabel tanpa henti (*pagination*).
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 3.15 Halaman Arsip Digital Transaksi</b></div>

**Penjelasan**: Susunan rapi riwayat historis keuangan (*Big Data*). Dipisah menjadi Tab "Arsip Pemasukan" dan Tab "Arsip Pengeluaran" yang masing-masing didukung oleh mesin *Filter* rentang tanggal agar Pimpinan mudah melakukan audit tahunan.

---

## 4. Tampilan Input dan Output

### 4.1 Input Autentikasi (Login Sistem)
**Input**:
* **Instruksi Screenshot Input**: Di halaman `login`, ketikkan email dan *password* sembarang (jangan klik login dulu). Ambil *screenshot* layar yang menunjukkan kotak input sedang terisi teks (sebagai simulasi proses mengisi form).
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 4.1 Input Autentikasi (Login Sistem)</b></div>

* **Penjelasan Input**: Gambar di atas menampilkan halaman input form login. Pengguna diharuskan memasukkan email dan *password* yang telah terdaftar ke dalam kolom yang tersedia sebelum dapat masuk ke dalam sistem.
**Output**:
* **Instruksi Screenshot Output**: Tekan tombol Login (dengan kredensial yang benar). Segera ambil *screenshot* halaman *Dashboard* yang pertama kali terbuka (misal: *Dashboard* Admin) lengkap dengan pop-up notifikasi hijau "Berhasil Login" jika ada, untuk membuktikan sistem merespons *input* tersebut.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 4.2 Output Autentikasi (Login Sistem)</b></div>

* **Penjelasan Output**: Gambar di atas menunjukkan *output* atau hasil apabila proses autentikasi berhasil. Sistem akan menampilkan notifikasi sukses dan mengarahkan (*redirect*) pengguna ke halaman *Dashboard* yang sesuai dengan hak akses (Role) masing-masing.

### 4.2 Input Pemesanan Barang (Checkout Pelanggan)
**Input**:
* **Instruksi Screenshot Input**: Login sebagai Pelanggan, pilih barang, lalu buka Keranjang (*Cart*). Isi data di bagian formulir *Checkout* (seperti memilih Metode Pembayaran dari *dropdown*). Screenshot halaman keranjang belanja yang sedang terisi ini.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 4.3 Input Pemesanan Barang (Checkout Pelanggan)</b></div>

* **Penjelasan Input**: Gambar di atas menampilkan halaman input (keranjang belanja) bagi pelanggan. Pelanggan dapat mengatur jumlah barang dan memilih metode pembayaran sebelum memproses pesanan lebih lanjut.
**Output**:
* **Instruksi Screenshot Output**: Tekan tombol "Checkout Sekarang". Setelah halaman dialihkan, ambil *screenshot* pada halaman `Pembayaran` yang memunculkan riwayat tagihan pesanan dengan status "Menunggu Pembayaran" beserta pop-up notifikasi hijau sukses.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 4.4 Output Pemesanan Barang (Checkout Pelanggan)</b></div>

* **Penjelasan Output**: Gambar di atas merupakan *output* dari proses pembuatan pesanan. Sistem berhasil memproses keranjang belanja, menyimpannya ke dalam *database*, dan menampilkan tagihan pesanan pada halaman Pembayaran pelanggan.

### 4.3 Input Persetujuan Pembayaran & Tagihan (Admin)
**Input**:
* **Instruksi Screenshot Input**: Login sebagai Admin, buka menu `Transaksi`. Arahkan *mouse* (jangan diklik dulu) pada tombol "ACC BAYAR" hijau pada pesanan yang baru dibuat tadi, lalu ambil *screenshot* untuk menunjukkan posisi tombol persetujuan tersebut.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 4.5 Input Persetujuan Pembayaran & Tagihan (Admin)</b></div>

* **Penjelasan Input**: Gambar di atas memperlihatkan langkah input dari Admin untuk memvalidasi pembayaran pesanan pelanggan. Admin melakukan persetujuan melalui tombol aksi yang tersedia.
**Output**:
* **Instruksi Screenshot Output**: Setelah tombol tersebut diklik, ambil *screenshot* pada layar tabel yang sama. Pastikan gambar menangkap *dropdown* status yang otomatis berubah menjadi "Proses" dan munculnya tombol aksi hitam bertuliskan "LIHAT RESI".
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 4.6 Output Persetujuan Pembayaran & Tagihan (Admin)</b></div>

* **Penjelasan Output**: Gambar di atas menunjukkan *output* setelah Admin menyetujui pembayaran. Sistem secara otomatis merubah status pesanan menjadi lunas, serta menerbitkan resi (Invoice) resmi.

### 4.4 Input Pembuatan Pesanan Pabrik (Purchase Order)
**Input**:
* **Instruksi Screenshot Input**: Login Admin, buka `PO Supplier` -> `Buat PO Baru`. Isi form seperti Pemilihan Pabrik (Supplier) dan tambahkan 2 baris produk. Screenshot form yang sudah terisi penuh ini (sebelum tombol simpan ditekan).
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 4.7 Input Pembuatan Pesanan Pabrik (Purchase Order)</b></div>

* **Penjelasan Input**: Gambar di atas menampilkan form input untuk membuat pesanan pasokan (*Purchase Order*). Admin harus memilih pabrik pemasok dan menginput jumlah kuantitas produk yang dibutuhkan untuk restok gudang.
**Output**:
* **Instruksi Screenshot Output**: Tekan tombol "Simpan PO". Setelah otomatis dialihkan ke halaman Detail PO, ambil *screenshot* layar yang memperlihatkan status "Pending Approval" beserta rincian pesanan pabrik yang baru saja Anda buat.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 4.8 Output Pembuatan Pesanan Pabrik (Purchase Order)</b></div>

* **Penjelasan Output**: Gambar di atas memperlihatkan *output* berupa penambahan data riwayat pemesanan pabrik yang baru dibuat, dengan status menunggu persetujuan (Approval) dari Manajemen.

### 4.5 Input Penerimaan Barang Fisik (Stok Masuk)
**Input**:
* **Instruksi Screenshot Input**: Dengan asumsi PO sudah disetujui, login sebagai Admin, buka `PO Supplier`, buka detail PO tersebut, dan klik "Terima Barang Fisik". Saat form *modal* pengecekan fisik muncul, ketikkan angka pada kolom "Kuantitas Diterima Bagus", lalu ambil *screenshot* form input tersebut.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 4.9 Input Penerimaan Barang Fisik (Stok Masuk)</b></div>

* **Penjelasan Input**: Gambar di atas menunjukkan form input bagi Admin saat menerima pasokan fisik dari pabrik. Admin harus menginput angka kuantitas barang yang diterima dengan kondisi baik (lolos QC).
**Output**:
* **Instruksi Screenshot Output**: Setelah form disimpan, pergi ke menu `Inventori`. Cari produk yang baru saja diterima, lalu *screenshot* baris produk tersebut untuk membuktikan angka pada kolom "Stok" sudah bertambah secara otomatis.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 4.10 Output Penerimaan Barang Fisik (Stok Masuk)</b></div>

* **Penjelasan Output**: Gambar di atas memperlihatkan *output* perubahan sistem di mana angka stok produk pada master data Inventori berhasil bertambah secara presisi sesuai dengan jumlah barang yang baru saja diterima.

### 4.6 Input Pemrosesan Surat Jalan Logistik
**Input**:
* **Instruksi Screenshot Input**: Buka menu `Pengiriman` di bilah sisi. Pada bagian 'Pesanan Siap Kirim', klik tombol "Proses Pengiriman" pada pesanan yang sudah lunas. Di dalam form modal yang muncul, pilih Armada Truk dari daftar *dropdown* (misal: Truck Hino Wingbox). Ambil *screenshot* layar saat form ini sedang terisi sebelum menekan tombol simpan.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 4.11 Input Pemrosesan Surat Jalan Logistik</b></div>

* **Penjelasan Input**: Gambar di atas adalah tampilan form input untuk menentukan armada logistik (truk pengiriman) sebelum pesanan didistribusikan kepada pelanggan.
**Output**:
* **Instruksi Screenshot Output**: Buka menu `Surat Jalan`, lalu klik tombol "Cetak DO / QR" pada data terbaru. Ambil *screenshot* sebagian (di-_crop_) yang hanya menyorot gambar **Kode QR (Barcode)** yang ada di dalam lembar cetak Surat Jalan tersebut sebagai bukti sistem *output* berjalan.
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 4.12 Output Pemrosesan Surat Jalan Logistik</b></div>

* **Penjelasan Output**: Gambar di atas adalah *output* dari sistem logistik berupa dokumen Surat Jalan PDF otomatis yang berisi data alamat pelanggan, kode pelacakan, serta kode *Barcode/QR Code* yang valid.

### 4.7 Output Laporan Laba Bersih Otomatis
**Input**:
* **Instruksi**: *Modul ini murni sistem penampil dan tidak memerlukan input ketik (Form) dari manusia secara statis.* Anda cukup melakukan **satu Screenshot** saja pada outputnya. Sistem otomatis menyedot *Big Data* transaksi dari balik tirai menggunakan algoritma *ManagementController*.
**Output**:
* **Instruksi Screenshot Output**: Login sebagai Manajemen (Pimpinan). Buka menu `Laporan Pemasukan & Pengeluaran`. Ambil *screenshot* secara _Close-up_ (Didekatkan) pada 3 Kotak Kartu Teratas, yaitu kotak: "Total Pemasukan", "Total Pengeluaran", dan "NET PROFIT (Laba Bersih)".
*(Sisipkan Gambar Di Sini)*
<div align="center"><b>Gambar 4.13 Output Laporan Laba Bersih Otomatis</b></div>

* **Penjelasan Output**: Gambar di atas merupakan tampilan *output* laporan analitik finansial bagi Pimpinan (Manajemen). Layar ini menyajikan hasil perhitungan komprehensif antara total pemasukan penjualan dengan total biaya pengeluaran, yang pada akhirnya menghasilkan kesimpulan angka Laba Bersih perusahaan.


---

# 7. Cara Pindah Device (Migrasi)

<div align="center">
  <p>Panduan Resmi Tata Cara Pemindahan Sistem Aplikasi PT Paramitra Praya Prawatya Antar Perangkat Komputer (100% Berfungsi Tanpa Cacat).</p>
</div>

---

## 🌟 KATA PENGANTAR

Sistem aplikasi ini terdiri dari dua bagian yang tidak terpisahkan: **Kumpulan Folder Aplikasi** dan **Rekaman Basis Data (*Database*)**. Jika Anda hanya memindahkan foldernya saja tanpa membawa pangkalan datanya, sistem akan kosong dan lumpuh.

Dokumen ini disusun menggunakan bahasa praktis agar pemindahan sistem dari komputer lama ke komputer baru dapat berjalan mulus tanpa kehilangan satu data pun.

---

## 📦 TAHAP 1: PERSIAPAN DI KOMPUTER LAMA

Langkah pertama yang paling penting adalah membungkus pangkalan data (*database*) ke dalam satu berkas, lalu membawanya bersama dengan folder aplikasi.

1. Buka aplikasi **Laragon**, lalu klik tombol **Database** (Langkah ini biasanya akan memunculkan jendela pengelola data seperti HeidiSQL).
2. Di layar sebelah kiri, cari nama pangkalan data kita: `paramitra_app`.
3. Klik kanan pada nama tersebut, lalu pilih menu **Export database as SQL** (Simpan sebagai berkas SQL).
4. Beri nama berkas tersebut menjadi **`paramitra_app.sql`**.
5. Pindahkan berkas `paramitra_app.sql` tersebut **ke dalam folder utama aplikasi kita** (yaitu di `C:\laragon\www\paramitra-app`).
6. Kini, folder `paramitra-app` Anda sudah utuh (berisi aplikasi sekaligus catatannya). Silakan **Klik Kanan pada folder `paramitra-app` tersebut**, lalu jadikan bentuk kompresi `.rar` atau `.zip`.
7. Pindahkan berkas `paramitra-app.rar` tersebut ke media penyimpanan portabel (*Flashdisk* atau Google Drive) Anda.

---

## 💻 TAHAP 2: PEMASANGAN DI KOMPUTER BARU

*Syarat: Pastikan komputer baru Anda sudah terpasang aplikasi Laragon yang siap pakai.*

1. Masukkan *Flashdisk* Anda ke komputer baru.
2. Buka folder instalasi tempat Laragon berada (Umumnya terletak di laci komputer: `C:\laragon\www`).
3. Pindahkan berkas RAR Anda ke dalam folder `www` tersebut.
4. Lakukan pengekstrakan atau pembongkaran berkas di titik tersebut (*Extract Here*).
5. **Perhatian Penting**: Pastikan setelah dibongkar, susunan rumah foldernya tidak berlapis, melainkan persis menempati jalur ini: `C:\laragon\www\paramitra-app`.
6. Buka aplikasi Laragon di komputer baru, lalu tekan tombol **Mulai (Start All)**.

---

## 🗄️ TAHAP 3: MENYUNTIKKAN BASIS DATA KE MESIN BARU

Aplikasi Anda kini sudah berada di rumah barunya, namun otaknya masih kosong. Kita perlu menyuntikkan data lama Anda ke komputer baru.

1. Pada aplikasi Laragon di komputer baru, klik tombol **Database**.
2. Buatlah wadah data yang baru dengan cara **Klik Kanan** -> pilih **Create new database** (Buat basis data baru).
3. Beri nama wadah tersebut sama persis dengan yang lama, yaitu: **`paramitra_app`**.
4. Klik pada nama wadah kosong tersebut.
5. Pilih menu **Import** (atau *Load SQL file*).
6. Temukan dan masukkan berkas **`paramitra_app.sql`** yang sebelumnya telah Anda selipkan di dalam folder aplikasi.
7. Tekan tombol **Jalankan / Eksekusi (*Execute / Go*)**. 
8. Tunggu beberapa detik hingga proses penyuntikan seluruh riwayat data pelanggan dan transaksi Anda selesai 100%.

---

## ⚙️ TAHAP 4: PENGATURAN ULANG DAN PENYEGARAN MESIN

Komputer baru memiliki pengaturan memori internal (*cache*) yang berbeda dengan komputer lama. Kita wajib menyegarkan "ingatan" aplikasi agar tidak tersesat di rumah barunya.

1. Buka aplikasi Laragon, lalu klik tombol **Terminal**. Layar instruksi berwarna gelap akan muncul.
2. Masukkan perintah berikut untuk memusatkan perhatian terminal ke dalam folder aplikasi kita, lalu tekan Enter:
   ```bash
   cd C:\laragon\www\paramitra-app
   ```
3. Selanjutnya, masukkan **perintah pembersihan sapu jagat** ini, lalu tekan Enter:
   ```bash
   php artisan optimize:clear
   ```
   *(Perintah ini adalah kunci utama yang akan membuang memori usang dan membuat sistem mengenali komponen komputer baru Anda).*
4. **Langkah Penjagaan Mutu Tampilan**: Agar kerapian desain, cat warna, dan tata letak tidak berantakan di layar yang baru, sangat disarankan untuk menjalankan satu perintah penyusunan ulang desain berikut ini, lalu tekan Enter:
   ```bash
   npm run build
   ```

---

## 🎉 TAHAP 5: UJI COBA KEBERHASILAN

Selamat! Proses transplantasi sistem telah sukses terlaksana. Mari kita uji coba kemampuannya.

1. Buka peramban internet Anda (Google Chrome atau Microsoft Edge).
2. Masukkan alamat sakti operasional kita di bilah atas:
   `http://localhost/paramitra-app/public`
3. Tekan Enter.

Sistem Aplikasi PT Paramitra Praya Prawatya akan terbuka dengan terang benderang, utuh, tanpa kehilangan satu angka pun dari riwayat bisnis yang Anda kerjakan di komputer sebelumnya. 🚀

> **💡 Catatan Teknologi Terbaru (Smart URL Root):**
> Anda tidak perlu khawatir dengan *Error 404 Not Found* saat menekan tombol-tombol di dalam aplikasi. Sistem ini telah ditanamkan kecerdasan untuk membaca struktur folder Laragon (`localhost/paramitra-app/public`) secara otomatis tanpa memotong jalurnya. Seluruh tombol dijamin akan bekerja 100% sempurna!

---

### ❓ PANDUAN MASALAH UMUM (TROUBLESHOOTING)

- **Masalah**: Tampilan situs berwarna polos putih berantakan tanpa gaya CSS.
  **Solusi**: Anda melewatkan langkah ke-4 pada Tahap 4. Silakan buka Terminal Laragon dan jalankan perintah `npm run build`.
- **Masalah**: Layar menampilkan tulisan *Database Connection Refused* (Koneksi Ditolak).
  **Solusi**: Pastikan tombol Laragon sudah dinyalakan (Start All), dan pastikan Anda tidak salah mengetik nama `paramitra_app` saat membuat *database* baru.
- **Masalah**: Gambar atau Ikon tidak muncul.
  **Solusi**: Pastikan komputer Anda terhubung ke internet saat pertama kali membukanya agar ikon dari perpustakaan *online* dapat terunduh sempurna.


---

# 8. Skenario Presentasi Dosen

Dokumen ini disusun khusus sebagai skenario demo dan alur bicara (*script*) yang mendetail untuk presentasi di hadapan Dosen Penguji. Anda dapat menyimpan file ini sebagai PDF untuk pegangan pribadi Anda saat maju presentasi.

**Persiapan Sebelum Presentasi:**
1. Pastikan server lokal (Laragon/XAMPP) sudah berjalan (Apache & MySQL).
2. Buka 3 *browser* (atau 3 *tab* dengan mode *Incognito/Private* yang berbeda) agar tidak perlu bolak-balik *login/logout*.
   - **Tab 1:** Login sebagai Staf Operasional (Admin) di `http://localhost/paramitra-app/public/login` (email: `admin@paramitra.com` | pass: `password`)
   - **Tab 2:** Login sebagai Pimpinan (Manajemen) di `http://localhost/paramitra-app/public/login` (email: `management@paramitra.com` | pass: `password`)
   - **Tab 3:** Login sebagai Pelanggan (Customer) di `http://localhost/paramitra-app/public/login` (email: `customer@paramitra.com` | pass: `password`)

---

## 🗣️ SESI 1: PEMBUKAAN & LATAR BELAKANG (2 Menit)

*(Berdiri dengan percaya diri, tatap mata dosen penguji)*

**[Sapaan & Latar Belakang]**
"Selamat pagi/siang Bapak/Ibu Dosen penguji. Hari ini saya akan mempresentasikan hasil pengembangan **Sistem ERP (Enterprise Resource Planning) berbasis Web untuk PT Paramitra Praya Prawatya**."

"Sistem ini dirancang khusus untuk memecahkan masalah operasional pencatatan manual yang rentan terhadap kehilangan data, stok yang tidak sinkron, dan pembuatan laporan yang memakan waktu berhari-hari. Melalui sistem ini, saya mengintegrasikan 3 peran utama (Pelanggan, Staf Admin, dan Pimpinan) ke dalam satu ekosistem yang serba terotomatisasi (*real-time*)."

**[Inovasi & Poin Keunggulan Utama]**
"Ada 3 inovasi utama yang akan saya demokan hari ini:
1. **Paperless Logistic via QR Code:** Bukti serah-terima barang tidak lagi mengandalkan tanda tangan pena, melainkan pemindaian (*scanning*) QR Code langsung melalui kamera sistem.
2. **Dynamic DOM Manipulation:** Formulir *input* transaksi berskala besar bisa diisi dalam satu halaman tanpa *loading* ulang.
3. **Real-time Financial Analytics:** Pimpinan memiliki Dasbor visualisasi keuangan dinamis yang angkanya langsung bergeser secara akurat dari setiap transaksi per detik."

---

## 💻 SESI 2: DEMO APLIKASI (Alur Pengujian)

*(Lakukan klik pada web perlahan agar Dosen bisa mengikuti pergerakan layar Anda)*

### ADEGAN 1: Transaksi Penjualan & Otomatisasi Dokumen
*(Buka **Tab 1** - Dasbor Staf Operasional / Admin)*

1. **Membuat Pesanan (Dynamic Form)**
   - "Sebagai Admin, saya akan masuk ke menu **Pesanan** di navigasi kiri, lalu menekan tombol **+ Buat Pesanan Baru**."
   - "Di sini saya ingin menyoroti fitur form dinamis. Ketika saya klik **+ Tambah Produk Lain**, sistem menggunakan Javascript (*DOM manipulation*) untuk memunculkan kolom baru ke bawah seketika, tanpa memuat ulang halaman (*refresh*). Ini efisiensi waktu yang krusial bagi staf jika harus melayani 50 pesanan sekaligus."
   - *(Isi form pesanan dengan salah satu pelanggan dan beberapa barang, lalu klik Simpan).*

2. **Pembayaran & *Generate* Invoice PDF**
   - "Setelah pesanan dibuat, masuk ke **Detail Pesanan** lalu saya klik tombol **ACC Bayar**."
   - "Begitu pembayaran divalidasi, sistem otomatis beralih ke *controller Invoice*. Tidak ada lagi staf yang membuka Microsoft Word untuk mengetik tagihan. Di menu **Invoice Keuangan**, kita bisa melihat bahwa Invoice berformat standar industri (lengkap dengan kop surat dan nomor surat unik) otomatis tercipta."

### ADEGAN 2: Pengiriman Barang & Validasi Kamera QR
*(Masih di **Tab 1** - Dasbor Staf Operasional / Admin)*

1. **Pembuatan Resi dan Surat Jalan (DO)**
   - "Selanjutnya, di menu **Pengiriman (Logistik)**, saya menekan tombol **Proses Pengiriman**. Sistem akan membuat *tracking number* (Resi) secara unik."
   - "Lalu kita menuju menu **Surat Jalan**. Di sinilah letak inovasinya. Saat saya menekan **Cetak DO / QR**, sistem akan mencetak lembar jalan (*Delivery Order*) yang di dalamnya disematkan **Kode QR unik** khusus untuk pesanan ini."
   - *(Tunjukkan kepada dosen halaman Surat Jalan ber-QR Code tersebut).*

2. **Proses Pindai (Scan) oleh Pelanggan di Lokasi**
   - *(Buka **Tab 3** - Dasbor Pelanggan)*
   - "Bayangkan kurir perusahaan kita telah tiba di pabrik pelanggan dengan membawa kertas Surat Jalan tadi."
   - "Pelanggan cukup membuka akun mereka di HP/Laptop, masuk ke menu **Lacak Pengiriman**, lalu menekan tombol biru **Scan QR Penerimaan**."
   - "Sistem akan meminta izin mengakses kamera perangkat (*Webcam/Kamera HP*). Saat kamera diarahkan ke kertas milik kurir, *bam!* Sistem langsung melempar validasi ke *database*."
   - *(Jelaskan kuncinya)*: "Kehebatan sinkronisasi terjadi di detik itu juga. Status Surat Jalan menjadi **DITERIMA**, status Pengiriman menjadi **SELESAI**, status Pesanan menjadi **SELESAI**, dan **Pendapatan Keuangan tercatat ke laporan**. Empat aksi sekaligus diselesaikan oleh satu pindai (*scan*) kamera."

### ADEGAN 3: Manajemen Gudang & Restock (*Purchase Order*)
*(Kembali ke **Tab 1** - Dasbor Staf Operasional / Admin)*

1. **Belanja Pabrik dan Perhitungan Stok**
   - "Selain menjual, PT Paramitra juga kulakan dari pabrik (*Supplier*). Di menu **PO Supplier**, sistem mengelola pembelian. Sama seperti penjualan, ini menggunakan form dinamis."
   - "Ketika barang fisik tiba di gudang, Admin masuk ke menu **Goods Receipt (Penerimaan Barang)**. Di sinilah validasi kunci terjadi. Admin harus mencentang kesesuaian fisik barang."
   - "Saat Admin menekan **Simpan & Update Stok**, sistem melakukan operasi penjumlahan otomatis pada inventori Gudang, serta mencatatkan transaksi pengeluaran (Minus) di pembukuan keuangan."

### ADEGAN 4: Halaman Eksekutif & Dasbor Pimpinan
*(Buka **Tab 2** - Dasbor Pimpinan / Manajemen)*

1. **Tren Finansial & Chart.js Dinamis**
   - "Sekarang kita berada di ranah *Top Management* atau Pimpinan. Halaman Dasbor ini sepenuhnya steril dari intervensi Staf biasa berkat sistem keamanan *Role-based Middleware*."
   - "Di tengah dasbor, terdapat **Grafik Tren Finansial** yang saya bangun menggunakan *library* **Chart.js**. Grafik ini tidak statis."
   - *(Klik dropdown pilihan waktu pada grafik)*
   - "Pimpinan dapat menyaring data langsung (*on the fly*): memilih **'1 Bulan Terakhir (Harian)'** untuk memantau ritme kas harian (per tanggal), atau **'6 Bulan' / '1 Tahun'** untuk melihat rekapitulasi bulanan secara holistik."

2. **Laporan & Mode *Print-Friendly* (Hemat Tinta)**
   - "Terakhir, di menu **Laporan**, Pimpinan bisa melihat rincian debet-kredit yang menghasilkan Laba Bersih di akhir tabel."
   - "Sebagai tambahan detail UI/UX, saat Pimpinan menekan **Ctrl + P** (Print) di *keyboard*, *CSS Media Query (@media print)* kami akan melucuti semua *sidebar*, latar belakang warna biru/hitam, dan menyisakan teks tabel hitam-putih yang elegan dan bersih, didesain murni untuk menghemat tinta *printer* kantor."

---

## 🎯 SESI 3: KESIMPULAN PENUTUP (1 Menit)

"Bapak/Ibu Dosen, melalui aplikasi ini, saya berhasil membuktikan implementasi perancangan sistem informasi berskala *Enterprise* yang komprehensif. Mulai dari sisi UI/UX yang dinamis (*Javascript DOM*, *Chart.js*), hingga integritas *Database* di belakang (*Backend validation, Eloquent Relationships*). Tidak ada lagi tumpang tindih data; ketika Pelanggan men-*scan* QR, seluruh departemen perusahaan (Gudang, Logistik, Keuangan, Staf Penjualan) menerima laporannya di detik yang sama."

"Demikian demonstrasi dari saya. Terima kasih atas waktunya, saya kembalikan kepada Bapak/Ibu Dosen apabila ada pertanyaan atau arahan."

---

## 💡 KISI-KISI & JAWABAN TEKNIS (TANYA JAWAB DOSEN)

Seringkali Dosen penguji menanyakan aspek keamanan dan validasi *backend*. Ini adalah jawaban *template* yang bisa Anda gunakan:

1. **Tanya Dosen:** *"Bagaimana sistem kamu mencegah Staf Gudang men-*update* stok dua kali untuk barang yang sama?"*
   **Jawaban Anda:** "Pada tabel *Goods Receipt* (Penerimaan Barang), saya memberikan *Foreign Key* dan validasi di *Controller*. Begitu nomor *Purchase Order (PO)* disubmit sebagai *Goods Receipt*, status *PO*-nya otomatis berubah menjadi *'Received'*. Sistem di-program untuk memblokir formulir baru jika nomor *PO* tersebut statusnya sudah *'Received'*. Stok dijamin aman dan absolut."

2. **Tanya Dosen:** *"Apa yang terjadi jika pembeli memindai (*scan*) QR Code dua kali?"*
   **Jawaban Anda:** "QR Code tersebut berisi kombinasi tautan *URL* unik ber-enkripsi ringan yang menyasar ke ID Surat Jalan spesifik. Di *Controller* (SuratJalanController), baris pertama kode saya adalah pengecekan IF. Jika status surat jalan SUDAH *'diterima'*, maka *request* dari kamera akan langsung ditolak dan dimunculkan pesan *Error* 'Sudah Diterima Sebelumnya', sehingga relasi *database* tidak akan tertimpa ulang."

3. **Tanya Dosen:** *"Mengapa kamu yakin keamanan routing-mu bagus? Apa yang mencegah *customer* mengetik '/admin/dashboard' di URL?"*
   **Jawaban Anda:** "Sistem *Routing* (Web.php) saya dibungkus oleh **Middleware Role-based Access Control (RBAC)** buatan bawaan *Laravel Framework*. *Middleware* ini mencegat setiap interaksi sebelum memuat halaman (*page load*). Jika *user* login sebagai *Customer* (level 0), saat dia memaksa masuk URL admin (level 1), *Middleware* langsung memotong koneksinya dan membuang (*redirect abort 403 / home*) pengguna kembali ke luar."
