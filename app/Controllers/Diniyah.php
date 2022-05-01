<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiniyahModel;

class Diniyah extends BaseController
{
    public function __construct()
    {
        $this->model = new DiniyahModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Diniyah',
            'diniyah' => $this->model->orderBy('nama_diniyah', 'ASC')->findAll(),
        ];

        return view('diniyah/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Diniyah',
            'validation' => \Config\Services::validation(),
        ];

        return view('diniyah/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_diniyah' => [
                'rules' => 'required|is_unique[diniyah.nama_diniyah]',
                'errors' => [
                    'required' => 'Nama diniyah harus diisi!',
                    'is_unique' => 'Nama diniyah sudah terdaftar!'
                ]
            ],
        ])) {
            return redirect()->to('/diniyah/add')->withInput();
        }

        $this->model->save([
            'nama_diniyah' => $this->request->getVar('nama_diniyah'),
        ]);

        session()->setFlashdata('message', 'Data diniyah berhasil ditambahkan!');

        return redirect()->to('/diniyah');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', 'Data diniyah berhasil dihapus!');
        return redirect()->to('/diniyah');
    }

    public function edit($nama)
    {
        $data = [
            'title' => 'Ubah Data Diniyah',
            'validation' => \Config\Services::validation(),
            'diniyah' => $this->model->where('nama_diniyah', $nama)->first(),
        ];

        return view('diniyah/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_diniyah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama diniyah harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/diniyah/edit/' . $this->request->getVar('nama_diniyah'))->withInput();
        }

        $this->model->save([
            'id_diniyah' => $id,
            'nama_diniyah' => $this->request->getVar('nama_diniyah'),
        ]);

        session()->setFlashdata('message', 'Data diniyah berhasil diubah!');

        return redirect()->to('/diniyah');
    }
}
