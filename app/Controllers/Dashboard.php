<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\AsatidzModel;
use App\Models\ProgramModel;
use App\Models\SantriModel;
use App\Models\KeuanganModel;
use App\Models\PengeluaranModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->santriModel = new SantriModel();
        $this->adminModel = new AdminModel();
        $this->asatidzModel = new AsatidzModel();
        $this->santriModel = new SantriModel();
        $this->programModel = new ProgramModel();
        $this->model = new KeuanganModel();
        $this->keluar = new PengeluaranModel();
    }

    public function index()
    {

        if (session('nis')) {
            return redirect()->to('dashboard/santri');
        }
        if (session('role') == 3) {
            return redirect()->to('perizinan/keamanan');
        }
        $status = ['Aktif', 'Non Aktif'];

        $data = [
            'title' => 'Dashboard',
            'totalAdmin' => $this->adminModel->where('role', 2)->countAllResults(),
            'totalAsatidz' => $this->asatidzModel->countAllResults(),
            'totalSantri' => $this->santriModel->whereIn('status', $status)->countAllResults(),
            'totalProgram' => $this->santriModel->countAllResults(),
            'totalSantriBaru' => $this->santriModel->where('status', 'Baru')->countAllResults(),
            'totalSantriAktif' => $this->santriModel->where('status', 'Aktif')->countAllResults(),
            'totalSantriNonAktif' => $this->santriModel->where('status', 'Non Aktif')->countAllResults(),
            'totalSantriAlumni' => $this->santriModel->where('status', 'Alumni')->countAllResults(),
            'totalPembayaranSPP' => $this->model->getSPP(),
            'totalPendaftaran' => $this->model->getTotalPen(),
            'totalDaftar' => $this->model->getTotalDaf(),
            'totalRutin' => $this->model->getRutin(),
            'lain' => $this->model->getTotalLain(),
            'kegiatanA' => $this->keluar->totalKegA(),
            'kegiatanB' => $this->keluar->totalKegB(),
            'kegiatanC' => $this->keluar->totalKegC(),
            'kegiatanD' => $this->keluar->totalKegD(),
            'kegiatanLain' => $this->keluar->totalKegLain(),
            'jumlah_keluar' => $this->keluar->pengeluaran_tahunan(),
            'jumlah_masuk' => $this->model->anggaran_tahunan(),
            'total_pemasukan' => $this->model->pemasukan_tahunan(),
            'total_pengeluaran' => $this->keluar->total_pengeluaranTahunan()
        ];

        return view('dashboard/index', $data);
    }
    public function asatidz()
    {
        $data = [
            'title' => 'Dashboard Asatidz',
            'asatidz' => $this->asatidzModel->where('username', session()->get('username'))->findAll(),
            'totalSantri' => $this->asatidzModel->where('username', session()->get('username'))->countAllResults(),
            // 'totalAdmin' => $this->asatidzModel->where('id=id')->countAllResults(),
        ];
        return view('dashboard/asatidz', $data);
    }
    public function santri()
    {
        $data = [
            'title' => 'Dashboard Santri',
            // 'totalAdmin' => $this->asatidzModel->where('id=id')->countAllResults(),
            'santri' => $this->santriModel->where('nis', session()->get('nis'))->findAll(),

        ];
        return view('dashboard/santri', $data);
    }
}
