<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GedungModel;

class Gedung extends BaseController
{
    public function __construct()
    {
        $this->model = new GedungModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Gedung',
            'gedung' => $this->model->findAll(),
        ];

        return view('gedung/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Gedung',
            'validation' => \Config\Services::validation(),
        ];

        return view('gedung/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_gedung' => [
                'rules' => 'required|is_unique[gedung.nama_gedung]',
                'errors' => [
                    'required' => 'Nama gedung harus diisi!',
                    'is_unique' => 'Nama gedung sudah terdaftar!'
                ]
            ],
        ])) {
            return redirect()->to('/gedung/add')->withInput();
        }

        $this->model->save([
            'nama_gedung' => $this->request->getVar('nama_gedung'),
        ]);

        session()->setFlashdata('message', 'Data Gedung Berhasil Di Tambahkan');

        return redirect()->to('/gedung');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', 'Data Gedung Berhasil Di Hapus');
        return redirect()->to('/gedung');
    }

    public function edit($nama)
    {
        $data = [
            'title' => 'Ubah Data Gedung',
            'validation' => \Config\Services::validation(),
            'gedung' => $this->model->where('nama_gedung', $nama)->first(),
        ];

        return view('gedung/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_gedung' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama program harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/program/edit/' . $this->request->getVar('nama_gedung'))->withInput();
        }

        $this->model->save([
            'id_gedung' => $id,
            'nama_gedung' => $this->request->getVar('nama_gedung'),
        ]);

        session()->setFlashdata('message', 'Data Gedung Berhasil Di Ubah');

        return redirect()->to('/gedung');
    }
}
