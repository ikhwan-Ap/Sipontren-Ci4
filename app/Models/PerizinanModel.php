<?php

namespace App\Models;

use CodeIgniter\Model;

class PerizinanModel extends Model
{
    protected $table            = 'perizinan';
    protected $primaryKey       = 'id_izin';
    protected $allowedFields    = ['id_santri', 'keterangan', 'tanggal_diterima', 'tanggal_ditolak', 'tanggal_izin', 'tanggal_estimasi', 'tanggal_pulang', 'user_penginput'];

    public function getIzin($id = false)
    {
        if ($id == false) {
            return $this->db->table('perizinan')->select('*')->join('santri', 'santri.id_santri = perizinan.id_santri')->get()->getResultArray();
        }

        return $this->db->table('perizinan')->select('*')->where('id_izin', $id)->join('santri', 'santri.id_santri = perizinan.id_santri')->get()->getRowArray();
    }

    public function getSantri()
    {

        $id_santri = $this->getVar('id_santri');
        return $this->db->table('perizinan')
            ->select('*')
            ->where('id_santri', $id_santri)
            ->join('santri', 'santri.id_santri = perizinan.id_santri')

            ->get()->getResultArray();
    }
}
