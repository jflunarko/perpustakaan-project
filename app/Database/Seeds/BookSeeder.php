<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'book_category_id' => 1,
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'publisher' => 'Bentang Pustaka',
                'year_published' => 2005,
                'status' => 1,
                'stock' => 5,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('books')->insertBatch($data);
    }
}
