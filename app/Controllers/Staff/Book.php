<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\BookCategoriesModel;

class Book extends BaseController
{
    protected $bookModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
        $this->categoryModel = new BookCategoriesModel();
    }

    public function index()
{
    if (!session()->get('is_staff_logged_in')) {
        return redirect()->to('/staff/login');
    }

    $search = $this->request->getGet('search');

    if ($search) {
        $books = $this->bookModel
            ->groupStart()
                ->like('title', $search)
                ->orLike('author', $search)
                ->orLike('publisher', $search)
            ->groupEnd()
            ->findAll();
    } else {
        $books = $this->bookModel->findAll();
    }

    return view('staff/book/index', [
        'books' => $books,
        'search' => $search
    ]);
}


    public function create()
    {
        $categories = $this->categoryModel->findAll();
        return view('staff/book/form', [
            'book' => null,
            'categories' => $categories
        ]);
    }

    public function edit($id)
    {
        $book = $this->bookModel->find($id);
        if (!$book) {
            return redirect()->to('/staff/book')->with('message', 'Buku tidak ditemukan');
        }

        $categories = $this->categoryModel->findAll();

        return view('staff/book/form', [
            'book' => $book,
            'categories' => $categories
        ]);
    }

    public function store()
    {
        $data = [
            'id'               => $this->request->getPost('id'),
            'book_category_id' => $this->request->getPost('book_category_id'),
            'title'            => $this->request->getPost('title'),
            'author'           => $this->request->getPost('author'),
            'publisher'        => $this->request->getPost('publisher'),
            'year_published'   => $this->request->getPost('year_published'),
            'status'           => $this->request->getPost('status') ?? 'available',
            'stock'            => $this->request->getPost('stock') ?? 0,
            'created_at'       => date('Y-m-d H:i:s'),
        ];

        $this->bookModel->save($data);

        return redirect()->to('/staff/book')->with('message', 'Buku berhasil disimpan');
    }

    public function delete($id)
    {
        $this->bookModel->delete($id);
        return redirect()->to('/staff/book')->with('message', 'Buku berhasil dihapus');
    }

    public function search()
{
    $keyword = $this->request->getGet('q');
    $bookModel = new \App\Models\BookModel();

    $books = $bookModel->like('title', $keyword)->findAll(10);

    $results = array_map(function ($book) {
        return [
            'id' => $book['id'],
            'text' => $book['title']
        ];
    }, $books);

    return $this->response->setJSON(['results' => $results]);
}

}
