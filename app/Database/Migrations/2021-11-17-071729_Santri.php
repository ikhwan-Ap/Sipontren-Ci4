<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Santri extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_santri' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nis'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'nik_ktp'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'no_kk'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'password'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_lengkap'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenis_kelamin'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tempat_lahir'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tanggal_lahir'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'desa_kelurahan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kecamatan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kabupaten'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'provinsi'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'no_hp_santri'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'id_kamar'       => [
                'type'       => 'INT',
                'constraint'       => 11,
                'null' => true,
            ],
            'id_diniyah'       => [
                'type'       => 'INT',
                'constraint'       => 11,
                'null' => true,
            ],
            'id_program'       => [
                'type'       => 'INT',
                'constraint'       => 11,
                'null' => true,
            ],
            'catatan_medis'       => [
                'type'       => 'TEXT',
            ],
            'jenis_kendaraan'       => [
                'type'       => 'VARCHAR',
                'constraint'       => '255',
                'null' => true,
            ],
            'plat_nomor'       => [
                'type'       => 'VARCHAR',
                'constraint'       => '20',
                'null' => true,
            ],
            'pendidikan_terakhir'       => [
                'type'       => 'VARCHAR',
                'constraint'       => '255',
            ],
            'pengalaman_mondok'       => [
                'type'       => 'TEXT',
            ],
            'pendidikan_sekarang'       => [
                'type'       => 'VARCHAR',
                'constraint'       => '255',
            ],
            'gol_darah'       => [
                'type'       => 'VARCHAR',
                'constraint'       => '20',
            ],
            'nama_almet'       => [
                'type'       => 'VARCHAR',
                'constraint'       => '255',
            ],
            'jurusan'       => [
                'type'       => 'VARCHAR',
                'constraint'       => '255',
            ],
            'kelas_semester'       => [
                'type'       => 'VARCHAR',
                'constraint'       => '255',
            ],
            'nisn_nim'       => [
                'type'       => 'VARCHAR',
                'constraint'       => '100',
            ],
            'id_orangtua'       => [
                'type'       => 'INT',
                'constraint'       => 11,
            ],
            'status'       => [
                'type'       => 'VARCHAR',
                'constraint'       => '100',
            ],
            'created_at'       => [
                'type'       => 'timestamp',
                'null' => true,
            ],
            'updated_at'       => [
                'type'       => 'timestamp',
                'null' => true,
            ],
            'deleted_at'       => [
                'type'       => 'timestamp',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_santri', true);
        $this->forge->createTable('santri');
    }

    public function down()
    {
        $this->forge->dropTable('santri');
    }
}
