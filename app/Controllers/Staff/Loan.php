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
        $this->loanModel->save([
            'id' => $this->request->getPost('id'),
            'book_id' => $this->request->getPost('book_id'),
            'member_id' => $this->request->getPost('member_id'),
            'staff_id' => session()->get('staff_id'),
            'loan_date' => $this->request->getPost('loan_date'),
            'due_date' => $this->request->getPost('due_date'),
            'return_date' => $this->request->getPost('return_date'),
            'status' => $this->request->getPost('status'),
        ]);

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
