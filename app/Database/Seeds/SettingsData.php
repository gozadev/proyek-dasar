<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingsData extends Seeder
{
    public function run()
    {
        $data = [
            [
                'set_id'        => 1,
                'value'           => 'T',
                'uraian'          => 'signUp',
                'ip_address_access'  => '-',
                'dr_maintenance'          => '-',
            ],
            [
                'set_id'        => 2,
                'value'   => 'T',
                'uraian'          => 'mode_maintenance',
                'ip_address_access'   => '127.0.0.1,127.0.0.0,::1',
                'dr_maintenance'       => '-',
            ],
            [
                'set_id'        => 3,
                'value'   => '1',
                'uraian'          => 'Login',
                'ip_address_access'   => '-',
                'dr_maintenance'       => '-',
            ],
        ];

        // Menggunakan Query Builder untuk memasukkan data
        $this->db->table('tb_settings_apps')->insertBatch($data);
    }
}
