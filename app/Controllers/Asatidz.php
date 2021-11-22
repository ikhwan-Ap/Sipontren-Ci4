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
            'title' => 'Data Asatidz',
            'asatidz' => $this->asatidzModel->findAll(),
        ];

        return view('asatidz/index', $data);
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
                'pendidikan' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'Riwayat Pendidikan harus di isi!!',
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
                'pendidikan' => $this->request->getVar('pendidikan'),
                // 'foto' => $namaFoto,
            ]
        );

        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>barang</strong> berhasil diubah!</div>');

        return redirect()->to('/asatidz/profil');
    }
    public function delete($id)
    {
        $this->asatidzModel->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data diniyah berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/asatidz');
    }
}
