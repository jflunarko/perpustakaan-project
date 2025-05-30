<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMemberTable extends Migration
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
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'      => true,
                'default'   => null,
            ],
            'address' => [
                'type'       => 'TEXT',
                'null'      => true,
                'default'   => null,
            ],
            'created_at' => [
                'type'       => 'TIMESTAMP',
                'null'      => true,
                'default'   => null,
            ],
            'updated_at' => [
                'type'       => 'TIMESTAMP',
                'null'      => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->addUniqueKey('email'); // Email harus unik
        $this->forge->addUniqueKey('username'); // Username harus unik
        
        $this->forge->createTable('members', true, [
            'ENGINE'      => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8mb4',
            'COLLATE'     => 'utf8mb4_0900_ai_ci'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('members', true);
    }
}