<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Asatidz extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'username'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'password'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nik_ktp'       => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'no_kk'       => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
            'nama_lengkap'       => [
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
            'program'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenis_kelamin'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat'       => [
                'type'       => 'TEXT',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('asatidz');
    }

    public function down()
    {
        $this->forge->dropTable('asatidz');
    }
}
