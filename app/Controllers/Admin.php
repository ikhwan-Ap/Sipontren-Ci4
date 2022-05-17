<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->model = new AdminModel();
    }

    public function index()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Admin',
            'admin' => $this->model->where('role', 2)->findAll(),
        ];

        return view('admin/index', $data);
    }

    public function create()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Tambah Admin',
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/add', $data);
    }

    public function save()
    {
        if (!$this->validate('havePasswordAdmin') || !$this->validate(['username' => [
            'rules' => 'required|is_unique[admin.username]',
            'errors' => [
                'required' => 'Username harus diisi!',
                'is_unique' => 'Username sudah terdaftar!',
            ]
        ],])) {
            return redirect()->to('/admin/add')->withInput();
        }
        $this->model->save([
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => '2',
        ]);

        session()->setFlashdata('message', 'Data admin berhasil ditambahkan!');

        return redirect()->to('/admin');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', 'Data admin berhasil dihapus!');
        return redirect()->to('/admin');
    }

    public function edit($username)
    {
        if (session()->get('role') != 1) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Ubah Admin',
            'validation' => \Config\Services::validation(),
            'admin' => $this->model->where('username', $username)->first(),
        ];

        return view('admin/edit', $data);
    }

    public function update($id)
    {
        if ($this->request->getVar('password') == '') {
            if (!$this->validate('noPasswordAdmin') || !$this->validate(
                ['username' => [
                    'rules' => "required|min_length[5]|max_length[16]|is_unique[admin.username,id,$id]",
                ]]
            )) {
                return redirect()->to('/admin/edit/' . $this->request->getVar('username'))->withInput();
            }
            $data = [
                'name' => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];
            $this->model->update(['id' => $id], $data);

            session()->setFlashdata('message', 'Data admin berhasil diubah!');

            return redirect()->to('/admin');
        } else {
            if (!$this->validate('havePasswordAdmin') || !$this->validate(
                ['username' => [
                    'rules' => "required|min_length[5]|max_length[16]|is_unique[admin.username,id,$id]",
                ]]
            )); {
                session()->setFlashdata('message', 'Password Dan Konfirmasi Password Tidak Sama');
                return redirect()->to('/admin/edit/' . $this->request->getVar('username'))->withInput();
            }
            $data = [
                'name' => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];
            $this->model->update(['id' => $id], $data);

            session()->setFlashdata('message', 'Data admin berhasil diubah!');

            return redirect()->to('/admin');
        }
    }

    public function detail($id)
    {
        if (session()->get('role') != 1) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Detail Admin',
            'validation' => \Config\Services::validation(),
            'admin' => $this->model->where('id', $id)->first(),
        ];

        return view('admin/detail', $data);
    }
}
