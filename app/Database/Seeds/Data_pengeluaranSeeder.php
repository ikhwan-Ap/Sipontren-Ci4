<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Data_pengeluaranSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_pengeluaran' => 'uang Kegiatan A',

            ],
            [
                'nama_pengeluaran' => 'uang kegiatan B',

            ],
            [
                'nama_pengeluaran' => 'uang kegiatan C',

            ],
        ];

        $this->db->table('data_pengeluaran')->insertBatch($data);
    }
}
