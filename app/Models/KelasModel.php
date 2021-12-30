<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $allowedFields = ['nama_kelas'];

    public function kelas_spp($id_kelas)
    {
        return  $this->db->table('kelas')
            ->select("santri.id_santri as id_santri")
            ->select("santri.nama_lengkap as nama_lengkap")
            ->select("kelas.nama_kelas as nama_kelas")
            ->select('(SELECT SUM(tagihan.jumlah_pembayaran)) AS tagihan', false)
            ->where('kelas.id_kelas', $id_kelas)
            ->join('santri', 'santri.id_kelas=kelas.id_kelas', 'left')
            ->join('tagihan', 'tagihan.id_kelas=kelas.id_kelas')
            ->orderBy('santri.nama_santri', 'desc')
            ->get()->getResultArray();
    }
}
