<?php

namespace App\Controllers\Public;
use App\Controllers\BaseController;

class Library extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Perpustakaan Digital',
            'meta_description' => 'Selamat datang di Perpustakaan Digital - Tempat terbaik untuk mencari dan membaca buku online'
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
        $data = [
            'title' => 'Katalog Buku - Perpustakaan Digital',
            'meta_description' => 'Jelajahi koleksi lengkap buku-buku terbaik di Perpustakaan Digital'
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