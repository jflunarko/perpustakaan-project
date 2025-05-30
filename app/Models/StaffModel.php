<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'staff';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'phone', 'last_login', 'created_at', 'updated_at'];
}
