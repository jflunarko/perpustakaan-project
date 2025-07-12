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

    public function register()
{
    return view('member/member_register');
}

public function doRegister()
{
    $validation = \Config\Services::validation();
    $session = session();
    $model = new \App\Models\MemberModel();

    $data = $this->request->getPost();

    if (!$this->validate([
        'username' => 'required|is_unique[members.username]',
        'email'    => 'required|valid_email|is_unique[members.email]',
        'password' => 'required|min_length[4]',
    ])) {
        $session->setFlashdata('error', implode('<br>', $validation->getErrors()));
        return redirect()->to('/member/register')->withInput();
    }

    $model->insert([
        'username'   => $data['username'],
        'email'      => $data['email'],
        'password'   => password_hash($data['password'], PASSWORD_DEFAULT),
        'phone'      => $data['phone'],
        'address'    => $data['address'],
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ]);

    $session->setFlashdata('success', 'Registrasi berhasil! Silakan login.');
    return redirect()->to('/member/login');
}
}
