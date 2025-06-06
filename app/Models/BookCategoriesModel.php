<?php

namespace App\Models;

use CodeIgniter\Model;

class BookCategoriesModel extends Model
{
    protected $table = 'book_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
}
