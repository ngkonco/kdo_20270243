<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PerangkatDaerahSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            [
                'id'            => 1,
                'kode_instansi' => 'DISDIK-01',
                'nama_instansi' => 'Dinas Pendidikan dan Kebudayaan',
                'alamat'        => 'Jl. Slamet Riyadi No. 102, Surakarta',
                'no_telepon'    => '(0271) 643210',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'id'            => 2,
                'kode_instansi' => 'DINKES-02',
                'nama_instansi' => 'Dinas Kesehatan Daerah',
                'alamat'        => 'Jl. Jenderal Sudirman No. 45, Surakarta',
                'no_telepon'    => '(0271) 632190',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'id'            => 3,
                'kode_instansi' => 'DPUPR-03',
                'nama_instansi' => 'Dinas Pekerjaan Umum dan Penataan Ruang',
                'alamat'        => 'Jl. Ki Mangunsarkoro No. 18, Surakarta',
                'no_telepon'    => '(0271) 651234',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'id'            => 4,
                'kode_instansi' => 'BPKAD-04',
                'nama_instansi' => 'Badan Pengelolaan Keuangan dan Aset Daerah',
                'alamat'        => 'Kompleks Balai Kota Solo, Jl. Jend. Sudirman No. 2, Surakarta',
                'no_telepon'    => '(0271) 642022',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
        ];

        $this->db->table('perangkat_daerah')->insertBatch($data);
    }
}

