<?php

namespace App\Controllers;

use App\Models\StaffModel;
use CodeIgniter\Controller;

class StaffAuth extends Controller
{
    public function login()
    {
        return view('staff_login');
    }

    public function doLogin()
{
    $session = session();
    $userModel = new StaffModel();

    $loginInput = $this->request->getPost('username');
    $inputPassword = $this->request->getPost('password');

    $userData = $userModel
        ->where('email', $loginInput)
        ->orWhere('username', $loginInput)
        ->first();

    if ($userData) {
        log_message('debug', 'User ditemukan: ' . json_encode($userData));
    } else {
        log_message('debug', 'User tidak ditemukan');
    }

    if ($userData && password_verify($inputPassword, $userData['password'])) {
        $session->set([
            'uid'        => $userData['id'],
            'username'   => $userData['username'],
            'is_staff_logged_in' => true,
        ]);

        return redirect()->to('/staff/dashboard');
    } else {
        $session->setFlashdata('error', 'Username/Email atau password salah');
        return redirect()->to('/staff/login');
    }
}


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
