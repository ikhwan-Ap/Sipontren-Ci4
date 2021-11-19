<?php

namespace App\Controllers;

use App\Models\SantriModel;

class Santri extends BaseController
{
    public function __construct()
    {
        $this->santri = new SantriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Santri',
            'santri' => $this->santri->getSantriActive(),
            'santriNon' => $this->santri->getSantriNonActive(),
        ];

        return view('santri/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Data Santri',
            'santri' => $this->santri->where('id_santri', $id)->first()
        ];

        return view('santri/detail', $data);
    }
}
