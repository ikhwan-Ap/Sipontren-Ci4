<?php

namespace App\Models;

use CodeIgniter\Model;

class DistrictsModel extends Model
{
    protected $table = 'districts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'regency_id'];


    public function get_kecamatan($kabupaten_id)
    {
        //ambil data desa berdasarkan id kecamatan yang dipilih
        $builder = $this->table('districts');
        $builder->where('regency_id', $kabupaten_id);
        $builder->orderBy('name', 'ASC');


        $query = $builder->get();

        $output = '<option value="">Pilih Kecamatan</option>';
        foreach ($query->getResultArray() as $row) {
            $output .= '<option value="' . $row['id'] . '" >' . $row['name'] . '</option>';
        }
        //return data desa
        return $output;
    }
}
