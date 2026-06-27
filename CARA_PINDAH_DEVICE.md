# 🚚 PANDUAN PINDAH KOMPUTER (MIGRASI PERANGKAT)

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
