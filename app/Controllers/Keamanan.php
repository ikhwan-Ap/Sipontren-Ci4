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
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi!'
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[admin.username]',
                'errors' => [
                    'required' => 'Username harus diisi!',
                    'is_unique' => 'Username sudah terdaftar!',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!'
                ]
            ],
            'password' => [
                'rules' => 'required|matches[password_conf]|min_length[5]',
                'errors' => [
                    'required' => 'Password harus diisi!',
                    'matches' => 'Password tidak sama dengan Konfirmasi Password!',
                    'min_length' => 'Password kurang dari 5 karakter!',
                ]
            ],
            'password_conf' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi Password harus diisi!',
                    'matches' => 'Konfirmasi Password tidak sama dengan Password!'
                ]
            ]
        ])) {
            return redirect()->to('/keamanan/add')->withInput();
        }

        $this->model->save([
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => '3',
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data Keamanan berhasil ditambahkan!
                      </div>
                    </div>');

        return redirect()->to('/keamanan');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data keamanan berhasil dihapus!
                      </div>
                    </div>');
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
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi!'
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi!',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!'
                ]
            ],
        ])) {
            return redirect()->to('/keamanan/edit/' . $this->request->getVar('username'))->withInput();
        }
        $password = $this->request->getVar('password');
        $password_conf = $this->request->getVar('password_conf');
        if ($password != $password_conf) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>×</span>
              </button>
              Password Dan Konfirmasi Password Tidak Sama
            </div>
          </div>');
            return redirect()->to('/keamanan/edit/' . $this->request->getVar('username'))->withInput();
        } else {
            $this->model->save([
                'id' => $id,
                'name' => $this->request->getVar('name'),
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),

            ]);

            session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data Keamanan berhasil diubah!
                      </div>
                    </div>');
        }
        return redirect()->to('/keamanan');
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
