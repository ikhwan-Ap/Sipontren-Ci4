<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KamarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kamar' => 'Kamar 1',
            ],
            [
                'nama_kamar' => 'Kamar 2',
            ],
            [
                'nama_kamar' => 'Kamar 3',
            ],
            [
                'nama_kamar' => 'Kamar 4',
            ],
        ];

        $this->db->table('kamar')->insertBatch($data);
    }
}
