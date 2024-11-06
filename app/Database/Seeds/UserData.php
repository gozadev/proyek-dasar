<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserData extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id'       => 1,
                'nama'          => 'SuperAdmin',
                'username'      => 'hero',
                'password'      => '$2y$10$tGvSMldXisVC.8dw9duUaezAU82mHPne/vX93Sa4Oo/O1FJbbjFSW',
                'akses_menu'    => '-',
                'akses_tombol'  => '-',
                'role'          => 'Super Admin',
                'sts_aktif'     => 'Y',
                'email'         => '-',
                'dashboard'     => 2,
                'bagian'        => 'Akuntansi',
                'unit'          => '-',
            ],

        ];

        // Using Query Builder
        $this->db->table('tb_users')->insertBatch($data);
    }
}
