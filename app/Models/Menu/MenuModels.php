<?php

namespace App\Models\Menu;

use CodeIgniter\Model;

class MenuModels extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_sub_menu';
    protected $primaryKey       = 'id_menu';
    protected $allowedFields    = ['id_mm','cap_menu','sts_menu','link'];


    public function getData($perPage, $start, $search = '')
    {
	
        $builder = $this->table($this->table);
			 
        if (!empty($search)) {
            $builder->like('cap_menu', $search);  
               // ->orLike('username', $search);        
            // ...
        }

        $builder->orderBy('id_menu', 'DESC')->limit($perPage, $start);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getDataCount($search = '')
    {	
        $builder = $this->table($this->table);
        if (!empty($search)) {
            $builder->like('cap_menu', $search);
               // ->orLike('username', $search);
        }
        return $builder->countAllResults();
    }

    public function getDataMaster($perPage, $start, $search = '')
    {
	
        $builder = $this->db->table('tb_menu_master');
			 
        if (!empty($search)) {
            $builder->like('cap_menu', $search);
               // ->orLike('username', $search);        
            // ...
        }

        $builder->orderBy('id_mm', 'DESC')->limit($perPage, $start);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getDataCountMaster($search = '')
    {	
        $builder = $this->db->table('tb_menu_master');
        if (!empty($search)) {
            $builder->like('cap_menu', $search);
               // ->orLike('username', $search);
        }
        return $builder->countAllResults();
    }
}
