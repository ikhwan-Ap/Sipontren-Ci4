<?php

namespace App\Controllers;

use App\Models\SantriModel;

class Alumni extends BaseController
{
    public function __construct()
    {
        $this->santri = new SantriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Alumni',
            'alumni' => $this->santri->getSantriAlumni(),
        ];

        return view('alumni/index', $data);
    }
}
