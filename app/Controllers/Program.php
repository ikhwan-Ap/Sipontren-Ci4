<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProgramModel;

class Program extends BaseController
{
    public function __construct()
    {
        $this->model = new ProgramModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Program',
            'program' => $this->model->findAll(),
        ];

        return view('program/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Program',
            'validation' => \Config\Services::validation(),
        ];

        return view('program/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_program' => [
                'rules' => 'required|is_unique[program.nama_program]',
                'errors' => [
                    'required' => 'Nama program harus diisi!',
                    'is_unique' => 'Nama program sudah terdaftar!'
                ]
            ],
        ])) {
            return redirect()->to('/program/add')->withInput();
        }
        $this->model->save(['nama_program' => $this->request->getVar('nama_program'),]);

        session()->setFlashdata('message', 'Data Program Berhasil Di tambahkan');

        return redirect()->to('/program');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', 'Data Program Berhasil Di Hapus');
        return redirect()->to('/program');
    }

    public function edit($nama)
    {
        $data = [
            'title' => 'Ubah Data Program',
            'validation' => \Config\Services::validation(),
            'program' => $this->model->where('nama_program', $nama)->first(),
        ];

        return view('program/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_program' => [
                'rules' => "required|is_unique[program.nama_program,id_program,$id]",
                'errors' => ['required' => 'Nama program harus diisi!',]
            ],
        ])) {
            return redirect()->to('/program/edit/' . $this->request->getVar('nama_program'))->withInput();
        }

        $this->model->update(['id_program' => $id], ['nama_program' => $this->request->getVar('nama_program'),]);

        session()->setFlashdata('message', 'Data Program Berhasil Di Ubah');

        return redirect()->to('/program');
    }
}
