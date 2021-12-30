<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\KelasModel;
use App\Models\AsatidzModel;
use App\Models\ProgramModel;
use App\Models\SantriModel;

class Kurikulum extends BaseController
{
    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->asatidz = new AsatidzModel();
        $this->program = new ProgramModel();
        $this->kelas = new KelasModel();
        $this->santri = new SantriModel();
    }

    public function index()
    {
        if (session()->get('role') != 1) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Kurikulum',
        ];

        return view('kurikulum/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Kurikulum',
            'validation' => \Config\Services::validation(),
            'program' => $this->program->findAll(),
            'asatidz' => $this->asatidz->findAll(),
            'kelas' => $this->kelas->findAll(),
            'santri' => $this->santri->findAll(),
        ];

        return view('kurikulum/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'program' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Program harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/kurikulum/add')->withInput();
        }
    }
}
