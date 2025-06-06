<?php

namespace App\Controllers\Member;

use App\Models\MemberModel;
use CodeIgniter\Controller;

class MemberAuth extends Controller
{
    public function login()
    {
        return view('member/member_login');
    }

    public function doLogin()
{
    $session = session();
    $userModel = new MemberModel();

    $loginInput = $this->request->getPost('username');
    $inputPassword = $this->request->getPost('password');

    $userData = $userModel
        ->where('email', $loginInput)
        ->orWhere('username', $loginInput)
        ->first();

    if ($userData && password_verify($inputPassword, $userData['password'])) {
        $session->set([
            'uid'        => $userData['id'],
            'username'   => $userData['username'],
            'is_member_logged_in' => true,
        ]);

        return redirect()->to('/');
    } else {
        $session->setFlashdata('error', 'Username/Email atau password salah');
        return redirect()->to('member/login');
    }
}


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
