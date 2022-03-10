<?php

namespace App\Models;

use CodeIgniter\Model;

class VillagesModel extends Model
{
    protected $table = 'villages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['district_id', 'name'];


    public function get_desa($kecamatan_id)
    {
        //ambil data desa berdasarkan id kecamatan yang dipilih

        $builder = $this->table('villages');

        $builder->where('district_id', $kecamatan_id);
        $builder->orderBy('name', 'ASC');

        $query = $builder->get();

        $output = '<option value="">Pilih Desa</option>';
        foreach ($query->getResultArray() as $row) {
            $output .= '<option value="' . $row['id'] . '" >' . $row['name'] . '</option>';
        }
        //return data desa
        return $output;
    }
}
