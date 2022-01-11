<?php

namespace App\Controllers;

use App\Models\SantriModel;

class Alumni extends BaseController
{
    public function __construct()
    {
        $this->santri = new SantriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Alumni',
            'alumni' => $this->santri->getSantriAlumni(),
        ];

        return view('alumni/index', $data);
    }

    public function delete($id)
    {
        $this->santri->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data Santri berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/alumni');
    }

    public function create()
    {
        $data = [
            'title' => 'Data Alumni',
            'validation' => \Config\Services::validation(),
        ];

        return view('alumni/add', $data);
    }

    public function save()
    {
        if (!$this->validate([

            'nis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nis harus diisi!',
                ]
            ],
            'nik_ktp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'NIK KTP harus diisi!',
                    'numeric' => 'NIK KTP harus angka!'
                ]
            ],
            'no_kk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'No KK harus diisi!',
                    'numeric' => 'No KK harus angka!'
                ]
            ],
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi!',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!',
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin harus diisi!',
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
            'no_hp_santri' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomer Hp  harus diisi!',
                ]
            ],
            'pendidikan_terakhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pendidikan terakhir harus diisi!',
                ]
            ],
            'pendidikan_sekarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pendidikan harus diisi!',
                ]
            ],

        ])) {
            return redirect()->to('/alumni/add')->withInput();
        }

        $this->santri->save([
            'nis' => $this->request->getVar('nis'),
            'nik_ktp' => $this->request->getVar('nik_ktp'),
            'no_kk' => $this->request->getVar('no_kk'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'email' => $this->request->getVar('email'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp_santri' => $this->request->getVar('no_hp_santri'),
            'status' => 'Alumni',
            'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
            'pendidikan_sekarang' => $this->request->getVar('pendidikan_sekarang'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data Alumni Berhasil Di tambahkan
                      </div>
                    </div>');

        return redirect()->to('/alumni');
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Data Alumni',
            'santri' => $this->santri->where('id_santri', $id)->first(),
        ];

        return view('alumni/detail', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Alumni',
            'validation' => \Config\Services::validation(),
            'santri' => $this->santri->getAlumni($id),
        ];

        return view('alumni/edit', $data);
    }

    public function update($id)
    {
        $id = $this->request->getVar('id_santri');
        if (!$this->validate([

            'nis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nis harus diisi!',
                ]
            ],
            'nik_ktp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'NIK KTP harus diisi!',
                    'numeric' => 'NIK KTP harus angka!'
                ]
            ],
            'no_kk' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'No KK harus diisi!',
                    'numeric' => 'No KK harus angka!'
                ]
            ],
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi!',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi!',
                    'valid_email' => 'Email tidak valid!',
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin harus diisi!',
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
            'no_hp_santri' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomer Hp  harus diisi!',
                ]
            ],
            'pendidikan_terakhir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pendidikan terakhir harus diisi!',
                ]
            ],
            'pendidikan_sekarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pendidikan harus diisi!',
                ]
            ],

        ])) {
            return redirect()->to('/alumni/edit/' .  $id)->withInput();
        }
        $this->santri->save([
            'id_santri' => $id,
            'nis' => $this->request->getVar('nis'),
            'nik_ktp' => $this->request->getVar('nik_ktp'),
            'no_kk' => $this->request->getVar('no_kk'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'email' => $this->request->getVar('email'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp_santri' => $this->request->getVar('no_hp_santri'),
            'status' => 'Alumni',
            'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
            'pendidikan_sekarang' => $this->request->getVar('pendidikan_sekarang'),
        ]);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data Alumni berhasil diubah!
                      </div>
                    </div>');

        return redirect()->to('/alumni');
    }
}
