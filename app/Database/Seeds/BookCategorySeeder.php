<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookCategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Fiksi', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Teknologi', 'created_at' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('book_categories')->insertBatch($data);
    }
}
