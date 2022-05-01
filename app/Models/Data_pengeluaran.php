<?php

namespace App\Models;

use CodeIgniter\Model;

class Data_pengeluaran extends Model
{
    protected $table = 'data_pengeluaran';
    protected $primaryKey = 'id_keluar';
    protected $allowedFields = ['nama_pengeluaran'];


    public function getData()
    {
        return $this->db
            ->table('data_pengeluaran')
            ->select('*')
            ->get()->getResultArray();
    }

    public function get_id_data($id_keluar)
    {
        return $this->db
            ->table('data_pengeluaran')
            ->select('*')
            ->where('id_keluar', $id_keluar)
            ->get()->getRowArray();
    }
}
