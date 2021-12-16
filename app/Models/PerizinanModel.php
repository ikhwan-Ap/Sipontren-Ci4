<?php

namespace App\Models;

use CodeIgniter\Model;

class PerizinanModel extends Model
{
    protected $table            = 'perizinan';
    protected $primaryKey       = 'id_izin';
    protected $allowedFields    = ['id_santri', 'keterangan', 'tanggal_terima', 'tanggal_kembali', 'status_izin'];

    public function getIzin($id = false)
    {
        if ($id == false) {
            return $this->db->table('perizinan')->select('*')->join('santri', 'santri.id_santri = perizinan.id_santri')->get()->getResultArray();
        }

        return $this->db->table('perizinan')->select('*')->where('id_izin', $id)->join('santri', 'santri.id_santri = perizinan.id_santri')->get()->getRowArray();
    }
}
