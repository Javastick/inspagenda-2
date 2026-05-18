# Implementation Plan: Fase 3.3 - Implementasi Views, Routing, Middleware & Massive Seeder

Dokumen ini berisi panduan tingkat tinggi (*high-level planning*) untuk merakit halaman antarmuka pengguna (View Assembly), mengatur alur navigasi yang aman (Routing & Middleware), serta menyiapkan *massive data seeding* untuk keperluan pengujian.

> [!IMPORTANT]
> **Standar Desain Global**: Seluruh halaman wajib dirancang dengan nuansa profesional dan **fully responsive (pendekatan mobile-first)**. Gunakan utilitas Tailwind CSS dan komponen DaisyUI secara ekstensif tanpa cacat tampilan di layar kecil. Pastikan konsistensi penggunaan Palet Warna Global (Primary `#FFC107`, Text `#1A1A1B`, Surface `#FFFFFF`).

---

## 1. Routing & Middleware Guard

*   **Pemetaan Alur Navigasi**: Alur navigasi harus mendefinisikan rute publik yang dapat diakses semua orang dan rute privat yang khusus untuk admin/operator.
*   **Public Routes (Tanpa Login)**:
    *   `/` (Welcome): Landing page sentral.
    *   `/home` (Kalender Publik): Halaman kalender agenda instansi secara global.
    *   `/divisions/{id}` (Portal Divisi): Halaman dashboard spesifik per-Irban.
    *   `/jadwal/{id}` (Detail Jadwal): Halaman untuk melihat detail atau keterangan jadwal spesifik.
    *   `/register-admin-secret` (Register Hidden): Halaman pendaftaran rahasia untuk admin.
*   **Protected Routes (Middleware `auth`)**:
    *   Rute-rute ini wajib diproteksi ketat agar hanya admin yang terautentikasi yang bisa mengaksesnya. Jika tidak login, *redirect* ke halaman login.
    *   `/admin/dashboard`: Dashboard manajemen utama (CRUD).
    *   `/admin/surat/create`: Form input surat tugas baru.
    *   `/admin/surat/{id}/edit`: Form pengeditan surat tugas.
    *   Rute aksi (POST/PUT/DELETE) untuk manajemen `invite_mails`.

---

## 2. View Assembly (Perakitan Halaman)

Rakit halaman-halaman berikut dengan wajib menggunakan Blade Components yang telah diekstrak pada fase sebelumnya (`<x-layout.app>`, `<x-calendar-widget>`, `<x-schedule-list>`, `<x-division-sidebar>`, `<x-auditor-stats>`).

*   **`welcome.blade.php` (Landing Page)**:
    *   Tampilkan logo Inspagenda secara sentral dan estetis.
    *   Sediakan 3 navigasi utama yang mencolok (misal menggunakan *Hero section* DaisyUI): "Lihat Jadwal", "Input Surat" (mengarah ke login jika belum), dan "Portal Divisi" (berupa *dropdown* atau *grid menu* pembagian Irban).
*   **`home.blade.php` (Kalender Global Publik)**:
    *   Gunakan `<x-layout.app>`.
    *   Kombinasikan `<x-calendar-widget>` yang merender *semua* jadwal (lintas divisi).
    *   Gunakan `<x-schedule-list>` untuk menampilkan daftar jadwal dengan filter "Hari ini" dan "Hari berikutnya" (jadwal 2 hari ke depan).
*   **`auth/login.blade.php`**:
    *   Halaman login admin dengan desain *card* profesional di tengah layar (*centered*).
*   **`auth/register.blade.php` (Hidden Register)**:
    *   Halaman registrasi admin dengan form yang memvalidasi *secret key*.
*   **`admin/dashboard.blade.php` (Manajemen CRUD)**:
    *   Halaman terlindungi dengan tabel manajemen untuk `invite_mails`.
    *   Tampilkan tabel arsip surat yang diurutkan dari yang terbaru (teratas) ke bawah.
    *   Tabel harus menampilkan tombol aksi: Lihat, Edit, Hapus.
    *   Beri tanda/badge visual pada baris tabel untuk menandai status jadwal: "Terlewat" (Abu-abu), "Hari Ini" (Hijau), "Mendatang" (Kuning).
*   **`admin/surat/create.blade.php` & `admin/surat/edit.blade.php`**:
    *   Formulir input dan edit surat undangan. Gunakan form control DaisyUI agar rapi.
*   **`divisions/portal.blade.php` (Portal Spesifik Irban)**:
    *   Sudah direfaktor sebelumnya, pastikan integrasi `<x-division-sidebar>`, `<x-calendar-widget>`, dan `<x-auditor-stats>` berjalan mulus di *mobile* (sidebar berubah menjadi *drawer* atau turun ke bawah konten utama).
    *   **Aturan Bisnis (Validasi Backend/Seeder)**: Pastikan setiap auditor bersifat eksklusif pada satu divisi (Relasi One-to-Many dari Divisi ke Auditor). Nama auditor di Irban 1 tidak boleh muncul di Irban 2.
*   **`jadwal/show.blade.php` (Lihat Keterangan)**:
    *   Halaman publik untuk melihat rincian suatu kegiatan (keterangan, lokasi, status pelaksanaan, auditor yang bertugas).

---

## 3. Massive Database Seeder (Pengujian Kapabilitas)

Untuk memastikan algoritma backend (seperti pemerataan tugas) dan rendering UI (kalender & list) berfungsi sempurna di bawah beban data nyata, buat mekanisme *seeding* masif:

*   **Pemanfaatan Library Faker**: Gunakan Laravel Factories yang dipadukan dengan Faker.
*   **Instruksi `DatabaseSeeder`**:
    *   buat 1 akun admin
    *   Buat `DivisionFactory` untuk men-*generate* struktur divisi dasar (Irban 1 - 4).
    *   Buat `AuditorFactory` untuk men-*generate* puluhan data auditor, dikaitkan secara ketat pada divisinya masing-masing.
    *   Buat `InviteMailFactory` untuk men-*generate* ratusan data surat undangan fiktif dengan rentang tanggal `masuk` dan `hari` bervariasi (dari sebulan yang lalu hingga bulan depan).
    *   Hubungkan auditor dengan jadwal melalui tabel pivot `auditor_schedule` dalam jumlah yang besar dan teracak.
