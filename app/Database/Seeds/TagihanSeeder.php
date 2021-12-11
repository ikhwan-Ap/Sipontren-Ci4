<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TagihanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_pembayaran' => 'uang uangan',
                'jumlah_pembayaran' => '100000'
            ],
            [
                'nama_pembayaran' => 'uang kegiatan A',
                'jumlah_pembayaran' => '250000'
            ],
            [
                'nama_pembayaran' => 'uang kegiatan B',
                'jumlah_pembayaran' => '100000'
            ],
        ];

        $this->db->table('tagihan')->insertBatch($data);
    }
}
