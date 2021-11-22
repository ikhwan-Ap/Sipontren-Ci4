<?php

namespace App\Controllers;

use App\Models\SantriModel;

class Santri extends BaseController
{
    public function __construct()
    {
        $this->santriModel = new SantriModel();

        // $fotosantri = $this->santriModel->where('username', session()->get('foto'))->first();
    }
    public function index()
    {
        $data = [
            'title' => 'Data Santri',
            'santri' => $this->santriModel->getSantriActive(),
            'santriNon' => $this->santriModel->getSantriNonActive(),
        ];

        return view('santri/index', $data);
    }
    public function profil()
    {
        $data = [
            'title' => 'Profil',
            'validate' => \Config\Services::validation(),
            'santri' => $this->santriModel->where('nis', session()->get('nis'))->first(),
        ];
        return view('santri/profil', $data);
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
                'tanggal_lahir' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'Tanggal Lahir harus di isi!!',
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
                'pendidikan_terakhir' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'Riwayat Pendidikan harus di isi!!',
                    ]
                ],
            ]
        )) {

            return redirect()->to('/santri/profil/' . $this->request->getVar('nis'))->withInput();
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
        $this->santriModel->save(

            [
                'id_santri' => $this->request->getVar('id_santri'),
                'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                'alamat' => $this->request->getVar('alamat'),
                'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
                'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                // 'foto' => $namaFoto,
            ]
        );

        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>Anda</strong> berhasil diubah!</div>');

        return redirect()->to('/santri/profil');
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Data Santri',
            'santri' => $this->santriModel->where('id_santri', $id)->first(),
        ];

        return view('santri/detail', $data);
    }

    public function coba()
    {
        $data = [
            'title' => 'dashboard',
        ];
        return view('dashboard/santri', $data);
    }

    public function biodata()
    {
        $data = [
            'title' => 'biodata santri',
            'santri' => $this->santriModel->where('nis', session()->get('nis'))->first(),
        ];
        return view('santri/biodata', $data);
    }
}
