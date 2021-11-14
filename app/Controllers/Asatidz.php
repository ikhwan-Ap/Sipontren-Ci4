<?php

namespace App\Controllers;

use App\Models\AsatidzModel;

class Asatidz extends BaseController
{
    public function __construct()
    {
        $this->model = new AsatidzModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Asatidz',
            'asatidz' => $this->model->where('id = id')->findAll(),
            // 'admin' => $this->model->where('role', 2)->findAll(),
        ];

        return view('admin/index', $data);
    }
}
