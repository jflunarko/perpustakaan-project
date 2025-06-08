<?php

namespace App\Controllers\Public;
use App\Controllers\BaseController;
use App\Models\BookModel; // Tambahkan ini

class Library extends BaseController
{
    public function index()
    {
        $bookModel = new BookModel();
        $books = $bookModel->limit(4)->find(); // Ambil 4 buku saja

        $data = [
            'title' => 'Perpustakaan Digital',
            'meta_description' => 'Selamat datang di Perpustakaan Digital - Tempat terbaik untuk mencari dan membaca buku online',
            'books' => $books // Kirim ke view
        ];
        
        return view('landing/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Tentang Kami - Perpustakaan Digital',
            'meta_description' => 'Pelajari lebih lanjut tentang visi dan misi Perpustakaan Digital'
        ];
        
        return view('landing/about', $data);
    }

    public function catalog()
{
    $bookModel = new \App\Models\BookModel();
    $books = $bookModel->findAll(); // Ambil semua buku

    $data = [
        'title' => 'Katalog Buku - Perpustakaan Digital',
        'meta_description' => 'Jelajahi koleksi lengkap buku-buku terbaik di Perpustakaan Digital',
        'books' => $books,
        'view_type' => 'all'

    ];
    
    return view('landing/catalog/index', $data);
}


    public function contact()
    {
        $data = [
            'title' => 'Kontak - Perpustakaan Digital',
            'meta_description' => 'Hubungi kami untuk pertanyaan atau bantuan terkait layanan perpustakaan'
        ];
        
        return view('landing/contact', $data);
    }
}
