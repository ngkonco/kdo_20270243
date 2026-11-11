<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RiwayatPemeliharaanSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            [
                'id'                   => 1,
                'kendaraan_id'         => 1, // Innova Venturer
                'tanggal_servis'       => '2026-09-15',
                'deskripsi_perbaikan'  => 'Servis berkala 40.000 KM, penggantian oli mesin synthetic, filter oli, filter udara, dan tune up mesin.',
                'biaya'                => 1850000.00,
                'bengkel'              => 'Bengkel Resmi Toyota Nasmoco Solo Baru',
                'status_kondisi_akhir' => 'Baik',
                'created_at'           => $now,
                'updated_at'           => $now,
            ],
            [
                'id'                   => 2,
                'kendaraan_id'         => 3, // Supra X 125
                'tanggal_servis'       => '2026-10-02',
                'deskripsi_perbaikan'  => 'Ganti rantai roda set, kampas rem depan & belakang, perbaikan kelistrikan lampu sein, dan servis karburator/injeksi.',
                'biaya'                => 475000.00,
                'bengkel'              => 'AHASS Motor Honda Slamet Riyadi',
                'status_kondisi_akhir' => 'Rusak Ringan',
                'created_at'           => $now,
                'updated_at'           => $now,
            ],
            [
                'id'                   => 3,
                'kendaraan_id'         => 5, // APV Ambulans
                'tanggal_servis'       => '2026-10-18',
                'deskripsi_perbaikan'  => 'Perbaikan kompresor AC kabin pasien, pengisian freon R134a, penggantian bearing alternator, dan pengecekan sirine darurat.',
                'biaya'                => 2450000.00,
                'bengkel'              => 'Bengkel Spesialis AC & Dinamo Berkah Jaya',
                'status_kondisi_akhir' => 'Baik',
                'created_at'           => $now,
                'updated_at'           => $now,
            ],
            [
                'id'                   => 4,
                'kendaraan_id'         => 6, // HiAce Ambulans Jenazah
                'tanggal_servis'       => '2026-08-20',
                'deskripsi_perbaikan'  => 'Penggantian shockbreaker depan kiri-kanan, perbaikan linkage transmisi gigi manual yang aus, dan balancing roda.',
                'biaya'                => 3650000.00,
                'bengkel'              => 'Bengkel Armada Sejahtera Motor',
                'status_kondisi_akhir' => 'Rusak Ringan',
                'created_at'           => $now,
                'updated_at'           => $now,
            ],
            [
                'id'                   => 5,
                'kendaraan_id'         => 7, // Hilux Double Cabin
                'tanggal_servis'       => '2026-09-30',
                'deskripsi_perbaikan'  => 'Penggantian oli gardan 4x4, flushing oli rem, peremajaan kampas rem depan cakram, dan penggantian filter solar.',
                'biaya'                => 2100000.00,
                'bengkel'              => 'Bengkel Resmi Toyota Nasmoco Ringroad',
                'status_kondisi_akhir' => 'Baik',
                'created_at'           => $now,
                'updated_at'           => $now,
            ],
            [
                'id'                   => 6,
                'kendaraan_id'         => 9, // Isuzu Elf Dump Truck
                'tanggal_servis'       => '2026-07-12',
                'deskripsi_perbaikan'  => 'Overhaul silinder hidrolik dump truck, perbaikan kebocoran seal pompa oli hidrolik, dan pengelasan sub-chassis bak belakang.',
                'biaya'                => 7800000.00,
                'bengkel'              => 'CV Karoseri & Bengkel Teknik Baja Utama',
                'status_kondisi_akhir' => 'Rusak Berat',
                'created_at'           => $now,
                'updated_at'           => $now,
            ],
        ];

        $this->db->table('riwayat_pemeliharaan')->insertBatch($data);
    }
}

