<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'totalAdmin' => $this->adminModel->where('role', 2)->countAllResults(),
        ];

        return view('dashboard/index', $data);
    }
}
