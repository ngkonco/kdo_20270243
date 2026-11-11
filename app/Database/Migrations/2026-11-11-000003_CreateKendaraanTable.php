<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKendaraanTable extends Migration
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
            'perangkat_daerah_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'pegawai_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'nomor_polisi' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'unique'     => true,
            ],
            'merk' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'tipe_model' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'tahun_produksi' => [
                'type'       => 'INT',
                'constraint' => 4,
            ],
            'warna' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'kondisi' => [
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
        $this->forge->addForeignKey('perangkat_daerah_id', 'perangkat_daerah', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pegawai_id', 'pegawai', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('kendaraan', true);
    }

    public function down()
    {
        $this->forge->dropTable('kendaraan', true);
    }
}

