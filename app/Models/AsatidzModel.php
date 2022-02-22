<?php

namespace App\Models;

use CodeIgniter\Model;

class AsatidzModel extends Model
{
    protected $table            = 'asatidz';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'username', 'email', 'password', 'alamat', 'jenis_kelamin',
        'nik_ktp', 'no_kk', 'nama_lengkap', 'tempat_lahir', 'id_program',
        'id_kelas', 'pendidikan', 'no_hp', 'tanggal_lahir'
    ];



    public function getLogin($username)
    {
        return $this->db->table($this->table)->getWhere(['username' => $username])->getRowArray();
    }
    public function edit($id)
    {
        return $this->db
            ->table('asatidz')
            ->select('*')
            ->where('asatidz.id', $id)
            ->join('program', 'program.id_program=asatidz.id_program')
            ->join('kelas', 'kelas.id_kelas=asatidz.id_kelas')
            ->get()->getRowArray();
    }
}
