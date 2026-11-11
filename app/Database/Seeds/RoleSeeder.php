<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            [
                'id'         => 1,
                'kode_role'  => 'admin',
                'nama_role'  => 'Administrator Sistem',
                'deskripsi'  => 'Akses penuh seluruh modul sistem, inventaris KDO, pemeliharaan, serta manajemen role dan pengguna.',
                'hak_akses'  => json_encode(['dashboard', 'kendaraan', 'pemeliharaan', 'pegawai', 'perangkat_daerah', 'roles', 'users']),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 2,
                'kode_role'  => 'operator',
                'nama_role'  => 'Pengurus Barang / Operator Aset',
                'deskripsi'  => 'Akses operasional input dan pembaruan data armada KDO, penanggung jawab PNS, dan pencatatan servis.',
                'hak_akses'  => json_encode(['dashboard', 'kendaraan', 'pemeliharaan', 'pegawai', 'perangkat_daerah']),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 3,
                'kode_role'  => 'pimpinan',
                'nama_role'  => 'Pimpinan / Kepala Badan',
                'deskripsi'  => 'Akses monitoring eksekutif kelaikan armada operasional, sebaran aset daerah, dan rekapitulasi biaya servis.',
                'hak_akses'  => json_encode(['dashboard', 'kendaraan', 'pemeliharaan']),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}
