<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kelas' => 'Kelas Diniyah 1 Ula',
            ],
            [
                'nama_kelas' => 'Kelas Diniyah 2 Ula',
            ],
            [
                'nama_kelas' => 'Kelas Diniyah 3 Ula',
            ],
            [
                'nama_kelas' => 'Kelas Diniyah 1 Wustho',
            ],
            [
                'nama_kelas' => 'Kelas Diniyah 2 Wustho',
            ],
        ];

        $this->db->table('kelas')->insertBatch($data);
    }
}
