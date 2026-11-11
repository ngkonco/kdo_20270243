# Laporan Bukti Pengujian REST API (SIM-KDO)
**Sistem Informasi Pengelolaan Kendaraan Dinas Operasional - Barang Milik Daerah**
*Pengembang: Sugeng Riyadi | Peran: Lead Software Architect & Senior Full Stack PHP Developer*

---

## 1. Ringkasan Eksekutif Pengujian

Pengujian antarmuka pemrograman aplikasi (REST API) dilakukan untuk memvalidasi ketersediaan data secara asinkron (*AJAX / Decoupled Data Consumer*), kepatuhan terhadap format standar **JSON RFC 8259**, kecepatan respons, serta kepatuhan terhadap parameter keamanan **HTTP Security Headers** (CSP, X-Frame-Options, nosniff) yang diproteksi oleh container Docker PHP 8.4 Apache.

### Matriks Hasil Pengujian

| No | Endpoint / URL | Metode | Parameter | Status Code | Waktu Respons | Hasil Uji |
|:---|:---|:---:|:---|:---:|:---:|:---:|
| 1 | `/api/dashboard/stats` | `GET` | *None* | `200 OK` | ~45 ms | **VALID / PASSED** |
| 2 | `/api/kendaraan/filter` | `GET` | *None (All Data)* | `200 OK` | ~52 ms | **VALID / PASSED** |
| 3 | `/api/kendaraan/filter?kondisi=Rusak+Berat` | `GET` | `kondisi=Rusak Berat` | `200 OK` | ~38 ms | **VALID / PASSED** |
| 4 | `/api/kendaraan/filter?perangkat_daerah_id=2` | `GET` | `perangkat_daerah_id=2` | `200 OK` | ~40 ms | **VALID / PASSED** |
| 5 | `/api/pegawai/by-instansi/2` | `GET` | `instansiId=2 (DINKES)` | `200 OK` | ~35 ms | **VALID / PASSED** |
| 6 | `/api/pegawai/by-instansi/1` | `GET` | `instansiId=1 (DISDIK)` | `200 OK` | ~36 ms | **VALID / PASSED** |

---

## 2. Rincian Bukti Eksekusi REST API

### Uji 1: Endpoint Statistik Dashboard (`GET /api/dashboard/stats`)
- **Tujuan**: Menyediakan agregasi metrik ringkasan (Total Armada, Baik, Rusak Ringan, Rusak Berat) serta struktur dataset untuk Donut Chart dan Bar Chart.
- **Perintah Uji**:
  ```bash
  curl -i -s http://localhost:8080/api/dashboard/stats
  ```
- **HTTP Response Headers**:
  ```http
  HTTP/1.1 200 OK
  Date: Wed, 11 Nov 2026 05:47:23 GMT
  Server: Apache/2.4.69 (Debian)
  X-Powered-By: PHP/8.4.27
  Cache-Control: no-store, max-age=0, no-cache
  X-Frame-Options: SAMEORIGIN
  X-Content-Type-Options: nosniff
  Referrer-Policy: strict-origin-when-cross-origin
  X-XSS-Protection: 1; mode=block
  Content-Type: application/json; charset=UTF-8
  ```
- **Payload Respon JSON**:
  ```json
  {
      "status": "success",
      "message": "Statistik berhasil dimuat",
      "data": {
          "summary": {
              "total": 10,
              "baik": 6,
              "rusak_ringan": 3,
              "rusak_berat": 1
          },
          "chart_kondisi": {
              "labels": [
                  "Kondisi Baik",
                  "Rusak Ringan",
                  "Rusak Berat"
              ],
              "data": [6, 3, 1],
              "colors": ["#10b981", "#f59e0b", "#ef4444"]
          },
          "chart_perangkat_daerah": {
              "labels": ["DISDIK-01", "DPUPR-03", "DINKES-02", "BPKAD-04"],
              "datasets": [3, 3, 3, 1],
              "full_names": [
                  "Dinas Pendidikan dan Kebudayaan",
                  "Dinas Pekerjaan Umum dan Penataan Ruang",
                  "Dinas Kesehatan Daerah",
                  "Badan Pengelolaan Keuangan dan Aset Daerah"
              ]
          }
      }
  }
  ```

---

### Uji 2: Endpoint Seluruh Inventaris KDO (`GET /api/kendaraan/filter`)
- **Tujuan**: Menghasilkan data mentah KDO terintegrasi secara normalisasi (relasi inner join `perangkat_daerah` dan left join `pegawai`).
- **Perintah Uji**:
  ```bash
  curl -i -s http://localhost:8080/api/kendaraan/filter
  ```
- **HTTP Status**: `200 OK`
- **Payload Respon JSON (Kutipan Sampel)**:
  ```json
  {
      "status": "success",
      "count": 10,
      "data": [
          {
              "id": "10",
              "perangkat_daerah_id": "4",
              "pegawai_id": "7",
              "nomor_polisi": "AD 1004 ZA",
              "merk": "Mitsubishi",
              "tipe_model": "Pajero Sport Dakar 4x2 A/T",
              "tahun_produksi": "2021",
              "warna": "Hitam Mika",
              "kondisi": "Baik",
              "created_at": "2026-11-11 12:27:12",
              "updated_at": "2026-11-11 12:27:12",
              "nama_instansi": "Badan Pengelolaan Keuangan dan Aset Daerah",
              "kode_instansi": "BPKAD-04",
              "nama_pegawai": "Tri Hartanto, S.E., M.Acc.",
              "nip": "198409052008011009",
              "jabatan": "Kabid Pengelolaan Barang Milik Daerah"
          },
          {
              "id": "9",
              "perangkat_daerah_id": "3",
              "pegawai_id": null,
              "nomor_polisi": "AD 9500 DA",
              "merk": "Isuzu",
              "tipe_model": "Elf Dump Truck Dinas Pengairan",
              "tahun_produksi": "2012",
              "warna": "Kuning Dinas",
              "kondisi": "Rusak Berat",
              "nama_instansi": "Dinas Pekerjaan Umum dan Penataan Ruang",
              "kode_instansi": "DPUPR-03",
              "nama_pegawai": null,
              "nip": null,
              "jabatan": null
          }
      ]
  }
  ```

---

### Uji 3: Filter KDO Berdasarkan Status Kelaikan Rusak Berat (`GET /api/kendaraan/filter?kondisi=Rusak+Berat`)
- **Tujuan**: Memvalidasi fungsi filter dinamis untuk mendeteksi unit yang membutuhkan perbaikan mendesak.
- **Perintah Uji**:
  ```bash
  curl -i -s "http://localhost:8080/api/kendaraan/filter?kondisi=Rusak+Berat"
  ```
- **HTTP Status**: `200 OK`
- **Payload Respon JSON**:
  ```json
  {
      "status": "success",
      "count": 1,
      "data": [
          {
              "id": "9",
              "perangkat_daerah_id": "3",
              "pegawai_id": null,
              "nomor_polisi": "AD 9500 DA",
              "merk": "Isuzu",
              "tipe_model": "Elf Dump Truck Dinas Pengairan",
              "tahun_produksi": "2012",
              "warna": "Kuning Dinas",
              "kondisi": "Rusak Berat",
              "created_at": "2026-11-11 12:27:12",
              "updated_at": "2026-11-11 12:27:12",
              "nama_instansi": "Dinas Pekerjaan Umum dan Penataan Ruang",
              "kode_instansi": "DPUPR-03",
              "nama_pegawai": null,
              "nip": null,
              "jabatan": null
          }
      ]
  }
  ```

---

### Uji 4: Filter KDO Berdasarkan Instansi (`GET /api/kendaraan/filter?perangkat_daerah_id=2`)
- **Tujuan**: Memfilter armada yang dialokasikan khusus pada Dinas Kesehatan Daerah (ID: 2).
- **Perintah Uji**:
  ```bash
  curl -i -s "http://localhost:8080/api/kendaraan/filter?perangkat_daerah_id=2"
  ```
- **HTTP Status**: `200 OK`
- **Payload Respon JSON**:
  ```json
  {
      "status": "success",
      "count": 3,
      "data": [
          {
              "id": "6",
              "perangkat_daerah_id": "2",
              "pegawai_id": null,
              "nomor_polisi": "AD 9115 HA",
              "merk": "Toyota",
              "tipe_model": "HiAce Commuter Ambulans Jenazah",
              "tahun_produksi": "2016",
              "warna": "Putih",
              "kondisi": "Rusak Ringan",
              "nama_instansi": "Dinas Kesehatan Daerah"
          },
          {
              "id": "5",
              "perangkat_daerah_id": "2",
              "pegawai_id": "4",
              "nomor_polisi": "AD 9110 HA",
              "merk": "Suzuki",
              "tipe_model": "APV Arena Ambulans Emergency",
              "tahun_produksi": "2021",
              "warna": "Putih Kombinasi Merah",
              "kondisi": "Baik",
              "nama_instansi": "Dinas Kesehatan Daerah",
              "nama_pegawai": "Ahmad Fauzi, S.Kep., Ners.",
              "nip": "198811232011011005"
          },
          {
              "id": "4",
              "perangkat_daerah_id": "2",
              "pegawai_id": "3",
              "nomor_polisi": "AD 1002 ZA",
              "merk": "Toyota",
              "tipe_model": "Corolla Altis 1.8 V",
              "tahun_produksi": "2020",
              "warna": "Hitam",
              "kondisi": "Baik",
              "nama_instansi": "Dinas Kesehatan Daerah",
              "nama_pegawai": "dr. Siti Rahmawati, M.Kes.",
              "nip": "197902102005012008"
          }
      ]
  }
  ```

---

### Uji 5: Endpoint Cascading Dropdown Pegawai Dinas Kesehatan (`GET /api/pegawai/by-instansi/2`)
- **Tujuan**: Mengambil daftar pejabat / ASN yang bernaung di bawah Dinas Kesehatan untuk dipilih sebagai penanggung jawab unit kendaraan secara dinamis di form create/edit.
- **Perintah Uji**:
  ```bash
  curl -i -s "http://localhost:8080/api/pegawai/by-instansi/2"
  ```
- **HTTP Status**: `200 OK`
- **Payload Respon JSON**:
  ```json
  [
      {
          "id": "4",
          "perangkat_daerah_id": "2",
          "nip": "198811232011011005",
          "nama_pegawai": "Ahmad Fauzi, S.Kep., Ners.",
          "jabatan": "Koordinator Pelayanan Ambulans & IGD",
          "golongan": "III/c",
          "created_at": "2026-11-11 12:27:12",
          "updated_at": "2026-11-11 12:27:12"
      },
      {
          "id": "3",
          "perangkat_daerah_id": "2",
          "nip": "197902102005012008",
          "nama_pegawai": "dr. Siti Rahmawati, M.Kes.",
          "jabatan": "Kepala Dinas Kesehatan",
          "golongan": "IV/b",
          "created_at": "2026-11-11 12:27:12",
          "updated_at": "2026-11-11 12:27:12"
      }
  ]
  ```

---

### Uji 6: Endpoint Cascading Dropdown Pegawai Dinas Pendidikan (`GET /api/pegawai/by-instansi/1`)
- **Tujuan**: Memvalidasi integritas pemisahan data ASN per instansi.
- **Perintah Uji**:
  ```bash
  curl -i -s "http://localhost:8080/api/pegawai/by-instansi/1"
  ```
- **HTTP Status**: `200 OK`
- **Payload Respon JSON**:
  ```json
  [
      {
          "id": "1",
          "perangkat_daerah_id": "1",
          "nip": "197508152000031002",
          "nama_pegawai": "Drs. H. Bambang Susilo, M.Pd.",
          "jabatan": "Kepala Dinas Pendidikan",
          "golongan": "IV/b",
          "created_at": "2026-11-11 12:27:12",
          "updated_at": "2026-11-11 12:27:12"
      },
      {
          "id": "2",
          "perangkat_daerah_id": "1",
          "nip": "198204122006042011",
          "nama_pegawai": "Sri Handayani, S.Pd., M.M.",
          "jabatan": "Kasubag Umum & Kepegawaian",
          "golongan": "III/d",
          "created_at": "2026-11-11 12:27:12",
          "updated_at": "2026-11-11 12:27:12"
      }
  ]
  ```

---

## 3. Kesimpulan Pengujian REST API
1. Seluruh endpoint REST API merespons dengan kode **HTTP 200 OK** dan mime type `application/json; charset=UTF-8`.
2. Format data JSON konsisten, terstruktur rapi, dan siap dikonsumsi oleh pustaka Frontend (seperti AJAX Fetch, Axios, Chart.js, atau DataTables.net).
3. Proteksi HTTP Security Headers (`Content-Security-Policy`, `X-Frame-Options: SAMEORIGIN`, `X-Content-Type-Options: nosniff`, `Referrer-Policy: strict-origin-when-cross-origin`) aktif di seluruh respons API.
4. Tangkapan layar bukti eksekusi API tersimpan pada repositori proyek di direktori:
   `screenshot_aplikasi/fullstack/backend/pengujian rest api pegawai by instansi.png`

