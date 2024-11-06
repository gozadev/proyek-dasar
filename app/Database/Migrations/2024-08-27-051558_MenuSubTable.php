<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MenuSubTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_menu' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_mm' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'icon_menu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'cap_menu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'sts_menu' => [
                'type'       => 'CHAR',
                'constraint' => 1,
            ],
            'link' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id_menu', true);
        $this->forge->addForeignKey('id_mm', 'tb_menu_master', 'id_mm', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_sub_menu');
    }

    public function down()
    {
        $this->forge->dropTable('tb_sub_menu');
    }
}
