# Panduan Optimasi, Testing, Debugging & Cleaning Code (Handover)

Dokumen ini berisi panduan dan *checklist* untuk mempersiapkan proyek menuju tahap *production* dan mempermudah proses serah terima (*handover*) ke developer lain.

## 1. Code Cleaning & Standarisasi (Refactoring)
- [ ] **Rapikan Format Kode:** Gunakan *Laravel Pint* atau *PHP CS Fixer* agar gaya penulisan kode (*coding style*) konsisten di seluruh file.
- [ ] **Hapus *Dead Code*:** Bersihkan file, fungsi, *route*, *view*, komponen, dan *library* (di `composer.json` atau `package.json`) yang tidak terpakai lagi.
- [ ] **Pindahkan Logika Bisnis:** Pastikan *Controller* tetap ramping (*thin controllers*). Pindahkan logika pemrosesan yang panjang/rumit ke *Services* atau *Actions*.
- [ ] **Variabel Lingkungan:** Pastikan file `.env.example` sudah diperbarui dengan variabel terbaru, dan pastikan file `.env` yang berisi kredensial asli/sensitif tidak masuk ke dalam repositori (git).

## 2. Optimasi Kode & Performa
- [ ] **Atasi N+1 Query Problem:** Gunakan *Eager Loading* (`with()`) saat mengambil data berelasi. Sangat direkomendasikan mengaktifkan `Model::preventLazyLoading(!app()->isProduction())` di `AppServiceProvider` untuk mendeteksi *lazy loading* saat masa *development*.
- [ ] **Database Indexing:** Pastikan kolom yang sering digunakan untuk pencarian (`WHERE`), pengurutan (`ORDER BY`), atau relasi (*Foreign Keys*) sudah diberi *index* pada file migrasi.
- [ ] **Cache Configuration:** Validasi aplikasi berjalan normal saat di-cache penuh. Jalankan perintah `php artisan optimize` (menggabungkan *cache* untuk route, config, dan view).
- [ ] **Optimasi Aset Frontend:** Pastikan menjalankan `npm run build` sebelum *deploy* ke production agar file CSS dan JS di-*minify* (ukurannya lebih kecil dan performa muat lebih cepat).

## 3. Testing & Debugging
- [ ] **Review Log Error:** Periksa file `storage/logs/laravel.log` secara berkala. Pastikan tidak ada *error* tersembunyi atau *warning* yang dibiarkan menumpuk.
- [ ] **Matikan Mode Debug:** Pastikan *tool* debugging (seperti *Laravel Debugbar* atau *Telescope*) dinonaktifkan di *production*. Set environment variable `APP_DEBUG=false` pada server *production*.
- [ ] **Automated Testing (Opsional):** Jalankan *unit/feature test* dengan *PHPUnit* atau *Pest*, terutama pada modul kritikal seperti *Role/Permission* dan *Editorial Workflow*.

## 4. Keamanan
- [ ] **Audit Dependensi:** Jalankan `composer audit` dan `npm audit` untuk memastikan dependensi (*library* pihak ketiga) bebas dari celah keamanan (*vulnerability*).
- [ ] **Keamanan Data (Mass Assignment):** Pastikan model telah dikonfigurasi dengan aman menggunakan properti `$fillable` (atau `$guarded` dengan hati-hati) agar tercegah dari modifikasi atribut tersembunyi.
- [ ] **Validasi Input:** Pastikan seluruh form atau masukan pengguna divalidasi (*Form Request Validation*) untuk menghindari *XSS* atau injeksi data yang tidak valid.

## 5. Dokumentasi & Handover
- [ ] **Perbarui `README.md`:** Tuliskan panduan setup sistem lokal, cantumkan spesifikasi minimal (versi PHP, Node.js), cara menginisialisasi *database* (`php artisan migrate --seed`), serta kredensial akun bawaan (Admin/Editor) untuk keperluan *testing*.
- [ ] **Dokumentasi Kode Kompleks:** Berikan penjelasan singkat (*DocBlocks* atau komentar) pada *method* atau fungsi logika yang kompleks agar developer penerima cepat memahami alur kerja aplikasi.
