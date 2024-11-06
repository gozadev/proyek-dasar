<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'username'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'password'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'akses_menu'    => ['type' => 'TEXT', 'null' => true],
            'akses_tombol'  => ['type' => 'TEXT', 'null' => true],
            'role'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sts_aktif'     => ['type' => 'CHAR', 'constraint' => 1, 'default' => 'Y'],
            'email'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'dashboard'     => ['type' => 'INT', 'constraint' => 11],
            'bagian'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'unit'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'locked_until'  => ['type' => 'DATETIME',  'null' => true],
        ]);
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('tb_users');
    }

    public function down()
    {
        $this->forge->dropTable('tb_users');
    }
}
