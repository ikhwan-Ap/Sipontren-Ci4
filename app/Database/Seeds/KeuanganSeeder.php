<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KeuanganSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_syahriyah' => '1',
                'id_santri' => '1',
                'id_tagihan' => '1',
                'status_pembayaran' => 'Lunas',
            ],
            [
                'id_syahriyah' => '1',
                'id_santri' => '2',
                'id_tagihan' => '1',
                'status_pembayaran' => 'Belum Lunas',
            ],

        ];

        $this->db->table('keuangan')->insertBatch($data);
    }
}
