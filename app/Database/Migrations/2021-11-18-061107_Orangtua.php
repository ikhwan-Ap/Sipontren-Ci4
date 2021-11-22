<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orangtua extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_orangtua' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_ayah'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_ibu'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'no_hp_wali'       => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'penghasilan_ortu_perbulan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'pekerjaan_ortu'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id_orangtua', true);
        $this->forge->createTable('orangtua');
    }

    public function down()
    {
        $this->forge->dropTable('orangtua');
    }
}
