<?php
namespace App\Controllers\Staff;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\BookCategoriesModel;
use App\Models\MemberModel;
use App\Models\LoanModel;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('is_staff_logged_in')) {
            return redirect()->to('/staff/login');
        }

        $bookModel = new BookModel();
        $categoryModel = new BookCategoriesModel();
        $memberModel = new MemberModel();
        $loanModel = new LoanModel();

        $data = [
            'totalBooks' => $bookModel->countAll(),
            'totalCategories' => $categoryModel->countAll(),
            'totalMembers' => $memberModel->countAll(),
            'activeLoans' => $loanModel->where('status', 'dipinjam')->countAllResults(),
            'recentLoans' => $loanModel
                ->select('loans.*, books.title AS book_title, members.username AS member_username')
                ->join('books', 'books.id = loans.book_id')
                ->join('members', 'members.id = loans.member_id')
                ->orderBy('loans.loan_date', 'DESC')
                ->limit(5)
                ->find()
        ];

        return view('staff/dashboard', $data);
    }
}

