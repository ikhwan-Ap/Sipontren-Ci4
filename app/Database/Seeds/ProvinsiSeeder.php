<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProvinsiSeeder extends Seeder
{
    public function run()
    {
        $data =  [
            [
                'nama_provinsi' => 'Jawa Tengah'
            ],
            [
                'nama_provinsi' => 'Jawa Barat'
            ]
        ];
        $this->db->table('provinsi')->insertBatch($data);
    }
}
