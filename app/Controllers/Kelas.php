<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;

class Kelas extends BaseController
{
    public function __construct()
    {
        $this->model = new KelasModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Kelas',
            'kelas' => $this->model->findAll(),
        ];

        return view('kelas/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Kelas',
            'validation' => \Config\Services::validation(),
        ];

        return view('kelas/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_kelas' => [
                'rules' => 'required|is_unique[kelas.nama_kelas]',
                'errors' => [
                    'required' => 'Nama kelas harus diisi!',
                    'is_unique' => 'Nama kelas sudah terdaftar!'
                ]
            ],
        ])) {
            return redirect()->to('/kelas/add')->withInput();
        }

        $this->model->save([
            'nama_kelas' => $this->request->getVar('nama_kelas'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data kelas berhasil ditambahkan!
                      </div>
                    </div>');

        return redirect()->to('/kelas');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data kelas berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/kelas');
    }

    public function edit($nama)
    {
        $data = [
            'title' => 'Ubah Data Kelas',
            'validation' => \Config\Services::validation(),
            'kelas' => $this->model->where('nama_kelas', $nama)->first(),
        ];

        return view('kelas/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama kelas harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/kelas/edit/' . $this->request->getVar('nama_kelas'))->withInput();
        }

        $this->model->save([
            'id_kelas' => $id,
            'nama_kelas' => $this->request->getVar('nama_kelas'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data kelas berhasil diubah!
                      </div>
                    </div>');

        return redirect()->to('/kelas');
    }
}
