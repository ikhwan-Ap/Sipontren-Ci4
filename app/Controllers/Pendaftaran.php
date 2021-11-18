<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrangtuaModel;
use App\Models\SantriModel;

class Pendaftaran extends BaseController
{
    public function __construct()
    {
        $this->santri = new SantriModel();
        $this->orangtua = new OrangtuaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pendaftaran Santri Baru',
            'santri' => $this->santri->getSantri(),
        ];

        return view('pendaftaran/index', $data);
    }
}
