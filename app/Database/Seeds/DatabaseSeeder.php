<?php

namespace App\Database\Seeds;

class DatabaseSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $this->call('StaffSeeder');
        $this->call('MemberSeeder');
        $this->call('BookCategorySeeder');
        $this->call('BookSeeder');
        $this->call('LoanSeeder');
    }
}
