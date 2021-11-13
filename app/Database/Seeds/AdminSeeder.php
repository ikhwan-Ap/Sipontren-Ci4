<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'mahasiswainformatika@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 1
            ],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'alkuffar2@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 2
            ],
        ];

        $this->db->table('admin')->insertBatch($data);
    }
}
