<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;
use App\Models\LoanModel;
use App\Models\BookModel;
use App\Models\MemberModel;

class Loan extends BaseController
{
    protected $loanModel;
    protected $bookModel;
    protected $memberModel;

    public function __construct()
    {
        $this->loanModel = new LoanModel();
        $this->bookModel = new BookModel();
        $this->memberModel = new MemberModel();
    }

    public function index()
    {
        if (!session()->get('is_staff_logged_in')) {
            return redirect()->to('/staff/login');
        }

        $search = $this->request->getGet('search');
        $query = $this->loanModel
            ->select('loans.*, books.title AS book_title, members.username AS member_name')
            ->join('books', 'books.id = loans.book_id')
            ->join('members', 'members.id = loans.member_id');

        if ($search) {
            $query->groupStart()
                    ->like('books.title', $search)
                    ->orLike('members.username', $search)
                 ->groupEnd();
        }

        $loans = $query->findAll();

        return view('staff/loan/index', [
            'loans' => $loans,
            'search' => $search
        ]);
    }

    public function create()
    {
        $books = $this->bookModel->findAll();
        $members = $this->memberModel->findAll();

        return view('staff/loan/form', [
            'loan' => null,
            'books' => $books,
            'members' => $members
        ]);
    }

    public function store()
{
    $id = $this->request->getPost('id');
        $returnDate = $this->request->getPost('return_date');
        $returnDate = $returnDate === '' ? null : $returnDate;
    if ($id) {
        $existingLoan = $this->loanModel->find($id);
        $newStatus = $this->request->getPost('status');

        if (!$existingLoan) {
            return redirect()->to('/staff/loan')->with('message', 'Data peminjaman tidak ditemukan');
        }

        // 🚫 Tidak boleh ubah jika sudah dikembalikan
        if ($existingLoan['status'] == '2') {
            return redirect()->to('/staff/loan')->with('message', 'Status tidak dapat diubah karena buku sudah dikembalikan.');
        }

        // ✅ Kurangi stok jika dari Pending → Dipinjam
        if ($existingLoan['status'] == '0' && $newStatus == '1') {
            $this->bookModel
                ->where('id', $existingLoan['book_id'])
                ->set('stock', 'stock - 1', false)
                ->update();
        }

        // ✅ Tambah stok jika diubah menjadi "Dikembalikan"
        if ($newStatus == '2') {
            $this->bookModel
                ->where('id', $existingLoan['book_id'])
                ->set('stock', 'stock + 1', false)
                ->update();
        }

        $this->loanModel->update($id, [
            'status' => $newStatus,
            'return_date' => $returnDate,
        ]);
    } else {
        // Create baru
        $status = $this->request->getPost('status');
        $bookId = $this->request->getPost('book_id');
        // ✅ Kurangi stok langsung jika status peminjaman adalah "Dipinjam"
        if ($status == '1') {
            $this->bookModel
                ->where('id', $bookId)
                ->set('stock', 'stock - 1', false)
                ->update();
        }
        
        $this->loanModel->save([
            'book_id' => $bookId,
            'member_id' => $this->request->getPost('member_id'),
            'staff_id' => session()->get('staff_id'),
            'loan_date' => $this->request->getPost('loan_date'),
            'due_date' => $this->request->getPost('due_date'),
            'return_date' => $returnDate,
            'status' => $status,
        ]);
    }

    return redirect()->to('/staff/loan')->with('message', 'Data peminjaman berhasil disimpan');
}



    public function edit($id)
    {
        $loan = $this->loanModel->find($id);
        $books = $this->bookModel->findAll();
        $members = $this->memberModel->findAll();

        return view('staff/loan/form', [
            'loan' => $loan,
            'books' => $books,
            'members' => $members
        ]);
    }

    public function delete($id)
    {
        $this->loanModel->delete($id);
        return redirect()->to('/staff/loan')->with('message', 'Data berhasil dihapus');
    }
}
