<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Keuangan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_keuangan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_santri'       => [
                'type'       => 'INT',
                'constraint'       => 11,
                'null' => true,
            ],
            'id_syahriyah'       => [
                'type'       => 'INT',
                'constraint'       => 11,
                'null' => true,
            ],
            'status_pembayaran'       => [
                'type'       => 'VARCHAR',
                'constraint'       => '100',
            ],
            'id_tagihan'       => [
                'type'       => 'INT',
                'constraint'       => 11,
                'null' => true,
            ],

        ]);
        $this->forge->addKey('id_keuangan', true);
        $this->forge->createTable('keuangan');
    }

    public function down()
    {
        $this->forge->dropTable('keuangan');
    }
}
