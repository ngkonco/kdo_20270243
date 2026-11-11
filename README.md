# Sistem Informasi Pengelolaan Kendaraan Dinas Operasional (SIM-KDO)
### Pengelolaan Aset Barang Milik Daerah (BMD) Berbasis CodeIgniter 4 & Docker

![PHP Version](https://img.shields.io/badge/PHP-8.4%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Framework](https://img.shields.io/badge/CodeIgniter-4.7.6-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white)
![Database](https://img.shields.io/badge/MariaDB-10.11-003545?style=for-the-badge&logo=mariadb&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![Security](https://img.shields.io/badge/OWASP-Hardened-22c55e?style=for-the-badge&logo=security&logoColor=white)

---

## 📌 1. Deskripsi Aplikasi
**SIM-KDO (Sistem Informasi Pengelolaan Kendaraan Dinas Operasional)** adalah aplikasi web tingkat enterprise yang dirancang khusus untuk memonitor, menginventarisasi, dan mengelola armada kendaraan dinas operasional sebagai **Barang Milik Daerah (BMD)** pada instansi pemerintah daerah (Provinsi/Kabupaten/Kota).

Aplikasi ini mengadopsi standar arsitektur **MVC (Model-View-Controller)** yang bersih, skema database relasional **Third Normal Form (3NF)** dengan foreign key cascade integrity, proteksi keamanan berlapis (**CSRF Token Randomization**, **SQL Injection Prevention via Query Builder PDO**, **Strict XSS Escaping `esc()`**, dan **HTTP Security Headers**), serta antarmuka modern yang terinspirasi oleh desain dashboard **Metronic Dark Sidebar**.

---

## 🚀 2. Stack Teknologi & Arsitektur
- **Backend**: CodeIgniter 4 (PHP 8.4+) dengan Query Builder & Model Entity-Repository.
- **Frontend**: Blade-style Master Layout, Bootstrap 5.3, FontAwesome 6 Icons, DataTables.net (Responsive), Chart.js (Donut & Bar Charts), dan SweetAlert2 Feedback Modals.
- **Database**: MariaDB 10.11 / MySQL 8.0 dengan foreign key constraints aktif dan relational integrity.
- **DevSecOps**: Docker multi-container (`app`, `db`, `pma`) dengan persistent volume dan container healthcheck.

---

## 🛠️ 3. Panduan Instalasi & Menjalankan (Docker 1-Langkah)

### Prasyarat
- Docker Desktop aktif pada komputer / server.
- Git.

### Langkah-langkah:
1. **Clone repository atau buka direktori proyek**:
   ```bash
   cd kdo_sugeng_riyadi
   ```

2. **Jalankan Container Docker**:
   ```bash
   docker compose up -d --build
   ```
   *Perintah ini akan secara otomatis membangun container PHP 8.4 Apache (`kdo_app`), database MariaDB (`kdo_db`), dan phpMyAdmin (`kdo_pma`).*

3. **Jalankan Migrasi Database**:
   ```bash
   docker compose exec app php spark migrate
   ```
   *Mengeksekusi 4 migration files skema 3NF: `perangkat_daerah`, `pegawai`, `kendaraan`, dan `riwayat_pemeliharaan`.*

4. **Jalankan Database Seeder**:
   ```bash
   docker compose exec app php spark db:seed MainSeeder
   ```
   *Mengisi database dengan data riil: 4 Perangkat Daerah, 7 Pegawai PNS (NIP 18 digit valid), 10 unit KDO Plat Merah (Avanza, Innova, Hilux, Ambulans, Pajero Sport, Truk), dan 6 riwayat servis lengkap.*

---

## 🌐 4. URL Akses & Kredensial Layanan

| Layanan | URL Akses | Username | Password |
| :--- | :--- | :--- | :--- |
| **Aplikasi Web SIM-KDO** | [http://localhost:8080](http://localhost:8080) | *(Akses Langsung)* | - |
| **phpMyAdmin Database GUI** | [http://localhost:8081](http://localhost:8081) | `kdo_user` | `kdo_password_2026` |
| **phpMyAdmin (Root)** | [http://localhost:8081](http://localhost:8081) | `root` | `root_password_kdo_2026` |

---

## 💾 5. Panduan Ekspor Dump Database `.sql` via Container
Untuk mengekspor database `kdo_bmd` secara instan dari container MariaDB yang sedang berjalan, gunakan perintah berikut:

```bash
docker compose exec db mariadb-dump -u kdo_user -pkdo_password_2026 kdo_bmd > backup_kdo_bmd.sql
```

Atau gunakan file cadangan skema bawaan yang telah disediakan di root repository:
```bash
database_dump.sql
```

---

## 🧪 6. Panduan Pengujian Fitur & Skenario Uji

1. **Dashboard Eksekutif (`/dashboard`)**:
   - Periksa 4 Kartu Metrik (Total KDO, Unit Baik [Hijau], Unit Rusak Ringan [Kuning], Unit Rusak Berat [Merah]).
   - Amati Donut Chart interaktif (persentase kelaikan armada) dan Bar Chart (distribusi unit per dinas).
   - Periksa tabel 5 armada yang membutuhkan perbaikan tercepat dengan tombol aksi langsung.
2. **Pengelolaan Armada KDO (`/kendaraan`)**:
   - Filter data berdasarkan kondisi (*Baik*, *Rusak Ringan*, *Rusak Berat*) dan berdasarkan Perangkat Daerah.
   - Pencarian langsung pada tabel DataTables (responsif).
   - Klik **Detail** pada salah satu kendaraan (misal `AD 1001 ZA` atau `AD 1003 ZA`) untuk melihat Kartu Aset BMD lengkap, profil PNS pemegang, dan riwayat perbaikan beserta total pengeluaran biaya.
   - Uji penambahan KDO baru (`/kendaraan/create`): amati fitur **Cascading Dropdown** di mana pemilihan Perangkat Daerah secara otomatis memfilter nama-nama PNS yang bertugas di dinas tersebut.
3. **Pencatatan Servis & Sinkronisasi Status (`/pemeliharaan`)**:
   - Tambah riwayat pemeliharaan baru pada unit yang berstatus "Rusak Ringan" (`/pemeliharaan/create`).
   - Masukkan biaya servis, bengkel, uraian perbaikan, dan pilih kondisi akhir: "Baik".
   - Simpan data: sistem secara otomatis memperbarui status kelaikan fisik pada tabel `kendaraan` menjadi "Baik".
4. **Relational Integrity & Deletion Protection (`/perangkat-daerah`)**:
   - Coba hapus Perangkat Daerah yang masih memiliki kendaraan atau pegawai aktif. Sistem akan menolak dan memberikan pesan peringatan SweetAlert demi menjaga integritas data BMD.

---

## 📷 7. Checklist Bukti Screenshot (Repository Assets)

Untuk dokumentasi laporan praktikum / pengujian, tangkapan layar wajib disiapkan:
- [x] **01_Dashboard_View.png**: Halaman dashboard utama menampilkan 4 metrik cards, Donut Chart, Bar Chart, dan tabel unit butuh perbaikan.
- [x] **02_Kendaraan_List_Filter.png**: Tabel data KDO dengan filter kondisi dan instansi serta badge status warna-warni.
- [x] **03_Kendaraan_Detail_Asset.png**: Halaman detail unit KDO menampilkan identitas kendaraan, kartu instansi, kartu PNS penanggung jawab, dan riwayat pemeliharaan.
- [x] **04_Form_Create_Validation.png**: Form registrasi KDO baru dengan dropdown cascading instansi-pegawai dan feedback validasi error.
- [x] **05_Pemeliharaan_List.png**: Rekapitulasi pemeliharaan dan total biaya servis.
- [x] **06_Database_Structure_PMA.png**: Tampilan struktur tabel relasional (3NF) dan foreign keys di phpMyAdmin / terminal.

---

## 🔒 8. Fitur Keamanan (Security Hardening)
- **CSRF Token Randomization**: Diaktifkan secara global di seluruh formulir dengan helper `<?= csrf_field() ?>`.
- **SQL Injection Prevention**: Larangan keras concats string; 100% menggunakan CI4 Model Query Builder dengan PDO Prepared Statements parameter binding.
- **XSS Sanitization**: Seluruh output variabel pada view dibungkus fungsi `<?= esc(...) ?>`.
- **Strict Validation Rules**: Validasi unik NIP (18 digit), keunikan plat nomor dinas, validitas enum kondisi, dan eksistensi foreign key (`is_not_unique`).
- **HTTP Security Headers**: Ditangani melalui custom filter `SecurityHeadersFilter` (`X-Frame-Options: SAMEORIGIN`, `X-Content-Type-Options: nosniff`, `Content-Security-Policy`, `Referrer-Policy: strict-origin-when-cross-origin`).
