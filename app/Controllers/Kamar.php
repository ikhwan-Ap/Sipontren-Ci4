<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KamarModel;

class Kamar extends BaseController
{
    public function __construct()
    {
        $this->model = new KamarModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Kamar',
            'kamar' => $this->model->findAll(),
        ];

        return view('kamar/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Kamar',
            'validation' => \Config\Services::validation(),
        ];

        return view('kamar/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_kamar' => [
                'rules' => 'required|is_unique[kamar.nama_kamar]',
                'errors' => [
                    'required' => 'Nama kamar harus diisi!',
                    'is_unique' => 'Nama kamar sudah terdaftar!'
                ]
            ],
        ])) {
            return redirect()->to('/kamar/add')->withInput();
        }

        $this->model->save([
            'nama_kamar' => $this->request->getVar('nama_kamar'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data kamar berhasil ditambahkan!
                      </div>
                    </div>');

        return redirect()->to('/kamar');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data kamar berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/kamar');
    }

    public function edit($nama)
    {
        $data = [
            'title' => 'Ubah Data Kamar',
            'validation' => \Config\Services::validation(),
            'kamar' => $this->model->where('nama_kamar', $nama)->first(),
        ];

        return view('kamar/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_kamar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kamar harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/kamar/edit/' . $this->request->getVar('nama_kamar'))->withInput();
        }

        $this->model->save([
            'id_kamar' => $id,
            'nama_kamar' => $this->request->getVar('nama_kamar'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data kamar berhasil diubah!
                      </div>
                    </div>');

        return redirect()->to('/kamar');
    }
}
