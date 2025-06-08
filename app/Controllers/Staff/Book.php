<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;
use App\Models\BookModel;

class Book extends BaseController
{
    public function index()
    {
        if (!session()->get('is_staff_logged_in')) {
            return redirect()->to('/staff/login');
        }
        return view('staff/book/index');
    }
    public function getBooks()
    {
        $limit = $this->request->getGet('limit');

        // Default limit jika tidak diset
        $limit = is_numeric($limit) && $limit > 0 ? (int)$limit : 10;

        $bookModel = new BookModel();
        $books = $bookModel->limit($limit)->find();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $books
        ]);
    }
}

