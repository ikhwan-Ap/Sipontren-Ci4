<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahModel extends Model
{
    protected $table = 'provinces';
    protected $primaryKey = 'id';
    protected $allowedFields = 'name';

    public function get_provinsi()
    {

        $builder = $this->table('provinces');
        $builder->orderBy('name', 'ASC');
        $query =  $builder->get();
        return $query->getResultArray();
    }


    public function get_kabupaten($provinsi_id)
    {
        //ambil data kabupaten berdasarkan id provinsi yang dipilih

        $builder = $this->table('wilayah');
        $builder->where('province_id', $provinsi_id);
        $builder->orderBy('name', 'ASC');
        $query =  $builder->get('regencies');
        return $query->getResultArray();
        $output = '<option value="">-- Pilih Kabupaten --</option>';

        //looping data
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        //return data kabupaten
        return $output;
    }

    public function get_kecamatan($kabupaten_id)
    {
        //ambil data kecamatan berdasarkan id kabupaten yang dipilih
        $builder = $this->table('wilayah');
        $builder->where('regency_id', $kabupaten_id);
        $builder->orderBy('name', 'ASC');
        $query = $builder->get('districts');

        $output = '<option value="">-- Pilih Kecamatan --</option>';

        //looping data
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        //return data kecamatan
        return $output;
    }

    public function get_desa($kecamatan_id)
    {
        //ambil data desa berdasarkan id kecamatan yang dipilih
        $builder = $this->table('wilayah');
        $builder->where('district_id', $kecamatan_id);
        $builder->orderBy('name', 'ASC');

        $query = $builder->get('villages');

        $output = '<option value="">-- Pilih Desa --</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '" >' . $row->name . '</option>';
        }
        //return data desa
        return $output;
    }
}
