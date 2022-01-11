<?php

namespace App\Models;

use CodeIgniter\Model;

class KeuanganModel extends Model
{
    protected $table            = 'keuangan';
    protected $primaryKey       = 'id_keuangan';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id_santri',  'id_tagihan', 'waktu', 'jumlah_bayar', 'bulan', 'jumlah_tagihan', 'id_kelas', 'periode'
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
        return $this->db->table('keuangan')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nama_lengkap ', 'nama_lengkap')
            ->select('santri.id_santri ', 'id_santri')
            ->select('santri.nis ', 'nis')
            ->select('keuangan.waktu ', 'waktu')
            ->select('keuangan.periode ', 'periode')
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS jumlah_bayar', false)
            ->select('(SELECT SUM(keuangan.jumlah_tagihan)) AS jumlah_tagihan', false)
            ->select("IF(SUM(keuangan.jumlah_bayar) >= (keuangan.jumlah_tagihan),'Lunas','Belum Lunas')as status")
            ->where('tagihan.nama_pembayaran', 'uang daftar ulang')
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.jumlah_tagihan')
            ->groupBy('keuangan.jumlah_bayar')
            ->groupBy('keuangan.id_santri')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }
    public function getLain()
    {
        $tagihan = ['uang syahriyah', 'uang daftar ulang', 'uang pendaftaran', 'uang makan', 'uang laptop'];
        return $this->db->table('keuangan')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nama_lengkap ', 'nama_lengkap')
            ->select('santri.id_santri ', 'id_santri')
            ->select('santri.nis ', 'nis')
            ->select('keuangan.waktu ', 'waktu')
            ->select('keuangan.periode ', 'periode')
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS jumlah_bayar', false)
            ->select('(SELECT SUM(keuangan.jumlah_tagihan)) AS jumlah_tagihan', false)
            ->select("IF(SUM(keuangan.jumlah_bayar) >= (keuangan.jumlah_tagihan),'Lunas','Belum Lunas')as status")
            ->whereNotIn('tagihan.nama_pembayaran', $tagihan)
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.jumlah_tagihan')
            ->groupBy('keuangan.jumlah_bayar')
            ->groupBy('keuangan.id_santri')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }
    public function getLainnya()
    {
        $tagihan = ['uang laptop', 'uang makan'];
        return $this->db->table('keuangan')
            ->select('keuangan.id_keuangan')
            ->select('santri.id_santri', 'id_santri')
            ->select('santri.nama_lengkap', 'nama_lengkap')
            ->select('santri.nis', 'nis')
            ->select('keuangan.waktu ', 'waktu')
            ->select('tagihan.nama_pembayaran', 'nama_pembayaran')
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS jumlah_bayar', false)
            ->select('(SELECT SUM(tagihan.jumlah_pembayaran)) AS jumlah_tagihan', false)
            ->select("IF(SUM(keuangan.jumlah_bayar) >= SUM(tagihan.jumlah_pembayaran),'Lunas','Belum Lunas')as status")
            ->whereIn('tagihan.nama_pembayaran', $tagihan)
            ->join('santri', 'santri.id_santri=keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan=keuangan.id_tagihan')
            ->groupBy('keuangan.jumlah_bayar')
            ->groupBy('tagihan.jumlah_pembayaran')
            ->groupBy('keuangan.id_santri')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }
    public function getPendaftaran()
    {
        return $this->db->table('keuangan')->select('*')->where('nama_pembayaran', 'uang pendaftaran')
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
            ->where('nama_pembayaran', $nama_pembayaran,)
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->orderBy('keuangan.waktu')
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

    public function filter_tanggalspp($id_santri, $bln)
    {

        $pembayaran = $this->db->table('keuangan');
        $pembayaran->select('id_keuangan');
        $pembayaran->select('periode');
        $pembayaran->selectSum('jumlah_bayar');
        $pembayaran->where('id_santri', $id_santri);
        $pembayaran->where('tagihan.nama_pembayaran', 'uang syahriyah');
        $pembayaran->where("DATE_FORMAT(waktu,'%Y-%m')", $bln);
        $pembayaran->join('tagihan', 'tagihan.id_tagihan=keuangan.id_tagihan');
        return $pembayaran->get()->getResultArray();
    }
    public function filter_rutin($id_santri, $bulan, $id_tagihan)
    {

        $pembayaran = $this->db->table('keuangan');
        $pembayaran->selectSum('jumlah_bayar');
        $pembayaran->where('id_santri', $id_santri);
        $pembayaran->where('id_tagihan', $id_tagihan);
        $pembayaran->where("DATE_FORMAT(waktu,'%Y-%m')", $bulan);
        return $pembayaran->get()->getResultArray();
    }

    public function coba_spp($id_santri, $tahun)
    {
        return $this->table('keuangan')
            ->select("DATE_FORMAT(keuangan.waktu, '%Y-%m')as bulan")
            ->select('keuangan.periode', 'periode')
            ->select('id_keuangan')
            ->select('periode')
            ->select("SUM(keuangan.jumlah_bayar) as total_bayar", false)
            ->where("id_santri", $id_santri)
            ->where("YEAR(keuangan.waktu)", $tahun)
            ->where('tagihan.nama_pembayaran', 'uang syahriyah')
            ->join('tagihan', 'tagihan.id_tagihan=keuangan.id_tagihan')
            ->groupBy("DATE_FORMAT(keuangan.waktu, '%Y-%m')")
            ->groupBy('keuangan.id_keuangan', 'id_keuangan')
            ->get()->getResultArray();
    }
    public function spp_($id_santri, $tahun)
    {
        return $this->table('keuangan')
            ->select("DATE_FORMAT(keuangan.waktu, '%Y-%m')as bulan")
            ->select("SUM(keuangan.jumlah_bayar) as total_bayar", false)
            ->where("id_santri", $id_santri)
            ->where("YEAR(keuangan.waktu)", $tahun)
            ->groupBy("DATE_FORMAT(keuangan.waktu, '%Y-%m')")
            ->get()->getResultArray();
    }


    public function spp()
    {
        return $this->db->table('keuangan')
            ->select('santri.nama_lengkap ', ' nama_lengkap')
            ->select('santri.id_santri ', ' id_santri')
            ->selectSum('keuangan.jumlah_bayar ', 'pembayaran')
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->get()->getResultArray();
    }
    public function keuangan_pendaftaran()
    {
        return $this->db->table('keuangan')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nama_lengkap ', 'nama_lengkap')
            ->select('santri.id_santri ', 'id_santri')
            ->select('santri.nis ', 'nis')
            ->select('keuangan.waktu ', 'waktu')
            ->select('keuangan.periode ', 'periode')
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS jumlah_bayar', false)
            ->select('(SELECT SUM(keuangan.jumlah_tagihan)) AS jumlah_tagihan', false)
            ->select("IF(SUM(keuangan.jumlah_bayar) >= (keuangan.jumlah_tagihan),'Lunas','Belum Lunas')as status")
            ->where('tagihan.nama_pembayaran', 'uang pendaftaran')
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.jumlah_tagihan')
            ->groupBy('keuangan.jumlah_bayar')
            ->groupBy('keuangan.id_santri')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }
    public function keuangan_lain()
    {
        $tagihan = ['uang syahriyah', 'uang daftar ulang', 'uang pendaftaran', 'uang laptop', 'uang makan'];

        return $this->db->table('keuangan')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nama_lengkap ', 'nama_lengkap')
            ->select('tagihan.nama_pembayaran ', 'nama_pembayaran')
            ->select('santri.id_santri ', 'id_santri')
            ->select('santri.nis ', 'nis')
            ->select('keuangan.waktu ', 'waktu')
            ->select('keuangan.periode ', 'periode')
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS jumlah_bayar', false)
            ->select('(SELECT SUM(keuangan.jumlah_tagihan)) AS jumlah_tagihan', false)
            ->select("IF(SUM(keuangan.jumlah_bayar) >= (keuangan.jumlah_tagihan),'Lunas','Belum Lunas')as status")
            ->whereNotIn('tagihan.nama_pembayaran', $tagihan)
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.jumlah_tagihan')
            ->groupBy('keuangan.jumlah_bayar')
            ->groupBy('keuangan.id_santri')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }

    public function status_pendaftaran($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $status = $tanggal['status'];
        return $this->db->table('keuangan')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nama_lengkap ', 'nama_lengkap')
            ->select('santri.id_santri ', 'id_santri')
            ->select('santri.nis ', 'nis')
            ->select("DATE_FORMAT(keuangan.waktu,'%Y-%m-%d')as waktu")
            ->select('keuangan.periode ', 'periode')
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS jumlah_bayar', false)
            ->select('(SELECT SUM(keuangan.jumlah_tagihan)) AS jumlah_tagihan', false)
            ->where('tagihan.nama_pembayaran', 'uang pendaftaran')
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.jumlah_tagihan')
            ->groupBy('keuangan.id_santri')
            ->groupBy('keuangan.jumlah_bayar')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }
    public function status_lain($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $status = $tanggal['status'];
        $tagihan = ['uang syahriyah', 'uang daftar ulang', 'uang pendaftaran', 'uang laptop', 'uang makan'];

        return $this->db->table('keuangan')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nama_lengkap ', 'nama_lengkap')
            ->select('santri.id_santri ', 'id_santri')
            ->select('santri.nis ', 'nis')
            ->select('tagihan.nama_pembayaran ', 'nama_pembayaran')
            ->select("DATE_FORMAT(keuangan.waktu,'%Y-%m-%d')as waktu")
            ->select('keuangan.periode ', 'periode')
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS jumlah_bayar', false)
            ->select('(SELECT SUM(keuangan.jumlah_tagihan)) AS jumlah_tagihan', false)
            ->whereNotIn('tagihan.nama_pembayaran', $tagihan)
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.jumlah_tagihan')
            ->groupBy('keuangan.id_santri')
            ->groupBy('keuangan.jumlah_bayar')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }

    public function status_pendaftaranBelum($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $status = $tanggal['status'];
        return $this->db->table('keuangan')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nama_lengkap ', 'nama_lengkap')
            ->select('santri.id_santri ', 'id_santri')
            ->select('santri.nis ', 'nis')
            ->select('keuangan.waktu ', 'waktu')
            ->select('keuangan.periode ', 'periode')
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS jumlah_bayar', false)
            ->select('(SELECT SUM(keuangan.jumlah_tagihan)) AS jumlah_tagihan', false)
            ->where('tagihan.nama_pembayaran', 'uang pendaftaran')
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.jumlah_tagihan')
            ->groupBy('keuangan.id_santri')
            ->groupBy('keuangan.jumlah_bayar')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }
    public function status_lainBelum($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $status = $tanggal['status'];
        $tagihan = ['uang syahriyah', 'uang daftar ulang', 'uang pendaftaran', 'uang laptop', 'uang makan'];

        return $this->db->table('keuangan')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nama_lengkap ', 'nama_lengkap')
            ->select('santri.id_santri ', 'id_santri')
            ->select('tagihan.nama_pembayaran ', 'nama_pembayaran')
            ->select('santri.nis ', 'nis')
            ->select('keuangan.waktu ', 'waktu')
            ->select('keuangan.periode ', 'periode')
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS jumlah_bayar', false)
            ->select('(SELECT SUM(keuangan.jumlah_tagihan)) AS jumlah_tagihan', false)
            ->whereNotIn('tagihan.nama_pembayaran', $tagihan)
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.jumlah_tagihan')
            ->groupBy('keuangan.id_santri')
            ->groupBy('keuangan.jumlah_bayar')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }

    public function status_pembayaran($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $tagihan = ['uang syahriyah', 'uang daftar ulang', 'uang pendaftaran'];
        $status = $tanggal['status'];

        return $this->db->table('keuangan')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nama_lengkap ', 'nama_lengkap')
            ->select('santri.id_santri ', 'id_santri')
            ->select('santri.nis ', 'nis')
            ->select('keuangan.waktu ', 'waktu')
            ->select('tagihan.nama_pembayaran ', 'nama_pembayaran')
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS jumlah_bayar', false)
            ->select('(SELECT SUM(tagihan.jumlah_pembayaran)) AS jumlah_tagihan', false)
            ->whereNotIn('tagihan.nama_pembayaran', $tagihan)
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.jumlah_tagihan')
            ->groupBy('keuangan.id_santri')
            ->groupBy('keuangan.jumlah_bayar')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }
    public function status_pembayaranBelum($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $status = $tanggal['status'];
        $tagihan = ['uang syahriyah', 'uang daftar ulang', 'uang pendaftaran'];
        return $this->db->table('keuangan')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nama_lengkap ', 'nama_lengkap')
            ->select('santri.id_santri ', 'id_santri')
            ->select('santri.nis ', 'nis')
            ->select('keuangan.waktu ', 'waktu')
            ->select('tagihan.nama_pembayaran ', 'nama_pembayaran')
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS jumlah_bayar', false)
            ->select('(SELECT SUM(tagihan.jumlah_pembayaran)) AS jumlah_tagihan', false)
            ->whereNotIn('tagihan.nama_pembayaran', $tagihan)
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.jumlah_tagihan')
            ->groupBy('keuangan.id_santri')
            ->groupBy('keuangan.jumlah_bayar')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }

    public function status_daftar_ulang($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $status = $tanggal['status'];
        return $this->db->table('keuangan')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nama_lengkap ', 'nama_lengkap')
            ->select('santri.id_santri ', 'id_santri')
            ->select('santri.nis ', 'nis')
            ->select('keuangan.waktu ', 'waktu')
            ->select('keuangan.periode ', 'periode')
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS jumlah_bayar', false)
            ->select('(SELECT SUM(keuangan.jumlah_tagihan)) AS jumlah_tagihan', false)
            ->where('tagihan.nama_pembayaran', 'uang daftar ulang')
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.jumlah_tagihan')
            ->groupBy('keuangan.id_santri')
            ->groupBy('keuangan.jumlah_bayar')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }

    public function status_daftar_ulangBelum($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $status = $tanggal['status'];
        return $this->db->table('keuangan')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nama_lengkap ', 'nama_lengkap')
            ->select('santri.id_santri ', 'id_santri')
            ->select('santri.nis ', 'nis')
            ->select("DATE_FORMAT(keuangan.waktu,'%d-%m-%Y')as waktu")
            ->select('keuangan.periode ', 'periode')
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS jumlah_bayar', false)
            ->select('(SELECT SUM(keuangan.jumlah_tagihan)) AS jumlah_tagihan', false)
            ->where('tagihan.nama_pembayaran', 'uang daftar ulang')
            ->where("waktu BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.jumlah_tagihan')
            ->groupBy('keuangan.id_santri')
            ->groupBy('keuangan.jumlah_bayar')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }

    public function keuangan_coba()
    {
        return $this->db->table('keuangan')
            ->select('santri.id_santri', 'id_santri')
            ->select('santri.nama_lengkap', 'nama_lengkap')
            ->select('santri.nis', 'nis')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('keuangan.periode', 'periode')
            ->select("DATE_FORMAT(keuangan.waktu,'%d-%m-%Y')as bulan")
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS pembayaran', false)
            ->select('(SELECT SUM(tagihan.jumlah_pembayaran)) AS tagihan', false)
            ->select("IF(SUM(keuangan.jumlah_bayar) >= SUM(tagihan.jumlah_pembayaran),'Lunas','Belum Lunas')as status")
            ->where('tagihan.nama_pembayaran', 'uang syahriyah')
            ->join('santri', 'santri.id_santri=keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan=keuangan.id_tagihan')
            ->groupBy("DATE_FORMAT(keuangan.waktu,'%Y-%m')")
            ->groupBy('santri.id_santri')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }
    public function salah()
    {
        return $this->db->table('keuangan')

            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nama_lengkap ', 'nama_lengkap')
            ->select('santri.id_santri ', 'id_santri')
            ->select('santri.nis ', 'nis')
            ->select('keuangan.waktu ', 'waktu')
            ->select('keuangan.periode ', 'periode')
            ->select("DATE_FORMAT(keuangan.waktu,'%d-%m-%Y')as bulan")
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS pembayaran', false)
            ->select('(SELECT SUM(tagihan.jumlah_pembayaran)) AS tagihan', false)
            ->where('keuangan.id_santri', 'id_santri')
            ->join('santri', 'santri.id_santri=keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan=keuangan.id_tagihan')
            ->groupBy("DATE_FORMAT(keuangan.waktu,'%Y-%m')")
            ->groupBy('santri.id_santri')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }
    public function filterspp($id_kelas)
    {
        return $this->db->table('keuangan')
            ->select('santri.id_santri')
            ->select('santri.nama_lengkap')
            ->select('santri.nis')
            ->select("DATE_FORMAT(keuangan.waktu,'%Y-%m-%d')as bulan")
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS pembayaran', false)
            ->select('(SELECT SUM(tagihan_kelas.jumlah_pembayaran)) AS tagihan', false)
            ->select("IF(SUM(keuangan.jumlah_bayar) >= SUM(tagihan_kelas.jumlah_pembayaran),'Lunas','Belum Lunas')as status")
            ->where('tagihan.nama_pembayaran', 'uang syahriyah')
            ->where('keuangan.id_kelas', $id_kelas)
            ->join('santri', 'santri.id_santri=keuangan.id_santri')
            ->join('tagihan_kelas', 'tagihan_kelas.id_kelas=keuangan.id_kelas')
            ->join('tagihan', 'tagihan.id_tagihan=tagihan_kelas.id_tagihan')
            ->groupBy("DATE_FORMAT(keuangan.waktu,'%Y-%m')")
            ->groupBy('santri.id_santri')
            ->orderBy('keuangan.id_keuangan', 'desc')
            ->get()->getResultArray();
    }
    public function keuangna_spp()
    {
        return $this->db->table('keuangan')
            ->select('santri.id_santri')
            ->select('santri.nama_lengkap')
            ->select("DATE_FORMAT(keuangan.waktu,'%Y-%m-%d')as bulan")
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS pembayaran', false)
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS tagihan', false)
            ->select("IF(SUM(keuangan.jumlah_bayar) >= SUM(keuangan.jumlah_tagihan),'Lunas','Belum Lunas')as status")
            ->where('tagihan.nama_pembayaran', 'uang syahriyah')
            ->join('tagihan', 'tagihan.id_tagihan=keuangan.id_tagihan')
            ->join('santri', 'santri.id_santri=keuangan.id_santri')
            ->groupBy("DATE_FORMAT(keuangan.waktu,'%Y-%m')")
            ->groupBy('santri.id_santri')
            ->get()->getResultArray();
    }
    public function bayar_pendaftaran($id_keuangan)
    {
        return $this->db->table('keuangan')
            ->select('keuangan.jumlah_bayar', 'jumlah_bayar')
            ->select('keuangan.jumlah_tagihan', 'jumlah_tagihan')
            ->where('id_keuangan', $id_keuangan)
            ->get()->getResultArray();
    }
    public function bayar_daftar_ulang($id_keuangan)
    {
        return $this->db->table('keuangan')
            ->select('keuangan.jumlah_bayar', 'jumlah_bayar')
            ->select('keuangan.jumlah_tagihan', 'jumlah_tagihan')
            ->where('id_keuangan', $id_keuangan)
            ->get()->getResultArray();
    }
    public function bayar_lainnya($id_keuangan)
    {
        return $this->db->table('keuangan')
            ->select('keuangan.jumlah_bayar', 'jumlah_bayar')
            ->select('tagihan.jumlah_pembayaran', 'jumlah_pembayaran')
            ->where('id_keuangan', $id_keuangan)
            ->join('tagihan', 'tagihan.id_tagihan= keuangan.id_tagihan')
            ->get()->getResultArray();
    }

    public function bayar_kekurangan($id_keuangan)
    {
        return $this->db->table('keuangan')
            ->select('keuangan.jumlah_bayar', 'jumlah_bayar')
            ->select('tagihan.jumlah_pembayaran', 'jumlah_pembayaran')
            ->where('id_keuangan', $id_keuangan)
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->get()->getResultArray();
    }
}
