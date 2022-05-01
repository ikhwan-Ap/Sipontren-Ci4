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

    public function kelasSpp($id_kelas)
    {
        $builder = $this->db->table('kelas');
        $builder->select('*');
        $builder->where('kelas.id_kelas', $id_kelas);
        $builder->join('santri', 'santri.id_kelas = kelas.id_kelas');
        $builder->join('keuangan', 'keuangan.id_kelas = kelas.id_kelas');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_kelas($id)
    {
        $builder = $this->db->table('kelas');
        $builder->select('kelas.id_kelas', 'id_kelas');
        $builder->select('kelas.nama_kelas', 'nama_kelas');
        $builder->join('santri', 'santri.id_kelas = kelas.id_kelas', 'LEFT');
        $builder->join('keuangan', 'keuangan.id_kelas = kelas.id_kelas', 'LEFT OUTER');
        $builder->where('santri.id_santri', $id);
        $builder->where('keuangan.id_tagihan', '27');
        $builder->where('keuangan.id_kelas != santri.id_kelas');
        $builder->orWhere('keuangan.id_tagihan', null);
        $builder->where('santri.password IS NOT NULL', null, false);
        $builder->where('santri.deleted_at', null);
        $builder->where('santri.status', 'Aktif');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
