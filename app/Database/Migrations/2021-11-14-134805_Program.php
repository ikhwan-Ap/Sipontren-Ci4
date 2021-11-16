<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Program extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_program' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_program'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ]
        ]);
        $this->forge->addKey('id_program', true);
        $this->forge->createTable('program');
    }

    public function down()
    {
        $this->forge->dropTable('program');
    }
}
