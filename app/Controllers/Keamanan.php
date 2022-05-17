<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Keamanan extends BaseController
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

            'title' => 'Keamanan',
            'admin' => $this->model->where('role', 3)->findAll(),
        ];

        return view('keamanan/index', $data);
    }

    public function create()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Tambah Keamanan',
            'validation' => \Config\Services::validation(),
        ];

        return view('keamanan/add', $data);
    }

    public function save()
    {
        if (!$this->validate('havePasswordKeamanan') || !$this->validate(['username' => 'required|is_unique[admin.username]'])) {
            return redirect()->to('/keamanan/add')->withInput();
        }

        $this->model->save([
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => '3',
        ]);

        session()->setFlashdata('message', 'Data Keamanan Berhasil Di tambahkan');

        return redirect()->to('/keamanan');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', 'Data Keamanan Berhasil Di Hapus!!');
        return redirect()->to('/keamanan');
    }

    public function edit($username)
    {
        if (session()->get('role') != 1) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Ubah Keamanan',
            'validation' => \Config\Services::validation(),
            'admin' => $this->model->where('username', $username)->first(),
        ];

        return view('keamanan/edit', $data);
    }

    public function update($id)
    {
        if ($this->request->getVar('password') == '') {
            if (!$this->validate('noPasswordAdmin') || !$this->validate(
                ['username' => [
                    'rules' => "required|min_length[5]|max_length[16]|is_unique[admin.username,id,$id]",
                ]]
            )) {
                return redirect()->to('/keamanan/edit/' . $this->request->getVar('username'))->withInput();
            }
            $this->model->update(['id_admin' => $id], [
                'name' => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'role' => '3',
            ]);

            session()->setFlashdata('message', 'Data Keamanan Berhasil Di tambahkan');

            return redirect()->to('/keamanan');
        } else {
            if (!$this->validate('havePasswordAdmin') || !$this->validate(
                ['username' => [
                    'rules' => "required|min_length[5]|max_length[16]|is_unique[admin.username,id,$id]",
                ]]
            )) {
                return redirect()->to('/keamanan/edit/' . $this->request->getVar('username'))->withInput();
            }
            $this->model->update(['id_admin' => $id], [
                'name' => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'email' => $this->request->getVar('email'),
                'role' => '3',
            ]);

            session()->setFlashdata('message', 'Data Keamanan Berhasil Di tambahkan');

            return redirect()->to('/keamanan');
        }
    }

    public function detail($id)
    {
        if (session()->get('role') != 1) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Detail Keamanan',
            'validation' => \Config\Services::validation(),
            'admin' => $this->model->where('id', $id)->first(),
        ];

        return view('keamanan/detail', $data);
    }
}
