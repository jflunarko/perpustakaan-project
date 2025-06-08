<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLoansTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'book_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'member_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'staff_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'loan_date' => [
                'type' => 'DATE',
            ],
            'due_date' => [
                'type' => 'DATE',
            ],
            'return_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['dipinjam', 'dikembalikan', 'terlambat'],
                'default' => 'dipinjam',
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
        $this->forge->addKey('book_id');
        $this->forge->addKey('member_id');
        $this->forge->addKey('staff_id');
        
        $this->forge->createTable('loans');

        // Add foreign key constraints
        $this->db->query('ALTER TABLE `loans` ADD CONSTRAINT `loans_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `loans` ADD CONSTRAINT `loans_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `loans` ADD CONSTRAINT `loans_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE SET NULL ON UPDATE CASCADE');
    }

    public function down()
    {
        // Drop foreign key constraints first
        $this->db->query('ALTER TABLE `loans` DROP FOREIGN KEY `loans_book_id_foreign`');
        $this->db->query('ALTER TABLE `loans` DROP FOREIGN KEY `loans_member_id_foreign`');
        $this->db->query('ALTER TABLE `loans` DROP FOREIGN KEY `loans_staff_id_foreign`');
        
        $this->forge->dropTable('loans');
    }
}