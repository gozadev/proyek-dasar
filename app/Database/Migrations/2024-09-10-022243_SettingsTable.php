<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'set_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'uraian'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'value'    => ['type' => 'CHAR', 'constraint' => 1,'default' => 'T'],
            'ip_address_access'          => ['type' => 'VARCHAR', 'constraint' => 255,'default' => 'T'],
            'dr_maintenance'          => ['type' => 'VARCHAR', 'constraint' => 255,'default' => 'T'],
         
        ]);
        $this->forge->addKey('set_id', true);
        $this->forge->createTable('tb_settings_apps');
    }

    public function down()
    {
        $this->forge->dropTable('tb_settings_apps');
    }
}
