# PRD UI/UX
# Sistem Informasi Pemasaran Properti — Berkah Cahaya Alfatih

**Versi Dokumen:** 1.0
**Tanggal:** 26 Juli 2026
**Referensi Visual:** Materi promosi Instagram @sumberberkahnur — "The Villa Grand Alfatih" (PT. Berkah Cahaya Alfatih)

---

## 1. LATAR BELAKANG & INTERPRETASI BRIEF

Materi promosi yang sudah dipakai perusahaan di Instagram punya karakter visual yang cukup kuat: **hijau tua sebagai warna dominan**, tipografi tebal dan besar, badge kuning untuk penawaran terbatas, kartu-kartu putih berisi angka (harga, DP, cashback), serta tepi kertas sobek (*torn paper*) yang memberi kesan promosi cetak/lapangan — bukan tampilan digital generik.

Website ini harus **melanjutkan identitas itu**, bukan mengganti dengan tema baru yang generik. Tapi karena beriklan sekali post di Instagram (hijau pekat + banyak dekorasi) berbeda kebutuhan dengan sebuah *website* yang dibaca berulang (butuh keterbacaan, hierarki, dan ruang bernapas), sistem warna & tipografi di bawah ini adalah **versi yang didisiplinkan** dari palet asli: hijau tetap jadi warna utama, kuning tetap jadi aksen penawaran, tapi latar halaman dibuat lebih tenang (bukan hijau penuh di semua bagian) supaya konten properti (foto, harga, spesifikasi) tetap mudah dibaca dalam waktu lama.

**Yang secara eksplisit dihindari:** gradient warna-warni ala AI (gradient hijau-ke-ungu, hijau-ke-biru, dsb), efek glow/blur dekoratif, kartu kaca (glassmorphism) tanpa alasan, dan ikon 3D generik. Semua warna di bawah adalah **warna solid/flat**, sesuai karakter asli materi promosi (yang juga solid, bukan gradient).

---

## 2. DESIGN TOKENS

### 2.1 Palet Warna

| Token | Hex | Penggunaan |
|---|---|---|
| `hijau-tua` (Forest Green) | `#123A28` | Header, footer, background section hero, teks di atas kuning |
| `hijau-utama` (Brand Green) | `#1F6B3D` | Tombol utama, navbar aktif, ikon, garis bawah judul |
| `hijau-muda` (Sage Tint) | `#E7EFE7` | Background section sekunder, hover state ringan, badge kategori |
| `kuning-emas` (Gold Accent) | `#E4A521` | Badge "Unit Terbatas", label promo, harga unggulan, CTA sekunder |
| `krem` (Paper) | `#F8F6F0` | Background utama halaman publik (pengganti hijau penuh flyer) |
| `arang` (Charcoal Text) | `#20241F` | Teks judul & body |
| `abu-baris` (Hairline) | `#D8D2C4` | Garis pembatas, border kartu, divider |
| `putih` | `#FFFFFF` | Kartu, form, permukaan konten |
| `merah-peringatan` | `#B3261E` | Status "Terjual", pesan error |

> Catatan: tidak ada warna gradient di seluruh sistem. Aksen visual dicapai lewat kontras hijau tua/kuning emas, bukan gradasi.

### 2.2 Tipografi

| Peran | Font | Alasan Pemilihan |
|---|---|---|
| **Display / Judul Besar** | **Archivo Black** (fallback: `Arial Black`) | Tebal, kokoh, blocky — senada dengan judul flyer asli ("THE VILLA GRAND ALFATIH") yang tebal dan penuh percaya diri. Dipakai terbatas hanya untuk H1/hero, tidak untuk body. |
| **Judul Section / Sub-heading** | **Archivo (SemiBold/Bold)** | Satu keluarga dengan display face agar konsisten, tapi lebih tenang untuk judul section berulang. |
| **Body Text** | **Inter (Regular/Medium)** | Grotesk netral, sangat terbaca di ukuran kecil — deskripsi properti, label form, teks panjang. |
| **Angka & Data** (harga, luas tanah, kode properti) | **IBM Plex Mono** | Angka harga dan kode properti (mis. `Rp 500.000.000`, `BCA-0001`) ditampilkan monospace agar terasa presisi seperti data teknis, bukan dekoratif. |

Skala tipe (desktop): H1 40–48px / H2 30px / H3 22px / Body 16px / Caption 13px. Line-height body 1.6 untuk keterbacaan deskripsi properti yang panjang.

### 2.3 Bentuk, Spacing, Elevasi
- **Radius sudut:** kecil dan konsisten — `6px` untuk kartu & tombol, `2px` untuk badge/tag (tegas, tidak membulat berlebihan — menghindari kesan "app generik").
- **Grid spacing:** basis 8px (8/16/24/32/48/64).
- **Elevasi:** shadow tipis dan solid (`0 2px 8px rgba(18,58,40,0.08)`), tidak ada efek blur/glow berwarna.
- **Border:** kartu properti memakai border tipis `1px solid #D8D2C4` sebagai pengganti bayangan berat — kesan "katalog/etalase", bukan "app modern kaca".

### 2.4 Elemen Signature: *Torn Edge Divider*
Elemen unik yang jadi jembatan antara identitas Instagram lama dan website baru: **garis pembatas bertekstur sobekan kertas** (zig-zag halus, bukan gelombang mulus) dipakai **satu kali per halaman** sebagai pembatas antara section hero (hijau tua) dan section konten (krem). Ini mengambil ciri khas paling menonjol dari flyer asli (tepi kertas sobek di setiap materi promosi) dan menerjemahkannya jadi satu elemen grafis konsisten di web — bukan dekorasi acak, tapi penanda transisi "dari promosi ke informasi".

```
[ HERO — hijau tua, judul Archivo Black putih ]
▔▔╲▁╱▔╲▁╱▔▔╲▁▔╲╱▔▔  ← torn edge divider (SVG, warna krem di atas hijau)
[ KONTEN — background krem ]
```

### 2.5 Ikonografi
- Gaya **line icon** (stroke 1.5–2px), sudut tegas, bukan ikon 3D/gradient.
- Set ikon spesifikasi properti: kamar tidur (bed), kamar mandi (shower), carport (mobil), luas tanah (denah petak), luas bangunan (rumah).
- Ikon kategori properti: rumah, ruko, tanah kavling, apartemen — flat, 1 warna (hijau utama di atas krem, putih di atas hijau tua).

---

## 3. PRINSIP PENGALAMAN PENGGUNA (UX PRINCIPLES)

1. **Harga & lokasi selalu terlihat tanpa klik** — dua informasi yang paling dicari calon konsumen (harga, lokasi) tampil langsung di kartu properti, tidak disembunyikan di halaman detail.
2. **Filter tidak menghilangkan konteks** — saat memfilter, jumlah hasil ("24 properti ditemukan") selalu tampil agar pengguna tahu efek filternya.
3. **CTA konsisten satu kata kerja** — tombol "Hubungi Kami" di semua tempat mengarah ke aksi yang sama (form kontak/WhatsApp), tidak berganti nama di halaman berbeda.
4. **Badge promo bermakna, bukan hiasan** — badge kuning ("Unit Terbatas", "Cashback") hanya dipakai kalau datanya benar diisi admin (bukan default selalu tampil), sesuai kebutuhan `is_unggulan` pada database.
5. **Kegagalan diberi arah, bukan disalahkan** — misal pencarian tanpa hasil: *"Belum ada properti yang cocok. Coba luaskan rentang harga atau ganti kategori."* — bukan sekadar "Data tidak ditemukan".

---

## 4. KOMPONEN UTAMA (COMPONENT LIBRARY)

### 4.1 Navbar Publik
```
┌───────────────────────────────────────────────────────────────┐
│ [Logo BCA]   Beranda   Properti   Tentang Kami   Kontak   [Hubungi Kami →] │
└───────────────────────────────────────────────────────────────┘
```
- Background hijau tua, teks krem/putih, tombol "Hubungi Kami" solid kuning emas dengan teks arang (kontras tertinggi, jadi CTA paling menonjol di navbar).
- Sticky saat scroll, menyusut tinggi 20% agar tidak makan tempat di mobile.

### 4.2 Kartu Properti (Property Card)
```
┌────────────────────────────┐
│ [ Foto Properti 4:3 ]       │
│ 🟡 Unit Terbatas             │ ← badge (kondisional)
├────────────────────────────┤
│ THE VILLA GRAND ALFATIH      │  Archivo SemiBold
│ 📍 Jl. Pramuka, Banjarmasin   │  Inter, abu tua
│ Rp 500.000.000                │  IBM Plex Mono, hijau utama, bold
│ 🛏 4  🚿 2  🚗 1  📐 100 m²    │  ikon spesifikasi ringkas
│ [ Tersedia ]                  │  status pill (hijau/merah/kuning)
└────────────────────────────┘
```

### 4.3 Stat Callout (diambil langsung dari gaya flyer "Harga Mulai / Total DP / Cashback")
Dipakai di halaman detail properti sebagai ringkasan cepat sebelum deskripsi panjang:
```
┌───────────────┬───────────────┬───────────────┐
│  HARGA MULAI   │   TIPE UNIT    │    STATUS      │
│  Rp 500 Jt     │   Tipe 70      │   Tersedia     │
└───────────────┴───────────────┴───────────────┘
```
Kartu putih, border 1px, angka besar dengan IBM Plex Mono — versi rapi dari kartu stat hijau-putih di flyer Instagram, tapi tanpa warna gradient dan diberi border tipis alih-alih shadow tebal.

### 4.4 Filter & Search Bar
```
┌──────────────────────────────────────────────────────────┐
│ 🔍 [ Cari nama properti / lokasi... ]           [ Cari ]  │
├──────────────────────────────────────────────────────────┤
│ Kategori ▾   Kota ▾   Rentang Harga ▾   Status ▾   Urutkan ▾ │
└──────────────────────────────────────────────────────────┘
```
- Di desktop: search bar full-width di atas, filter berbentuk dropdown horizontal di bawahnya (bukan sidebar) — supaya kartu properti dapat lebar penuh untuk grid 3 kolom.
- Di mobile: filter dilipat jadi satu tombol "Filter" yang membuka bottom-sheet.

### 4.5 Badge & Status Pill
| Status | Warna |
|---|---|
| Tersedia | Hijau utama, teks putih |
| Disewa | Hijau tua, teks krem |
| Negosiasi | Kuning emas, teks arang |
| Terjual | Merah peringatan, teks putih |

### 4.6 Formulir Kontak
- Label di atas input (bukan placeholder-only, agar tetap terbaca setelah diisi).
- Tombol submit: "Kirim Pesan" — solid hijau utama.
- Setelah submit sukses: pesan konfirmasi inline hijau muda "Pesan terkirim. Tim kami akan menghubungi Anda segera." — bukan popup modal, agar tidak mengganggu alur.

---

## 5. WIREFRAME HALAMAN — SISI PUBLIK

### 5.1 Beranda
```
┌─────────────────────────────────────────────────────────────┐
│ NAVBAR (hijau tua)                                            │
├─────────────────────────────────────────────────────────────┤
│ HERO (hijau tua, full-width)                                  │
│   "WUJUDKAN RUMAH IMPIAN ANDA BERSAMA BERKAH CAHAYA ALFATIH"  │  ← Archivo Black putih
│   [ Cari properti impian Anda... 🔍 ]                          │  ← search bar mengambang di hero
├╲▁╱╲▁╱╲▁╱╲▁╱╲▁╱╲▁╱╲▁╱╲▁╱╲▁╱╲▁╱╲▁╱────── torn edge divider ──┤
│ (background krem)                                              │
│ KATEGORI: [Rumah] [Ruko] [Tanah Kavling] [Apartemen]           │  pill kategori
│                                                                 │
│ PROPERTI UNGGULAN                                              │
│ [Card] [Card] [Card]                                           │  grid 3 kolom
│                                                                 │
│ TENTANG BERKAH CAHAYA ALFATIH (ringkas)                        │
│ [foto/ilustrasi]   Teks profil singkat + [Selengkapnya →]      │
│                                                                 │
│ CTA STRIP (hijau tua penuh)                                    │
│ "Punya pertanyaan seputar properti kami?" [ Hubungi Kami ]     │
├─────────────────────────────────────────────────────────────┤
│ FOOTER (hijau tua): Logo, Alamat, Kontak, Sosial Media, Peta   │
└─────────────────────────────────────────────────────────────┘
```

### 5.2 Daftar Properti
```
┌─────────────────────────────────────────────────────────────┐
│ NAVBAR                                                         │
├─────────────────────────────────────────────────────────────┤
│ Judul halaman: "Semua Properti"     "24 properti ditemukan"   │
│ [ Search bar + Filter row ]                                    │
├─────────────────────────────────────────────────────────────┤
│ [Card] [Card] [Card]                                           │
│ [Card] [Card] [Card]                                           │  grid responsif
│ [Card] [Card] [Card]                                           │
│              [ Pagination: ‹ 1 2 3 4 › ]                       │
├─────────────────────────────────────────────────────────────┤
│ FOOTER                                                          │
└─────────────────────────────────────────────────────────────┘
```
Kondisi kosong: ilustrasi line-art sederhana + teks "Belum ada properti yang cocok dengan pencarian Anda" + tombol "Reset Filter".

### 5.3 Detail Properti
```
┌─────────────────────────────────────────────────────────────┐
│ NAVBAR                                                         │
├─────────────────────────────────────────────────────────────┤
│ [ Galeri foto — slider utama + thumbnail strip di bawah ]     │
├─────────────────────────────────────────────────────────────┤
│ THE VILLA GRAND ALFATIH — Tipe 70          [ Tersedia ]        │
│ 📍 Jl. Pramuka Gg. Kasturi, Banjarmasin Timur                  │
│ Rp 700.000.000                                                 │
│ [ Stat Callout: Harga / Tipe / Status ]                        │
│                                                                 │
│ Spesifikasi                     |  Fasilitas                  │
│ 🛏 4 Kamar Tidur                 |  Carport, Garden             │
│ 🚿 2 Kamar Mandi                 |  Listrik PLN                 │
│ 📐 100 m² Luas Tanah             |  Air PDAM                    │
│ 🏠 2 Lantai                      |                              │
│                                                                 │
│ Deskripsi Properti (paragraf)                                  │
│                                                                 │
│ [ Tombol besar: Hubungi Kami Tentang Properti Ini → ]          │
│                                                                 │
│ Properti Serupa                                                │
│ [Card] [Card] [Card]                                           │
├─────────────────────────────────────────────────────────────┤
│ FOOTER                                                          │
└─────────────────────────────────────────────────────────────┘
```

### 5.4 Tentang Kami
```
HERO kecil (hijau tua): "Tentang Berkah Cahaya Alfatih"
├╲▁╱ torn edge divider ╲▁╱┤
Profil perusahaan | Visi & Misi (2 kartu berdampingan) | Kontak singkat + CTA
```

### 5.5 Kontak
```
HERO kecil: "Hubungi Kami"
├─────────────────────────────────────────┤
[ Form Kontak ]        |  [ Info: alamat, telp, WA, jam operasional, peta embed ]
```

---

## 6. WIREFRAME HALAMAN — SISI ADMIN

Sisi admin memakai palet yang sama tapi lebih fungsional (lebih banyak putih, hijau hanya sebagai sidebar & aksen aksi) — prioritas kecepatan input data, bukan promosi.

### 6.1 Login Admin
```
┌───────────────────────────────┐
│         [ Logo BCA ]           │
│    Masuk ke Dashboard Admin    │
│  [ Username ]                  │
│  [ Password ]                  │
│  [   Masuk   ] ← hijau utama   │
└───────────────────────────────┘
```
Background krem polos, kartu login putih di tengah — tidak memakai hero hijau penuh agar fokus pada form.

### 6.2 Layout Dashboard (semua halaman admin)
```
┌───────────┬───────────────────────────────────────────┐
│  SIDEBAR   │  Topbar: [judul halaman]     [Admin ▾]     │
│ (hijau tua)├───────────────────────────────────────────┤
│ Dashboard  │                                             │
│ Properti   │   [ Konten halaman ]                        │
│ Kategori   │                                             │
│ Galeri     │                                             │
│ Info Perusahaan │                                        │
│ Kontak     │                                             │
│ Logout     │                                             │
└───────────┴───────────────────────────────────────────┘
```
- Sidebar hijau tua dengan ikon line putih, item aktif diberi latar kuning emas tipis + teks arang (kontras tinggi, jelas menunjukkan lokasi saat ini).
- Konten utama background krem, kartu/table putih dengan border tipis (konsisten dengan sisi publik).

### 6.3 Kelola Properti (Tabel + CRUD)
```
Kelola Properti                          [ + Tambah Properti ]
[ 🔍 Cari properti... ]
┌────┬──────────────────────┬──────────┬───────────┬─────────┬────────┐
│Foto│ Nama Properti         │ Kategori │ Harga      │ Status  │ Aksi   │
├────┼──────────────────────┼──────────┼───────────┼─────────┼────────┤
│ 🖼 │ The Villa Grand Alfatih│ Rumah    │ Rp 500 Jt  │ Tersedia│ ✏ 🗑 👁 │
└────┴──────────────────────┴──────────┴───────────┴─────────┴────────┘
```
Form tambah/edit properti: dibagi jadi 3 blok jelas — **Informasi Umum** (nama, kategori, deskripsi), **Spesifikasi** (luas tanah/bangunan, kamar, carport), **Harga & Status**, **Upload Foto** (drag & drop multi-upload dengan preview grid).

### 6.4 Kelola Galeri
Grid thumbnail foto per properti dengan tombol hapus (ikon 🗑) di tiap foto + tombol "Jadikan Sampul" pada foto yang belum jadi cover.

### 6.5 Kelola Kategori
Tabel sederhana: Nama Kategori | Jumlah Properti | Aksi — form tambah/edit muncul sebagai panel geser (slide-over) dari kanan, bukan modal di tengah, agar konteks tabel tetap terlihat.

### 6.6 Kelola Informasi Perusahaan
Form satu halaman panjang dengan sub-bagian: Profil (logo, deskripsi, visi misi), Kontak (telepon, WA, email, alamat), Media Sosial, Peta Lokasi (embed).

### 6.7 Kelola Kontak/Pesan Masuk
```
┌───┬─────────────┬────────────────────┬─────────────┬─────────┐
│●  │ Nama         │ Pesan (ringkas)     │ Tanggal     │ Aksi    │
├───┼─────────────┼────────────────────┼─────────────┼─────────┤
│🟡 │ Budi Santoso │ Tanya tipe 70...    │ 2 jam lalu  │ 👁 🗑    │
└───┴─────────────┴────────────────────┴─────────────┴─────────┘
```
Bulat kuning penuh = belum dibaca, bulat outline = sudah dibaca. Klik baris membuka detail pesan di panel kanan tanpa pindah halaman.

---

## 7. RESPONSIVE & AKSESIBILITAS

### 7.1 Breakpoint
| Breakpoint | Lebar | Perubahan Layout |
|---|---|---|
| Mobile | < 640px | Grid properti 1 kolom, filter jadi bottom-sheet, sidebar admin jadi hamburger menu |
| Tablet | 640–1024px | Grid properti 2 kolom, navbar tetap horizontal disederhanakan |
| Desktop | > 1024px | Grid properti 3 kolom, sidebar admin permanen terbuka |

### 7.2 Aksesibilitas
- Kontras teks minimum 4.5:1 (hijau tua `#123A28` di atas krem `#F8F6F0` = kontras tinggi, sudah memenuhi).
- Semua tombol & link punya *focus state* terlihat (outline 2px kuning emas), bukan dihilangkan.
- Semua foto properti wajib memiliki teks alternatif (alt text) diisi admin saat upload (mis. "Tampak depan The Villa Grand Alfatih tipe 70").
- Form kontak memakai `<label>` eksplisit terhubung ke input, bukan hanya placeholder.
- Animasi dibatasi (`prefers-reduced-motion` dihormati) — transisi halus di bawah 250ms, tanpa animasi berulang/mengganggu (autoplay slider foto tetap dapat dijeda pengguna).

---

## 8. MOTION & INTERAKSI (Dipakai Secukupnya)

- **Hover kartu properti:** border berubah dari abu tipis menjadi hijau utama + sedikit elevasi shadow (150ms) — tanpa scale/zoom berlebihan.
- **Torn edge divider:** statis, tidak dianimasikan (elemen identitas, bukan efek).
- **Transisi filter:** hasil grid fade-in singkat (150–200ms) saat filter diterapkan, agar terasa responsif tanpa mengagetkan.
- Tidak ada parallax, tidak ada partikel/efek dekoratif tambahan — sesuai prinsip "satu keberanian visual" yaitu torn edge divider, sisanya dijaga tenang dan fungsional.

---

## 9. ASET YANG PERLU DISIAPKAN

| Aset | Sumber | Catatan |
|---|---|---|
| Logo PT. Berkah Cahaya Alfatih (vektor, latar transparan) | Sudah ada (lihat referensi IG) | Perlu versi monokrom putih untuk dipakai di atas hijau tua |
| Font Archivo (Black, Bold, SemiBold) | Google Fonts (gratis) | — |
| Font Inter (Regular, Medium) | Google Fonts (gratis) | — |
| Font IBM Plex Mono (Regular, Medium) | Google Fonts (gratis) | Untuk harga & kode properti |
| Set ikon line (bed, bath, car, land, house, phone, whatsapp, map-pin) | Lucide Icons (open-source, sesuai gaya line minimal) | — |
| Foto properti (real, per unit) | Diunggah admin | Minimal 5 foto per properti: tampak depan, ruang tamu, kamar, dapur, denah |

---

## 10. RINGKASAN KEPUTUSAN DESAIN (DESIGN RATIONALE)

| Keputusan | Alasan |
|---|---|
| Warna solid, tanpa gradient | Konsisten dengan materi promosi asli yang solid; menghindari kesan "template AI" |
| Latar krem untuk konten (bukan hijau penuh) | Flyer Instagram efektif untuk sekali lihat; website dibaca berulang & butuh keterbacaan jangka panjang |
| Torn edge divider sebagai signature | Satu elemen ikonik dari flyer asli diterjemahkan jadi identitas web yang konsisten, bukan ditiru mentah-mentah |
| Archivo Black dibatasi hanya di hero/H1 | Tebal & mencolok seperti judul flyer, tapi tidak dipaksakan ke seluruh teks agar tetap terbaca |
| IBM Plex Mono untuk angka harga | Memberi kesan presisi/data pada informasi yang paling penting bagi konsumen properti |
| Badge kuning emas kondisional, bukan default | Menjaga makna promosi (unit terbatas, cashback) tetap jujur sesuai data, tidak jadi hiasan kosong |

---

*Dokumen ini melengkapi PRD Sistem Informasi Pemasaran Properti (versi fungsional/database) dengan spesifikasi desain UI/UX yang siap dipakai sebagai acuan implementasi Blade template, CSS/Tailwind config, dan komponen di Laravel.*
