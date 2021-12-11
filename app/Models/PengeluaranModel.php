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
}
