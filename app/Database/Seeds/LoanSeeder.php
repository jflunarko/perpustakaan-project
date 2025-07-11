<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LoanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'book_id' => 1,
                'member_id' => 1,
                'staff_id' => 1,
                'loan_date' => date('Y-m-d'),
                'due_date' => date('Y-m-d', strtotime('+7 days')),
                'return_date' => null,
                'status' => 'borrowed',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('loans')->insertBatch($data);
    }
}
