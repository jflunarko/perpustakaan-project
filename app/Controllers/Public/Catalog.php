<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\LoanModel;

class Catalog extends BaseController
{
    protected $bookModel;
    protected $loanModel;
    protected $session;

    public function __construct()
    {
        $this->bookModel = new BookModel();
        $this->loanModel = new LoanModel();
        $this->session = \Config\Services::session();
    }

    // Method untuk menampilkan semua katalog buku
    public function index()
    {
        // Ambil semua buku
        $books = $this->bookModel->findAll();

        $data = [
            'title' => 'Katalog Buku',
            'books' => $books,
            'view_type' => 'all' // Menandai ini adalah view semua buku
        ];

        return view('landing/catalog/index', $data);
    }

    // Method untuk menampilkan buku yang sedang dipinjam oleh member
    public function myBorrowedBooks()
    {
        // Cek apakah member sudah login
        if (!$this->session->get('is_member_logged_in')) {
            return redirect()->to('/member/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $memberId = $this->session->get('uid');
        
        // Ambil buku yang sedang dipinjam oleh member (belum dikembalikan)
        // Gunakan status dari tabel loans
        $borrowedBooks = $this->loanModel->select('loans.*, books.id as book_id, books.title, books.author, books.publisher, books.year_published, books.stock, books.status as book_status')
                                        ->join('books', 'books.id = loans.book_id')
                                        ->where('loans.member_id', $memberId)
                                        ->where('loans.return_date', null) // Belum dikembalikan
                                        ->whereIn('loans.status', ['0', '1', '2'])
                                        ->findAll();

        $data = [
            'title' => 'Buku yang Sedang Dipinjam',
            'books' => $borrowedBooks,
            'view_type' => 'dipinjam' // Menandai ini adalah view buku yang dipinjam
        ];

        return view('landing/catalog/index', $data);
    }
}