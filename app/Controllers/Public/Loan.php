<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\LoanModel;

class Loan extends BaseController
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

    public function borrow($bookId)
    {
        // Cek apakah member sudah login
        if (!$this->session->get('is_member_logged_in')) {
            return redirect()->to('/member/login')->with('error', 'Silakan login terlebih dahulu untuk meminjam buku.');
        }

        // Ambil data buku
        $book = $this->bookModel->find($bookId);
        if (!$book) {
            return redirect()->to('/catalog')->with('error', 'Buku tidak ditemukan.');
        }

        // Cek apakah member sudah meminjam buku ini dan belum dikembalikan
        $memberId = $this->session->get('uid');
        $existingLoan = $this->loanModel->where([
            'book_id' => $bookId,
            'member_id' => $memberId,
            'return_date' => null // Belum dikembalikan
        ])->whereIn('status', ['1', '0', '2'])->first();

        // Selalu kirim data buku dan loan info
        $data = [
            'title' => 'Pinjam Buku',
            'book' => $book,
            'userLoan' => $existingLoan, // Kirim data loan user jika ada
            'canBorrow' => !$existingLoan && $book['status'] == '1' && $book['stock'] > 0
        ];

        return view('landing/catalog/loan', $data);
    }

    public function processLoan()
    {
        // Cek apakah member sudah login
        if (!$this->session->get('is_member_logged_in')) {
            return redirect()->to('/member/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'book_id' => 'required|integer',
            'loan_date' => 'required|valid_date',
            'due_date' => 'required|valid_date'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $bookId = $this->request->getPost('book_id');
        $loanDate = $this->request->getPost('loan_date');
        $dueDate = $this->request->getPost('due_date');
        $memberId = $this->session->get('uid');

        // Cek apakah buku masih tersedia
        $book = $this->bookModel->find($bookId);
        if (!$book || $book['status'] != '1' || $book['stock'] <= 0) {
            return redirect()->to('/catalog')->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        // Cek apakah member sudah meminjam buku ini dan belum dikembalikan
        $existingLoan = $this->loanModel->where([
            'book_id' => $bookId,
            'member_id' => $memberId,
            'return_date' => null // Belum dikembalikan
        ])->whereIn('status', ['0', '1'])->first();

        if ($existingLoan) {
            return redirect()->back()->withInput()->with('error', 'Anda sudah meminjam buku ini dan belum mengembalikannya.');
        }

        // Validasi tanggal
        if (strtotime($loanDate) > strtotime($dueDate)) {
            return redirect()->back()->withInput()->with('error', 'Tanggal kembali harus setelah tanggal pinjam.');
        }

        // Data untuk insert ke tabel loans
        $loanData = [
            'book_id' => $bookId,
            'member_id' => $memberId,
            'staff_id' => null, // Bisa di-set nanti ketika staff approve
            'loan_date' => $loanDate,
            'due_date' => $dueDate,
            'return_date' => null,
            'status' => 0, // Status awal pending, nanti bisa diubah staff
        ];

        // Mulai transaction
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Insert data peminjaman
            $this->loanModel->insert($loanData);

            // Update stok buku (kurangi 1)
            $this->bookModel->update($bookId, [
                'status' => ($book['stock'] - 1) > 0 ? '1' : '0' // Jika stok habis, ubah status jadi tidak tersedia
            ]);

            $db->transComplete();

            if ($db->transStatus() === FALSE) {
                throw new \Exception('Gagal memproses peminjaman');
            }

            return redirect()->to('/catalog')->with('success', 'Permintaan peminjaman berhasil disubmit. Silakan tunggu konfirmasi dari staff.');

        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function returnBook()
    {
        // Cek apakah member sudah login
        if (!$this->session->get('is_member_logged_in')) {
            return redirect()->to('/member/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Pastikan method adalah POST
        if (!$this->request->getMethod() === 'post') {
            return redirect()->to('/catalog')->with('error', 'Method tidak valid.');
        }

        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'loan_id' => 'required|integer',
            'book_id' => 'required|integer'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('error', 'Data tidak valid.');
        }

        $loanId = $this->request->getPost('loan_id');
        $bookId = $this->request->getPost('book_id');
        $memberId = $this->session->get('uid');

        // Cek apakah loan record ada dan milik member yang login
        $loan = $this->loanModel->where([
            'id' => $loanId,
            'book_id' => $bookId,
            'member_id' => $memberId,
            'return_date' => null // Belum dikembalikan
        ])->whereIn('status', ['1'])->first();

        if (!$loan) {
            return redirect()->to('/catalog')->with('error', 'Data peminjaman tidak ditemukan atau tidak valid.');
        }

        // Ambil data buku
        $book = $this->bookModel->find($bookId);
        if (!$book) {
            return redirect()->to('/catalog')->with('error', 'Data buku tidak ditemukan.');
        }

        // Mulai transaction
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Update data peminjaman - set return_date dan status
            $this->loanModel->update($loanId, [
                'return_date' => date('Y-m-d H:i:s'),
                'status' => '2'
            ]);

            // Update stok buku (tambah 1)
            $newStock = $book['stock'] + 1;
            $this->bookModel->update($bookId, [
                'stock' => $newStock,
                'status' => '1' // Set status jadi tersedia karena ada stok
            ]);

            $db->transComplete();

            if ($db->transStatus() === FALSE) {
                throw new \Exception('Gagal memproses pengembalian');
            }

            return redirect()->to('/catalog')->with('success', 'Buku berhasil dikembalikan. Terima kasih!');

        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->to('/catalog')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Method untuk menampilkan riwayat peminjaman member
    public function myLoans()
    {
        // Cek apakah member sudah login
        if (!$this->session->get('is_member_logged_in')) {
            return redirect()->to('/member/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $memberId = $this->session->get('uid');
        
        // Ambil riwayat peminjaman member dengan join ke tabel books
        $loans = $this->loanModel->select('loans.*, books.title, books.author, books.publisher')
                                ->join('books', 'books.id = loans.book_id')
                                ->where('loans.member_id', $memberId)
                                ->orderBy('loans.created_at', 'DESC')
                                ->findAll();

        $data = [
            'title' => 'Riwayat Peminjaman',
            'loans' => $loans
        ];

        return view('landing/member/loans', $data);
    }
}