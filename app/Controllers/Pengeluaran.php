<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KeuanganModel;
use App\Models\TagihanModel;
use App\Models\SantriModel;
use App\Models\PengeluaranModel;
use App\Models\Data_pengeluaran;
use App\Models\KelasModel;


class Pengeluaran extends BaseController
{
    public function __construct()
    {
        $this->model = new KeuanganModel();
        $this->tagihan = new TagihanModel();
        $this->santri = new SantriModel();
        $this->pengeluaran = new PengeluaranModel();
        $this->data_pengeluaran = new Data_pengeluaran();
        $this->kelas = new KelasModel();
    }

    public function pengeluaran()
    {
        $data = [
            'tanggal' => '',
            'title' => 'Pengeluaran',
            'keluar' => $this->data_pengeluaran->getData(),
            'data' => $this->pengeluaran->getPengeluaran_baru(),
            'pengeluaran' => $this->pengeluaran->total_pengeluaran(),
            'jumlah_keluar' => $this->pengeluaran->pengeluaran(),
            'jumlah_masuk' => $this->model->jumlah_pemasukan(),
        ];
        return view('pengeluaran/pengeluaran', $data);
    }

    public function pengeluaran_baru()
    {
        $data = [
            'title' => 'Data Pengeluaran',
            'Pengeluaran' => $this->data_pengeluaran->findAll(),
        ];
        return view('pengeluaran/pengeluaran_baru', $data);
    }

    public function pengeluaran_add()
    {
        $data = [
            'Lunas' => $this->model->jumlah_pemasukan(),
            'pengeluaran' => $this->pengeluaran->pengeluaran(),
            'pengeluaran_baru' => $this->data_pengeluaran->findAll(),
            'title' => 'Tambah Data Pengeluaran',
            'validation' => \Config\Services::validation(),

        ];
        return view('pengeluaran/pengeluaran_add', $data);
    }

    public function tambah_data_pengeluaran()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $nama_pengeluaran = $this->request->getVar('nama_pengeluaran');
            $valid = $this->validate([
                'nama_pengeluaran' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Nama Pengeluaran Harus diisi!',]
                ],
            ]);
            if (!$valid) {
                $data = [
                    'error' => ['errorNama' => $validation->getError('nama_pengeluaran'),]
                ];
            } else {
                $this->data_pengeluaran->save(['nama_pengeluaran' => $nama_pengeluaran]);
                session()->setFlashdata('message', 'Data Berhasil Di Tambahkan');
                $data = ['sukses' => 'Data Berhasil Di Tambahakan'];
            }
        }
        echo json_encode($data);
    }

    public function get_id_data($id_keluar)
    {
        $data = $this->data_pengeluaran->get_id_data($id_keluar);
        echo json_encode($data);
    }

    public function edit_data_pengeluaran()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $nama_pengeluaran = $this->request->getVar('nama_pengeluaran');
            $id_keluar = $this->request->getVar('id_keluar');
            $valid = $this->validate([
                'nama_pengeluaran' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Nama Pengeluaran Harus diisi!',]
                ],
            ]);
            if (!$valid) {
                $data = [
                    'error' => ['errorNama' => $validation->getError('nama_pengeluaran'),]
                ];
            } else {
                $this->data_pengeluaran->update(['id_keluar' => $id_keluar], ['nama_pengeluaran' => $nama_pengeluaran]);
                session()->setFlashdata('message', 'Data Berhasil Di Ubah');
                $data = ['sukses' => 'Data Berhasil Di Ubah'];
            }
        }
        echo json_encode($data);
    }

    public function save_pengeluaran()
    {
        if (!$this->validate([
            'id_keluar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pengeluaran Harus diisi!',
                ]
            ],
            'jumlah_pengeluaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah Pengeluaran Harus di Isi',
                ]
            ],
            'waktu_pengeluaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal  harus diisi!',
                ]
            ],

        ])) {
            return redirect()->to('/pengeluaran/pengeluaran_add')->withInput();
        }
        $jumlah_pengeluaran = $this->request->getVar('jumlah_pengeluaran');
        $sql = $this->db->query("SELECT sum(jumlah_bayar) as jumlah_bayar FROM keuangan");
        $cek = $sql->getRow()->jumlah_bayar;
        $pengeluaran = $this->db->query("SELECT sum(jumlah_pengeluaran) as jumlah_pengeluaran FROM pengeluaran WHERE jumlah_pengeluaran='$jumlah_pengeluaran'");
        $cek_pengeluaran = $pengeluaran->getRow()->jumlah_pengeluaran;
        $anggaran = $cek - $cek_pengeluaran;
        if ($jumlah_pengeluaran > $anggaran) {
            session()->setFlashdata('message', 'Pengeluaran Melebihi Anggaran Tersedia');
            return redirect()->to('/pengeluaran/pengeluaran_add')->withInput();
        } else {
            $this->pengeluaran->save([
                'id_keluar' => $this->request->getVar('id_keluar'),
                'jumlah_pengeluaran' => $jumlah_pengeluaran,
                'waktu_pengeluaran' => $this->request->getVar('waktu_pengeluaran'),
            ]);
            session()->setFlashdata('message', 'Data Pengeluaran Berhasil Di Tambahkan');
            return redirect()->to('/pengeluaran');
        }
    }

    public function edit_pengeluaran($nama)
    {
        $data = [
            'title' => 'Ubah Data Pengeluaran',
            'validation' => \Config\Services::validation(),
            'data' => $this->data_pengeluaran->where('nama_pengeluaran', $nama)->first(),
        ];

        return view('pengeluaran/edit', $data);
    }

    public function update_pengeluaran($id)
    {
        if (!$this->validate([
            'nama_pengeluaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pengeluaran harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/pengeluaran/edit/' . $this->request->getVar('nama_pengeluaran'))->withInput();
        }

        $this->data_pengeluaran->update(['id_tagihan' => $id], ['nama_pengeluaran' => $this->request->getVar('nama_pengeluaran'),]);

        session()->setFlashdata('message', 'Data Tagihan Berhasil Di Ubah');

        return redirect()->to('/pengeluaran/pengeluaran_baru');
    }

    public function delete_pengeluaranbaru($id)
    {
        $this->data_pengeluaran->delete($id);
        session()->setFlashdata('message', 'Data Pengeluaran Berhasil Di Hapus!!');
        return redirect()->to('/pengeluaran_baru');
    }
    public function delete_pengeluaran($id)
    {
        $this->pengeluaran->delete($id);
        session()->setFlashdata('message', 'Data Pengeluaran Berhasil Di Hapus!!');
        return redirect()->to('/pengeluaran');
    }


    public function filter_pengeluaran()
    {
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_selesai = $this->request->getVar('tgl_selesai');
        $nama_pengeluaran = $this->request->getVar('nama_pengeluaran');
        $tanggal = [
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'nama_pengeluaran' => $nama_pengeluaran
        ];
        if ($tgl_mulai != null || $tgl_selesai != null || $nama_pengeluaran != null) {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'nama_pengeluaran' => $nama_pengeluaran
            ];
            $data = [
                'title' => 'Pengeluaran',
                'keluar' => $this->data_pengeluaran->getData(),
                'data' => $this->pengeluaran->getPengeluaran($tanggal),
                'pengeluaran' => $this->pengeluaran->pengeluaran_total($tanggal),
                'jumlah_keluar' => $this->pengeluaran->pengeluaran(),
                'jumlah_masuk' => $this->model->jumlah_pemasukan(),
                'tanggal' => $tanggal,
            ];
        } else {
            $data = [
                'title' => 'Pengeluaran',
                'data' => $this->pengeluaran->getPengeluaran_baru(),
                'pengeluaran' => $this->pengeluaran->total_pengeluaran(),
                'jumlah_keluar' => $this->pengeluaran->pengeluaran(),
                'jumlah_masuk' => $this->model->jumlah_pemasukan(),
                'keluar' => $this->data_pengeluaran->getData(),

            ];
        }


        return view('laporan/pengeluaran', $data);
    }
}
