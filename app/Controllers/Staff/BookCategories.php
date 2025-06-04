<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;
use App\Models\BookCategoriesModel;

class BookCategories extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new BookCategoriesModel();
    }

    public function index()
    {
        if (!session()->get('is_staff_logged_in')) {
            return redirect()->to('/staff/login');
        }

        // Ambil parameter pencarian
        $search = $this->request->getGet('search');
        
        // Jika ada pencarian, filter berdasarkan nama
        if ($search) {
            $data['categories'] = $this->model->like('name', $search)->findAll();
        } else {
            $data['categories'] = $this->model->findAll();
        }
        
        // Kirim data pencarian ke view
        $data['search'] = $search;
        
        return view('staff/book-categories/index', $data);
    }

    public function create()
    {
        return view('staff/book-categories/form', ['category' => null]);
    }

    public function store()
    {
        $this->model->save([
            'id'   => $this->request->getPost('id'), // null jika tambah, isi jika edit
            'name' => $this->request->getPost('name')
        ]);

        return redirect()->to('/staff/book-categories')->with('message', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $category = $this->model->find($id);
        return view('staff/book-categories/form', ['category' => $category]);
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/staff/book-categories')->with('message', 'Data berhasil dihapus');
    }
}