<?php

namespace App\Models;

use CodeIgniter\Model;

class SantriModel extends Model
{
    protected $table            = 'santri';
    protected $primaryKey       = 'id_santri';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nis', 'nik_ktp', 'no_kk', 'password', 'email', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
        'alamat', 'desa_kelurahan', 'kecamatan', 'kabupaten', 'provinsi',
        'no_hp_santri', 'id_kamar', 'id_diniyah', 'id_program', 'catatan_medis',
        'pendidikan_terakhir', 'pengalaman_mondok', 'pendidikan_sekarang', 'gol_darah',
        'nama_almet', 'kelas_semester', 'nisn_nim', 'id_orangtua', 'status', 'created_at', 'updated_at', 'deleted_at'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    public function getSantriNew($id = false)
    {
        if ($id == false) {
            return $this->db->table('santri')->select('*')->where('status', 'Baru')->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->get()->getResultArray();
        }

        return $this->db->table('santri')->select('*')->where(['id_santri' => $id, 'status' => 'Baru'])->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->get()->getRowArray();
    }

    public function getSantriNonActive()
    {
        return $this->db->table('santri')->select('*')->where('status', 'Non Aktif')->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->get()->getResultArray();
    }

    public function getSantriActive()
    {
<<<<<<< HEAD
        $builder = $this->db->table('santri');
        $builder->select('*');
        $builder->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getLogin($nis)
    {
        return $this->db->table($this->table)->getWhere(['nis' => $nis])->getRowArray();
=======
        return $this->db->table('santri')->select('*')->where('status', 'Aktif')->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->get()->getResultArray();
>>>>>>> 67bdac01758eccc20981040c60c1fe6293cd0eb9
    }

    public function getSantriAlumni()
    {
        return $this->db->table('santri')->select('*')->where('status', 'Alumni')->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->get()->getResultArray();
    }

    public function getSantri($id = false)
    {
        if ($id == false) {
            return $this->db->table('santri')->select('*')->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->get()->getResultArray();
        }
        return $this->db->table('santri')->select('*')->where('id_santri', $id)->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->get()->getRowArray();
    }
}
