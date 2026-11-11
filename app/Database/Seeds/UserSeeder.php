<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $data = [
            [
                'id'           => 1,
                'username'     => 'admin',
                'nama_lengkap' => 'Administrator BMD',
                'email'        => 'admin@bmd.pemda.go.id',
                'password'     => password_hash('admin123', PASSWORD_BCRYPT),
                'role'         => 'admin',
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'id'           => 2,
                'username'     => 'operator',
                'nama_lengkap' => 'Operator Pengurus Barang',
                'email'        => 'operator@bmd.pemda.go.id',
                'password'     => password_hash('operator123', PASSWORD_BCRYPT),
                'role'         => 'operator',
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'id'           => 3,
                'username'     => 'pimpinan',
                'nama_lengkap' => 'Kepala Badan BPKAD',
                'email'        => 'pimpinan@bmd.pemda.go.id',
                'password'     => password_hash('pimpinan123', PASSWORD_BCRYPT),
                'role'         => 'pimpinan',
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}

