<?php

namespace App\Models;

use CodeIgniter\Model;

class KeuanganModel extends Model
{
    protected $table            = 'keuangan';
    protected $primaryKey       = 'id_keuangan';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id_santri',  'id_tagihan', 'status_pembayaran', 'waktu', 'jumlah_bayar', 'bulan'
    ];
    public function getSudahLunas()
    {
        $builder = $this->db->table('keuangan');
        $builder->select('*');
        $builder->where('nama_pembayaran', 'uang syahriyah');
        $builder->join('santri', 'santri.id_santri = keuangan.id_santri');
        $builder->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan');
        $builder->orderBy('waktu', 'desc');
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
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->select('keuangan.id_keuangan')
            ->selectSum('keuangan.jumlah_bayar')
            ->orderBy('keuangan.jumlah_bayar')
            ->get()->getResultArray();
    }
    public function jumlah_pemasukan()
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
            ->select('tagihan.nama_pembayaran')
            ->selectSum('keuangan.jumlah_bayar')
            ->where('status_pembayaran',  'Lunas')
            ->where('nama_pembayaran', $nama_pembayaran,)
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.waktu')
            ->get()->getResultArray();
    }
    public function Pemasukan_total($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $nama_pembayaran = $tanggal['nama_pembayaran'];
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->select('tagihan.nama_pembayaran')
            ->selectSum('keuangan.jumlah_bayar')
            ->where('status_pembayaran',  'Lunas')
            ->where('nama_pembayaran', $nama_pembayaran,)
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->orderBy('keuangan.waktu')
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
            ->groupBy('keuangan.waktu')
            ->get()->getResultArray();
    }
    public function total_laporanmasuk($tanggal)
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
            ->orderBy('keuangan.waktu')
            ->get()->getResultArray();
    }

    public function keuangan($id_santri)
    {
        return $this->db->query("SELECT 
    SUM(IF(month = 'Jan', total, 0)) AS 'Jan',
    SUM(IF(month = 'Feb', total, 0)) AS 'Feb',
    SUM(IF(month = 'Mar', total, 0)) AS 'Mar',
    SUM(IF(month = 'Apr', total, 0)) AS 'Apr',
    SUM(IF(month = 'May', total, 0)) AS 'May',
    SUM(IF(month = 'Jun', total, 0)) AS 'Jun',
    SUM(IF(month = 'Jul', total, 0)) AS 'Jul', 
    SUM(IF(month = 'Aug', total, 0)) AS 'Aug',
    SUM(IF(month = 'Sep', total, 0)) AS 'Sep',
    SUM(IF(month = 'Oct', total, 0)) AS 'Oct',
    SUM(IF(month = 'Nov', total, 0)) AS 'Nov',
    SUM(IF(month = 'Dec', total, 0)) AS 'Dec',
    SUM(total) AS total_yearly
    FROM (
    SELECT DATE_FORMAT(keuangan.waktu, '%b') AS month, SUM(keuangan.jumlah_bayar) as total
    FROM keuangan INNER JOIN santri ON santri.id_santri = keuangan.id_santri
    WHERE keuangan.id_santri = '" . $id_santri . "' AND keuangan.waktu <= NOW() and keuangan.waktu >= Date_add(Now(),interval - 12 month)
    GROUP BY DATE_FORMAT(keuangan.waktu, '%m-%Y')) as sub")->getResultArray();
    }

    public function keuangan_spp($id_santri = false)
    {
        if ($id_santri == false) {
            return $this->db->query("SELECT 
        SUM(IF(month = 'Jan', total, 0)) AS 'Jan',
        SUM(IF(month = 'Feb', total, 0)) AS 'Feb',
        SUM(IF(month = 'Mar', total, 0)) AS 'Mar',
        SUM(IF(month = 'Apr', total, 0)) AS 'Apr',
        SUM(IF(month = 'May', total, 0)) AS 'May',
        SUM(IF(month = 'Jun', total, 0)) AS 'Jun',
        SUM(IF(month = 'Jul', total, 0)) AS 'Jul', 
        SUM(IF(month = 'Aug', total, 0)) AS 'Aug',
        SUM(IF(month = 'Sep', total, 0)) AS 'Sep',
        SUM(IF(month = 'Oct', total, 0)) AS 'Oct',
        SUM(IF(month = 'Nov', total, 0)) AS 'Nov',
        SUM(IF(month = 'Dec', total, 0)) AS 'Dec',
        SUM(total) AS total_yearly
        FROM (
        SELECT DATE_FORMAT(keuangan.waktu, '%b') AS month, SUM(keuangan.jumlah_bayar) as total
        FROM keuangan INNER JOIN santri ON santri.id_santri = keuangan.id_santri 
        WHERE keuangan.waktu <= NOW() and keuangan.waktu >= Date_add(Now(),interval - 12 month)
        GROUP BY DATE_FORMAT(keuangan.waktu, '%m-%Y')) as sub")->getResultArray(); // kie langka where breati yangambil kabeh data  ksysnmr sing perlu diilangna id santrei tok wan,, iya kayane kie dim 
        }
        return $this->db->query("SELECT 
    SUM(IF(month = 'Jan', total, 0)) AS 'Jan',
    SUM(IF(month = 'Feb', total, 0)) AS 'Feb',
    SUM(IF(month = 'Mar', total, 0)) AS 'Mar', 
    SUM(IF(month = 'Apr', total, 0)) AS 'Apr',
    SUM(IF(month = 'May', total, 0)) AS 'May',
    SUM(IF(month = 'Jun', total, 0)) AS 'Jun',
    SUM(IF(month = 'Jul', total, 0)) AS 'Jul', 
    SUM(IF(month = 'Aug', total, 0)) AS 'Aug',
    SUM(IF(month = 'Sep', total, 0)) AS 'Sep',
    SUM(IF(month = 'Oct', total, 0)) AS 'Oct',
    SUM(IF(month = 'Nov', total, 0)) AS 'Nov',
    SUM(IF(month = 'Dec', total, 0)) AS 'Dec',
    SUM(total) AS total_yearly
    FROM (
    SELECT DATE_FORMAT(keuangan.waktu, '%b') AS month, SUM(keuangan.jumlah_bayar) as total
    FROM keuangan INNER JOIN santri ON santri.id_santri = keuangan.id_santri
    WHERE keuangan.id_santri = '" . $id_santri . "' AND keuangan.waktu <= NOW() and keuangan.waktu >= Date_add(Now(),interval - 12 month)
    GROUP BY DATE_FORMAT(keuangan.waktu, '%m-%Y')) as sub")->getRowArray();
    }

    public function keuangan_pendaftaran()
    {

        return $this->db->table('keuangan')
            ->select('santri.nama_lengkap', 'nama_lengkap')
            ->select('santri.id_santri', 'id_santri')
            ->select('santri.nis', 'nis')
            ->selectSum('keuangan.jumlah_bayar')
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->groupBy('keuangan.waktu', 'sub')
            ->get()->getResultArray();
    }
}
