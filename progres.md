# Log Progres Pembangunan USB Digital Archive

## Fase 1: Instalasi & Fondasi (Selesai)
- Menginstal Laravel 13 dan menghubungkan ke database MySQL (`web_usb`).
- Mengaktifkan ekstensi PHP `intl` dan menginstal Filament v5 untuk CMS Panel.
- Memperbaiki tabel `users` bawaan dengan menambahkan kolom `role` (admin, editor, author) yang aman.
- Membuat akun admin pertama dan memastikan panel dashboard bisa diakses.

## Fase 2: Database & CMS Panel (Berjalan)
- Membuat 5 tabel spesifik secara terpisah untuk mengakomodasi seluruh fitur tanpa kompromi (sesuai *rules-1*): 
  1. `cultural_explorations` (Telusur Budaya)
  2. `art_news` (Denyut Seni)
  3. `artworks` (Karya - Mendukung *Photo Story* & Video)
  4. `projects` (Proyek)
  5. `archives` (Arsip)
- Mengamankan model database dari celah *Mass Assignment* (menambahkan `$fillable`).
- Menjalankan *auto-generate* untuk menghasilkan halaman Master Data (CRUD) Filament bagi ke-5 tabel tersebut.
- **[SELESAI]** Mempercantik komponen UI form input di dashboard (seperti *File Upload*, *Rich Text Editor*, dan *Dropdown*).

## Status Kelengkapan (Berdasarkan requirement.txt)

**Yang sudah dibuat (Struktur Database & CMS Dashboard):**
- [x] **User Role:** Struktur *database* dan sistem *role* (Admin, Editor, Author, Visitor). Akun Admin pertama.
- [x] **Karya:** Struktur *database* untuk Fotografi, Videografi, Photo Story (multi-gambar), dan Dokumenter Visual (video embed).
- [x] **Telusur Budaya:** Struktur *database* (mendukung Lokasi & Tags).
- [x] **Denyut Seni:** Struktur *database* (mendukung Kalender/Event Date & Highlight).
- [x] **Proyek:** Struktur *database* (mendukung Video Embed).
- [x] **Arsip USB:** Struktur *database* (mendukung filter Tahun & Jenis Kegiatan).
- [x] **Penyempurnaan Panel CMS:** Form teks biasa telah diubah menjadi *Rich Text Editor*, *Image Uploader*, dan *Tags Input*, serta kolom *user_id* disembunyikan. Nama menu sidebar disesuaikan dengan standar Filament, dan label dalam form diterjemahkan ke bahasa Indonesia agar lebih ramah (*user-friendly*).
- [x] **Keamanan & Manajemen User (Fase 2.5):** Sistem *Policy* (hak akses) telah aktif dengan ketat. *Author* hanya bisa mengelola tulisan/karyanya sendiri, sedangkan *Admin* mengatur keseluruhan web. Menu rahasia (*Projects*, *Archives*, *Users*) sukses disembunyikan dari Editor & Author.
- [x] **Sistem Editorial Workflow (Pending/Accepted):** Sistem persetujuan redaksi telah aktif. Author hanya bisa menyimpan tulisan sebagai *Pending/Draft* (`is_published` tersembunyi), dan eksklusif hanya Admin/Editor yang bisa mem-*publish* tulisan tersebut ke publik. Aturan bawaan *database* telah diamankan agar *default* tulisan baru selalu berstatus *Pending*.

## Persiapan Fase Berikutnya (Fase 3: Frontend TALL Stack)

**Yang belum dibuat (Frontend Website):**
- [ ] **Halaman Beranda (Frontend):** Hero banner, Tagline, Highlight Artikel/Karya, Shortcut.
- [ ] **Halaman Tentang USB (Frontend):** Sejarah, Visi Misi, Filosofi, Struktur, Departemen.
- [ ] **Halaman Kontak (Frontend):** Email, IG, TikTok, YouTube, Lokasi, Form Kontak (tanpa database agar aman spam).
- [ ] **Tampilan Website (Frontend) untuk 5 Rubrik Utama:** Menampilkan data Karya, Budaya, Seni, Proyek, dan Arsip dari database ke halaman publik yang cantik.
