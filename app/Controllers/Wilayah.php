<?php

use CodeIgniter\RESTful\ResourceController;
use App\Models\WilayahModel;


class Wilayah extends ResourceController
{
    public function __construct()
    {
        $this->wilayah = new WilayahModel();
    }

    public function index()
    {
        $data['provinsi'] = $this->wilayah->get_provinsi();
        return view('/register', $data);
    }

    //request data kabupaten berdasarkan id provinsi yang dipilih
    public  function get_kabupaten()
    {
        if ($this->request->getVar('provinsi_id')) {
            echo $this->wilayah->get_kabupaten($this->request->getVar('provinsi_id'));
        }
    }

    //request data kecamatan berdasarkan id kabupaten yang dipilih
    public  function get_kecamatan()
    {
        if ($this->request->getVar('kabupaten_id')) {
            echo $this->wilayah->get_kecamatan($this->request->getVar('kabupaten_id'));
        }
    }

    //request data desa berdasarkan id kecamatan yang dipilih
    public function get_desa()
    {
        if ($this->request->getVar('kecamatan_id')) {
            echo $this->wilayah->get_desa($this->request->getVar('kecamatan_id'));
        }
    }
}
