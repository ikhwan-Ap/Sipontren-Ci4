<?php

namespace App\Models;

use CodeIgniter\Model;

class OrangtuaModel extends Model
{
    protected $table            = 'orangtua';
    protected $primaryKey       = 'id_orangtua';
    protected $useSoftDeletes = true;
    protected $allowedFields    = [
        'nama_ayah',
        'nama_ibu',
        'no_hp_wali',
        'penghasilan_ortu_perbulan',
        'pekerjaan_ortu',
    ];
    protected $deletedField  = 'deleted_at';

    public function getID()
    {
        return $this->db->insertID();
    }

    public function add($excel)
    {
        $this->db->table('orangtua')->insert($excel);
    }

    public function get($excel)
    {
        return $this->db->insertID($excel);
    }

    public function Get_id($excel)
    {
        return $this->table('orangtua')
            ->where('id_orangtua', $excel)
            ->get()->getRowArray();
    }
}
