<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_program' => 'Bahasa Al-Kutub',
            ],
            [
                'nama_program' => 'Bahasa Arab',
            ],
            [
                'nama_program' => 'Bahasa Inggris',
            ],
            [
                'nama_program' => 'Tahfidz Al-Quran',
            ],
        ];

        $this->db->table('program')->insertBatch($data);
    }
}
