<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\AsatidzModel;

class Login extends BaseController
{
    public function index()
    {
        return view('login/user');
    }

    public function login()
    {
        // do something
    }

    public function logoutUser()
    {
        // do something
    }

    public function admin()
    {
        if (session('username')) {
            return redirect()->to('dashboard');
        }

        return view('login/admin', [
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function loginAdmin()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi!'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi!'
                ]
            ]
        ])) {
            return redirect()->to('login/admin')->withInput();
        }

        $adminModel = new AdminModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataAdmin = $adminModel->getLogin($username);

        if (!empty($dataAdmin)) {
            if (password_verify($password, $dataAdmin['password'])) {
                session()->set([
                    'username' => $dataAdmin['username'],
                    'name' => $dataAdmin['name'],
                    'role' => $dataAdmin['role']
                ]);

                if ($dataAdmin['role'] == 1) {
                    return redirect()->to('dashboard');
                } elseif ($dataAdmin['role'] == 2) {
                    return redirect()->to('dashboard');
                }
            } else {
                session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Cek username atau password!
                      </div>
                    </div>');
                return redirect()->to('login/admin')->withInput();
            }
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Cek username atau password!
                      </div>
                    </div>');
            return redirect()->to('login/admin')->withInput();
        }
    }

    public function logoutAdmin()
    {
        $array_items = ['name', 'username', 'role'];
        session()->remove($array_items);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Berhasil logout!
                      </div>
                    </div>');
        return redirect()->to('login/admin')->withInput();
    }

    public function asatidz()
    {
        if (session('username')) {
            return redirect()->to('dashboard');
        }
        return view(
            'login/asatidz',
            [
                'validation' => \Config\Services::validation(),
            ]
        );
    }
    public function loginasatidz()
    {
        if (!$this->validate(
            [
                'username' => [
                    'required',
                    'errors' => [
                        'required' => 'username harus di isi'

                    ]
                ],

                'password' => [
                    'required',
                    'errors' => [
                        'required' => 'password harus di isi'
                    ]
                ]
            ]
        )) {
            return redirect()->to('login/asatidz')->withInput();
        }
        $asatidzModel = new AsatidzModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataAsatidz = $asatidzModel->getLogin($username);
        if (!empty($dataAsatidz)) {
            if (password_verify($password, $dataAsatidz['password'])) {
                session()->set([
                    'username' => $dataAsatidz['username'],
                    'nama_lengkap' => $dataAsatidz['nama_lengkap'],
                ]);
            } else {
                session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Cek username atau password!
                      </div>
                    </div>');
                return redirect()->to('login/asatidz')->withInput();
            }
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Cek username atau password!
                      </div>
                    </div>');
            return redirect()->to('login/asatidz')->withInput();
        }
    }
}
