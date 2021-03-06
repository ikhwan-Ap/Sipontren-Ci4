<?php

namespace App\Models;

use CodeIgniter\Model;

class KeuanganModel extends Model
{
    protected $table            = 'keuangan';
    protected $primaryKey       = 'id_keuangan';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id_santri',  'id_tagihan', 'waktu', 'jumlah_bayar', 'bulan', 'jumlah_tagihan', 'id_kelas', 'periode', 'ket_bayar', 'bukti'
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

    public function get_id($id_keuangan)
    {
        $builder = $this->db->table('keuangan');
        $builder->select('*');
        $builder->where('id_keuangan', $id_keuangan);
        $query = $builder->get();
        return $query->getRowArray();
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
            ->select('keuangan.ket_bayar ', 'ket_bayar')
            ->select('keuangan.bukti ', 'bukti')
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
            ->groupBy('keuangan.waktu', 'desc')
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
        $not = ['0'];
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->select('keuangan.id_tagihan')
            ->selectSum('keuangan.jumlah_bayar')
            ->whereNotIn('keuangan.jumlah_bayar', $not)
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.id_tagihan')
            ->groupBy('keuangan.waktu')
            ->get()->getResultArray();
    }

    public function total_pemasukan()
    {
        $tahun = date('Y');
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->select('keuangan.id_keuangan')
            ->selectSum('keuangan.jumlah_bayar')
            ->orderBy('keuangan.jumlah_bayar')
            ->get()->getResultArray();
    }
    public function pemasukan_tahunan()
    {
        $tahun = date('Y');
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->select('keuangan.id_keuangan')
            ->selectSum('keuangan.jumlah_bayar')
            ->where("DATE_FORMAT(waktu,'%Y')", $tahun)
            ->orderBy('keuangan.jumlah_bayar')
            ->get()->getResultArray();
    }

    public function jumlah_pemasukan()
    {
        $sql = "SELECT sum(jumlah_bayar) as jumlah_bayar FROM keuangan";
        $result = $this->db->query($sql);
        return $result->getRow()->jumlah_bayar;
    }

    public function anggaran_tahunan()
    {
        $tahun = date('Y');
        $builder = $this->db->table('keuangan');
        $builder->selectSum('jumlah_bayar', 'jumlah_bayar');
        $builder->where("DATE_FORMAT(waktu,'%Y')", $tahun);
        $query = $builder->get();
        return $query->getRow()->jumlah_bayar;
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
        $null = ['null', '0', ''];
        return $this->db
            ->table('keuangan')
            ->select('*')
            ->selectSum('keuangan.jumlah_bayar')
            ->whereNotIn('keuangan.jumlah_bayar',  $null)
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->orderBy('keuangan.id_keuangan', 'Desc')
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
        $pembayaran->select('ket_bayar');
        $pembayaran->selectSum('jumlah_bayar');
        $pembayaran->selectSum('jumlah_tagihan', 'tagihan');
        $pembayaran->where('keuangan.id_santri', $id_santri);
        $pembayaran->where('tagihan.nama_pembayaran', 'uang syahriyah');
        $pembayaran->where("DATE_FORMAT(waktu,'%Y-%m')", $bln);
        $pembayaran->join('tagihan', 'tagihan.id_tagihan=keuangan.id_tagihan');
        // $pembayaran->join('santri', 'santri.id_kelas = keuangan.id_kelas');
        $pembayaran->groupBy('jumlah_bayar');
        return $pembayaran->get()->getResultArray();
    }

    public function tagihanSpp($id_kelas)
    {
        $builder = $this->db->table('keuangan');
        $builder->select('*');
        $builder->where('tagihan.nama_pembayaran', 'uang syahriyah');
        $builder->where('santri.id_kelas', $id_kelas);
        $builder->where('santri.id_kelas = keuangan.id_kelas');
        $builder->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan');
        $builder->join('santri', 'santri.id_santri = keuangan.id_santri');
        $builder->groupBy('santri.id_santri', 'asc');
        $query = $builder->get();
        return $query->getResultArray();
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
            ->select("DATE_FORMAT(keuangan.periode, '%Y-%m')as time")
            ->select('keuangan.periode', 'periode')
            ->select('keuangan.id_keuangan')
            ->select('ket_bayar')
            ->select('keuangan.waktu', 'waktu')
            ->select('jumlah_tagihan')
            ->select('kelas.nama_kelas')
            ->select('jumlah_bayar')
            ->select("SUM(keuangan.jumlah_bayar) as total_bayar", false)
            ->where("keuangan.id_santri", $id_santri)
            ->where("YEAR(keuangan.waktu)", $tahun)
            ->where('keuangan.id_tagihan', '27')
            ->where('keuangan.id_kelas = santri.id_kelas')
            ->join('tagihan', 'tagihan.id_tagihan=keuangan.id_tagihan')
            ->join('kelas', 'kelas.id_kelas = keuangan.id_kelas')
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->groupBy("DATE_FORMAT(keuangan.waktu, '%Y-%m')")
            ->groupBy('keuangan.id_keuangan', 'id_keuangan')
            ->orderBy('id_keuangan', 'desc')
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

    public function getPeriode($id_santri)
    {
        return $this->table('keuangan')
            ->select('keuangan.periode', 'periode')
            ->where('santri.id_kelas = keuangan.id_kelas')
            ->where('keuangan.id_santri', $id_santri)
            ->where('keuangan.id_tagihan', '27')
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
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
            ->select('keuangan.ket_bayar ', 'ket_bayar')
            ->select('keuangan.bukti ', 'bukti')
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

    public function Get_pendaftaran()
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

    public function daftarUlang()
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

    public function Get_daftar()
    {
        return $this->db->table('keuangan')
            ->select('santri.id_santri ', 'id_santri')
            ->where('tagihan.nama_pembayaran', 'uang pendaftaran')
            ->where('santri.status', 'Baru')
            ->join('santri', 'santri.id_santri = keuangan.id_santri')
            ->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')
            ->groupBy('keuangan.jumlah_tagihan')
            ->groupBy('keuangan.jumlah_bayar')
            ->groupBy('keuangan.id_santri')
            ->orderBy('keuangan.waktu', 'desc')
            ->get()->getResultArray();
    }

    public function get_hasil()
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
            ->get()->getRowArray();
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
            ->select('keuangan.ket_bayar')
            ->select('keuangan.bukti')
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
        return $this->db->table('keuangan')
            ->select('keuangan.id_keuangan', 'id_keuangan')
            ->select('santri.nama_lengkap ', 'nama_lengkap')
            ->select('santri.id_santri ', 'id_santri')
            ->select('santri.nis ', 'nis')
            ->select('keuangan.waktu ', 'waktu')
            ->select('keuangan.periode ', 'periode')
            ->select('keuangan.bukti')
            ->select('keuangan.ket_bayar')
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS jumlah_bayar', false)
            ->select('(SELECT SUM(keuangan.jumlah_tagihan)) AS jumlah_tagihan', false)
            ->where('tagihan.nama_pembayaran', 'uang pendaftaran')
            ->where('jumlah_bayar', '0')
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
            ->select('keuangan.ket_bayar')
            ->select('keuangan.bukti')
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
            ->select('keuangan.ket_bayar', 'ket_bayar')
            ->select('kelas.nama_kelas', 'nama_kelas')
            ->select("DATE_FORMAT(keuangan.waktu,'%d-%m-%Y')as bulan")
            ->select('(SELECT SUM(keuangan.jumlah_bayar)) AS pembayaran', false)
            ->select('(SELECT SUM(tagihan.jumlah_pembayaran)) AS tagihan', false)
            ->select("IF(SUM(keuangan.jumlah_bayar) >= SUM(tagihan.jumlah_pembayaran),'Lunas','Belum Lunas')as status")
            ->where('tagihan.nama_pembayaran', 'uang syahriyah')
            ->join('santri', 'santri.id_santri=keuangan.id_santri')
            ->join('kelas', 'kelas.id_kelas=keuangan.id_kelas')
            ->join('tagihan', 'tagihan.id_tagihan=keuangan.id_tagihan')
            ->groupBy("DATE_FORMAT(keuangan.waktu,'%Y-%m')")
            ->groupBy('santri.id_santri')
            ->orderBy('keuangan.id_keuangan', 'desc')
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

    public function getSPP()
    {
        $builder = $this->db->table('keuangan');
        $builder->selectSum('jumlah_bayar');
        $builder->where('tagihan.nama_pembayaran', 'uang syahriyah');
        $builder->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan');
        $builder->orderBy('keuangan.id_tagihan');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getTotalPen()
    {
        $builder = $this->db->table('keuangan');
        $builder->selectSum('jumlah_bayar');
        $builder->where('tagihan.nama_pembayaran', 'uang pendaftaran');
        $builder->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan');
        $builder->orderBy('keuangan.id_tagihan');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getTotalDaf()
    {
        $builder = $this->db->table('keuangan');
        $builder->selectSum('jumlah_bayar');
        $builder->where('tagihan.nama_pembayaran', 'uang daftar ulang');
        $builder->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan');
        $builder->orderBy('keuangan.id_tagihan');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getRutin()
    {
        $rutin = ['uang makan', 'uang laptop'];
        $builder = $this->db->table('keuangan');
        $builder->selectSum('jumlah_bayar');
        $builder->whereIn('tagihan.nama_pembayaran', $rutin);
        $builder->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan');
        $builder->orderBy('keuangan.id_tagihan');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getTotalLain()
    {
        $tagihan = ['uang syahriyah', 'uang daftar ulang', 'uang pendaftaran', 'uang laptop', 'uang makan'];
        $builder = $this->db->table('keuangan');
        $builder->selectSum('jumlah_bayar');
        $builder->whereNotIn('tagihan.nama_pembayaran', $tagihan);
        $builder->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan');
        $builder->orderBy('keuangan.id_tagihan');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function addPendaftaran($data)
    {
        $query = $this->db->table('keuangan')->insert($data);

        return $this->db->insertID();
    }

    public function searchSpp($title)
    {
        $builder = $this->db->table('keuangan');
        $builder->select('*');
        $builder->like('nama_lengkap', $title);
        $builder->where('tagihan.nama_pembayaran', 'uang syahriyah');
        $builder->where('santri.id_kelas = keuangan.id_kelas');
        $builder->where('santri.deleted_at', null);
        $builder->join('santri', 'santri.id_santri = keuangan.id_santri');
        $builder->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan');
        $builder->groupBy('santri.id_santri', 'ASC');
        $builder->limit(10);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getSql($waktu, $id_santri, $id_tagihan)
    {
        $builder = $this->db->table('keuangan');
        $builder->select('id_tagihan');
        $builder->select('id_santri');
        $builder->select("DATE_FORMAT(waktu,'%Y')", $waktu);
        $builder->select("DATE_FORMAT(waktu,'%m')", $waktu);
        $builder->where('id_santri', $id_santri);
        $builder->where('id_tagihan', $id_tagihan);
        $builder->where("DATE_FORMAT(waktu,'%Y')", $waktu);
        $builder->where("DATE_FORMAT(waktu,'%m')", $waktu);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function santri($array)
    {
        $builder = $this->db->table('keuangan');
        $builder->select('*');
        $builder->where($array);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function hari_tgl($array_tgl)
    {
        $builder = $this->db->table('keuangan');
        $builder->select('*');
        $builder->where($array_tgl);
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function hapus_spp($hapus_id)
    {
        $builder = $this->db->table('keuangan');
        $builder->where($hapus_id);
        $builder->where('id_tagihan', '27');
        $builder->where('waktu', null);
        return $builder->delete();
    }

    public function get_spp($id, $id_tagihan, $id_kelas)
    {
        $builder = $this->db->table('keuangan');
        $builder->select('*');
        $builder->where('id_tagihan', $id_tagihan);
        $builder->where('id_santri', $id);
        $builder->where('id_kelas', $id_kelas);
        $query = $builder->get();
        return $query->getRowArray();
    }



    public function getBulan($waktu)
    {
        return $this->table('keuangan')
            ->where('waktu', $waktu)
            ->get()->getRowArray();
    }

    public function getKet($id_keuangan)
    {
        return $this->table('keuangan')
            ->where('id_keuangan', $id_keuangan)
            ->join('santri', 'santri.id_santri=keuangan.id_santri')
            ->get()->getRowArray();
    }

    public function add_spp($hasil)
    {
        $query = $this->db->table('keuangan')
            ->insert($hasil);
        return $query;
    }

    public function getData()
    {
        $builder = $this->db->table('keuangan');
        $builder->select('id_santri', 'id_santri');
        $builder->select('id_kelas', 'id_kelas');
        $builder->where('id_kelas IS NOT NULL', null, false);
        $builder->where('id_santri IS NOT NULL', null, false);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function get_data($id_keuangan)
    {
        $builder = $this->db->table('keuangan');
        $builder->select('*');
        $builder->where('id_keuangan', $id_keuangan);
        $builder->join('santri', 'santri.id_santri = keuangan.id_santri');
        $builder->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan');
        $query = $builder->get();
        return $query->getRowArray();
    }
}
