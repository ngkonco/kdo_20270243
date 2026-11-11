<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleIdToUsersTable extends Migration
{
    public function up()
    {
        $fields = [
            'role_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id',
            ],
        ];

        $this->forge->addColumn('users', $fields);

        // Tambahkan Foreign Key constraint
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'SET NULL');
        $this->forge->processIndexes('users');
    }

    public function down()
    {
        $this->forge->dropForeignKey('users', 'users_role_id_foreign');
        $this->forge->dropColumn('users', 'role_id');
    }
}
