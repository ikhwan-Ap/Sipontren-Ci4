<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->model = new AdminModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Admin',
            'admin' => $this->model->where('role', 2)->findAll(),
        ];

        return view('admin/index', $data);
    }
}
