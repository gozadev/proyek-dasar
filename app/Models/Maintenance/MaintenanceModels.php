<?php

namespace App\Models\Maintenance;

use CodeIgniter\Model;

class MaintenanceModels extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_maintenance';
    protected $primaryKey       = 'id_modeM';
  
    protected $allowedFields    = ['mode_maintenance','ip_access'];

   
}
