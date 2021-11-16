<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GedungSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_gedung' => 'Aula',
            ],
            [
                'nama_gedung' => 'Bahasa',
            ],
            [
                'nama_gedung' => 'Olahraga',
            ],
            [
                'nama_gedung' => 'Masjid Abu Bakar Ash-Shiddiq',
            ],
        ];

        $this->db->table('gedung')->insertBatch($data);
    }
}
