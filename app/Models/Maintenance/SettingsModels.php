<?php

namespace App\Models\Maintenance;

use CodeIgniter\Model;

class SettingsModels extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_settings_apps';
    protected $primaryKey       = 'set_id';
    protected $allowedFields    = ['signUp'];

   
}
