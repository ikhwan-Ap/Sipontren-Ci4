<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

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
            'id_keluar' => [
                'type'  => 'INT',
                'constraint' => 11,
            ],
            'jumlah_pengeluaran'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'waktu_pengeluaran' => [
                'type' => 'DATE',
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
