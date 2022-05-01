<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id_pengeluaran';
    protected $allowedFields = ['id_keluar', 'jumlah_pengeluaran', 'waktu_pengeluaran'];

    public function total_pengeluaran()
    {
        return $this->db
            ->table('pengeluaran')
            ->select('*')
            ->select('pengeluaran.id_pengeluaran')
            ->selectSum('pengeluaran.jumlah_pengeluaran')
            ->orderBy('pengeluaran.jumlah_pengeluaran')
            ->get()->getResultArray();
    }

    public function total_pengeluaranTahunan()
    {
        $tahun = date('Y');
        return $this->db
            ->table('pengeluaran')
            ->select('*')
            ->select('pengeluaran.id_pengeluaran')
            ->selectSum('pengeluaran.jumlah_pengeluaran')
            ->where("DATE_FORMAT(waktu_pengeluaran,'%Y')", $tahun)
            ->orderBy('pengeluaran.jumlah_pengeluaran')
            ->get()->getResultArray();
    }


    public function pengeluaran()
    {
        $sql = "SELECT sum(jumlah_pengeluaran) as jumlah_pengeluaran FROM pengeluaran";
        $result = $this->db->query($sql);
        return $result->getRow()->jumlah_pengeluaran;
    }

    public function pengeluaran_tahunan()
    {
        $tahun = date('Y');
        $builder = $this->db->table('pengeluaran');
        $builder->selectSum('jumlah_pengeluaran', 'jumlah_pengeluaran');
        $builder->where("DATE_FORMAT(waktu_pengeluaran,'%Y')", $tahun);
        $query = $builder->get();
        return $query->getRow()->jumlah_pengeluaran;
    }

    public function getPengeluaran($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $nama_pengeluaran = $tanggal['nama_pengeluaran'];
        return $this->db
            ->table('pengeluaran')
            ->select('*')
            ->select('pengeluaran.id_keluar')
            ->select('data_pengeluaran.nama_pengeluaran')
            ->selectSum('pengeluaran.jumlah_pengeluaran')
            ->where('nama_pengeluaran', $nama_pengeluaran,)
            ->where("waktu_pengeluaran BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('data_pengeluaran', 'data_pengeluaran.id_keluar = pengeluaran.id_keluar')
            ->groupBy('pengeluaran.waktu_pengeluaran')
            ->orderBy('data_pengeluaran.nama_pengeluaran')
            ->get()->getResultArray();
    }
    public function pengeluaran_total($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $nama_pengeluaran = $tanggal['nama_pengeluaran'];
        return $this->db
            ->table('pengeluaran')
            ->select('*')
            ->select('pengeluaran.id_keluar')
            ->select('data_pengeluaran.nama_pengeluaran')
            ->selectSum('pengeluaran.jumlah_pengeluaran')
            ->where('nama_pengeluaran', $nama_pengeluaran,)
            ->where("waktu_pengeluaran BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->join('data_pengeluaran', 'data_pengeluaran.id_keluar = pengeluaran.id_keluar')
            ->orderBy('data_pengeluaran.nama_pengeluaran')
            ->orderBy('pengeluaran.jumlah_pengeluaran')
            ->get()->getResultArray();
    }
    public function getPengeluaran_baru()
    {
        return $this->db
            ->table('pengeluaran')
            ->select('*')
            ->join('data_pengeluaran', 'data_pengeluaran.id_keluar = pengeluaran.id_keluar')
            ->orderBy('pengeluaran.id_pengeluaran', 'Desc')
            ->get()->getResultArray();
    }

    public function totalKegA()
    {
        $builder = $this->db->table('pengeluaran');
        $builder->selectSum('jumlah_pengeluaran');
        $builder->where('data_pengeluaran.nama_pengeluaran', 'uang Kegiatan A');
        $builder->join('data_pengeluaran', 'data_pengeluaran.id_keluar = pengeluaran.id_keluar');
        $builder->orderBy('pengeluaran.id_keluar');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function totalKegB()
    {
        $builder = $this->db->table('pengeluaran');
        $builder->selectSum('jumlah_pengeluaran');
        $builder->where('data_pengeluaran.nama_pengeluaran', 'uang Kegiatan B');
        $builder->join('data_pengeluaran', 'data_pengeluaran.id_keluar = pengeluaran.id_keluar');
        $builder->orderBy('pengeluaran.id_keluar');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function totalKegC()
    {
        $builder = $this->db->table('pengeluaran');
        $builder->selectSum('jumlah_pengeluaran');
        $builder->where('data_pengeluaran.nama_pengeluaran', 'uang Kegiatan C');
        $builder->join('data_pengeluaran', 'data_pengeluaran.id_keluar = pengeluaran.id_keluar');
        $builder->orderBy('pengeluaran.id_keluar');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function totalKegD()
    {
        $builder = $this->db->table('pengeluaran');
        $builder->selectSum('jumlah_pengeluaran');
        $builder->where('data_pengeluaran.nama_pengeluaran', 'uang Kegiatan D');
        $builder->join('data_pengeluaran', 'data_pengeluaran.id_keluar = pengeluaran.id_keluar');
        $builder->orderBy('pengeluaran.id_keluar');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function totalKegLain()
    {
        $lain = ['uang Kegiatan A', 'uang Kegiatan B', 'uang Kegiatan C', 'uang Kegiatan D'];
        $builder = $this->db->table('pengeluaran');
        $builder->selectSum('jumlah_pengeluaran');
        $builder->whereNotIn('data_pengeluaran.nama_pengeluaran', $lain);
        $builder->join('data_pengeluaran', 'data_pengeluaran.id_keluar = pengeluaran.id_keluar');
        $builder->orderBy('pengeluaran.id_keluar');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
