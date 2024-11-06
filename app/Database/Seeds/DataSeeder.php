<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run()
    {
      //  $this->call('MaintenanceSeeder');
        $this->call('SettingsData');
        $this->call('MasterMenuData');
        $this->call('SubMenuData');
        $this->call('UserData');
    }
    //buka terminal kemduian ketikkan dibawah ini : 
    //php spark db:seed DataSeeder
}
