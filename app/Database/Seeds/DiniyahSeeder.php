<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiniyahSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_diniyah' => 'Al-Jurumiah',
            ],
            [
                'nama_diniyah' => 'Al-Amsilah At-Tashriiyyah 1',
            ],
            [
                'nama_diniyah' => 'Bahasa Arab 1',
            ],
            [
                'nama_diniyah' => 'Bahasa Inggris 1',
            ],
            [
                'nama_diniyah' => 'Tahfidz Juz Amma 1',
            ],
            [
                'nama_diniyah' => 'Tafsir Juz Amma 1',
            ],
            [
                'nama_diniyah' => 'Aqidatul Awam',
            ],
            [
                'nama_diniyah' => 'Sanifah Al-Najah',
            ],
        ];

        $this->db->table('diniyah')->insertBatch($data);
    }
}
