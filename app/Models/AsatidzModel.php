<?php

namespace App\Models;

use CodeIgniter\Model;

class AsatidzModel extends Model
{
    protected $table            = 'asatidz';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields    = [
        'username', 'email', 'password', 'alamat', 'jenis_kelamin',
        'nik_ktp', 'no_kk', 'nama_lengkap', 'tempat_lahir', 'id_program',
        'pendidikan', 'no_hp', 'tanggal_lahir', 'deleted_at', 'created_at', 'updated_at',
        'provinsi', 'kabupaten', 'kecamatan', 'desa_kelurahan'
    ];
    protected $deletedField  = 'deleted_at';
    protected $useTimestamps = true;

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
            ->get()->getRowArray();
    }

    public function Get_provinsi($id)
    {
        $builder = $this->table('asatidz');
        $builder->select('*');
        $builder->select('provinces.id as id_provinsi');
        $builder->select('provinces.name as nama_provinsi');
        $builder->where('asatidz.id', $id);
        $builder->orderBy('name', 'ASC');
        $builder->join('provinces', 'provinces.id = asatidz.provinsi', 'left');
        $query =  $builder->get();
        return $query->getRowArray();
    }

    public function Get_kabupaten($id)
    {
        $builder = $this->table('asatidz');
        $builder->select('*');
        $builder->select('regencies.id as id_kabupaten');
        $builder->select('regencies.name as nama_kabupaten');
        $builder->where('asatidz.id', $id);
        $builder->orderBy('name', 'ASC');
        $builder->join('regencies', 'regencies.id = asatidz.kabupaten', 'left');
        $query =  $builder->get();
        return $query->getRowArray();
    }

    public function Get_kecamatan($id)
    {
        $builder = $this->table('asatidz');
        $builder->select('districts.id as id_kecamatan');
        $builder->select('districts.name as nama_kecamatan');
        $builder->where('asatidz.id', $id);
        $builder->orderBy('name', 'ASC');
        $builder->join('districts', 'districts.id = asatidz.kecamatan', 'left');
        $query =  $builder->get();
        return $query->getRowArray();
    }

    public function Get_desa($id)
    {
        $builder = $this->table('asatidz');
        $builder->select('villages.id as id_desa');
        $builder->select('villages.name as nama_desa');
        $builder->where('asatidz.id', $id);
        $builder->orderBy('name', 'ASC');
        $builder->join('villages', 'villages.id = asatidz.desa_kelurahan', 'left');
        $query =  $builder->get();
        return $query->getRowArray();
    }

    public function get_detail($id)
    {
        $builder = $this->table('asatidz');
        $builder->select('*');
        $builder->select('provinces.name as nama_provinsi');
        $builder->select('regencies.name as nama_kabupaten');
        $builder->select('districts.name as nama_kecamatan');
        $builder->select('villages.name as nama_desa');
        $builder->where('asatidz.id', $id);
        $builder->join('provinces', 'provinces.id = asatidz.provinsi', 'left');
        $builder->join('regencies', 'regencies.id = asatidz.kabupaten', 'left');
        $builder->join('districts', 'districts.id = asatidz.kecamatan', 'left');
        $builder->join('villages', 'villages.id = asatidz.desa_kelurahan', 'left');
        $builder->join('program', 'program.id_program = asatidz.id_program');
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function get_softDel($id)
    {
        $builder = $this->table('asatidz');
        $builder->select('id');
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
