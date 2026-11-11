<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            [
                'id'                  => 1,
                'perangkat_daerah_id' => 1, // DISDIK
                'pegawai_id'          => 1, // Bambang Susilo
                'nomor_polisi'        => 'AD 1001 ZA',
                'merk'                => 'Toyota',
                'tipe_model'          => 'Innova Venturer 2.4 A/T',
                'tahun_produksi'      => 2021,
                'warna'               => 'Hitam Metalik',
                'kondisi'             => 'Baik',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 2,
                'perangkat_daerah_id' => 1, // DISDIK
                'pegawai_id'          => 2, // Sri Handayani
                'nomor_polisi'        => 'AD 9012 DA',
                'merk'                => 'Toyota',
                'tipe_model'          => 'Avanza 1.3 G M/T',
                'tahun_produksi'      => 2019,
                'warna'               => 'Silver Metalik',
                'kondisi'             => 'Baik',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 3,
                'perangkat_daerah_id' => 1, // DISDIK
                'pegawai_id'          => null, // Pool Kendaraan Operasional Sekolah
                'nomor_polisi'        => 'AD 2045 ZA',
                'merk'                => 'Honda',
                'tipe_model'          => 'Supra X 125 FI Dinas',
                'tahun_produksi'      => 2017,
                'warna'               => 'Hitam Merah',
                'kondisi'             => 'Rusak Ringan',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 4,
                'perangkat_daerah_id' => 2, // DINKES
                'pegawai_id'          => 3, // Siti Rahmawati
                'nomor_polisi'        => 'AD 1002 ZA',
                'merk'                => 'Toyota',
                'tipe_model'          => 'Corolla Altis 1.8 V',
                'tahun_produksi'      => 2020,
                'warna'               => 'Hitam',
                'kondisi'             => 'Baik',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 5,
                'perangkat_daerah_id' => 2, // DINKES
                'pegawai_id'          => 4, // Ahmad Fauzi
                'nomor_polisi'        => 'AD 9110 HA',
                'merk'                => 'Suzuki',
                'tipe_model'          => 'APV Arena Ambulans Emergency',
                'tahun_produksi'      => 2021,
                'warna'               => 'Putih Kombinasi Merah',
                'kondisi'             => 'Baik',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 6,
                'perangkat_daerah_id' => 2, // DINKES
                'pegawai_id'          => null, // Pool Ambulans Cadangan
                'nomor_polisi'        => 'AD 9115 HA',
                'merk'                => 'Toyota',
                'tipe_model'          => 'HiAce Commuter Ambulans Jenazah',
                'tahun_produksi'      => 2016,
                'warna'               => 'Putih',
                'kondisi'             => 'Rusak Ringan',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 7,
                'perangkat_daerah_id' => 3, // DPUPR
                'pegawai_id'          => 5, // Joko Wahyudi
                'nomor_polisi'        => 'AD 1003 ZA',
                'merk'                => 'Toyota',
                'tipe_model'          => 'Hilux Double Cabin 2.4 4x4',
                'tahun_produksi'      => 2022,
                'warna'               => 'Abu-abu Metalik',
                'kondisi'             => 'Baik',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 8,
                'perangkat_daerah_id' => 3, // DPUPR
                'pegawai_id'          => 6, // Rian Pratama
                'nomor_polisi'        => 'AD 9405 PA',
                'merk'                => 'Mitsubishi',
                'tipe_model'          => 'Triton Single Cabin Patroli Proyek',
                'tahun_produksi'      => 2018,
                'warna'               => 'Putih',
                'kondisi'             => 'Rusak Ringan',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 9,
                'perangkat_daerah_id' => 3, // DPUPR
                'pegawai_id'          => null, // Aset Alat Berat / Truck Dinas
                'nomor_polisi'        => 'AD 9500 DA',
                'merk'                => 'Isuzu',
                'tipe_model'          => 'Elf Dump Truck Dinas Pengairan',
                'tahun_produksi'      => 2012,
                'warna'               => 'Kuning Dinas',
                'kondisi'             => 'Rusak Berat',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 10,
                'perangkat_daerah_id' => 4, // BPKAD
                'pegawai_id'          => 7, // Tri Hartanto
                'nomor_polisi'        => 'AD 1004 ZA',
                'merk'                => 'Mitsubishi',
                'tipe_model'          => 'Pajero Sport Dakar 4x2 A/T',
                'tahun_produksi'      => 2021,
                'warna'               => 'Hitam Mika',
                'kondisi'             => 'Baik',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
        ];

        $this->db->table('kendaraan')->insertBatch($data);
    }
}

