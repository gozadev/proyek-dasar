<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MenuMasterTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mm' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'icon_menu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'cap_menu' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'sts_menu' => [
                'type'       => 'CHAR',
                'constraint' => 1,
            ],
        ]);
        $this->forge->addKey('id_mm', true);
        $this->forge->createTable('tb_menu_master');
    }

    public function down()
    {
        $this->forge->dropTable('tb_menu_master');
    }
}
