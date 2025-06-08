<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table      = 'books';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'book_category_id',
        'title',
        'author',
        'publisher',
        'year_published',
        'status',
        'stock',
        'created_at'
    ];

    protected $useTimestamps = false; // set to true if using created_at/updated_at as timestamps


}

