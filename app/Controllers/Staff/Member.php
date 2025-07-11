<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;
use App\Models\MemberModel;

class Member extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new MemberModel();
    }

    public function index()
    {
        if (!session()->get('is_staff_logged_in')) {
            return redirect()->to('/staff/login');
        }

        $search = $this->request->getGet('search');
        $data['search'] = $search;

        if ($search) {
            $data['members'] = $this->model->like('username', $search)
                                           ->orLike('email', $search)
                                           ->orLike('phone', $search)
                                           ->findAll();
        } else {
            $data['members'] = $this->model->findAll();
        }

        return view('staff/member/index', $data);
    }

    public function create()
    {
        return view('staff/member/form', ['member' => null]);
    }

    public function store()
    {
        $id = $this->request->getPost('id');
        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'phone'    => $this->request->getPost('phone'),
            'address'  => $this->request->getPost('address'),
        ];

        if (!$id) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->model->save(array_merge(['id' => $id], $data));

        return redirect()->to('/staff/member')->with('message', 'Data member berhasil disimpan');
    }

    public function edit($id)
    {
        $member = $this->model->find($id);
        return view('staff/member/form', ['member' => $member]);
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/staff/member')->with('message', 'Data member berhasil dihapus');
    }
}
