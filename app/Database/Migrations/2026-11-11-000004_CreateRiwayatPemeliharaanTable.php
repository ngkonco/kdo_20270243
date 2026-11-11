<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRiwayatPemeliharaanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kendaraan_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tanggal_servis' => [
                'type' => 'DATE',
            ],
            'deskripsi_perbaikan' => [
                'type' => 'TEXT',
            ],
            'biaya' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
                'default'    => 0.00,
            ],
            'bengkel' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'status_kondisi_akhir' => [
                'type'       => 'ENUM',
                'constraint' => ['Baik', 'Rusak Ringan', 'Rusak Berat'],
                'default'    => 'Baik',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kendaraan_id', 'kendaraan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('riwayat_pemeliharaan', true);
    }

    public function down()
    {
        $this->forge->dropTable('riwayat_pemeliharaan', true);
    }
}

