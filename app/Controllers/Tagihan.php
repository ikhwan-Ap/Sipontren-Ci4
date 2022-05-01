<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KeuanganModel;
use App\Models\TagihanModel;
use App\Models\SantriModel;
use App\Models\PengeluaranModel;
use App\Models\Data_pengeluaran;
use App\Models\KelasModel;

class Tagihan extends BaseController
{
    public function __construct()
    {
        $this->model = new KeuanganModel();
        $this->tagihan = new TagihanModel();
        $this->santri = new SantriModel();
        $this->pengeluaran = new PengeluaranModel();
        $this->data = new Data_pengeluaran();
        $this->kelas = new KelasModel();
    }


    public function tagihan()
    {
        $data = [
            'title' => 'Tagihan',
            'tagihan' => $this->tagihan->getTagihan(),
        ];
        return view('tagihan/tagihan', $data);
    }

    public function tagihan_add()
    {
        $data = [
            'title' => 'Tagihan Baru',
            'validation' => \Config\Services::validation(),
        ];
        return view('tagihan/tagihan_add', $data);
    }

    public function save_tagihan()
    {
        if (!$this->validate([
            'nama_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pembayaran Harus diisi!',
                ]
            ],

        ])) {
            return redirect()->to('/pembayaran/tagihan_add')->withInput();
        }

        $this->tagihan->save([
            'nama_pembayaran' => $this->request->getVar('nama_pembayaran'),
        ]);
        session()->setFlashdata('message', 'Data Tagihan Berhasil Di Tambahkan');
        return redirect()->to('/tagihan/tagihan');
    }
    public function tagihan_rutin()
    {
        $data = [
            'title' => 'Tagihan Baru',
            'validation' => \Config\Services::validation(),
        ];
        return view('tagihan/tagihanrutin_add', $data);
    }

    public function save_rutin()
    {
        if (!$this->validate([
            'jumlah_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah Pembayaran Harus diisi!',
                ]
            ],
            'nama_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pembayaran Harus diisi!',
                ]
            ],

        ])) {
            return redirect()->to('/tagihan/tagihan_rutin')->withInput();
        }
        $nama_pembayaran = $this->request->getVar('nama_pembayaran');
        $sql = $this->db->query("SELECT nama_pembayaran FROM tagihan WHERE nama_pembayaran='$nama_pembayaran'
       ")->getRowArray();
        if ($sql > 0) {
            session()->setFlashdata('message', 'Nama Pembayaran Tersebut Telah Tersedia');
            return redirect()->to('/tagihan/tagihan_rutin')->withInput();
        } else {
            $this->tagihan->save([
                'nama_pembayaran' => $nama_pembayaran,
                'jumlah_pembayaran' => $this->request->getVar('jumlah_pembayaran')
            ]);
            session()->setFlashdata('message', 'Data Tagihan berhasil ditambahkan!');
            return redirect()->to('/tagihan');
        }
    }
    public function delete_tagihan($id)
    {
        $this->tagihan->delete($id);
        session()->setFlashdata('message', 'Data Tagihan berhasil dihapus!');
        return redirect()->to('/tagihan/tagihan');
    }
    public function edit($nama)
    {
        $data = [
            'title' => 'Ubah Data Tagihan',
            'validation' => \Config\Services::validation(),
            'tagihan' => $this->tagihan->where('nama_pembayaran', $nama)->first(),
        ];

        return view('tagihan/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pembayaran harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/tagihan/edit/' . $this->request->getVar('nama_pembayaran'))->withInput();
        }

        $this->tagihan->save([
            'id_tagihan' => $id,
            'nama_pembayaran' => $this->request->getVar('nama_pembayaran'),
        ]);

        session()->setFlashdata('message', 'Data Tagihan Berhasil Di Ubah');

        return redirect()->to('/tagihan');
    }

    public function edit_rutin($nama)
    {
        $data = [
            'title' => 'Ubah Data Tagihan',
            'validation' => \Config\Services::validation(),
            'tagihan' => $this->tagihan->where('nama_pembayaran', $nama)->first(),
        ];

        return view('tagihan/edit_rutin', $data);
    }

    public function update_rutin($id)
    {
        if (!$this->validate([
            'nama_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pembayaran harus diisi!',
                ]
            ],
            'jumlah_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pembayaran harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/tagihan/edit_rutin/' . $this->request->getVar('nama_pembayaran'))->withInput();
        }

        $this->tagihan->save([
            'id_tagihan' => $id,
            'nama_pembayaran' => $this->request->getVar('nama_pembayaran'),
            'jumlah_pembayaran' => $this->request->getVar('jumlah_pembayaran'),
        ]);

        session()->setFlashdata('message', 'Data Tagihan Berhasil Di Ubah');

        return redirect()->to('/tagihan');
    }

    public function edit_regis($nama)
    {
        $data = [
            'title' => 'Ubah Data Tagihan',
            'validation' => \Config\Services::validation(),
            'tagihan' => $this->tagihan->where('nama_pembayaran', $nama)->first(),
        ];

        return view('tagihan/edit_regis', $data);
    }

    public function update_regis($id)
    {
        if (!$this->validate([
            'nama_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pembayaran harus diisi!',
                ]
            ],
            'jumlah_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pembayaran harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/tagihan/edit_regis/' . $this->request->getVar('nama_pembayaran'))->withInput();
        }

        $this->tagihan->save([
            'id_tagihan' => $id,
            'nama_pembayaran' => $this->request->getVar('nama_pembayaran'),
            'jumlah_pembayaran' => $this->request->getVar('jumlah_pembayaran'),
        ]);

        session()->setFlashdata('message', 'Data Tagihan Berhasil Di Ubah');

        return redirect()->to('/tagihan');
    }
}
