<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBooksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'            => 'INT',
                'constraint'      => 11,
                'unsigned'        => true,
                'auto_increment'  => true,
            ],
            'book_category_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'default'    => null,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
            ],
            'publisher' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
            ],
            'year_published' => [
                'type'       => 'INT',
                'constraint' => 4,
                'null'       => true,
                'default'    => null,
            ],
            'status' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => null,
            ],
            'stock' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
                'default'    => 0,
            ],
            'created_at' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
                'default'    => null,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary key
        $this->forge->addForeignKey('book_category_id', 'book_categories', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('books', true, [
            'ENGINE'      => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8mb4',
            'COLLATE'     => 'utf8mb4_0900_ai_ci'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('books', true);
    }
}
