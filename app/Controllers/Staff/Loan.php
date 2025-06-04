<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;

class Loan extends BaseController
{
    public function index()
    {
        if (!session()->get('is_staff_logged_in')) {
            return redirect()->to('/staff/login');
        }
        return view('staff/loan/index');
    }
}

