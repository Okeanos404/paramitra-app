# 🎓 SKENARIO PRESENTASI & UJI TESTING SISTEM (ERP PARAMITRA)

Dokumen ini disusun khusus sebagai panduan alur bicara (*script*) dan skenario demo aplikasi di hadapan Dosen Penguji. Pastikan aplikasi Laragon/XAMPP sudah menyala dan buka aplikasi di `http://localhost/paramitra-app/public` sebelum presentasi dimulai.

---

## 🗣️ SESI 1: PEMBUKAAN & LATAR BELAKANG (1-2 Menit)

**[Sapaan & Perkenalan]**
"Selamat pagi/siang Bapak/Ibu Dosen penguji. Pada kesempatan kali ini, saya akan mendemonstrasikan **Sistem ERP (Enterprise Resource Planning) PT Paramitra Praya Prawatya**."

**[Masalah & Solusi]**
"Aplikasi ini dibangun untuk mengatasi permasalahan pencatatan operasional perusahaan yang sebelumnya masih manual. Sistem ini mengintegrasikan 3 aktor utama, yaitu **Pelanggan, Staf Operasional (Admin), dan Pimpinan (Manajemen)** dalam satu ekosistem yang *real-time*."

**[Poin Keunggulan Utama]**
"Keunggulan utama sistem ini terletak pada:
1. **Otomatisasi Dokumen:** Tagihan (Invoice) dan Surat Jalan di- *generate* otomatis.
2. **Paperless & QR Code:** Konfirmasi penerimaan barang menggunakan *scan* QR.
3. **Real-time Analytics:** Dasbor keuangan interaktif untuk pengambil keputusan.
4. **Sinkronisasi Otomatis:** Pergerakan stok, logistik, dan laporan keuangan saling terhubung tanpa perlu *input* berulang."

---

## 💻 SESI 2: DEMO APLIKASI (Alur Pengujian)

*(Pada sesi ini, Anda disarankan untuk langsung mendemokan aplikasi sambil berbicara)*

### Adegan 1: Kemudahan Pelanggan & Staf Admin (Sisi Penjualan)
1. **[Buka Browser - Login sebagai Admin]**
   - *Gunakan email: `admin@paramitra.com` | password: `password`*
   - "Sistem kami mengakomodasi transaksi dari dua arah. Pelanggan bisa belanja mandiri, atau Staf Admin bisa memasukkan pesanan yang masuk via telepon."
2. **[Demo: Transaksi -> Buat Pesanan]**
   - "Di sini saya mendemokan fleksibilitas *Form* Pesanan Dinamis. Saat saya klik **'+ Tambah Produk Lain'**, formulir bertambah ke bawah tanpa perlu memuat ulang (*loading*) halaman berkat implementasi DOM Javascript. Ini sangat mempercepat kerja Staf jika ada puluhan item."
3. **[Demo: Pembayaran & Invoice Otomatis]**
   - Masuk ke tabel pesanan yang baru dibuat, klik **"ACC Bayar"**.
   - "Begitu pembayaran divalidasi, sistem otomatis menerbitkan **Surat Tagihan (Invoice) berformat PDF**. Tidak perlu lagi menggunakan kalkulator atau Microsoft Word."

### Adegan 2: Inovasi Logistik (QR Code Surat Jalan)
1. **[Demo: Pengiriman -> Proses Pengiriman]**
   - "Selanjutnya adalah proses pengiriman. Saat Staf Logistik menekan tombol 'Proses Pengiriman', resi pengiriman otomatis terbentuk."
2. **[Demo: Surat Jalan -> Cetak DO / QR]**
   - "Inilah salah satu fitur unggulan sistem ini. Surat Jalan dicetak langsung lengkap dengan **Kode QR**. Ketika supir tiba di lokasi, pelanggan cukup men- *scan* Kode QR tersebut."
   - *(Jelaskan kepada dosen)*: "Saat QR di-*scan* dan dikonfirmasi, seketika itu juga status Surat Jalan, status Pengiriman, dan status Pesanan otomatis tersinkronisasi menjadi **'Selesai'**. Hal ini mencegah terjadinya redudansi atau ketidakcocokan data."

### Adegan 3: Tata Kelola Gudang (Pembelian ke Pabrik / PO)
1. **[Demo: PO Supplier -> Buat PO]**
   - "Tidak hanya jualan, sistem ini juga menangani belanja ke pabrik (*Purchase Order*). Sama halnya dengan penjualan, PO ke pabrik dikelola secara sistematis hingga status persetujuan (*approval*)."
2. **[Demo: Terima Barang Fisik & Update Stok]**
   - "Ketika barang dari pabrik tiba, Staf cukup masuk ke menu Penerimaan Barang (Goods Receipt). Saat form disubmit (klik *Simpan & Update Stok*), sistem akan otomatis **menambahkan angka stok ke database Gudang** dan **mencatat total biayanya ke dalam laporan pengeluaran** perusahaan."

### Adegan 4: Pengambilan Keputusan (Dasbor Pimpinan)
1. **[Logout Admin, Login sebagai Pimpinan]**
   - *Gunakan email: `management@paramitra.com` | password: `password`*
2. **[Demo: Dasbor Analitik]**
   - "Halaman ini dirancang khusus untuk eksekutif. Sistem secara otomatis menghitung selisih antara Pendapatan dari pesanan yang selesai dan Pengeluaran dari barang yang diterima."
   - "Terdapat grafik interaktif Tren Finansial yang kami buat menggunakan **Chart.js**. Grafik ini bersifat dinamis; pimpinan bisa menyaring rentang waktu (misalnya **1 Bulan Terakhir (Harian), 6 Bulan, atau 1 Tahun**) secara langsung (*on the fly*) tanpa reload halaman utuh."
3. **[Demo: Laporan & Mode Cetak Printer]**
   - Buka menu **Laporan**.
   - "Pada menu Laporan, seluruh transaksi disajikan lengkap hingga total Laba Bersih di paling bawah. Apabila Pimpinan menekan tombol **Ctrl + P** (Print), desain antarmuka kami akan otomatis menyesuaikan diri (CSS *print media query*), mematikan warna latar belakang agar tulisan menjadi hitam putih demi menghemat tinta *printer*."

---

## 🎯 SESI 3: PENUTUP & KESIMPULAN (1 Menit)

"Sebagai kesimpulan, sistem ERP PT Paramitra yang telah dibangun ini membuktikan bahwa:
1. **Validitas Data Terjamin**: Tidak ada lagi uang keluar atau stok bertambah tanpa bukti fisik (Goods Receipt). Sinkronisasi dari hulu (pesanan) ke hilir (arsip) diikat dengan validasi *database* berlapis.
2. **Modern & Terukur**: Penggunaan QR Code mengeliminasi penggunaan kertas berlebih, mempercepat birokrasi, dan mencegah resiko hilangnya dokumen tanda terima.
3. **Siap Diimplementasikan**: Sistem ini sudah diuji untuk dapat berjalan secara dinamis di berbagai lingkungan server (lokal/hosting) berkat perbaikan sistem *routing* yang kami sesuaikan.

Demikian presentasi dari saya. Terima kasih atas perhatian Bapak/Ibu Dosen, saya persilakan apabila ada kritik, saran, maupun pertanyaan."

---

## 💡 TIPS TAMBAHAN SAAT TANYA JAWAB DENGAN DOSEN

Jika Dosen bertanya hal teknis, ini adalah jawaban kuncinya:
- **Tanya:** *"Bagaimana cara sistem mencegah stok minus?"*
  **Jawab:** "Kami menanamkan *database transaction* dan *lockForUpdate()* pada Controller. Saat proses pesanan berjalan, sistem mengecek kecukupan stok; jika tidak cukup, transaksi langsung dibatalkan (*rollback*) sebelum data tersimpan."
- **Tanya:** *"Kenapa harus pakai QR Code di Surat Jalan?"*
  **Jawab:** "Untuk mencegah manipulasi data oleh kurir. QR Code bersifat unik per pengiriman. Saat discan, otomatis meng-update 3 tabel relasi sekaligus (Surat Jalan, Logistik, dan Pesanan Induk) secara sinkron."
- **Tanya:** *"Bagaimana keamanan Hak Aksesnya?"*
  **Jawab:** "Sistem menggunakan *Middleware* Role-based di tingkat *routing*. Pelanggan biasa sama sekali tidak bisa memaksa masuk mengetikkan URL halaman admin atau manajemen, sistem akan langsung menendang (*redirect*) mereka keluar."
