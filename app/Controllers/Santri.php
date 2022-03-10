<?php

namespace App\Controllers;

use App\Models\OrangtuaModel;
use App\Models\SantriModel;
use App\Models\KelasModel;
use App\Models\KamarModel;
use App\Models\DiniyahModel;
use App\Models\KeuanganModel;
use App\Models\ProgramModel;
use App\Models\WilayahModel;
use App\Models\RegenciesModel;
use App\Models\DistrictsModel;
use App\Models\VillagesModel;

class Santri extends BaseController
{
    public function __construct()
    {
        $this->santriModel = new SantriModel();
        $this->santri = new SantriModel();
        $this->ortu = new OrangtuaModel();
        $this->kelas = new KelasModel();
        $this->diniyah = new DiniyahModel();
        $this->kamar = new KamarModel();
        $this->program = new ProgramModel();
        $this->keuangan = new KeuanganModel();
        $this->provinsi = new WilayahModel();
        $this->kabupaten = new RegenciesModel();
        $this->kecamatan = new DistrictsModel();
        $this->desa = new VillagesModel();
    }

    // $fotosantri = $this->santriModel->where('username', session()->get('foto'))->first();

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
            'validation' => \Config\Services::validation(),
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
            return redirect()->to('/santri/profil/' . $this->request->getVar('nis'))->withInput();
        } else {
            $this->santriModel->save(

                [
                    'id_santri' => $this->request->getVar('id_santri'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                    'alamat' => $this->request->getVar('alamat'),
                    'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
                    'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                ]
            );

            session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>Anda</strong> berhasil diubah!</div>');
        }

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

    public function biodata()
    {
        $data = [
            'title' => 'biodata santri',
            // 'santri' => $this->santriModel->where('nis', session()->get('nis'))->first(),
            'santri' => $this->db->table('santri')->select('*')->where('nis', session()->get('nis'))
                ->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')
                ->join('kamar', 'kamar.id_kamar = santri.id_kamar')
                ->join('diniyah', 'diniyah.id_diniyah = santri.id_diniyah')
                ->join('kelas', 'kelas.id_kelas = santri.id_kelas')
                ->join('program', 'program.id_program = santri.id_program')
                ->get()->getRowArray(),
        ];
        return view('santri/biodata', $data);
    }
    public function pembayaran()
    {
        $data = [
            'title' => 'biodata santri',
            // 'santri' => $this->santriModel->where('nis', session()->get('nis'))->first(),
            'santri' => $this->db->table('keuangan')->select('*')->where('nis', session()->get('nis'))
                ->join('santri', 'santri.id_santri = keuangan.id_santri', 'left')
                ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan', 'left')
                ->get()->getResultArray(),
        ];
        return view('santri/pembayaran', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Data Santri',
            'validation' => \Config\Services::validation(),
            'wilayah' => $this->provinsi->get_provinsi(),
            'kelas' => $this->kelas->findAll(),
            'diniyah' => $this->diniyah->findAll(),
            'program' => $this->program->findAll(),
            'kamar' => $this->kamar->findAll(),

        ];

        return view('santri/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nis' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'NIS harus diisi!',
                    'numeric' => 'NIS harus angka!'
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
            'id_program' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Program harus diisi!',
                ]
            ],
            'id_diniyah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Diniyah harus diisi!',
                ]
            ],
            'id_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas harus diisi!',
                ]
            ],
            'id_kamar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kamar harus diisi!',
                ]
            ],
            'jenis_kendaraan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kendaraan harus diisi!',
                ]
            ],
            'plat_nomor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Plat Nomor harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/santri/add')->withInput();
        }

        $this->ortu->save([
            'nama_ayah' => $this->request->getVar('nama_ayah'),
            'nama_ibu' => $this->request->getVar('nama_ibu'),
            'no_hp_wali' => $this->request->getVar('no_hp_wali'),
            'pekerjaan_ortu' => $this->request->getVar('pekerjaan_ortu'),
        ]);

        $idOrtu = $this->ortu->getID();


        $this->santri->save([
            'nis' => $this->request->getVar('nis'),
            'nik_ktp' => $this->request->getVar('nik_ktp'),
            'no_kk' => $this->request->getVar('no_kk'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
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
            'jenis_kendaraan' => $this->request->getVar('jenis_kendaraan'),
            'plat_nomor' => $this->request->getVar('plat_nomor'),
            'id_diniyah' => $this->request->getVar('id_diniyah'),
            'id_program' => $this->request->getVar('id_program'),
            'id_kelas' => $this->request->getVar('id_kelas'),
            'id_kamar' => $this->request->getVar('id_kamar'),
            'status' => 'Aktif',
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Pendaftaran berhasil ditambahkan!
                      </div>
                    </div>');

        return redirect()->to('/santri');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Santri',
            'validation' => \Config\Services::validation(),
            'santri' => $this->santri->edit($id),
            'kelas' => $this->kelas->findAll(),
            'diniyah' => $this->diniyah->findAll(),
            'program' => $this->program->findAll(),
            'kamar' => $this->kamar->findAll(),
            'santri_program' => $this->santri->Get_program($id),
            'provinsi' => $this->santri->Get_provinsi($id),
            'kabupaten' => $this->santri->Get_kabupaten($id),
            'kecamatan' => $this->santri->Get_kecamatan($id),
            'desa' => $this->santri->Get_desa($id),
            'wilayah' => $this->provinsi->get_provinsi(),
        ];

        return view('santri/edit', $data);
    }

    public function update($id)
    {
        $id =  $this->request->getVar('id_santri');
        $id_orangtua =  $this->request->getVar('id_orangtua');
        if (!$this->validate([
            'nis' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'NIS harus diisi!',
                    'numeric' => 'NIS harus angka!'
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
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status harus diisi!',
                ]
            ],
            'id_program' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Program harus diisi!',
                ]
            ],
            'id_diniyah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Diniyah harus diisi!',
                ]
            ],
            'id_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas harus diisi!',
                ]
            ],
            'id_kamar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kamar harus diisi!',
                ]
            ],
            'jenis_kendaraan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kendaraan harus diisi!',
                ]
            ],
            'plat_nomor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Plat Nomor harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/santri/edit/' . $id)->withInput();
        }

        $this->ortu->save([
            'id_orangtua' => $id_orangtua,
            'nama_ayah' => $this->request->getVar('nama_ayah'),
            'nama_ibu' => $this->request->getVar('nama_ibu'),
            'no_hp_wali' => $this->request->getVar('no_hp_wali'),
            'pekerjaan_ortu' => $this->request->getVar('pekerjaan_ortu'),
        ]);
        $id_diniyah = $this->request->getVar('id_diniyah');
        $id_program = $this->request->getVar('id_program');
        $id_kelas = $this->request->getVar('id_kelas');
        $id_kamar = $this->request->getVar('id_kamar');
        $password = $this->request->getVar('password');
        $idOrtu = $this->ortu->getID();
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
            return redirect()->to('/santri/edit/' . $id)->withInput();
        } else {
            $this->santri->save([
                'id_santri' => $id,
                'nis' => $this->request->getVar('nis'),
                'nik_ktp' => $this->request->getVar('nik_ktp'),
                'no_kk' => $this->request->getVar('no_kk'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
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
                'id_diniyah' => $id_diniyah,
                'id_program' => $id_program,
                'id_kelas' => $id_kelas,
                'id_kamar' => $id_kamar,
                'id_orangtua' => $id_orangtua,
                'jenis_kendaraan' => $this->request->getVar('jenis_kendaraan'),
                'plat_nomor' => $this->request->getVar('plat_nomor'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'status' => $this->request->getVar('status'),
            ]);
        }
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data santri berhasil diubah!
                      </div>
                    </div>');

        return redirect()->to('/santri');
    }

    public function editnonaktif($id)
    {
        $data = [
            'title' => 'Edit Data Santri Non Aktif',
            'validation' => \Config\Services::validation(),
            'santri' => $this->santri->editNon($id),
            'santri_program' => $this->santri->Get_program($id),
            'provinsi' => $this->santri->Get_provinsi($id),
            'kabupaten' => $this->santri->Get_kabupaten($id),
            'kecamatan' => $this->santri->Get_kecamatan($id),
            'desa' => $this->santri->Get_desa($id),
            'wilayah' => $this->provinsi->get_provinsi(),
            'santri_diniyah' => $this->santri->where('id_santri', $id)
                ->join('diniyah', 'diniyah.id_diniyah=santri.id_diniyah')
                ->first(),
            'santri_kelas' => $this->santri->where('id_santri', $id)
                ->join('kelas', 'kelas.id_kelas=santri.id_kelas')
                ->first(),
            'santri_kamar' => $this->santri->where('id_santri', $id)
                ->join('kamar', 'kamar.id_kamar=santri.id_kamar')
                ->first(),
            'kelas' => $this->kelas->findAll(),
            'diniyah' => $this->diniyah->findAll(),
            'program' => $this->program->findAll(),
            'kamar' => $this->kamar->findAll(),
        ];

        return view('santri/editnonaktif', $data);
    }

    public function updatenonaktif($id)
    {
        $id =  $this->request->getVar('id_santri');
        $id_orangtua =  $this->request->getVar('id_orangtua');
        if (!$this->validate([
            'nis' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'NIS harus diisi!',
                    'numeric' => 'NIS harus angka!'
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
            'desa_kelurahan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Desa / Kelurahan harus diisi!',
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
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status harus diisi!',
                ]
            ],
            'id_program' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Program harus diisi!',
                ]
            ],
            'id_diniyah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Diniyah harus diisi!',
                ]
            ],
            'id_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas harus diisi!',
                ]
            ],
            'id_kamar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kamar harus diisi!',
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
            'jenis_kendaraan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kendaraan harus diisi!',
                ]
            ],
            'plat_nomor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Plat Nomor harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/santri/editnonaktif/' . $id)->withInput();
        }

        $this->ortu->save([
            'id_orangtua' => $id_orangtua,
            'nama_ayah' => $this->request->getVar('nama_ayah'),
            'nama_ibu' => $this->request->getVar('nama_ibu'),
            'no_hp_wali' => $this->request->getVar('no_hp_wali'),
            'pekerjaan_ortu' => $this->request->getVar('pekerjaan_ortu'),

        ]);

        $idOrtu = $this->ortu->getID();
        $this->santri->save([
            'id_santri' => $id,
            'nis' => $this->request->getVar('nis'),
            'nik_ktp' => $this->request->getVar('nik_ktp'),
            'no_kk' => $this->request->getVar('no_kk'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'email' => $this->request->getVar('email'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'alamat' => $this->request->getVar('alamat'),
            'provinsi' => $this->request->getVar('provinsi'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'desa_kelurahan' => $this->request->getVar('desa_kelurahan'),
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
            'jenis_kendaraan' => $this->request->getVar('jenis_kendaraan'),
            'plat_nomor' => $this->request->getVar('plat_nomor'),
            'id_diniyah' => $this->request->getVar('id_diniyah'),
            'id_program' => $this->request->getVar('id_program'),
            'id_kelas' => $this->request->getVar('id_kelas'),
            'id_kamar' => $this->request->getVar('id_kamar'),
            'id_orangtua' => $id_orangtua,
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'status' => $this->request->getVar('status'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data santri berhasil diubah!
                      </div>
                    </div>');

        return redirect()->to('/santri');
    }

    public function delete($id)
    {
        $this->db->table('santri')->delete(['id_santri' => $id]);
        $this->db->table('orangtua')->delete(['id_orangtua' => $id]);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data Santri berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/santri');
    }

    public  function Get_kabupaten($provinsi_id)
    {

        if ($provinsi_id != '') {
            echo $this->kabupaten->get_kabupaten($provinsi_id);
        }
    }
    //request data kecamatan berdasarkan id kabupaten yang dipilih
    public  function Get_kecamatan($kabupaten_id)
    {
        if ($this->request->isAJAX()) {

            if ($kabupaten_id != '') {
                echo $this->kecamatan->get_kecamatan($kabupaten_id);
            }
        }
    }

    //request data desa berdasarkan id kecamatan yang dipilih
    public function Get_desa($kecamatan_id)
    {
        if ($this->request->isAJAX()) {

            if ($kecamatan_id != '') {
                echo $this->desa->get_desa($kecamatan_id);
            }
        }
    }
}
