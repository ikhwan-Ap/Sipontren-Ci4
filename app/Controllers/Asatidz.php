<?php

namespace App\Controllers;

use App\Models\AsatidzModel;

class Asatidz extends BaseController
{
    public function __construct()
    {
        $this->asatidzModel = new AsatidzModel();
        if (session()->get('username')) {
            return redirect()->to('dashboard/asatidz');
        }
        $fotoasatidz = $this->asatidzModel->where('username', session()->get('foto'))->first();
    }

    public function index()
    {

        $data = [
            'title' => 'Asatidz',
            'asatidz' => $this->asatidzModel->where('username', session()->get('username'))->first(),

            // 'admin' => $this->model->where('role', 2)->findAll(),
        ];

        return view('asatids/index', $data);
    }

    public function profil()
    {
        $data = [
            'title' => 'Profil',
            'validate' => \Config\Services::validation(),
            'asatidz' => $this->asatidzModel->where('username', session()->get('username'))->first(),
        ];
        return view('asatidz/profil', $data);
    }
    public function editprofil()
    {
        if (!$this->validate(
            [
                'nama_lengkap' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'nama harus di isi!!',
                    ]
                ],
                'no_hp' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'Nomor Hp harus di isi!!',
                    ]
                ],
                'email' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'email harus di isi!!',
                    ]
                ],
                'tempat_lahir' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'Tempat Tanggal Lahir harus di isi!!',
                    ]
                ],
                'alamat' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'alamat harus di isi!!',
                    ]
                ],
                'nik_ktp' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'Nomor Nik  harus di isi!!',
                    ]
                ],
                'no_kk' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'Nomor KK harus di isi!!',
                    ]
                ],
                'pendidikan' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'Riwayat Pendidikan harus di isi!!',
                    ]
                ],
                'program' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'Program  harus di isi!!',
                    ]
                ],
                'jenis_kelamin' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'Gender harus di isi!!',
                    ]
                ],
            ]
        )) {

            return redirect()->to('/asatidz/profil/' . $this->request->getVar('username'))->withInput();
        }

        // $fileFoto = $this->request->getFile('foto');
        // if ($fileFoto->getError() == 0) {
        //     $namaFoto = 'default.png';
        // } else {
        //     $namaFoto = $fileFoto->getRandomName();

        //     $image = \Config\Services::image()
        //         ->withFile($fileFoto)
        //         ->resize(400, 200, true, 'height')
        //         ->save(FCPATH . '/img/' . $namaFoto);
        // }
        $this->asatidzModel->save(

            [
                'id' => $this->request->getVar('id'),
                'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                'no_hp' => $this->request->getVar('no_hp'),
                'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                'alamat' => $this->request->getVar('alamat'),
                'nik_ktp' => $this->request->getVar('nik_ktp'),
                'no_kk' => $this->request->getVar('no_kk'),
                'pendidikan' => $this->request->getVar('pendidikan'),
                'program' => $this->request->getVar('program'),
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                // 'foto' => $namaFoto,
            ]
        );

        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>barang</strong> berhasil diubah!</div>');

        return redirect()->to('/asatidz/profil');
    }
    public function template()
    {
        return view('layout/template');
    }
}
