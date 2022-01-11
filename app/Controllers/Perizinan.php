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
        ];

        return view('perizinan/index', $data);
    }

    public function keamanan()
    {
        $data = [
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
            return redirect()->to('/perizinan/add')->withInput();
        }

        $this->perizinan->save([
            'id_santri' => $this->request->getVar('id_santri'),
            'keterangan' => $this->request->getVar('keterangan'),
            'tanggal_izin' => $this->request->getVar('tanggal_izin'),
            'tanggal_estimasi' => $this->request->getVar('tanggal_estimasi'),
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

        return redirect()->to('/perizinan');
    }

    public function terima($id_izin)
    {
        $this->perizinan->save([
            'id_izin' => $id_izin,
            'tanggal_diterima' => date("Y-m-d h:m", time()),
        ]);

        return redirect()->to('/perizinan');
    }

    public function pulang($id_izin)
    {
        $this->perizinan->save([
            'id_izin' => $id_izin,
            'tanggal_pulang' => date("Y-m-d h:m", time()),
        ]);

        return redirect()->to('/perizinan');
    }
    public function pulang_keamanan($id_izin)
    {
        $this->perizinan->save([
            'id_izin' => $id_izin,
            'tanggal_pulang' => date("Y-m-d h:m", time()),
        ]);

        return redirect()->to('/perizinan/keamanan');
    }

    public function ditolak($id_izin)
    {
        $this->perizinan->save([
            'id_izin' => $id_izin,
            'tanggal_ditolak' => date("Y-m-d h:m", time()),
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
