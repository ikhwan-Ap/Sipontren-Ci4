<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AsatidzSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nik_ktp' => '1110121110121110',
                'no_kk' => '1110121110121110',
                'username' => 'ustadz',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Ikhwan',
                'tempat_lahir' => 'Banyumas',
                'tanggal_lahir' => '10-9-1999',
                'program' => 'Shorof',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Purwojati',
                'email' => 'ikhwanaditya14@gmail.com',
                'no_hp' => '08156811615',
                'jadwal' => '10.00 Kamis',
                'kelas' => 'Tafsir',
                'total_santri' => '40',
                'pertemuan' => '10 ',
                'pendidikan' => 'sma',
                'foto' => 'default.png'
            ],
            [
                'nik_ktp' => '1110121110121110',
                'no_kk' => '1110121110121110',
                'username' => 'habib',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Dimas',
                'tempat_lahir' => 'Banyumas',
                'tanggal_lahir' => '19-9-1999',
                'program' => 'Fikih',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Banyumas',
                'email' => 'ikhwanaditya14@gmail.com',
                'no_hp' => '08156811615',
                'jadwal' => '9.00 Jumat',
                'kelas' => 'ilmu waris',
                'total_santri' => '40',
                'pertemuan' => '10 ',
                'pendidikan' => 'SMA',
                'foto' => 'default.png'
            ],
        ];

        $this->db->table('asatidz')->insertBatch($data);
    }
}
