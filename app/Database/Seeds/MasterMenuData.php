<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterMenuData extends Seeder
{
    public function run()
    {
        $data = [
            [
                'icon_menu' => 'bi bi-backpack4-fill',
                'cap_menu'  => 'Master',
                'sts_menu'  => 'Y',
            ],
            [
                'icon_menu' => 'bi bi-stack',
                'cap_menu'  => 'Transaksi',
                'sts_menu'  => 'Y',
            ],
            [
                'icon_menu' => 'bi bi-stack',
                'cap_menu'  => 'Laporan',
                'sts_menu'  => 'Y',
            ],
        ];

        // Using Query Builder
        $this->db->table('tb_menu_master')->insertBatch($data);
    }
    
}
