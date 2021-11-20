<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\AsatidzModel;
use App\Models\SantriModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->santriModel = new SantriModel();
        $this->adminModel = new AdminModel();
        $this->asatidzModel = new AsatidzModel();
        $this->santriModel = new SantriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'totalAdmin' => $this->adminModel->where('role', 2)->countAllResults(),
            'totalSantri' => $this->santriModel->countAllResults(),
            'totalSantriBaru' => $this->santriModel->where('status', 'Baru')->countAllResults(),
            'totalSantriAktif' => $this->santriModel->where('status', 'Aktif')->countAllResults(),
            'totalSantriNonAktif' => $this->santriModel->where('status', 'Non Aktif')->countAllResults(),
            'totalSantriAlumni' => $this->santriModel->where('status', 'Alumni')->countAllResults(),
        ];

        return view('dashboard/index', $data);
    }
    public function asatidz()
    {
        $data = [
            'title' => 'Dashboard',
            'asatidz' => $this->asatidzModel->where('username', session()->get('username'))->findAll(),
            'totalSantri' => $this->asatidzModel->where('username', session()->get('username'))->countAllResults(),
            // 'totalAdmin' => $this->asatidzModel->where('id=id')->countAllResults(),
        ];
        return view('dashboard/asatidz', $data);
    }
    public function santri()
    {
        $data = [
            'title' => 'Dashboard',
            // 'totalAdmin' => $this->asatidzModel->where('id=id')->countAllResults(),
            'santri' => $this->santriModel->where('nis', session()->get('nis'))->findAll(),

        ];
        return view('dashboard/santri', $data);
    }
}
