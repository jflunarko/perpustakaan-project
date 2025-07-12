<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run()
    {
        $names = ['Jonathan', 'desmond', 'kent', 'steven', 'davine'];
        $data = [];

        foreach ($names as $name) {
            $data[] = [
                'username'   => $name,
                'email'      => $name . '@example.com',
                'password'   => password_hash($name, PASSWORD_DEFAULT),
                'phone'      => '08' . rand(100000000, 999999999), // nomor acak
                'address'    => 'Jl. ' . ucfirst($name) . ' No.' . rand(1, 100),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('members')->insertBatch($data);
    }
}
