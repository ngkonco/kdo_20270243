# Panduan Akses & Kredensial Pengguna (akses_aplikasi.md)
### Sistem Informasi Pengelolaan Kendaraan Dinas Operasional (SIM-KDO)
**Studi Kasus: Barang Milik Daerah (BMD)**

Dokumen ini berisi informasi tautan akses, akun pengguna terotentikasi, kredensial database container, serta petunjuk cepat pengujian sistem.

---

## 🌐 1. Tautan Layanan Aplikasi

| Layanan | URL Akses | Keterangan |
| :--- | :--- | :--- |
| **Halaman Login SIM-KDO** | [http://localhost:8080/login](http://localhost:8080/login) | Pintu masuk autentikasi utama (*Protected Session*) |
| **Dashboard Utama** | [http://localhost:8080/](http://localhost:8080/) atau [http://localhost:8080/dashboard](http://localhost:8080/dashboard) | Halaman ringkasan analitik KDO |
| **Master Role & Hak Akses** | [http://localhost:8080/roles](http://localhost:8080/roles) | Pengelolaan tingkatan wewenang dan izin modul |
| **Master Pengguna Sistem** | [http://localhost:8080/users](http://localhost:8080/users) | Pengelolaan akun, password, dan penugasan peran |
| **phpMyAdmin Database GUI** | [http://localhost:8081](http://localhost:8081) | Pengelolaan database MariaDB via GUI web |

---

## 🔐 2. Akun & Kredensial Pengguna Aplikasi Siap Pakai

Sistem telah dilengkapi dengan 3 akun pengguna bawaan yang memiliki tingkatan hak akses berbeda. Seluruh password dienkripsi menggunakan algoritma **Bcrypt** (`PASSWORD_BCRYPT`):

### A. Administrator BMD (Hak Akses Penuh)
* **Role**: `admin`
* **Username**: `admin`
* **Email**: `admin@bmd.pemda.go.id`
* **Password**: `admin123`
* **Deskripsi Peran**: Memiliki wewenang mengelola seluruh master data (Perangkat Daerah, Pegawai PNS), inventarisasi armada KDO, mencatat servis pemeliharaan, serta menghapus data aset.

### B. Operator Pengurus Barang (Operasional & Servis)
* **Role**: `operator`
* **Username**: `operator`
* **Email**: `operator@bmd.pemda.go.id`
* **Password**: `operator123`
* **Deskripsi Peran**: Bertugas melakukan pendataan kendaraan operasional baru, pemantauan kondisi fisik armada, serta penginputan riwayat servis dan biaya perbaikan berkala.

### C. Kepala Badan / Pimpinan (Monitoring & Pengawasan)
* **Role**: `pimpinan`
* **Username**: `pimpinan`
* **Email**: `pimpinan@bmd.pemda.go.id`
* **Password**: `pimpinan123`
* **Deskripsi Peran**: Digunakan oleh jajaran pimpinan untuk memonitor kelaikan armada melalui Donut Chart, distribusi kendaraan per dinas melalui Bar Chart, serta rekapitulasi anggaran pemeliharaan.

> **💡 Tips Pengujian Cepat (1-Klik)**:
> Pada halaman login `http://localhost:8080/login`, telah disediakan tombol pintas **Demo Credentials**. Cukup klik kartu peran (*Admin* / *Operator*), maka form login akan terisi otomatis tanpa perlu mengetik manual.

---

## 🗄️ 3. Kredensial Database MariaDB (Container `kdo_db`)

Kredensial berikut digunakan oleh aplikasi CodeIgniter 4 dan dapat digunakan untuk login langsung ke **phpMyAdmin** ([http://localhost:8081](http://localhost:8081)):

* **Host (Internal Container)**: `db`
* **Host (Dari Komputer Host)**: `localhost` atau `127.0.0.1`
* **Port**: `3306`
* **Nama Database**: `kdo_bmd`
* **Username Standar**: `kdo_user`
* **Password Standar**: `kdo_password_2026`
* **Root Password**: `root_password_kdo_2026`

---

## 🚀 4. Perintah Cepat Container Docker

### Menjalankan Container:
```bash
docker compose up -d --build
```

### Eksekusi Migrasi Skema 3NF:
```bash
docker compose exec app php spark migrate
```

### Eksekusi Seeder Data Riil & Akun Pengguna:
```bash
docker compose exec app php spark db:seed MainSeeder
```

### Ekspor Dump Database Terkini:
```bash
docker compose exec db mariadb-dump -u kdo_user -pkdo_password_2026 kdo_bmd > backup_kdo_bmd.sql
```

### Menghentikan Container:
```bash
docker compose down
```
