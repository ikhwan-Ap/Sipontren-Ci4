<?php

namespace App\Controllers;


class Santri extends BaseController
{

    public function index()
    {

        $data = [
            'title' => 'santri',

            // 'admin' => $this->model->where('role', 2)->findAll(),
        ];

        return view('santri/index', $data);
    }
}
