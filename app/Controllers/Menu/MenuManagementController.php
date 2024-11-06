<?php

namespace App\Controllers\Menu;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\Menu\MenuModels;
use App\Controllers\BaseController;
use App\Models\User\UserModels;
use App\Models\SubMenu\SubMenuModels;


class MenuManagementController extends BaseController
{
    protected $menuModels;
    protected $db;
    protected $acMenuId;
    protected $subMenu;
    protected $masterMenu;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) 
    {
        parent::initController($request, $response, $logger);

        $this->masterMenu = 'Master';
        $this->subMenu = 'Menu Management';

        $this->menuModels = new MenuModels();
        $this->db = \Config\Database::connect();

        $this->userModels = new UserModels();
        $this->subMenuModels = new SubMenuModels();
        $userAkses = $this->userModels->select('akses_menu')->where(['user_id' => session()->get('iduser')])->get()->getRow()->akses_menu;
        $this->acMenuId = $this->subMenuModels->select('id_menu')->where(['cap_menu' => $this->subMenu])->get()->getRow()->id_menu;
           
        if(session()->get('role') != 'Super Admin'){
            if(strpos( $userAkses ,$this->acMenuId) === false){
                $response->redirect(base_url(session()->get('dashboard')));
            }
        }
        
        
    }
    public function index()
    {
        $menuMaster = $this->db->table('tb_menu_master')->select('id_mm,cap_menu')->orderBy('id_mm', 'DESC')->get()->getResultArray();
        $data = [
            'masterMenu' => $this->masterMenu,
            'subMenu' => $this->subMenu,
            'menumaster' => $menuMaster
           
        ];
        return view('dashboard/menu_management',$data);
        
    }

    public function dataSubMenu()
    {
        // Menghitung jumlah total data
        $totalRecords = $this->menuModels->countAll();
        // Konfigurasi pagination
	
        $perPage  =intval($this->request->getPost('length'));  // Jumlah data per halaman
         $start  =intval($this->request->getPost('start'));  // Indeks data awal
        $search = $this->request->getPost('search')['value']; // Kata kunci pencarian (opsional)
       
         // Mengambil data dengan pagination
         $data = $this->menuModels->getData($perPage, $start, $search);
         $totalFiltered = $this->menuModels->getDataCount($search);

         // Format data yang akan dikirimkan ke DataTables
        $result = [
            "draw" => $this->request->getPost('draw'), // Nomor draw (harus dikirimkan kembali ke DataTables)
            "recordsTotal" => $totalRecords, // Jumlah total data
            "recordsFiltered" => $totalFiltered, // Jumlah data setelah diterapkan filter (jika ada)
            "data" => $data // Data yang akan ditampilkan di tabel
        ];

        // Mengirimkan data dalam format JSON
        return $this->response->setJSON($result);
       
    }

    public function dataMasterMenu()
    {
        // Menghitung jumlah total data
        $totalRecords =  $this->db->table('tb_menu_master')->countAll();
        // Konfigurasi pagination
	
        $perPage  =intval($this->request->getPost('length'));  // Jumlah data per halaman
         $start  =intval($this->request->getPost('start'));  // Indeks data awal
        $search = $this->request->getPost('search')['value']; // Kata kunci pencarian (opsional)
       
         // Mengambil data dengan pagination
         $data = $this->menuModels->getDataMaster($perPage, $start, $search);
         $totalFiltered = $this->menuModels->getDataCountMaster($search);

         // Format data yang akan dikirimkan ke DataTables
        $result = [
            "draw" => $this->request->getPost('draw'), // Nomor draw (harus dikirimkan kembali ke DataTables)
            "recordsTotal" => $totalRecords, // Jumlah total data
            "recordsFiltered" => $totalFiltered, // Jumlah data setelah diterapkan filter (jika ada)
            "data" => $data // Data yang akan ditampilkan di tabel
        ];

        // Mengirimkan data dalam format JSON
        return $this->response->setJSON($result);
       
    }

    public function getDataSubMenu()
    {
        $menuId = $this->request->getPost('menuid');
        $result = $this->menuModels->where(['id_menu' => $menuId])->get()->getRow();
        return json_encode($result); 
    }

    public function getDataMasterMenu()
    {
        $menuId = $this->request->getPost('menuid');
        $result = $this->db->table('tb_menu_master')->where(['id_mm' => $menuId])->get()->getRow();
        return json_encode($result); 
    }

    

    public function storeSubMenu()
    {
        $store = $this->request->getPost();
     
        if($store['action'] =='tambah'){
            if($store['optionstore'] =='submenu'){

                $data = [
                    'cap_menu'=> $store['nsm'],
                    'sts_menu'=> $store['stsAktif'],
                    'link'=> $store['lsm'],
                    'id_mm'=> $store['idmastermenu']
                ];

                if($this->menuModels->save($data)){
                    session()->setFlashData("info",'Toastify({text: "Submenu baru berhasil ditambahkan", duration: 4000,style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },}).showToast();');
                   return  redirect()->back();
                }else{
                    session()->setFlashData("info",'Toastify({text: "Submenu baru Gagal diperbaharui", duration: 4000,style: {
                        background: "linear-gradient(to right, #b00000, #f5b0b0)",
                    },}).showToast();');
                   return  redirect()->back();
                }
            }elseif($store['optionstore'] =='mastermenu'){
                $data = [
                    'cap_menu'=> $store['nmm'],
                    'sts_menu'=> $store['stsmm'],
                    'icon_menu'=> $store['imm'],    
                ];

                 // Insert the data using the query builder
                $builder = $this->db->table('tb_menu_master');
                $builder->insert($data);

                if($this->db->affectedRows() > 0){
                    session()->setFlashData("info",'Toastify({text: "Master Menu baru berhasil ditambahkan", duration: 4000,style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },}).showToast();');
                  return  redirect()->back();
                }else{
                    session()->setFlashData("info",'Toastify({text: "Master Menu baru Gagal diperbaharui", duration: 4000,style: {
                        background: "linear-gradient(to right, #b00000, #f5b0b0)",
                    },}).showToast();');
                  return  redirect()->back();
                }

            }
        }elseif($store['action'] =='edit'){
            if($store['optionstore'] =='submenu'){
                $data = [
                    'cap_menu'=> $store['nsm'],
                    'sts_menu'=> $store['stsAktif'],
                    'link'=> $store['lsm'],
                    'id_mm'=> $store['idmastermenu']
                ];
                if( $this->menuModels->update($store['idsubmenu'],$data)){
                    session()->setFlashData("info",'Toastify({text: "Submenu berhasil diperbaharui", duration: 4000,style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },}).showToast();');
                  return  redirect()->back();
                }else{
                    session()->setFlashData("info",'Toastify({text: "Submenu Gagal diperbaharui", duration: 4000,style: {
                        background: "linear-gradient(to right, #b00000, #f5b0b0)",
                    },}).showToast();');
                  return  redirect()->back();
                }
            }elseif($store['optionstore'] =='mastermenu'){
                $data = [
                    'cap_menu'=> $store['nmm'],
                    'sts_menu'=> $store['stsmm'],
                    'icon_menu'=> $store['imm'],    
                ];
              
                 // Insert the data using the query builder
                 $builder = $this->db->table('tb_menu_master');  
                 $builder->where(['id_mm' => $store['idmastermenu']]);
                 $builder->update($data);
                 // Check if the update was successful
                if ($this->db->affectedRows() > 0) {
                    session()->setFlashData("info",'Toastify({text: "Master menu berhasil diperbaharui", duration: 4000,style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },}).showToast();');
                    return  redirect()->back();
                } else {
                    session()->setFlashData("info",'Toastify({text: "Master menu Gagal diperbaharui", duration: 4000,style: {
                        background: "linear-gradient(to right, #b00000, #f5b0b0)",
                    },}).showToast();');
                    return  redirect()->back();
                }


                 
            }

            
        }
    }

    public function deleteMenu()
    {
        $store = $this->request->getPost();
        $builder =  $this->db->table('tb_menu_master');

        if($store['optionMenu'] == 'master-menu'){
                $builder->where('id_mm',$store['menuId'])->delete();

             // Check if the delete operation was successful
                if ($this->db->affectedRows() > 0) {
                    return json_encode('success');
                } else {
                    return json_encode('gagal');
                }
       
        }elseif($store['optionMenu'] == 'sub-menu'){
            $this->menuModels->delete($store['menuId']);

            // Check if the delete operation was successful
                if ( $this->menuModels->affectedRows() > 0) {
                    return json_encode('success');
                } else {
                    return json_encode('gagal');
                }         
        }   
    }

   

}
