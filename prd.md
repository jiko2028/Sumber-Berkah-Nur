# Product Requirements Document (PRD)
# Sistem Informasi Pemasaran Properti
## PT/CV Berkah Cahaya Alfatih

**Versi Dokumen:** 1.0
**Tanggal:** 26 Juli 2026
**Platform:** Website (Laravel Framework)

---

## 1. PENDAHULUAN

### 1.1 Latar Belakang
Berkah Cahaya Alfatih adalah perusahaan yang bergerak di bidang pemasaran properti. Selama ini proses penyampaian informasi properti kepada calon konsumen masih dilakukan secara manual/konvensional (brosur, media sosial, atau komunikasi langsung), sehingga jangkauan informasi terbatas dan kurang efisien. Untuk itu dibutuhkan sebuah **Sistem Informasi Pemasaran Properti berbasis website** yang dapat menjadi media penyampaian informasi dan promosi properti secara terpusat, mudah diakses, dan mudah dikelola.

### 1.2 Tujuan
1. Menyediakan media promosi dan informasi properti berbasis web yang dapat diakses kapan saja oleh calon konsumen.
2. Mempermudah admin/marketing dalam mengelola data properti (tambah, ubah, hapus, tampil).
3. Mempermudah calon konsumen dalam mencari dan menyaring properti sesuai kebutuhan (lokasi, harga, kategori, dsb).
4. Menyediakan kanal komunikasi (kontak) antara calon konsumen dan pihak perusahaan.

### 1.3 Ruang Lingkup Sistem
**Termasuk dalam sistem (in-scope):**
- Media informasi dan promosi properti berbasis web.
- Pengelolaan data properti: tambah, ubah, hapus, tampilkan.
- Pengelolaan kategori properti.
- Pengelolaan galeri foto properti.
- Pengelolaan informasi/profil perusahaan.
- Pengelolaan data kontak dan pesan masuk dari calon konsumen.
- Fitur pencarian dan penyaringan (filter) properti.
- Halaman detail informasi properti.

**Tidak termasuk dalam sistem (out-of-scope):**
- Pengembangan aplikasi mobile (Android/iOS native).
- Fitur kecerdasan buatan (AI), machine learning, dan big data.
- Proses pembangunan/konstruksi properti dan manajemen proyek konstruksi.
- Legalitas dan administrasi kepemilikan properti (sertifikat, akta, dsb).
- Transaksi keuangan/pembayaran online (payment gateway, cicilan KPR online, dsb).

### 1.4 Pengguna Sistem (Aktor)
| Aktor | Deskripsi | Hak Akses |
|---|---|---|
| **Admin/Marketing** | Pengelola internal sistem dari pihak perusahaan | Login, kelola properti, kategori, galeri, informasi perusahaan, kelola kontak/pesan masuk |
| **Calon Konsumen (Guest/Publik)** | Pengunjung website yang mencari informasi properti | Melihat beranda, mencari & menyaring properti, melihat detail properti, mengirim pesan/kontak, melihat profil perusahaan |

---

## 2. DESKRIPSI UMUM SISTEM

Sistem ini merupakan **website company profile + katalog properti** yang berfungsi sebagai etalase digital. Sistem terdiri dari dua sisi utama:

1. **Sisi Publik (Front-End)** — diakses oleh calon konsumen tanpa perlu login, berisi informasi properti, pencarian, detail properti, profil perusahaan, dan formulir kontak.
2. **Sisi Admin (Back-End/Dashboard)** — diakses oleh admin/marketing setelah login, digunakan untuk mengelola seluruh konten yang tampil di sisi publik.

---

## 3. DAFTAR FITUR & KEBUTUHAN FUNGSIONAL

### 3.1 Login Admin
- FR-01: Sistem menyediakan form login dengan username/email dan password.
- FR-02: Sistem melakukan validasi kredensial dan menampilkan pesan error jika salah.
- FR-03: Sistem menyediakan fitur logout.
- FR-04: Sistem membatasi akses halaman admin hanya untuk pengguna yang sudah login (middleware auth).
- FR-05: Sistem menyediakan fitur ubah password admin.
- FR-06: Halaman dashboard menampilkan ringkasan data (jumlah properti, jumlah kategori, jumlah pesan masuk, dsb).

### 3.2 Kelola Data Properti
- FR-07: Admin dapat menambah data properti baru (nama, kategori, harga, lokasi, deskripsi, spesifikasi, status, foto utama, dsb).
- FR-08: Admin dapat mengubah/mengedit data properti yang sudah ada.
- FR-09: Admin dapat menghapus data properti.
- FR-10: Admin dapat menampilkan/menonaktifkan (publish/unpublish) properti dari tampilan publik.
- FR-11: Admin dapat mengubah status properti (Tersedia, Terjual, Disewa, Dalam Negosiasi).
- FR-12: Sistem menampilkan daftar seluruh properti dalam bentuk tabel pada dashboard admin dengan fitur pencarian data.
- FR-13: Admin dapat menandai properti sebagai "unggulan" (featured) agar tampil di beranda.

### 3.3 Kelola Kategori
- FR-14: Admin dapat menambah kategori properti (contoh: Rumah, Ruko, Tanah Kavling, Apartemen, Gudang).
- FR-15: Admin dapat mengubah dan menghapus kategori.
- FR-16: Sistem mencegah penghapusan kategori yang masih digunakan oleh data properti (validasi relasi).

### 3.4 Kelola Galeri
- FR-17: Admin dapat menambah beberapa foto (multi-upload) untuk satu properti.
- FR-18: Admin dapat menghapus foto tertentu dari galeri properti.
- FR-19: Admin dapat menentukan foto sampul/utama (cover image) properti.
- FR-20: Sistem melakukan validasi ukuran dan format file gambar yang diunggah (jpg, jpeg, png; maks. tertentu, misal 2MB).

### 3.5 Kelola Informasi Perusahaan
- FR-21: Admin dapat mengubah profil perusahaan (nama, alamat, deskripsi, visi misi, logo).
- FR-22: Admin dapat mengubah informasi kontak perusahaan (telepon, email, media sosial, jam operasional).
- FR-23: Konten ini ditampilkan pada halaman "Tentang Kami" dan footer website publik.

### 3.6 Kelola Kontak
- FR-24: Sistem menyediakan formulir kontak/hubungi kami di sisi publik (nama, email, no. telepon, pesan, opsional properti terkait).
- FR-25: Admin dapat melihat daftar pesan masuk dari calon konsumen.
- FR-26: Admin dapat menandai pesan sebagai sudah dibaca/belum dibaca.
- FR-27: Admin dapat menghapus pesan.
- FR-28: (Opsional) Sistem mengirim notifikasi email ke admin saat ada pesan baru masuk.

### 3.7 Pencarian Properti
- FR-29: Pengunjung dapat mencari properti berdasarkan kata kunci (nama/lokasi properti).
- FR-30: Sistem menampilkan hasil pencarian dalam bentuk daftar/kartu properti.
- FR-31: Sistem menampilkan pesan jika data tidak ditemukan.

### 3.8 Penyaringan (Filter) Properti
- FR-32: Pengunjung dapat menyaring properti berdasarkan kategori.
- FR-33: Pengunjung dapat menyaring properti berdasarkan rentang harga (minimal-maksimal).
- FR-34: Pengunjung dapat menyaring properti berdasarkan lokasi/kota.
- FR-35: Pengunjung dapat menyaring properti berdasarkan status (tersedia/terjual/disewa).
- FR-36: Filter dapat dikombinasikan (misal kategori + rentang harga sekaligus).
- FR-37: Hasil filter dapat diurutkan (harga termurah/termahal, terbaru).

### 3.9 Halaman Informasi Properti (Detail)
- FR-38: Sistem menampilkan detail lengkap properti: nama, harga, lokasi, deskripsi, spesifikasi (luas tanah, luas bangunan, kamar tidur, kamar mandi, carport, dll), status, dan galeri foto.
- FR-39: Sistem menampilkan galeri foto dalam bentuk slider/lightbox.
- FR-40: Sistem menampilkan tombol/aksi "Hubungi Kami" atau "Tanya Properti Ini" yang terhubung ke form kontak/WhatsApp.
- FR-41: Sistem menampilkan properti terkait/serupa (rekomendasi kategori sama).
- FR-42: Sistem mencatat jumlah dilihat (views) pada tiap properti.

---

## 4. ALUR SISTEM (BUSINESS PROCESS FLOW)

### 4.1 Alur Sisi Admin
```
[Admin membuka halaman login]
        ↓
[Input username & password] → (Gagal) → [Tampilkan pesan error] → kembali ke login
        ↓ (Berhasil)
[Masuk ke Dashboard Admin]
        ↓
   ┌────────────────────────────────────────────┐
   │  Menu: Properti | Kategori | Galeri |        │
   │  Info Perusahaan | Kontak/Pesan Masuk         │
   └────────────────────────────────────────────┘
        ↓
[Pilih menu] → [Tambah/Ubah/Hapus/Lihat Data] → [Sistem simpan ke database] → [Notifikasi sukses] → [Data tampil di sisi publik]
        ↓
[Logout]
```

### 4.2 Alur Sisi Calon Konsumen (Publik)
```
[Buka Website] 
        ↓
[Halaman Beranda: Properti Unggulan, Kategori, Profil Singkat Perusahaan]
        ↓
   ┌──────────────────────────────┐
   │  Pilih: Cari Properti /       │
   │  Lihat Semua Properti /       │
   │  Tentang Kami / Kontak        │
   └──────────────────────────────┘
        ↓
[Halaman Daftar Properti] → [Input kata kunci pencarian] atau [Pilih filter kategori/harga/lokasi/status]
        ↓
[Sistem menampilkan hasil sesuai pencarian/filter]
        ↓
[Klik salah satu properti] → [Halaman Detail Properti: deskripsi, spesifikasi, galeri foto]
        ↓
[Klik "Hubungi Kami"] → [Isi form kontak] → [Sistem simpan pesan ke database] → [Admin menerima & membalas via telepon/email/WA]
```

### 4.3 Diagram Konteks (Ringkas)
```
                 ┌───────────────────────────────┐
   Admin/       →│                                │→  Data Properti,
   Marketing    ←│   SISTEM INFORMASI PEMASARAN   │←  Kategori, Galeri,
                 │   PROPERTI - BERKAH CAHAYA      │   Info Perusahaan
                 │   ALFATIH                       │
   Calon        →│                                │→  Hasil Pencarian,
   Konsumen     ←│                                │←  Detail Properti,
                 └───────────────────────────────┘   Konfirmasi Pesan
```

---

## 5. KEBUTUHAN NON-FUNGSIONAL

| Kategori | Kebutuhan |
|---|---|
| **Usability** | Tampilan responsif (mobile-friendly) menggunakan Bootstrap/Tailwind CSS, navigasi mudah dipahami pengunjung awam |
| **Performance** | Halaman utama & daftar properti dimuat maks. 3 detik dengan optimasi gambar (lazy load, kompresi) |
| **Security** | Password admin di-hash (bcrypt), proteksi CSRF (bawaan Laravel), validasi input untuk mencegah SQL Injection & XSS, rate limiting login |
| **Maintainability** | Kode mengikuti struktur MVC Laravel, penamaan konsisten, mudah dikembangkan lebih lanjut |
| **Portability** | Dapat dijalankan di hosting berbasis PHP/MySQL umum (shared hosting/VPS) |
| **Availability** | Website dapat diakses 24 jam (tergantung ketersediaan hosting) |
| **Backup** | Tersedia mekanisme backup database secara berkala (manual/terjadwal) |

---

## 6. KEBUTUHAN TEKNOLOGI (TECH STACK)

| Komponen | Teknologi yang Digunakan |
|---|---|
| Bahasa Pemrograman | PHP |
| Framework | Laravel (versi 10/11 LTS) |
| Database | MySQL / MariaDB |
| Front-End | Blade Template, Bootstrap 5 / Tailwind CSS, JavaScript, jQuery (opsional) |
| Autentikasi | Laravel Breeze / Laravel Auth bawaan |
| Web Server | Apache / Nginx |
| Tools Pendukung | Composer, Node.js & NPM (untuk asset bundling), Git (version control) |
| Text Editor/IDE | Visual Studio Code |
| Server Lokal (Development) | XAMPP / Laragon |

---

## 7. PERANCANGAN BASIS DATA (DATABASE)

### 7.1 Entity Relationship Diagram (Deskripsi Relasi)
```
tb_kategori (1) ────< (N) tb_properti
tb_properti (1) ────< (N) tb_galeri
tb_properti (1) ────< (N) tb_pesan   (opsional, pesan terkait properti tertentu)
tb_admin    (1) ────< (N) tb_properti (created_by, opsional)
tb_informasi_perusahaan  (berdiri sendiri, 1 baris data / singleton)
```

### 7.2 Struktur Tabel Database

**Tabel: `users` (Admin/Marketing)**
| Field | Tipe Data | Keterangan |
|---|---|---|
| id | BIGINT (PK, AI) | Primary key |
| name | VARCHAR(100) | Nama admin |
| username | VARCHAR(50) | Username unik untuk login |
| email | VARCHAR(100) | Email unik |
| password | VARCHAR(255) | Password (hashed) |
| role | ENUM('super_admin','marketing') | Level akses |
| foto_profil | VARCHAR(255) | Foto profil admin (nullable) |
| status | ENUM('aktif','nonaktif') | Status akun |
| created_at, updated_at | TIMESTAMP | Waktu pembuatan/perubahan |

**Tabel: `kategori`**
| Field | Tipe Data | Keterangan |
|---|---|---|
| id | BIGINT (PK, AI) | Primary key |
| nama_kategori | VARCHAR(100) | Nama kategori (Rumah, Ruko, Tanah, dll) |
| slug | VARCHAR(150) | URL friendly, unik |
| deskripsi | TEXT | Deskripsi kategori (nullable) |
| created_at, updated_at | TIMESTAMP | |

**Tabel: `properti`**
| Field | Tipe Data | Keterangan |
|---|---|---|
| id | BIGINT (PK, AI) | Primary key |
| kode_properti | VARCHAR(20) | Kode unik properti (misal: BCA-0001) |
| kategori_id | BIGINT (FK → kategori.id) | Relasi kategori |
| user_id | BIGINT (FK → users.id) | Admin yang menginput (nullable) |
| judul | VARCHAR(150) | Nama/judul properti |
| slug | VARCHAR(200) | URL friendly, unik |
| deskripsi | TEXT | Deskripsi lengkap properti |
| harga | DECIMAL(15,2) | Harga properti |
| status_properti | ENUM('tersedia','terjual','disewa','negosiasi') | Status ketersediaan |
| tipe_transaksi | ENUM('jual','sewa') | Jenis transaksi |
| alamat | VARCHAR(255) | Alamat lengkap |
| kota | VARCHAR(100) | Kota/kabupaten (untuk filter lokasi) |
| provinsi | VARCHAR(100) | Provinsi |
| luas_tanah | INT | Luas tanah (m²) |
| luas_bangunan | INT | Luas bangunan (m²) |
| jumlah_kamar_tidur | INT | Jumlah kamar tidur (nullable) |
| jumlah_kamar_mandi | INT | Jumlah kamar mandi (nullable) |
| carport | INT | Jumlah carport/garasi (nullable) |
| fasilitas | TEXT | Fasilitas tambahan (nullable, bisa JSON) |
| foto_utama | VARCHAR(255) | Path foto utama/cover |
| is_unggulan | BOOLEAN | Tampil di beranda atau tidak |
| is_publish | BOOLEAN | Publish/draft |
| dilihat | INT (default 0) | Jumlah views |
| created_at, updated_at | TIMESTAMP | |

**Tabel: `galeri_properti`**
| Field | Tipe Data | Keterangan |
|---|---|---|
| id | BIGINT (PK, AI) | Primary key |
| properti_id | BIGINT (FK → properti.id) | Relasi properti |
| gambar | VARCHAR(255) | Path file gambar |
| keterangan | VARCHAR(150) | Keterangan gambar (nullable) |
| urutan | INT | Urutan tampil gambar |
| created_at, updated_at | TIMESTAMP | |

**Tabel: `informasi_perusahaan`**
| Field | Tipe Data | Keterangan |
|---|---|---|
| id | BIGINT (PK, AI) | Primary key (umumnya 1 baris data) |
| nama_perusahaan | VARCHAR(150) | "Berkah Cahaya Alfatih" |
| logo | VARCHAR(255) | Path logo |
| deskripsi | TEXT | Profil singkat perusahaan |
| visi | TEXT | Visi perusahaan |
| misi | TEXT | Misi perusahaan |
| alamat | VARCHAR(255) | Alamat kantor |
| telepon | VARCHAR(20) | No. telepon |
| whatsapp | VARCHAR(20) | No. WhatsApp |
| email | VARCHAR(100) | Email perusahaan |
| jam_operasional | VARCHAR(100) | Jam operasional kantor |
| link_instagram | VARCHAR(150) | (nullable) |
| link_facebook | VARCHAR(150) | (nullable) |
| link_youtube | VARCHAR(150) | (nullable) |
| peta_lokasi | TEXT | Embed Google Maps (nullable) |
| created_at, updated_at | TIMESTAMP | |

**Tabel: `pesan_kontak`**
| Field | Tipe Data | Keterangan |
|---|---|---|
| id | BIGINT (PK, AI) | Primary key |
| properti_id | BIGINT (FK → properti.id, nullable) | Relasi jika pesan terkait properti tertentu |
| nama | VARCHAR(100) | Nama pengirim |
| email | VARCHAR(100) | Email pengirim |
| no_telepon | VARCHAR(20) | No. telepon pengirim |
| subjek | VARCHAR(150) | Subjek pesan (nullable) |
| pesan | TEXT | Isi pesan |
| status_baca | ENUM('belum_dibaca','sudah_dibaca') | Status pesan |
| created_at, updated_at | TIMESTAMP | |

---

## 8. STRUKTUR MENU / SITEMAP

### 8.1 Sisi Publik
```
Beranda
├── Tentang Kami
├── Properti
│   ├── Semua Properti (dengan filter & pencarian)
│   └── Detail Properti
├── Kontak
└── (Footer: Info Perusahaan, Sosial Media, Peta Lokasi)
```

### 8.2 Sisi Admin (Dashboard)
```
Login
└── Dashboard
    ├── Kelola Properti
    │   ├── Daftar Properti
    │   ├── Tambah Properti
    │   ├── Edit Properti
    │   └── Kelola Galeri per Properti
    ├── Kelola Kategori
    ├── Kelola Informasi Perusahaan
    ├── Kelola Kontak / Pesan Masuk
    ├── Pengaturan Akun (ubah password)
    └── Logout
```

---

## 9. DAFTAR HALAMAN (PAGE LIST)

| No | Halaman | Akses | Deskripsi |
|---|---|---|---|
| 1 | Login Admin | Admin | Form autentikasi masuk dashboard |
| 2 | Dashboard | Admin | Ringkasan statistik data |
| 3 | Daftar Properti (Admin) | Admin | Tabel data properti + aksi CRUD |
| 4 | Form Tambah/Edit Properti | Admin | Input data & upload foto |
| 5 | Kelola Galeri | Admin | Upload/hapus foto per properti |
| 6 | Kelola Kategori | Admin | CRUD kategori |
| 7 | Kelola Informasi Perusahaan | Admin | Edit profil perusahaan |
| 8 | Kelola Kontak/Pesan Masuk | Admin | Lihat, tandai, hapus pesan |
| 9 | Beranda | Publik | Properti unggulan, kategori, sekilas perusahaan |
| 10 | Daftar Properti (Publik) | Publik | List properti + search + filter |
| 11 | Detail Properti | Publik | Info lengkap + galeri + form kontak |
| 12 | Tentang Kami | Publik | Profil, visi misi perusahaan |
| 13 | Kontak | Publik | Form kontak + info alamat, peta, sosial media |

---

## 10. KEBUTUHAN SISTEM (SPESIFIKASI MINIMUM)

### 10.1 Kebutuhan Perangkat Lunak (Development)
- Sistem Operasi: Windows/Linux/macOS
- Web Server lokal: XAMPP/Laragon (Apache, MySQL, PHP ≥ 8.2)
- Composer & Node.js (npm/yarn)
- Text editor: Visual Studio Code
- Browser: Chrome/Firefox/Edge

### 10.2 Kebutuhan Perangkat Keras (Minimum)
- Processor Dual Core ke atas
- RAM minimal 4 GB (disarankan 8 GB)
- Ruang penyimpanan minimal 10 GB kosong
- Koneksi internet (untuk hosting/testing online)

### 10.3 Kebutuhan Hosting (Produksi)
- Shared hosting/VPS dengan PHP ≥ 8.2, MySQL ≥ 5.7
- Kapasitas penyimpanan disesuaikan jumlah foto properti (disarankan min. 1-2 GB)
- SSL Certificate (HTTPS) untuk keamanan

---

## 11. ASUMSI & BATASAN (CONSTRAINTS)

1. Pembayaran/transaksi properti dilakukan secara offline/manual di luar sistem.
2. Verifikasi legalitas properti dilakukan oleh tim internal perusahaan di luar sistem.
3. Konten (teks, foto) properti diinput manual oleh admin/marketing.
4. Sistem tidak menyediakan fitur chat real-time; komunikasi lanjutan diarahkan ke telepon/WhatsApp/email.
5. Hanya terdapat satu jenis akun admin dengan level kurang lebih setara (admin & marketing), kecuali ditentukan lain saat implementasi.

---

## 12. INDIKATOR KEBERHASILAN (SUCCESS METRICS)

1. Admin dapat melakukan seluruh operasi CRUD properti tanpa error dalam waktu < 5 menit per proses.
2. Calon konsumen dapat menemukan properti sesuai kriteria pencarian dalam waktu singkat (maks. 3 klik dari beranda).
3. Waktu muat halaman rata-rata di bawah 3 detik.
4. Seluruh pesan dari calon konsumen tercatat dan dapat diakses admin tanpa kehilangan data.

---

*Dokumen ini dapat digunakan sebagai acuan pengembangan Sistem Informasi Pemasaran Properti untuk Berkah Cahaya Alfatih, mulai dari tahap analisis, perancangan database, hingga implementasi menggunakan framework Laravel.*