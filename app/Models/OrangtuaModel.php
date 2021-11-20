<?php

namespace App\Models;

use CodeIgniter\Model;

class OrangtuaModel extends Model
{
    protected $table            = 'orangtua';
    protected $primaryKey       = 'id_orangtua';
    protected $allowedFields    = [
        'nama_ayah',
        'nama_ibu',
        'no_hp_wali',
        'penghasilan_ortu_perbulan',
        'pekerjaan_ortu',
    ];

    public function getID()
    {
        return $this->db->insertID();
    }
}
