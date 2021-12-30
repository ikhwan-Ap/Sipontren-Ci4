<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrangtuaModel;
use App\Models\SantriModel;

class Register extends BaseController
{
    public function __construct()
    {
        $this->santri = new SantriModel();
        $this->ortu = new OrangtuaModel();
    }

    public function index()
    {
        return view('register/index', [
            'title' => 'Pendaftaran',
            'validation' => \Config\Services::validation(),
            'provinsi' => $this->santri->getProvinsi(),
            'provinsi_selected' => '',
            'kabupaten' => $this->santri->getKabupaten(),
            'kabupaten_selected' => '',
            'kecamatan' => $this->santri->getKecamatan(),
            'kecamatan_selected' => '',
            'desa' => $this->santri->getDesa(),
            'desa_selected' => '',
        ]);
    }

    public function create()
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
            'pekerjaan_ortu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pekerjaan Ortu Sekarang harus diisi!',
                ]
            ],
            'gol_darah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Golongan Darah harus diisi!',
                ]
            ],
            'nisn_nim' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NISN / NIM harus diisi!',
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
        ])) {
            return redirect()->to('/register')->withInput();
        }

        $this->ortu->save([
            'nama_ayah' => $this->request->getVar('nama_ayah'),
            'nama_ibu' => $this->request->getVar('nama_ibu'),
            'no_hp_wali' => $this->request->getVar('no_hp_wali'),
            'pekerjaan_ortu' => $this->request->getVar('pekerjaan_ortu'),
        ]);

        $idOrtu = $this->ortu->getID();

        $this->santri->save([
            'nik_ktp' => $this->request->getVar('nik_ktp'),
            'no_kk' => $this->request->getVar('no_kk'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'email' => $this->request->getVar('email'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'alamat' => $this->request->getVar('alamat'),
            'desa_kelurahan' => $this->request->getVar('desa_kelurahan'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'provinsi' => $this->request->getVar('provinsi'),
            'no_hp_santri' => $this->request->getVar('no_hp_santri'),
            'catatan_medis' => $this->request->getVar('catatan_medis'),
            'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
            'pengalaman_mondok' => $this->request->getVar('pengalaman_mondok'),
            'pendidikan_sekarang' => $this->request->getVar('pendidikan_sekarang'),
            'gol_darah' => $this->request->getVar('gol_darah'),
            'nisn_nim' => $this->request->getVar('nisn_nim'),
            'nama_almet' => $this->request->getVar('nama_almet'),
            'kelas_semester' => $this->request->getVar('kelas_semester'),
            'jurusan' => $this->request->getVar('jurusan'),
            'id_orangtua' => $idOrtu,
            'status' => 'Baru',
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Pendaftaran berhasil ditambahkan!
                      </div>
                    </div>');

        return redirect()->to('/register');
    }
}
