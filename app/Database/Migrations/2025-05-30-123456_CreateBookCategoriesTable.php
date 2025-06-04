<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookCategoriesTable extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'      => false,
            ],
            'created_at' => [
                'type'       => 'TIMESTAMP',
                'null'       => false,
            ],
            'updated_at' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
            ],
            'deleted_at' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->createTable('book_categories', true, [
            'ENGINE'      => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8mb4',
            'COLLATE'     => 'utf8mb4_0900_ai_ci'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('book_categories', true);
    }
}