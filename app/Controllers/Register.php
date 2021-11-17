<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Register extends BaseController
{
    public function index()
    {
        return view('register/index', [
            'title' => 'Pendaftaran',
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function create()
    {
        if (!$this->validate([
            'nik_ktp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NIK KTP harus diisi!'
                ]
            ],
            'no_kk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No KK harus diisi!'
                ]
            ],
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi!'
                ]
            ],
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi!',
                ]
            ],
            'tempat_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat Lahir harus diisi!',
                ]
            ],
            'tanggal_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Lahir harus diisi!',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi!',
                ]
            ],
            'desa_kelurahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Desa / Kelurahan harus diisi!',
                ]
            ],
            'kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kecamatan harus diisi!',
                ]
            ],
            'kabupaten' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kabupaten harus diisi!',
                ]
            ],
            'provinsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Provinsi harus diisi!',
                ]
            ],
            'nama_ayah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Ayah harus diisi!',
                ]
            ],
            'nama_ibu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Ibu harus diisi!',
                ]
            ],
            'no_hp_santri' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'No HP harus diisi!',
                    'numeric' => 'No HP harus angka!',
                ]
            ],
            'no_hp_wali' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'No HP harus diisi!',
                    'numeric' => 'No HP harus angka!',
                ]
            ],
            'catatan_medis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Catatan Medis harus diisi!',
                ]
            ],
            'pendidikan_terakhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pendidikan Terakhir harus diisi!',
                ]
            ],
            'pengalaman_mondok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pengalaman Mondok harus diisi!',
                ]
            ],
            'pendidikan_sekarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pendidikan Sekarang harus diisi!',
                ]
            ],
            'gol_darah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Golongan Darah harus diisi!',
                ]
            ],
            'nisn' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NISN harus diisi!',
                ]
            ],
            'nama_almet' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Almamater harus diisi!',
                ]
            ],
            'kelas_semester' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas / Semester harus diisi!',
                ]
            ],
            'jurusan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jurusan harus diisi!',
                ]
            ],
            'nisn_nim' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NISN / NIM harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/register')->withInput();
        }

        $this->model->save([
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => '2',
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data admin berhasil ditambahkan!
                      </div>
                    </div>');

        return redirect()->to('/admin');
    }
}
