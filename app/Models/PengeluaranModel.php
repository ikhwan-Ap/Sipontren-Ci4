<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id_pengeluaran';
    protected $allowedFields = ['nama_pengeluaran', 'jumlah_pengeluaran', 'waktu_pengeluaran'];

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
    public function pengeluaran()
    {
        $sql = "SELECT sum(jumlah_pengeluaran) as jumlah_pengeluaran FROM pengeluaran";
        $result = $this->db->query($sql);
        return $result->getRow()->jumlah_pengeluaran;
    }
    public function getPengeluaran($tanggal)
    {
        $tgl_mulai = $tanggal['tgl_mulai'];
        $tgl_selesai = $tanggal['tgl_selesai'];
        $nama_pengeluaran = $tanggal['nama_pengeluaran'];
        return $this->db
            ->table('pengeluaran')
            ->select('*')
            ->select('pengeluaran.nama_pengeluaran')
            ->selectSum('pengeluaran.jumlah_pengeluaran')
            ->where('nama_pengeluaran', $nama_pengeluaran,)
            ->where("waktu_pengeluaran BETWEEN '$tgl_mulai' AND '$tgl_selesai'")
            ->orderBy('pengeluaran.nama_pengeluaran')
            ->orderBy('pengeluaran.jumlah_pengeluaran')
            ->get()->getResultArray();
    }
}
