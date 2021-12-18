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
            'izin' => $this->perizinan->getIzin(),
        ];

        return view('perizinan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Surat Izin Keluar',
            'validation' => \Config\Services::validation(),
            'santri' => $this->santri->findAll(),
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
            'tanggal_kembali' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Kembali harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/perizinan/add')->withInput();
        }

        $this->perizinan->save([
            'id_santri' => $this->request->getVar('id_santri'),
            'keterangan' => $this->request->getVar('keterangan'),
            'tanggal_izin' => $this->request->getVar('tanggal_izin'),
            'tanggal_kembali' => $this->request->getVar('tanggal_kembali'),
            'tanggal_terima' => time(),
            'status_izin' => 'Menunggu',
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

    public function persetujuan()
    {
        $data = [
            'title' => 'Tambah Surat Izin Keluar',
            'validation' => \Config\Services::validation(),
            'izin' => $this->perizinan->getIzin(),
        ];

        return view('perizinan/persetujuan', $data);
    }

    public function terima($id_santri)
    {
        $this->perizinan->save([
            'id_santri' => $id_santri,
            'keterangan' => $this->request->getVar('keterangan'),
            'tanggal_izin' => $this->request->getVar('tanggal_izin'),
            'tanggal_kembali' => $this->request->getVar('tanggal_kembali'),
            'tanggal_terima' => time(),
            'status_izin' => 'Diterima',
        ]);

        return redirect()->to('/perizinan');
    }
    public function kembali($id_izin)
    {
        $this->perizinan->save([
            'id_izin' => $id_izin,
            'tanggal_terima' => time(),
            'status_izin' => 'Kembali',
        ]);

        return redirect()->to('/perizinan');
    }
    public function ditolak($id_izin)
    {
        $this->perizinan->save([
            'id_izin' => $id_izin,
            'tanggal_terima' => time(),
            'status_izin' => 'Ditolak',
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
                        Data Pembayaran berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/perizinan');
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
