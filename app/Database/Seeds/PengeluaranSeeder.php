<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PengeluaranSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_pengeluaran' => 'uang uangan',
                'jumlah_pengeluaran' => '100000'
            ],
            [
                'nama_pengeluaran' => 'uang kegiatan A',
                'jumlah_pengeluaran' => '250000'
            ],
            [
                'nama_pengeluaran' => 'uang kegiatan B',
                'jumlah_pengeluaran' => '100000'
            ],
        ];

        $this->db->table('pengeluaran')->insertBatch($data);
    }
}
