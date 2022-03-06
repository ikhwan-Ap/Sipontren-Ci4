<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PerizinanModel;
use App\Models\SantriModel;

class Perizinan extends BaseController
{
    public function __construct()
    {
        $this->santri = new SantriModel();
        $this->perizinan = new PerizinanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Perizinan',
            'izin' => $this->perizinan->getKeamanan(),
            'validation' => \Config\Services::validation(),
            'user_penginput' => session()->get('name')
        ];

        return view('perizinan/index', $data);
    }

    public function keamanan()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'title' => 'Perizinan',
            'izin' => $this->perizinan->getKeamanan(),
        ];

        return view('perizinan/keamanan', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Surat Izin Keluar',
            'validation' => \Config\Services::validation(),
            'santri' => $this->santri->findAll(),
            'user_penginput' => session()->get('name'),
        ];

        return view('perizinan/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NIS harus diisi!'
                ]
            ],
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi!',
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan harus diisi!',
                ]
            ],
            'tanggal_izin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Izin harus diisi!',
                ]
            ],
            'tanggal_estimasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Estimasi Kembali harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/perizinan')->withInput();
        }
        $id_santri = $this->request->getVar('id_santri');
        $tanggal_izin = $this->request->getVar('tanggal_izin');
        $tanggal_estimasi = $this->request->getVar('tanggal_estimasi');

        if ($tanggal_estimasi < $tanggal_izin) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>×</span>
              </button>
              Tanggal Izin Dan Estimasi Tidak Sesuai / Tidak Relevan
            </div>
          </div>');
            return redirect()->to('/perizinan')->withInput();
        } else {
            $this->perizinan->save([
                'id_santri' => $id_santri,
                'keterangan' => $this->request->getVar('keterangan'),
                'tanggal_izin' => $tanggal_izin,
                'tanggal_estimasi' => $tanggal_estimasi,
                'user_penginput' => $this->request->getVar('user_penginput'),
            ]);
            session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>×</span>
              </button>
              Data perizinan berhasil ditambahkan!
            </div>
          </div>');
        }
        return redirect()->to('/perizinan');
    }

    public function terima($id_izin)
    {
        $this->perizinan->save([
            'id_izin' => $id_izin,
            'tanggal_diterima' => date("Y-m-d h:i:s", time()),
        ]);

        return redirect()->to('/perizinan');
    }

    public function pulang($id_izin)
    {
        $this->perizinan->save([
            'id_izin' => $id_izin,
            'tanggal_pulang' => date("Y-m-d h:i:s", time()),
        ]);

        return redirect()->to('/perizinan');
    }
    public function pulang_keamanan($id_izin)
    {
        $this->perizinan->save([
            'id_izin' => $id_izin,
            'tanggal_pulang' => date("Y-m-d h:i:s", time()),
        ]);

        return redirect()->to('/perizinan/keamanan');
    }

    public function ditolak($id_izin)
    {
        $this->perizinan->save([
            'id_izin' => $id_izin,
            'tanggal_ditolak' => date("Y-m-d h:i:s", time()),
        ]);

        return redirect()->to('/perizinan');
    }

    public function delete($id)
    {
        $this->perizinan->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data perizinan berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/perizinan');
    }
    public function ajax_terlambat($id_izin)
    {

        if ($this->request->getMethod() == "POST") {
            $rules = [
                'ket_terlambat' => 'required'
            ];
            if (!$this->validate($rules)) {
                $response = [
                    'success' => false,
                    'msg' => 'Keterangan Terlambat Harus Terisi',
                ];
                return $this->response->setJSON($response);
            } else {
                $data = [
                    'id_izin' => $id_izin,
                    'tanggal_pulang' => date("Y-m-d h:i:s", time()),
                    'ket_terlambat' => $this->request->getVar('ket_terlambat')
                ];
            }
            if ($this->perizinan->insert($data)) {
                $response = [
                    'success' => true,
                    'msg' => 'Data Terlambat Berhasil Di Inputkan'
                ];
            } else {
                $response = [
                    'success' => true,
                    'msg' => 'Gagal Menginput Data Terlambat'
                ];
            }
            return $this->response->setJSON($response);
        }
    }
    public function terlambat($id_izin)
    {
        if (!$this->validate([
            'ket_terlambat' => [
                'rules' => 'required',
                'errors' => [
                    session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                      <button class="close" data-dismiss="alert">
                        <span></span>
                      </button>
                      Keterangan Terlambat Harus Di Isi !!
                    </div>
                  </div>')
                ]
            ],
        ])) {
            if (session()->get('role') != 1) {
                return redirect()->to('/perizinan/keamanan');
            }
            return redirect()->to('/perizinan')->withInput();
        }
        $this->perizinan->save([
            'id_izin' => $id_izin,
            'tanggal_pulang' => date("Y-m-d h:i:s", time()),
            'ket_terlambat' => $this->request->getVar('ket_terlambat'),
        ]);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Keterangan berhasil ditambah!
                      </div>
                    </div>');
        if (session()->get('role') != 1) {
            return redirect()->to('/perizinan/keamanan');
        }
        return redirect()->to('/perizinan');
    }

    public function riwayat()
    {
        $data = [
            'title' => 'Riwayat Perizinan',
            'izin' => $this->perizinan->getIzin(),
        ];

        return view('perizinan/riwayat', $data);
    }

    public function detailRiwayatIzin($id_izin)
    {
        $data = [
            'title' => 'Detail Riwayat Perizinan',
            'izin' => $this->perizinan->getIzin($id_izin),
        ];

        return view('perizinan/detail_riwayat', $data);
    }

    public function perizinan_add()
    {
        $data = [
            'id_santri' => $this->request->getVar('id_santri'),
            'tanggal_izin' => $this->request->getVar('tanggal_izin'),
            'tanggal_estimasi' => $this->request->getVar('tanggal_estimasi'),
            'keterangan' => $this->request->getVar('keterangan'),
            'user_penginput' => $this->request->getVar('user_penginput'),
        ];
        $insert = $this->perizinan->perizinan_add();
        echo json_encode(array("status" => true));
    }

    public function get_autofill()
    {
        if (isset($_GET['term'])) {
            $result = $this->santri->search_santri($_GET['term']);

            if (count($result) > 0) {
                foreach ($result as $row) {
                    $arr_result[] =  array(
                        'label' => $row->nis,
                        'nama_lengkap' => $row->nama_lengkap,
                        'id_santri' => $row->id_santri,
                    );
                }
                echo json_encode($arr_result);
            }
        }
    }
}
