<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\AsatidzModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->asatidzModel = new AsatidzModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'totalAdmin' => $this->adminModel->where('role', 2)->countAllResults(),
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
        ];
        return view('dashboard/santri', $data);
    }
}
