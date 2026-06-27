# 📊 ALUR SISTEM KERJA PARAMITRA - PANDUAN LENGKAP

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
