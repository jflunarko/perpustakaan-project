<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;

class Book extends BaseController
{
    public function index()
    {
        if (!session()->get('is_staff_logged_in')) {
            return redirect()->to('/staff/login');
        }
        return view('staff/book/index');
    }
}

