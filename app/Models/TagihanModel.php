<?php

namespace App\Models;

use CodeIgniter\Model;

class TagihanModel extends Model
{
    protected $table = 'tagihan';
    protected $primaryKey = 'id_tagihan';
    protected $allowedFields = ['nama_pembayaran', 'jumlah_pembayaran', 'id_kelas'];

    public function getLainnya()
    {
        $tagihan = ['uang syahriyah', 'uang daftar ulang', 'uang pendaftaran'];
        return $this->db
            ->table('tagihan')
            ->select('*')
            ->whereNotIn('nama_pembayaran', $tagihan)
            ->get()->getResultArray();
    }
    public function getTagihan()
    {

        return $this->table('tagihan')
            ->select('*')
            ->groupBy('tagihan.nama_pembayaran')
            ->orderBy('id_tagihan', 'desc')
            ->get()->getResultArray();
    }
    public function Lain()
    {
        $tagihan = ['uang syahriyah', 'uang daftar ulang', 'uang pendaftaran', 'uang makan', 'uang laptop'];
        return $this->table('tagihan')
            ->select('*')
            ->whereNotIn('nama_pembayaran', $tagihan)
            ->groupBy('tagihan.nama_pembayaran')
            ->orderBy('id_tagihan', 'desc')
            ->get()->getResultArray();
    }
    public function Tagihan()
    {
        return $this->table('tagihan')
            ->select('*')
            ->join('kelas', 'tagihan.id_kelas = kelas.id_kelas')
            ->orderBy('tagihan.nama_pembayaran')
            ->orderBy('id_tagihan', 'desc')
            ->get()->getResultArray();
    }

    public function tagihan_rutin($id_tagihan)
    {
        return $this->table('tagihan')
            ->select('santri.id_santri', 'id_santri')
            ->select('santri.nama_lengkap', 'nama_lengkap')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nis', 'nis')
            ->select('tagihan.nama_pembayaran', 'nama_pembayaran')
            ->select('keuangan.id_tagihan', 'id_tagihan')
            ->select('tagihan.jumlah_pembayaran', 'jumlah_[embayaran')
            ->select("SUM(tagihan.jumlah_pembayaran) as tagihan", false)
            ->where('tagihan.id_tagihan', $id_tagihan)
            ->join('keuangan', 'keuangan.id_tagihan = tagihan.id_tagihan', 'left')
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->groupBy('santri.id_santri')
            ->get()->getResultArray();
    }

    public function getRutin($id_tagihan)
    {
        $builder = $this->table('tagihan');
        $builder->select('*');
        $builder->where('id_tagihan', $id_tagihan);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_tagihan()
    {
        $builder = $this->db->table('tagihan');
        $builder->selectSum('jumlah_pembayaran');
        $builder->where('nama_pembayaran', 'uang daftar ulang');
        $query = $builder->get();
        return $query->getRowArray();
    }
}
