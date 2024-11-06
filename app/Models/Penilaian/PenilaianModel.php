<?php namespace App\Models\Penilaian;
use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $DBGroup          = "default";
    protected $table            = "tb05_pn";
    protected $primaryKey       = "Id_pn";
    protected $allowedFields    = ["tgl","jb","nljb"];
    // Definisi model Anda di sini

    public function getData($perPage, $start, $search = "",$filter ){
        
     
        $db = \Config\Database::connect();
        $builder = $db->table('tb_user t3');
        $builder->select('tb05_pn.Id_pn,tb05_pn.tgl,tb05_pn.nm_pg, tb05_pn.nik,jb,nljb,nj,nj1,nj2,nj3,jnd,pir');
        $builder->join('tb01_pnv', 't3.id_pnv = tb01_pnv.id_pnv');
        $builder->join('tb02_pg', 'tb01_pnv.id_pnv = tb02_pg.id_pnv');
        $builder->join('tb05_pn', 'tb02_pg.nik = tb05_pn.nik'); // Join ke tb05_pn menggunakan nik
        $builder->where('t3.user_id', 11);
        $builder->where('tb02_pg.sts_a', 'Y'); 
        $builder->where('tb05_pn.tgl', $filter);
        $builder->orderBy("tb02_pg.nik", "DESC")->limit($perPage, $start);

        if (!empty($search)) {
            $builder->like("", $search); // silahkan sesuaikan sendiri filter pencarian 
            // ->orLike("", $search);        
            // ...
        }
        
        $query = $builder->get();
        return $query->getResult();

    }

    public function getDataCount($search = "",$filter){	
        
        $db = \Config\Database::connect();
        $builder = $db->table('tb_user t3');
        $builder->select('tb05_pn.nm_pg');
        $builder->join('tb01_pnv', 't3.id_pnv = tb01_pnv.id_pnv');
        $builder->join('tb02_pg', 'tb01_pnv.id_pnv = tb02_pg.id_pnv');
        $builder->join('tb05_pn', 'tb02_pg.nik = tb05_pn.nik'); // Join ke tb05_pn menggunakan nik
        $builder->where('t3.user_id', 11);
        $builder->where('tb02_pg.sts_a', 'Y');
        $builder->where('tb05_pn.tgl', $filter); 
       

        if (!empty($search)) {
            $builder->like("", $search); // silahkan sesuaikan sendiri filter pencarian  $filter = date("Y-m");
            // ->orLike("", $search);
        }
        return $builder->countAllResults();
    }

    public function getBulan(){

        $db = \Config\Database::connect();
        $builder = $db->table('tb_user t3');
        $builder->distinct();
        $builder->select('tb05_pn.tgl');
        $builder->join('tb01_pnv', 't3.id_pnv = tb01_pnv.id_pnv');
        $builder->join('tb02_pg', 'tb01_pnv.id_pnv = tb02_pg.id_pnv');
        $builder->join('tb05_pn', 'tb02_pg.nik = tb05_pn.nik'); // Join ke tb05_pn menggunakan nik
        $builder->where('t3.user_id', 11);
        $builder->where('tb02_pg.sts_a', 'Y');
        $builder->where('YEAR(CONCAT(tb05_pn.tgl, "-01")) = YEAR(CURDATE())', null, false);
        $builder->orderBy('tgl', 'DESC');

    

        $query = $builder->get();
        $results = $query->getResultArray();
        return $results;
    }

}