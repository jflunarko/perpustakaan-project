<?php

namespace App\Models;

use CodeIgniter\Model;

class BookRatingModel extends Model
{
    protected $table      = 'book_ratings';
    protected $primaryKey = 'id';

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = [
        'member_id',
        'book_id',
        'rating',
    ];
}
