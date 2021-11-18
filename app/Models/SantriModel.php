<?php

namespace App\Models;

use CodeIgniter\Model;

<<<<<<< HEAD
class AsatidzModel extends Model
{
    protected $table            = 'asatidz';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'username', 'email', 'password', 'alamat', 'jenis_kelamin',
        'nik_ktp', 'no_kk', 'nama_lengkap', 'tempat_lahir', 'program',
        'jadwal', 'kelas', 'pendidikan', 'foto'
    ];



    public function getLogin($username)
    {
        return $this->db->table($this->table)->getWhere(['username' => $username])->getRowArray();
=======
class SantriModel extends Model
{
    protected $table            = 'santri';
    protected $primaryKey       = 'id_santri';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nis', 'password', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir',
        'alamat', 'desa_kelurahan', 'kecamatan', 'kabupaten', 'provinsi',
        'no_hp_santri', 'id_kamar', 'id_diniyah', 'id_program', 'catatan_medis',
        'pendidikan_terakhir', 'pengalaman_mondok', 'pendidikan_sekarang', 'gol_darah',
        'nama_almet', 'kelas_semester', 'nisn_nim', 'id_orangtua', 'status', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;

    function getSantri()
    {
        $builder = $this->db->table('santri');
        $builder->select('*');
        $builder->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua');
        $query = $builder->get();
        return $query->getResultArray();
>>>>>>> f83aa9a14818611b92c5a4de1fe22322018ae33c
    }
}
