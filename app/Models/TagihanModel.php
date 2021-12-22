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
        return $this->db
            ->table('tagihan')
            ->select('*')
            ->join('kelas', 'kelas.id_kelas = tagihan.id_kelas')
            ->get()->getResultArray();
    }
}
