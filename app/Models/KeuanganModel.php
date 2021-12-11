<?php

namespace App\Models;

use CodeIgniter\Model;

class KeuanganModel extends Model
{
    protected $table            = 'keuangan';
    protected $primaryKey       = 'id_keuangan';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id_santri',  'id_tagihan', 'status_pembayaran', 'waktu', 'jumlah_bayar'
    ];
    public function getSudahLunas()
    {
        $builder = $this->db->table('keuangan');
        $builder->select('*');
        $builder->where('nama_pembayaran', 'uang syahriyah');
        $builder->join('santri', 'santri.id_santri = keuangan.id_santri');
        $builder->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getBelumLunas()
    {
        return $this->db->table('keuangan')->select('*')->where('status_pembayaran', 'Belum Lunas')
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->get()->getResultArray();
    }
    public function getKeuangan($id = false)
    {
        if ($id == false) {
            return $this->db->table('keuangan')->select('*')
                ->join('santri', 'santri.id_santri = keuangan.id_santri')
                ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
                ->get()->getResultArray();
        }
        return $this->db->table('keuangan')->select('*')->where('id_keuangan', $id)
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->get()->getRowArray();
    }
    public function getDaftarUlang()
    {
        return $this->db->table('keuangan')->select('*')->where('nama_pembayaran', 'uang daftar ulang')
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->get()->getResultArray();
    }
    public function getPendaftaran()
    {
        return $this->db->table('keuangan')->select('*')->where('nama_pembayaran', 'uang pendaftaran')
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->get()->getResultArray();
    }
    public function getLainnya()
    {
        $tagihan = ['uang syahriyah', 'uang daftar ulang', 'uang pendaftaran'];
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->whereNotIn('nama_pembayaran', $tagihan)
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->get()->getResultArray();
    }

    public function pendapatan()
    {
        return $this->db
            ->table('keuangan')
            ->select('keuangan.id_keuangan')
            ->select('keuangan.waktu')
            ->select('keuangan.id_tagihan')
            ->select('tagihan.nama_pembayaran')
            ->selectSum('keuangan.jumlah_bayar')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.id_tagihan')
            ->groupBy('keuangan.waktu')
            ->get()->getResultArray();
    }
    public function total_pemasukan()
    {
        $sql = "SELECT sum(jumlah_bayar) as jumlah_bayar FROM keuangan";
        $result = $this->db->query($sql);
        return $result->getRow()->jumlah_bayar;
    }
}
