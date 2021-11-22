<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SantriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nis' => '10010001',
                'nik_ktp' => '10010001020101',
                'no_kk' => '10010001020101',
                'password' => password_hash('santri123', PASSWORD_DEFAULT),
                'email' => 'anggie@gmail.com',
                'nama_lengkap' => 'Anggie Febriansyah',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Kebumen',
                'tanggal_lahir' => '12/10/2000',
                'alamat' => 'Kebumen, Jawa Tengah',
                'desa_kelurahan' => 'Sempor',
                'kecamatan' => 'Gombong',
                'kabupaten' => 'Kebumen',
                'provinsi' => 'Jawa Tengah',
                'no_hp_santri' => '08920901234',
                'id_kamar' => '1',
                'id_diniyah' => '1',
                'id_program' => '1',
                'catatan_medis' => 'Masuk Angin',
                'jenis_kendaraan' => 'Motor',
                'plat_nomor' => 'R 5678 AF',
                'pendidikan_terakhir' => 'SMA/SMK',
                'pengalaman_mondok' => 'Belum Pernah',
                'pendidikan_sekarang' => 'Universitas Amikom Purwokerto',
                'gol_darah' => 'A',
                'nama_almet' => 'Universitas Amikom Purwokerto',
                'jurusan' => 'IPA',
                'kelas_semester' => 'Semester 7',
                'nisn_nim' => '18110002',
                'id_orangtua' => '1',
                'status' => 'Non Aktif',
            ],
            [
                'nis' => '10010002',
                'nik_ktp' => '10010001020102',
                'no_kk' => '10010001020102',
                'password' => password_hash('santri123', PASSWORD_DEFAULT),
                'email' => 'farhan@gmail.com',
                'nama_lengkap' => 'Farhan Ramdhani Ashari',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Purwokerto',
                'tanggal_lahir' => '9/7/1999',
                'alamat' => 'Bumiayu, Jawa Tengah',
                'desa_kelurahan' => 'Bantar Kawung',
                'kecamatan' => 'Bumiayu',
                'kabupaten' => 'Brebes',
                'provinsi' => 'Jawa Tengah',
                'no_hp_santri' => '08920901234',
                'id_kamar' => '1',
                'id_diniyah' => '1',
                'id_program' => '1',
                'catatan_medis' => 'Masuk Angin',
                'jenis_kendaraan' => 'Motor',
                'plat_nomor' => 'R 1234 FR',
                'pendidikan_terakhir' => 'SMA/SMK',
                'pengalaman_mondok' => 'Belum Pernah',
                'pendidikan_sekarang' => 'Universitas Amikom Purwokerto',
                'gol_darah' => 'B',
                'nama_almet' => 'Universitas Amikom Purwokerto',
                'jurusan' => 'IPS',
                'kelas_semester' => 'Semester 7',
                'nisn_nim' => '18110029',
                'id_orangtua' => '2',
                'status' => 'Non Aktif',
            ],
        ];

        $this->db->table('santri')->insertBatch($data);
    }
}
