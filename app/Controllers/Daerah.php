<?php

namespace App\Controllers;

use App\Models\WilayahModel;
use App\Models\RegenciesModel;
use App\Models\DistrictsModel;
use App\Models\VillagesModel;


class Daerah extends BaseController
{
    public function __construct()
    {
        $this->provinsi = new WilayahModel();
        $this->kabupaten = new RegenciesModel();
        $this->kecamatan = new DistrictsModel();
        $this->desa = new VillagesModel();
    }

    public function index()
    {
        $data['provinsi'] = $this->provinsi->get_provinsi();
        return view('/register', $data);
    }

    //request data kabupaten berdasarkan id provinsi yang dipilih
    public  function Get_kabupaten($provinsi_id)
    {

        if ($provinsi_id != '') {
            echo $this->kabupaten->get_kabupaten($provinsi_id);
        }
    }
    //request data kecamatan berdasarkan id kabupaten yang dipilih
    public  function Get_kecamatan($kabupaten_id)
    {
        if ($this->request->isAJAX()) {

            if ($kabupaten_id != '') {
                echo $this->kecamatan->get_kecamatan($kabupaten_id);
            }
        }
    }

    //request data desa berdasarkan id kecamatan yang dipilih
    public function Get_desa($kecamatan_id)
    {
        if ($this->request->isAJAX()) {

            if ($kecamatan_id != '') {
                echo $this->desa->get_desa($kecamatan_id);
            }
        }
    }
}
