# Deklarasi Penggunaan Model AI / Asisten Pengembang (agents.md)

Dokumen ini disusun sebagai wujud transparansi akademik dan profesionalisme rekayasa perangkat lunak sesuai regulasi pengujian dan pengembangan proyek sistem informasi.

---

## 1. Identitas Model AI & Lingkungan Kerja
- **Nama Asisten / Model AI**: Antigravity Assistant (Powered by Google DeepMind Gemini Technology)
- **Peran yang Dijalankan**: Lead Software Architect, Senior Full Stack PHP Developer, & DevOps Specialist
- **Tanggal Pengembangan**: 11 November 2026
- **Lingkungan**: Windows x86_64, Docker Desktop Linux Engine, Visual Studio Code / Antigravity IDE

---

## 2. Ringkasan Instruksi Prompt Pengguna
Instruksi prompt yang diberikan berfokus pada pembangunan sistem informasi terintegrasi secara end-to-end tanpa hardcode dan siap jalan (*production-ready*) untuk studi kasus:
> *"Sistem Informasi Pengelolaan Kendaraan Dinas Operasional (KDO) - Barang Milik Daerah (BMD)"*

Cakupan instruksi mencakup:
1. **Containerization**: Pembuatan `Dockerfile` multi-stage/PHP 8.4-apache dengan modul dan ekstensi wajib (`intl`, `mbstring`, `pdo_mysql`, `mysqli`, `zip`, `gd`, `curl`, `opcache`), `docker-compose.yml` multi-container (`app`, `db`, `pma`), dan `.env`.
2. **Database Normalization (3NF)**: Perancangan skema relasional 4 entitas (`perangkat_daerah`, `pegawai`, `kendaraan`, `riwayat_pemeliharaan`) dengan foreign key cascade integrity, migrations, dan seeder data riil.
3. **Security Hardening**: Proteksi CSRF (`csrf_field()`), mitigasi SQL Injection (Query Builder PDO parameter binding), mitigasi XSS (`esc()`), validasi ketat, dan HTTP Security Headers.
4. **Backend Implementation**: Arsitektur MVC bersih, controllers modular, auto timestamps, and business logic otomatis (sinkronisasi kondisi pasca pemeliharaan).
5. **Frontend Implementation**: Antarmuka responsif mengadopsi konsep *Metronic Dark Sidebar*, Bootstrap 5, FontAwesome, DataTables.net, Chart.js (Donut & Bar), dan SweetAlert2 dialogs.
6. **Dokumentasi & Repository Assets**: Penyusunan `README.md`, `agents.md`, dump SQL, dan panduan pengujian screenshot.

---

## 3. Ruang Lingkup Kode yang Dihasilkan AI

| Komponen / Berkas | Ruang Lingkup Kode yang Dibuat | Status Validasi |
| :--- | :--- | :--- |
| `Dockerfile` | Konfigurasi image PHP 8.4 Apache, instalasi paket OS & ekstensi PHP, konfigurasi vhost DocumentRoot `public/`, dan setup perizinan direktori `writable/`. | Selesai & Teruji |
| `docker-compose.yml` | Orkestrasi 3 layanan (`app`, `db` MariaDB 10.11, `pma` phpMyAdmin) dengan persistent storage, network bridge, dan healthcheck. | Selesai & Teruji |
| `docker/apache/000-default.conf` | VirtualHost Apache dengan direktif `AllowOverride All` dan direct point ke DocumentRoot `public/`. | Selesai & Teruji |
| `app/Database/Migrations/` | 4 Berkas migrasi database normalisasi 3NF dengan tipe data presisi, indeks, dan relasi foreign key. | Selesai & Teruji |
| `app/Database/Seeds/` | 5 Berkas seeder (Perangkat Daerah, Pegawai, Kendaraan, Riwayat Pemeliharaan, dan MainSeeder) dengan data realistis plat dinas merah. | Selesai & Teruji |
| `database_dump.sql` | Berkas dump SQL mandiri skema + seeder data siap impor langsung. | Selesai & Teruji |
| `app/Models/` | 4 Model (`PerangkatDaerahModel`, `PegawaiModel`, `KendaraanModel`, `RiwayatPemeliharaanModel`) lengkap dengan `$allowedFields`, validasi, dan agregasi data analitik. | Selesai & Teruji |
| `app/Controllers/` | 5 Controller (`DashboardController`, `PerangkatDaerahController`, `PegawaiController`, `KendaraanController`, `PemeliharaanController`) dengan logika CRUD lengkap, AJAX endpoint, dan feedback flashdata. | Selesai & Teruji |
| `app/Filters/SecurityHeadersFilter.php` | Filter HTTP Security Headers (`X-Frame-Options`, `X-Content-Type-Options`, `CSP`, `Referrer-Policy`). | Selesai & Teruji |
| `app/Views/layouts/` | Master view `main.php`, Metronic-style dark sidebar `sidebar.php`, dan sticky header navbar `navbar.php`. | Selesai & Teruji |
| `app/Views/dashboard/` | Halaman dashboard dengan 4 summary cards, Donut Chart, Bar Chart, dan tabel unit butuh perbaikan. | Selesai & Teruji |
| `app/Views/kendaraan/` | View index (DataTables & filter), create (cascading dropdown instansi-pegawai), edit, dan kartu aset detail komprehensif. | Selesai & Teruji |
| `app/Views/pegawai/` | View index, create, dan edit master pegawai PNS. | Selesai & Teruji |
| `app/Views/perangkat_daerah/` | View index, create, dan edit master perangkat daerah. | Selesai & Teruji |
| `app/Views/pemeliharaan/` | View index rekapitulasi, create pencatatan servis (sinkronisasi status), dan edit. | Selesai & Teruji |
| `README.md` & `agents.md` | Dokumentasi teknis, petunjuk instalasi, panduan ekspor database, dan deklarasi AI. | Selesai & Teruji |

---

## 4. Pernyataan Integritas Kode
Seluruh baris kode yang dihasilkan telah ditinjau untuk memastikan:
- Tidak ada kredensial atau rahasia yang ter-hardcode secara tidak aman.
- Tidak ada query mentah (*raw SQL string concatenations*) yang rentan injeksi SQL.
- Seluruh form dilindungi dengan token CSRF valid.
- Kode siap dijalankan langsung di lingkungan container Docker tanpa dependensi instalasi manual pada sistem host.

