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
    public function coba()
    {

        $jam = [
            '1' => '07:30-10:00',
            '2' => '10:15-12:00',
            '3' => '12:30-14:00',
            '4' => '14:15-15:45',
            '5' => '16:15-17:00',
            '6' => '10:15-12:00',
        ];
        $hari = [
            '1' => 'senin',
            '2' => 'selasa',
            '3' => 'rabu',
            '4' => 'kamis',
            '5' => 'jumat',
            '6' => 'sabtu',
        ];

        for ($i = 1; $i <= 6; $i++)
            $waktu = $hari[$i];

        $menit = $jam[$i];
        $jadwal = $hari[1] . $jam[1]; {
            $penjadwalan = $jadwal[$i];
        }
        dd($penjadwalan);
    }
}
