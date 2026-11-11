-- ==============================================================
-- SISTEM INFORMASI PENGELOLAAN KENDARAAN DINAS OPERASIONAL (KDO)
-- BARANG MILIK DAERAH (BMD)
-- Database Dump Schema & Realistic Seed Data
-- ==============================================================

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

-- --------------------------------------------------------
-- Table structure for table `perangkat_daerah`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `perangkat_daerah`;
CREATE TABLE `perangkat_daerah` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_instansi` varchar(20) NOT NULL,
  `nama_instansi` varchar(150) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_instansi` (`kode_instansi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `perangkat_daerah`
INSERT INTO `perangkat_daerah` (`id`, `kode_instansi`, `nama_instansi`, `alamat`, `no_telepon`, `created_at`, `updated_at`) VALUES
(1, 'DISDIK-01', 'Dinas Pendidikan dan Kebudayaan', 'Jl. Slamet Riyadi No. 102, Surakarta', '(0271) 643210', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(2, 'DINKES-02', 'Dinas Kesehatan Daerah', 'Jl. Jenderal Sudirman No. 45, Surakarta', '(0271) 632190', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(3, 'DPUPR-03', 'Dinas Pekerjaan Umum dan Penataan Ruang', 'Jl. Ki Mangunsarkoro No. 18, Surakarta', '(0271) 651234', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(4, 'BPKAD-04', 'Badan Pengelolaan Keuangan dan Aset Daerah', 'Kompleks Balai Kota Solo, Jl. Jend. Sudirman No. 2, Surakarta', '(0271) 642022', '2026-11-11 10:00:00', '2026-11-11 10:00:00');

-- --------------------------------------------------------
-- Table structure for table `pegawai`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `perangkat_daerah_id` int(11) UNSIGNED NOT NULL,
  `nip` varchar(18) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `golongan` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip` (`nip`),
  KEY `fk_pegawai_perangkat_daerah` (`perangkat_daerah_id`),
  CONSTRAINT `fk_pegawai_perangkat_daerah` FOREIGN KEY (`perangkat_daerah_id`) REFERENCES `perangkat_daerah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `pegawai`
INSERT INTO `pegawai` (`id`, `perangkat_daerah_id`, `nip`, `nama_pegawai`, `jabatan`, `golongan`, `created_at`, `updated_at`) VALUES
(1, 1, '197508152000031002', 'Drs. H. Bambang Susilo, M.Pd.', 'Kepala Dinas Pendidikan', 'IV/b', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(2, 1, '198204122006042011', 'Sri Handayani, S.Pd., M.M.', 'Kasubag Umum & Kepegawaian', 'III/d', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(3, 2, '197902102005012008', 'dr. Siti Rahmawati, M.Kes.', 'Kepala Dinas Kesehatan', 'IV/b', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(4, 2, '198811232011011005', 'Ahmad Fauzi, S.Kep., Ners.', 'Koordinator Pelayanan Ambulans & IGD', 'III/c', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(5, 3, '197706202002121003', 'Ir. Joko Wahyudi, S.T., M.Eng.', 'Kepala Bidang Bina Marga', 'IV/a', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(6, 3, '199003142015021004', 'Rian Pratama, S.T.', 'Pengawas Lapangan & Pemeliharaan Jalan', 'III/b', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(7, 4, '198409052008011009', 'Tri Hartanto, S.E., M.Acc.', 'Kabid Pengelolaan Barang Milik Daerah', 'IV/a', '2026-11-11 10:00:00', '2026-11-11 10:00:00');

-- --------------------------------------------------------
-- Table structure for table `kendaraan`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kendaraan`;
CREATE TABLE `kendaraan` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `perangkat_daerah_id` int(11) UNSIGNED NOT NULL,
  `pegawai_id` int(11) UNSIGNED DEFAULT NULL,
  `nomor_polisi` varchar(15) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `tipe_model` varchar(50) NOT NULL,
  `tahun_produksi` int(4) NOT NULL,
  `warna` varchar(30) NOT NULL,
  `kondisi` enum('Baik','Rusak Ringan','Rusak Berat') NOT NULL DEFAULT 'Baik',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_polisi` (`nomor_polisi`),
  KEY `fk_kendaraan_perangkat_daerah` (`perangkat_daerah_id`),
  KEY `fk_kendaraan_pegawai` (`pegawai_id`),
  CONSTRAINT `fk_kendaraan_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_kendaraan_perangkat_daerah` FOREIGN KEY (`perangkat_daerah_id`) REFERENCES `perangkat_daerah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `kendaraan`
INSERT INTO `kendaraan` (`id`, `perangkat_daerah_id`, `pegawai_id`, `nomor_polisi`, `merk`, `tipe_model`, `tahun_produksi`, `warna`, `kondisi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'AD 1001 ZA', 'Toyota', 'Innova Venturer 2.4 A/T', 2021, 'Hitam Metalik', 'Baik', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(2, 1, 2, 'AD 9012 DA', 'Toyota', 'Avanza 1.3 G M/T', 2019, 'Silver Metalik', 'Baik', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(3, 1, NULL, 'AD 2045 ZA', 'Honda', 'Supra X 125 FI Dinas', 2017, 'Hitam Merah', 'Rusak Ringan', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(4, 2, 3, 'AD 1002 ZA', 'Toyota', 'Corolla Altis 1.8 V', 2020, 'Hitam', 'Baik', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(5, 2, 4, 'AD 9110 HA', 'Suzuki', 'APV Arena Ambulans Emergency', 2021, 'Putih Kombinasi Merah', 'Baik', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(6, 2, NULL, 'AD 9115 HA', 'Toyota', 'HiAce Commuter Ambulans Jenazah', 2016, 'Putih', 'Rusak Ringan', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(7, 3, 5, 'AD 1003 ZA', 'Toyota', 'Hilux Double Cabin 2.4 4x4', 2022, 'Abu-abu Metalik', 'Baik', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(8, 3, 6, 'AD 9405 PA', 'Mitsubishi', 'Triton Single Cabin Patroli Proyek', 2018, 'Putih', 'Rusak Ringan', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(9, 3, NULL, 'AD 9500 DA', 'Isuzu', 'Elf Dump Truck Dinas Pengairan', 2012, 'Kuning Dinas', 'Rusak Berat', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(10, 4, 7, 'AD 1004 ZA', 'Mitsubishi', 'Pajero Sport Dakar 4x2 A/T', 2021, 'Hitam Mika', 'Baik', '2026-11-11 10:00:00', '2026-11-11 10:00:00');

-- --------------------------------------------------------
-- Table structure for table `riwayat_pemeliharaan`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `riwayat_pemeliharaan`;
CREATE TABLE `riwayat_pemeliharaan` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kendaraan_id` int(11) UNSIGNED NOT NULL,
  `tanggal_servis` date NOT NULL,
  `deskripsi_perbaikan` text NOT NULL,
  `biaya` decimal(12,2) NOT NULL DEFAULT 0.00,
  `bengkel` varchar(100) NOT NULL,
  `status_kondisi_akhir` enum('Baik','Rusak Ringan','Rusak Berat') NOT NULL DEFAULT 'Baik',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pemeliharaan_kendaraan` (`kendaraan_id`),
  CONSTRAINT `fk_pemeliharaan_kendaraan` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `riwayat_pemeliharaan`
INSERT INTO `riwayat_pemeliharaan` (`id`, `kendaraan_id`, `tanggal_servis`, `deskripsi_perbaikan`, `biaya`, `bengkel`, `status_kondisi_akhir`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-09-15', 'Servis berkala 40.000 KM, penggantian oli mesin synthetic, filter oli, filter udara, dan tune up mesin.', 1850000.00, 'Bengkel Resmi Toyota Nasmoco Solo Baru', 'Baik', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(2, 3, '2026-10-02', 'Ganti rantai roda set, kampas rem depan & belakang, perbaikan kelistrikan lampu sein, dan servis karburator/injeksi.', 475000.00, 'AHASS Motor Honda Slamet Riyadi', 'Rusak Ringan', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(3, 5, '2026-10-18', 'Perbaikan kompresor AC kabin pasien, pengisian freon R134a, penggantian bearing alternator, dan pengecekan sirine darurat.', 2450000.00, 'Bengkel Spesialis AC & Dinamo Berkah Jaya', 'Baik', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(4, 6, '2026-08-20', 'Penggantian shockbreaker depan kiri-kanan, perbaikan linkage transmisi gigi manual yang aus, dan balancing roda.', 3650000.00, 'Bengkel Armada Sejahtera Motor', 'Rusak Ringan', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(5, 7, '2026-09-30', 'Penggantian oli gardan 4x4, flushing oli rem, peremajaan kampas rem depan cakram, dan penggantian filter solar.', 2100000.00, 'Bengkel Resmi Toyota Nasmoco Ringroad', 'Baik', '2026-11-11 10:00:00', '2026-11-11 10:00:00'),
(6, 9, '2026-07-12', 'Overhaul silinder hidrolik dump truck, perbaikan kebocoran seal pompa oli hidrolik, dan pengelasan sub-chassis bak belakang.', 7800000.00, 'CV Karoseri & Bengkel Teknik Baja Utama', 'Rusak Berat', '2026-11-11 10:00:00', '2026-11-11 10:00:00');

SET FOREIGN_KEY_CHECKS=1;
COMMIT;

