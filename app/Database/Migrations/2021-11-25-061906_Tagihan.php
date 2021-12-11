<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tagihan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tagihan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_pembayaran'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jumlah_pembayaran'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],


        ]);
        $this->forge->addKey('id_tagihan', true);
        $this->forge->createTable('tagihan');
    }

    public function down()
    {
        $this->forge->dropTable('tagihan');
    }
}
