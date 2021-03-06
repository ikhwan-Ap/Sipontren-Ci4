<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\AsatidzModel;
use App\Models\SantriModel;

class Login extends BaseController
{
    public function index()
    {
        if (session('nis')) {
            return redirect()->to('dashboard/santri');
        }
        return view('login/user', [
            'title' => 'Login Santri',
            'validation' => \Config\Services::validation(),
        ]);
    }



    public function admin()
    {
        if (session('username')) {
            return redirect()->to('dashboard');
        }

        return view('login/admin', [
            'title' => 'Login Admin',
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
                session()->setFlashdata('error', 'Cek Username Atau Password !!');
                return redirect()->to('login/admin')->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Cek Username Atau Password');
            return redirect()->to('login/admin')->withInput();
        }
    }

    public function logoutAdmin()
    {
        $array_items = ['name', 'username', 'role'];
        session()->remove($array_items);
        session()->setFlashdata('message', 'Anda Berhasil Logout');
        return redirect()->to('login/admin')->withInput();
    }

    public function asatidz()
    {
        if (session('username')) {
            return redirect()->to('dashboard/asatidz');
        }
        return view(
            'login/asatidz',
            [
                'title' => 'Login Asatidz',
                'validation' => \Config\Services::validation(),
            ]
        );
    }
    public function loginasatidz()
    {
        if (!$this->validate(
            [
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'username harus di isi'

                    ]
                ],

                'password' => [
                    'rules' => 'required',
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
                return redirect()->to('dashboard/asatidz');
            } else {
                session()->setFlashdata('error', 'Cek Username atau Password !!');
                return redirect()->to('login/asatidz')->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Cek Username atau Password !!');

            return redirect()->to('login/asatidz')->withInput();
        }
    }
    public function logoutAsatidz()
    {
        $array_items = ['name', 'username'];
        session()->remove($array_items);
        session()->setFlashdata('message', 'Anda Berhasil Logout');

        return redirect()->to('login/asatidz')->withInput();
    }

    public function loginsantri()
    {
        if (!$this->validate(
            [
                'nis' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'nis harus di isi'

                    ]
                ],

                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'password harus di isi'
                    ]
                ]
            ]
        )) {
            return redirect()->to('login')->withInput();
        }
        $santriModel = new SantriModel();
        $nis = $this->request->getVar('nis');
        $password = $this->request->getVar('password');
        $dataSantri = $santriModel->getLogin($nis);
        if (!empty($dataSantri)) {
            if (password_verify($password, $dataSantri['password'])) {
                session()->set([
                    'nis' => $dataSantri['nis'],
                    'username' => $dataSantri['nis'],
                    'nama_lengkap' => $dataSantri['nama_lengkap'],
                ]);
                return redirect()->to('dashboard/santri');
            } else {
                session()->setFlashdata('error', 'Cek Username atau Password !!');

                return redirect()->to('login/index')->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Cek Username atau Password !!');

            return redirect()->to('login/index')->withInput();
        }
    }
    public function logoutSantri()
    {
        $array_items = ['nama_lengkap', 'nis'];
        session()->destroy($array_items);
        session()->setFlashdata('message', 'Anda Berhasil Logout');

        return redirect()->to('login/index')->withInput();
    }
}
