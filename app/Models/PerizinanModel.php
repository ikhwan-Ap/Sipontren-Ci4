<?php

namespace App\Models;

use App\Controllers\Perizinan;
use CodeIgniter\Model;

class PerizinanModel extends Model
{
    protected $table            = 'perizinan';
    protected $primaryKey       = 'id_izin';
    protected $allowedFields    =
    [
        'id_santri', 'keterangan', 'tanggal_diterima', 'tanggal_ditolak', 'tanggal_izin', 'tanggal_estimasi',
        'tanggal_pulang', 'ket_terlambat', 'user_update', 'user_penginput'
    ];

    public function getIzin($id = false)
    {
        if ($id == false) {
            return $this->db->table('perizinan')->select('*')
                ->join('santri', 'santri.id_santri = perizinan.id_santri')

                ->orderBy('tanggal_pulang', 'desc')
                ->get()->getResultArray();
        }

        return $this->db->table('perizinan')->select('*')->where('id_izin', $id)
            ->join('santri', 'santri.id_santri = perizinan.id_santri')

            ->get()->getRowArray();
    }

    public function get_perizinan()
    {
    }

    public function perizinan_add($data)
    {

        $query = $this->db->table('perizinan')->insert($data);
        return $this->db->$query;
    }

    public function getKeamanan($id = false)
    {
        if ($id == false) {
            return $this->db->table('perizinan')
                ->select('*')
                ->where('tanggal_ditolak', null)
                ->where('tanggal_pulang', null)
                ->join('santri', 'santri.id_santri = perizinan.id_santri')
                ->orderBy('id_izin', 'desc')
                ->get()->getResultArray();
        }
        return $this->db
            ->table('perizinan')
            ->select('*')
            ->where('id_izin', $id)
            ->join('santri', 'santri.id_santri = perizinan.id_santri')

            ->get()->getRowArray();
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

    public function get_id($id_izin)
    {
        $builder = $this->db->table('perizinan');
        $builder->select('*');
        $builder->where('id_izin', $id_izin);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
