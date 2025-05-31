<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index(): string
    {
        return view('dashboard/index'); // atau ganti sesuai view kamu
    }
}
