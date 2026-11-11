<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            [
                'id'                  => 1,
                'perangkat_daerah_id' => 1, // DISDIK
                'nip'                 => '197508152000031002',
                'nama_pegawai'        => 'Drs. H. Bambang Susilo, M.Pd.',
                'jabatan'             => 'Kepala Dinas Pendidikan',
                'golongan'            => 'IV/b',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 2,
                'perangkat_daerah_id' => 1, // DISDIK
                'nip'                 => '198204122006042011',
                'nama_pegawai'        => 'Sri Handayani, S.Pd., M.M.',
                'jabatan'             => 'Kasubag Umum & Kepegawaian',
                'golongan'            => 'III/d',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 3,
                'perangkat_daerah_id' => 2, // DINKES
                'nip'                 => '197902102005012008',
                'nama_pegawai'        => 'dr. Siti Rahmawati, M.Kes.',
                'jabatan'             => 'Kepala Dinas Kesehatan',
                'golongan'            => 'IV/b',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 4,
                'perangkat_daerah_id' => 2, // DINKES
                'nip'                 => '198811232011011005',
                'nama_pegawai'        => 'Ahmad Fauzi, S.Kep., Ners.',
                'jabatan'             => 'Koordinator Pelayanan Ambulans & IGD',
                'golongan'            => 'III/c',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 5,
                'perangkat_daerah_id' => 3, // DPUPR
                'nip'                 => '197706202002121003',
                'nama_pegawai'        => 'Ir. Joko Wahyudi, S.T., M.Eng.',
                'jabatan'             => 'Kepala Bidang Bina Marga',
                'golongan'            => 'IV/a',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 6,
                'perangkat_daerah_id' => 3, // DPUPR
                'nip'                 => '199003142015021004',
                'nama_pegawai'        => 'Rian Pratama, S.T.',
                'jabatan'             => 'Pengawas Lapangan & Pemeliharaan Jalan',
                'golongan'            => 'III/b',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
            [
                'id'                  => 7,
                'perangkat_daerah_id' => 4, // BPKAD
                'nip'                 => '198409052008011009',
                'nama_pegawai'        => 'Tri Hartanto, S.E., M.Acc.',
                'jabatan'             => 'Kabid Pengelolaan Barang Milik Daerah',
                'golongan'            => 'IV/a',
                'created_at'          => $now,
                'updated_at'          => $now,
            ],
        ];

        $this->db->table('pegawai')->insertBatch($data);
    }
}

