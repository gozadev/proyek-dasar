<?php

function masterMenu($accUser){
    $db = \Config\Database::connect();

    if(session()->get('role') != 'Super Admin'){
        $query = $db->query("SELECT distinct `tb_menu_master`.`cap_menu`,`tb_menu_master`.`icon_menu`,`tb_menu_master`.`id_mm` FROM `tb_menu_master`
        INNER JOIN `tb_sub_menu` ON `tb_menu_master`.`id_mm` = `tb_sub_menu`.`id_mm` 
        where find_in_set(`tb_sub_menu`.`id_menu`,'".$accUser."') and `tb_menu_master`.`sts_menu` = 'Y';");
    }else{
        $query = $db->query("SELECT distinct `tb_menu_master`.`cap_menu`,`tb_menu_master`.`icon_menu`,`tb_menu_master`.`id_mm` FROM `tb_menu_master`
        INNER JOIN `tb_sub_menu` ON `tb_menu_master`.`id_mm` = `tb_sub_menu`.`id_mm` 
        where  `tb_menu_master`.`sts_menu` = 'Y';");
    }

    return $query->getResultArray();
}

function subMenu($accUser,$idMenuMaster){
    $db = \Config\Database::connect();
    if(session()->get('role') != 'Super Admin'){
    $query = $db->query("SELECT
    `t1`.`id_mm`,
    `t1`.`icon_menu`,
    `t1`.`cap_menu`,
    `t1`.`link`,
    `t1`.`id_menu`
  FROM
    `tb_sub_menu` `t1` where  `t1`.`id_mm` = $idMenuMaster  and find_in_set(`t1`.`id_menu`,'".$accUser."') and `t1`.`sts_menu` = 'Y';");
    }else{
        $query = $db->query("SELECT
        `t1`.`id_mm`,
        `t1`.`icon_menu`,
        `t1`.`cap_menu`,
        `t1`.`link`,
    `t1`.`id_menu`
      FROM
        `tb_sub_menu` `t1` where  `t1`.`id_mm` = $idMenuMaster  and  `t1`.`sts_menu` = 'Y';");
    }
    return $query->getResultArray();
}

function masterMenuUSER($accUser){
    $db = \Config\Database::connect();
    $query = $db->query("SELECT distinct`tb_menu_master`.`id_mm` AS mmakses FROM `tb_menu_master`
        INNER JOIN `tb_sub_menu` ON `tb_menu_master`.`id_mm` = `tb_sub_menu`.`id_mm` 
        where find_in_set(`tb_sub_menu`.`id_menu`,'".$accUser."') and `tb_menu_master`.`sts_menu` = 'Y';");

    return $query->getRow();
}


function getMasterMenu(){
    $db = \Config\Database::connect();
    if(session()->get('role') == 'Super Admin'){
        $query = $db->query("SELECT distinct `tb_menu_master`.`cap_menu`,`tb_menu_master`.`id_mm` FROM `tb_menu_master`
        INNER JOIN `tb_sub_menu` ON `tb_menu_master`.`id_mm` = `tb_sub_menu`.`id_mm` 
        where `tb_menu_master`.`sts_menu` = 'Y';");
    }else{
        $query = $db->query("SELECT distinct `tb_menu_master`.`cap_menu`,`tb_menu_master`.`id_mm` FROM `tb_menu_master`
        INNER JOIN `tb_sub_menu` ON `tb_menu_master`.`id_mm` = `tb_sub_menu`.`id_mm` 
        where `tb_menu_master`.`sts_menu` = 'Y' and `tb_menu_master`.`cap_menu` != 'Master';");
    }
    
    return $query->getResultArray(); 
}

function getSubMenu($idMenuMaster){
    $db = \Config\Database::connect();
    $query = $db->query("SELECT
        `t1`.`id_menu`,
        `t1`.`icon_menu`,
        `t1`.`cap_menu`,
        `t1`.`link`
      FROM
        `tb_sub_menu` `t1` where  `t1`.`id_mm` = $idMenuMaster  and  `t1`.`sts_menu` = 'Y';");
    
    return $query->getResultArray();
}

function getSubMenuButton($idSubMenu){
    $db = \Config\Database::connect();
    $query = $db->query("SELECT
    `tb_btn_acc`.`id_menu`,
    `tb_btn_acc`.`id_btn`,
    `tb_btn_acc`.`btn_name`,
    `tb_btn_acc`.`btn_class`,
    `tb_btn_acc`.`posisi`
  FROM
    `tb_btn_acc`
  WHERE
    `tb_btn_acc`.`id_menu` = ? and  `tb_btn_acc`.`sts_active` = 'Y' ;"  , [$idSubMenu]);
    
    return $query->getResultArray();
}

function getRoleUser()
    {	
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_role_user')
        ->select('role')
        ->where('role !=', 'Super User')
        ->get();
       
        return  $builder->getResultArray();
    }

function getNoMenu($namaSubMenu){
    $db = \Config\Database::connect();
    $query = $db->query("SELECT
        `t1`.`id_menu`
      FROM
        `tb_sub_menu` `t1` where `t1`.`cap_menu` = ? ;",[$namaSubMenu]);
    
    return $query->getRow();
}

function getAccButtom($no,$accUser){
    $db = \Config\Database::connect();
    $query = $db->query("SELECT DISTINCT * FROM `tb_btn_acc` where find_in_set(`id_btn`,'$accUser' ) and id_menu = ?;",[$no]);
    return $query->getResultArray();
}




function getAcctombol($accUser,$idField,$menuId){
    $db = \Config\Database::connect();
    $menu = '';
    if(session()->get('role') != 'Super Admin'){
    
        // Ambil data user berdasarkan username
        $user = $db->table('tb_user')->select('akses_tombol')
        ->where('user_id', $accUser)
        ->get()
        ->getRow();
        $tombol = $db->table('tb_btn_acc')->whereIn('id_btn',  explode(',', $user->akses_tombol))->where(['posisi  ' => 'detail','sts_active' => 'Y','id_menu' => $menuId])->get()->getResultArray();

   
    }else{
        $tombol = $db->table('tb_btn_acc')->where(['posisi  ' => 'detail','sts_active' => 'Y','id_menu' => $menuId])->get()->getResultArray();
    }
      

    foreach($tombol as $t){
       
        $menu .= ' <a class="dropdown-item  '.$t['btn_class'].'" data-field-id="'.$idField.'"   href="#"> '.$t['btn_name'].'</a> ' ;
    }

    return  $menu;
}


