<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MaintenanceData extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_modeM'           => 1,
                'mode_maintenance'   => 'T',
                'ip_access'          => '127.0.0.1,127.0.0.0',
                'dr_maintenance'     => '2023-09-27 14:52:00',
            ],
        ];

        // Menggunakan Query Builder untuk memasukkan data
        $this->db->table('tb_maintenance')->insertBatch($data);
    }
}
