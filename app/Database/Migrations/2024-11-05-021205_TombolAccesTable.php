<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TombolAccesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_btn'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_menu'      => ['type' => 'INT', 'constraint' => 11,'default' => 0],
            'btn_name'     => ['type' => 'VARCHAR', 'constraint' => 255,'default' => '-'],
            'btn_class'    => ['type' => 'VARCHAR', 'constraint' => 255,'default' => '-'],
            'data'         =>  ['type' => 'VARCHAR', 'constraint' => 20,'default' => '-'],
            'posisi'       => ['type' => 'enum', 'constraint' => ['top','detail'], 'default' => 'top'],
            'sts_active'   => ['type' => 'CHAR', 'constraint' => 1, 'default' => 'Y'],
            
        ]);
        $this->forge->addKey('id_btn', true);
        $this->forge->createTable('tb_btn_acc');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tb_btn_acc');
    }
}
