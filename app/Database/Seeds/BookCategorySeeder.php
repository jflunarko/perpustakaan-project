<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookCategorySeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            ['id' => 1, 'name' => 'Novel', 'created_at' => $now],
            ['id' => 2, 'name' => 'Fantasi', 'created_at' => $now],
            ['id' => 3, 'name' => 'Motivasi', 'created_at' => $now],
            ['id' => 4, 'name' => 'Drama', 'created_at' => $now],
        ];

        $this->db->table('book_categories')->insertBatch($data);
    }
}
