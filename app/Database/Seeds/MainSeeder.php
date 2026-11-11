<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks momentarily for safe fresh seeding if re-run
        $this->db->disableForeignKeyChecks();

        // Truncate existing data in reverse order
        $this->db->table('riwayat_pemeliharaan')->truncate();
        $this->db->table('kendaraan')->truncate();
        $this->db->table('pegawai')->truncate();
        $this->db->table('perangkat_daerah')->truncate();
        $this->db->table('users')->truncate();

        // Re-enable foreign key checks
        $this->db->enableForeignKeyChecks();

        // Call Seeders in strict foreign-key order
        $this->call('UserSeeder');
        $this->call('PerangkatDaerahSeeder');
        $this->call('PegawaiSeeder');
        $this->call('KendaraanSeeder');
        $this->call('RiwayatPemeliharaanSeeder');
    }
}
