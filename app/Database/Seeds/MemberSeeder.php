<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'john_doe',
                'email' => 'john@example.com',
                'password' => password_hash('secret', PASSWORD_DEFAULT),
                'phone' => '08991234567',
                'address' => 'Jl. Merdeka No.123',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('members')->insertBatch($data);
    }
}
