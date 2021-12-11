<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use DateTime;

class Pengeluaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengeluaran' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_pengeluaran'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jumlah_pengeluaran'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'waktu_pengeluaran' => [
                'type' => 'DateTime',
                'null' => true,
            ]


        ]);
        $this->forge->addKey('id_pengeluaran', true);
        $this->forge->createTable('pengeluaran');
    }

    public function down()
    {
        $this->forge->dropTable('pengeluaran');
    }
}
