<?php

namespace App\Models;

use CodeIgniter\Model;

class AsatidzModel extends Model
{
    protected $table            = 'asatidz';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'username', 'email', 'password', 'alamat', 'jenis_kelamin',
        'nik_ktp', 'no_kk', 'nama_lengkap', 'tempat_lahir', 'program',
        'jadwal', 'kelas', 'pendidikan', 'foto', 'pertemuan', 'no_hp', 'total_santri', 'tanggal_lahir'
    ];



    public function getLogin($username)
    {
        return $this->db->table($this->table)->getWhere(['username' => $username])->getRowArray();
    }
}
