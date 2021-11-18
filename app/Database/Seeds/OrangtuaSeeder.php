<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OrangtuaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_ayah' => 'Refry Riyanto',
                'nama_ibu' => 'Maratun Soleha',
                'no_hp_wali' => '085612344321',
                'penghasilan_ortu_perbulan' => '12.000.000',
                'pekerjaan_ortu' => 'PNS',
            ],
            [
                'nama_ayah' => 'Dede Agung Prastowo',
                'nama_ibu' => 'Diyah Primasari',
                'no_hp_wali' => '085612344321',
                'penghasilan_ortu_perbulan' => '12.000.000',
                'pekerjaan_ortu' => 'PNS',
            ],
        ];

        $this->db->table('orangtua')->insertBatch($data);
    }
}
