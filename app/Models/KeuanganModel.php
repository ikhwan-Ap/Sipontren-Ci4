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
        return $this->db->table('keuangan')->select('*')
            ->where('status_pembayaran', 'Belum Lunas')
            ->where('nama_pembayaran', 'uang syahriyah')
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
            ->select('*')
            ->select('keuangan.id_tagihan')
            ->where('status_pembayaran', 'Lunas')
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
    public function getSudahLunasFilter($tanggal)
    {

        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];

        $status_pembayaran = $tanggal['status_pembayaran'];
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->where('status_pembayaran', $status_pembayaran, 'Lunas')
            ->where('nama_pembayaran', 'uang syahriyah')
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->get()->getResultArray();
    }
    public function getLunasFilter($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $status_pembayaran = $tanggal['status_pembayaran'];
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->where('status_pembayaran',  $status_pembayaran, 'Belum Lunas')
            ->where('nama_pembayaran', 'uang syahriyah')
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->get()->getResultArray();
    }
    public function getPendaftaranLunas($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $status_pembayaran = $tanggal['status_pembayaran'];
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->where('status_pembayaran',  $status_pembayaran, 'Lunas')
            ->where('nama_pembayaran', 'uang pendaftaran')
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->get()->getResultArray();
    }
    public function getPendaftaranBelumLunas($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $status_pembayaran = $tanggal['status_pembayaran'];
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->where('status_pembayaran',  $status_pembayaran, 'Belum Lunas')
            ->where('nama_pembayaran', 'uang pendaftaran')
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->get()->getResultArray();
    }
    public function getDaftarUlangLunas($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $status_pembayaran = $tanggal['status_pembayaran'];
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->where('status_pembayaran',  $status_pembayaran, 'Lunas')
            ->where('nama_pembayaran', 'uang daftar ulang')
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->get()->getResultArray();
    }
    public function getDaftarUlangBelumLunas($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $status_pembayaran = $tanggal['status_pembayaran'];
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->where('status_pembayaran',  $status_pembayaran, 'Belum Lunas')
            ->where('nama_pembayaran', 'uang daftar ulang')
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->get()->getResultArray();
    }
    public function getLainnyaLunas($tanggal)
    {
        $tagihan = ['uang syahriyah', 'uang daftar ulang', 'uang pendaftaran'];
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $status_pembayaran = $tanggal['status_pembayaran'];
        $nama_pembayaran = $tanggal['nama_pembayaran'];
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->whereNotIn('nama_pembayaran', $tagihan)
            ->where('nama_pembayaran', $nama_pembayaran)
            ->where('status_pembayaran',  $status_pembayaran, 'Lunas')
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->get()->getResultArray();
    }
    public function getLainnyaBelumLunas($tanggal)
    {

        $tagihan = ['uang syahriyah', 'uang daftar ulang', 'uang pendaftaran'];
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $status_pembayaran = $tanggal['status_pembayaran'];
        $nama_pembayaran = $tanggal['nama_pembayaran'];
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->where('status_pembayaran',  $status_pembayaran, 'Belum Lunas')
            ->whereNotIn('nama_pembayaran', $tagihan)
            ->where('nama_pembayaran', $nama_pembayaran)
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->get()->getResultArray();
    }

    public function getPemasukan($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $nama_pembayaran = $tanggal['nama_pembayaran'];
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->select('keuangan.id_tagihan')
            ->select('tagihan.nama_pembayaran')
            ->selectSum('keuangan.jumlah_bayar')
            ->where('status_pembayaran',  'Lunas')
            ->where('nama_pembayaran', $nama_pembayaran,)
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.id_tagihan')
            ->groupBy('keuangan.waktu')
            ->groupBy('tagihan.nama_pembayaran')
            ->groupBy('keuangan.jumlah_bayar')
            ->get()->getResultArray();
    }

    public function pemasukan()
    {
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->selectSum('keuangan.jumlah_bayar')
            ->where('status_pembayaran',  'Lunas')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->groupBy('keuangan.id_tagihan')
            ->groupBy('keuangan.waktu')
            ->groupBy('keuangan.id_santri')
            ->get()->getResultArray();
    }
    public function laporanmasuk($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $nama_pembayaran = $tanggal['nama_pembayaran'];
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->selectSum('keuangan.jumlah_bayar')
            ->where('status_pembayaran',  'Lunas')
            ->where('nama_pembayaran', $nama_pembayaran,)
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->groupBy('keuangan.id_tagihan')
            ->groupBy('keuangan.waktu')
            ->groupBy('keuangan.id_santri')
            ->groupBy('keuangan.jumlah_bayar')
            ->get()->getResultArray();
    }
}
