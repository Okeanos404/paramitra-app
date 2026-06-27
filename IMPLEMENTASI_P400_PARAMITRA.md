# IMPLEMENTASI

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
