<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Diniyah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_diniyah' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_diniyah'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ]
        ]);
        $this->forge->addKey('id_diniyah', true);
        $this->forge->createTable('diniyah');
    }

    public function down()
    {
        $this->forge->dropTable('diniyah');
    }
}
