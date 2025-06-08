<?php

namespace App\Models;

use CodeIgniter\Model;

class LoanModel extends Model
{
    protected $table = 'loans';
    protected $primaryKey = 'id';
    protected $allowedFields = ['book_id', 'member_id', 'staff_id', 'loan_date', 'due_date', 'return_date', 'status'];
}
