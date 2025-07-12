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
                'title'            => 'Laskar Pelangi',
                'author'           => 'Andrea Hirata',
                'publisher'        => 'Bentang Pustaka',
                'year_published'   => 2005,
                'status'           => 1,
                'stock'            => 5,
                'created_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'book_category_id' => 2,
                'title'            => 'Bumi',
                'author'           => 'Tere Liye',
                'publisher'        => 'Gramedia Pustaka Utama',
                'year_published'   => 2014,
                'status'           => 1,
                'stock'            => 3,
                'created_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'book_category_id' => 3,
                'title'            => 'Negeri 5 Menara',
                'author'           => 'Ahmad Fuadi',
                'publisher'        => 'Gramedia',
                'year_published'   => 2009,
                'status'           => 1,
                'stock'            => 4,
                'created_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'book_category_id' => 1,
                'title'            => 'Ayah',
                'author'           => 'Andrea Hirata',
                'publisher'        => 'Bentang Pustaka',
                'year_published'   => 2015,
                'status'           => 1,
                'stock'            => 2,
                'created_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'book_category_id' => 2,
                'title'            => 'Pulang',
                'author'           => 'Tere Liye',
                'publisher'        => 'Gramedia Pustaka Utama',
                'year_published'   => 2015,
                'status'           => 1,
                'stock'            => 6,
                'created_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'book_category_id' => 3,
                'title'            => 'Perahu Kertas',
                'author'           => 'Dewi Lestari',
                'publisher'        => 'Bentang Pustaka',
                'year_published'   => 2009,
                'status'           => 1,
                'stock'            => 4,
                'created_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'book_category_id' => 4,
                'title'            => 'Sang Pemimpi',
                'author'           => 'Andrea Hirata',
                'publisher'        => 'Bentang Pustaka',
                'year_published'   => 2006,
                'status'           => 1,
                'stock'            => 5,
                'created_at'       => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('books')->insertBatch($data);
    }
}
