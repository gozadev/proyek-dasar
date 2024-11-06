<?php namespace App\Models\Test;
use CodeIgniter\Model;

class TestModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = "tb_test";
    protected $primaryKey       = "id";
    protected $allowedFields    = ["input1","input2","input3","input4","input5","input6"];
    // Definisi model Anda di sini

    public function getData($perPage, $start, $search = ""){
        
        $builder = $this->table($this->table);
                    
            if (!empty($search)) {
                $builder->like("", $search); // silahkan sesuaikan sendiri filter pencarian 
                // ->orLike("", $search);        
                // ...
            }

        $builder->orderBy("id", "DESC")->limit($perPage, $start);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getDataCount($search = ""){	
        $builder = $this->table($this->table);
        if (!empty($search)) {
            $builder->like("", $search); // silahkan sesuaikan sendiri filter pencarian 
            // ->orLike("", $search);
        }
        return $builder->countAllResults();
    }


}