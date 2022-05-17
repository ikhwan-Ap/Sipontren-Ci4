<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\TagihanModel;

class Kelas extends BaseController
{
    public function __construct()
    {
        $this->model = new KelasModel();
        $this->tagihan = new TagihanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Kelas',
            'kelas' => $this->model->findAll(),
        ];

        return view('kelas/index', $data);
    }
    public function coba()
    {
        $data = [
            'title' => 'Data Kelas',
        ];

        return view('alumni/a', $data);
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

        session()->setFlashdata('message', 'Data Kelas Berhasil Di Tambahkan');

        return redirect()->to('/kelas');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', 'Data Kelas Berhasil Di Hapus');
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
                'rules' => "required|is_unique[kelas.nama_kelas,id_kelas,$id]",
                'errors' => [
                    'required' => 'Nama kelas harus diisi!',
                ]
            ],
            'nama_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pembayaran harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/kelas/edit/' . $this->request->getVar('nama_kelas'))->withInput();
        }
        $data = [
            'id_kelas' => $id,
            'nama_kelas' => $this->request->getVar('nama_kelas'),
            'id_tagihan' => $this->request->getVar('id_tagihan')
        ];
        $this->model->update(['id_kelas' => $id], $data);

        session()->setFlashdata('message', 'Data Kelas Berhasil Di Ubah');

        return redirect()->to('/kelas');
    }
}
