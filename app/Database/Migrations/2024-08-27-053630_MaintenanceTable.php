<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MaintenanceTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_modeM'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'mode_maintenance'    => ['type' => 'CHAR', 'constraint' => 1],
            'ip_access'           => ['type' => 'TEXT'],
            'dr_maintenance'      => ['type' => 'VARCHAR', 'constraint' => 20],
        ]);
        $this->forge->addKey('id_modeM', true);
        $this->forge->createTable('tb_maintenance');
    }

    public function down()
    {
        $this->forge->dropTable('tb_maintenance');
    }
}
