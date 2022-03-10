<?php

namespace App\Models;

use CodeIgniter\Model;

class RegenciesModel extends Model
{
    protected $table = 'regencies';
    protected $primaryKey = 'id';
    protected $allowedFields = ['province_id', 'name'];


    public function get_kabupaten($provinsi_id)
    {
        //ambil data kabupaten berdasarkan id provinsi yang dipilih

        $builder = $this->table('regencies');
        $builder->where('province_id', $provinsi_id);
        $builder->orderBy('name', 'ASC');
        $query =  $builder->get();

        $output = '<option value="">Pilih Kabupaten</option>';

        //looping data
        foreach ($query->getResultArray() as $row) {
            $output .= '<option value="' .  $row['id']  . '">' . $row['name']  . '</option>';
        }
        //return data kabupaten
        return $output;
    }
}
