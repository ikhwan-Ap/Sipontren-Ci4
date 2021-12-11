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

        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>Profil</strong> berhasil diubah!</div>');

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
                        Data asatidz berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/asatidz');
    }

    public function create()
    {
        $data = [
            'title' => 'Data Asatidz',
            'validation' => \Config\Services::validation(),
        ];

        return view('asatidz/add', $data);
    }

    public function save()
    {
        if (!$this->validate([

            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi!',
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
            'no_hp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomer Hp  harus diisi!',
                ]
            ],
            'jadwal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jadwal harus diisi!',
                ]
            ],
            'kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kelas harus diisi!',
                ]
            ],
            'total_santri' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'total santri harus diisi!',
                ]
            ],
            'pertemuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pertemuan harus diisi!',
                ]
            ],
            'pendidikan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pendidikan harus diisi!',
                ]
            ],
            'program' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'program harus diisi!',
                ]
            ],
            'foto' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'foto harus diisi!',
                ]
            ],

        ])) {
            return redirect()->to('/asatidz/add')->withInput();
        }

        $this->asatidzModel->save([
            'username' => $this->request->getVar('username'),
            'nik_ktp' => $this->request->getVar('nik_ktp'),
            'no_kk' => $this->request->getVar('no_kk'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'email' => $this->request->getVar('email'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),
            'jadwal' => $this->request->getVar('jadwal'),
            'kelas' => $this->request->getVar('kelas'),
            'total_santri' => $this->request->getVar('total_santri'),
            'pertemuan' => $this->request->getVar('pertemuan'),
            'foto' => $this->request->getVar('foto'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'program' => $this->request->getVar('program'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Pendaftaran berhasil ditambahkan!
                      </div>
                    </div>');

        return redirect()->to('/asatidz');
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Data Asatidz',
            'asatidz' => $this->asatidzModel->where('id', $id)->first(),
        ];

        return view('asatidz/detail', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Asatidz',
            'validation' => \Config\Services::validation(),
            'asatidz' => $this->asatidzModel->where('id', $id)->first(),
        ];

        return view('asatidz/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
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
            'program' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'program harus diisi!',
                ]
            ],
            'no_hp' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'No HP harus diisi!',
                    'numeric' => 'No HP harus angka!',
                ]
            ],
            'jadwal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jadawl harus diisi!',
                ]
            ],
            'pendidikan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pendidikan harus diisi!',
                ]
            ],
            'kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas  harus diisi!',
                ]
            ],
            'pertemuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pertemuan harus diisi!',
                ]
            ],
            'total_santri' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Total santri harus diisi!',
                ]
            ],
            'foto' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Foto harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/asatidz/edit/' . $this->request->getVar('id'))->withInput();
        }

        $this->asatidzModel->save([
            'id' => $id,
            'nik_ktp' => $this->request->getVar('nik_ktp'),
            'no_kk' => $this->request->getVar('no_kk'),
            'username' => $this->request->getVar('username'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'email' => $this->request->getVar('email'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'alamat' => $this->request->getVar('alamat'),
            'program' => $this->request->getVar('program'),
            'jadwal' => $this->request->getVar('jadwal'),
            'kelas' => $this->request->getVar('kelas'),
            'total_santri' => $this->request->getVar('total_santri'),
            'no_hp' => $this->request->getVar('no_hp'),
            'pertemuan' => $this->request->getVar('pertemuan'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'foto' => $this->request->getVar('foto'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data asatidz berhasil diubah!
                      </div>
                    </div>');

        return redirect()->to('/asatidz');
    }
}
