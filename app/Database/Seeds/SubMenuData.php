<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubMenuData extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_mm'     => 1,
                'icon_menu' => '-',
                'cap_menu'  => 'User Management',
                'sts_menu'  => 'Y',
                'link'      => 'dashboard/usermanagement',
            ],
            [
                'id_mm'     => 1,
                'icon_menu' => '-',
                'cap_menu'  => 'Maintenance Mode',
                'sts_menu'  => 'Y',
                'link'      => 'dashboard/maintenance',
            ],
            [
                'id_mm'     => 1,
                'icon_menu' => '-',
                'cap_menu'  => 'Menu Management',
                'sts_menu'  => 'Y',
                'link'      => 'dashboard/menumanagement',
            ],
            [
                'id_mm'     => 1,
                'icon_menu' => '-',
                'cap_menu'  => 'CRUD Generator',
                'sts_menu'  => 'Y',
                'link'      => 'dashboard/crudgenerator',
            ],
         
        ];

        // Using Query Builder
        $this->db->table('tb_sub_menu')->insertBatch($data);
    }
}
