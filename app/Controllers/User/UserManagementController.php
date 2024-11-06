<?php

namespace App\Controllers\User;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Controllers\BaseController;

use App\Models\User\UserModels;
use App\Models\SubMenu\SubMenuModels;



class UserManagementController extends BaseController
{
    protected $userModels;
    protected $subMenuModels;
    protected $validation;
    protected $acMenuId;

    protected $subMenu;
    protected $masterMenu;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) 
    {
        parent::initController($request, $response, $logger);
      
        $this->masterMenu = 'Master';
        $this->subMenu = 'User Management';

        $this->validation = service('validation');

    
        // ==============akses menu======================
      
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
       

        $data = [
            'masterMenu' => $this->masterMenu,
            'subMenu' => $this->subMenu,
            'role' =>  getRoleUser(), 
           
           // 'unit' =>  getUnit() // UTIL_HELPER
        ];

       
        return view('dashboard/user_management',$data);
        
    }


    public function dataUser()
    {
        // Menghitung jumlah total data
        $totalRecords = $this->userModels->where(['role !=' => 'super admin'])->countAll();
        // Konfigurasi pagination
	
         $perPage  =intval($this->request->getPost('length'));  // Jumlah data per halaman
         $start  =intval($this->request->getPost('start'));  // Indeks data awal
         $search = $this->request->getPost('search')['value']; // Kata kunci pencarian (opsional)



         // Mengambil data dengan pagination
         $data = $this->userModels->getData($perPage, $start, $search);
         $totalFiltered = $this->userModels->getDataCount($search);

         // Format data yang akan dikirimkan ke DataTables
        $result = [
            "draw" => $this->request->getPost('draw'), // Nomor draw (harus dikirimkan kembali ke DataTables)
            "recordsTotal" => $totalRecords, // Jumlah total data
            "recordsFiltered" => $totalFiltered, // Jumlah data setelah diterapkan filter (jika ada)
            "data" => $data // Data yang akan ditampilkan di tabel
        ];

        // Mengirimkan data dalam format JSON
        return $this->response->setJSON(  $result);
       
    }

    public function getDataUser()
    {
        $userId = $this->request->getPost('userId');
        $result = $this->userModels->where(['user_id' => $userId])->get()->getRow();
        return json_encode($result); 
    }

    public function cekAksesMenuUser()
    {
   
        $htmlScript = '';
        $userAkses = $this->userModels->select('akses_menu,akses_tombol')->where(['user_id' => $this->request->getPost('userId')])->get()->getRow()->akses_menu;
        $userAksesTombol = $this->userModels->select('akses_menu,akses_tombol')->where(['user_id' => $this->request->getPost('userId')])->get()->getRow()->akses_tombol;

        if ($userAkses != '-'){
            $userMm = explode(",", masterMenuUSER($userAkses)->mmakses);
        }else{
           
            $userMm = explode(",", "0");
        }

       

        foreach(getMasterMenu() as $m){
            $cekListM = '';
			if (in_array($m['id_mm'], $userMm)) {
				$cekListM = "checked";
			}

            $htmlScript .= '<li>
                            <input id="master-menu" name="masterMenu[]" value="'.$m['id_mm'].'" type="checkbox" '.$cekListM.'  /><label for="'.$m['cap_menu'].'"> '.$m['cap_menu'].'</label>
                            <ul>';
           
            foreach(getSubMenu($m['id_mm']) as $s){
                $cekListSm = '';
                if (in_array($s['id_menu'], explode(",",$userAkses))) {
                    $cekListSm = "checked";
                }

                $htmlScript .= '
                <li>
                <input id="sub-menu" type="checkbox"name="subMenu[]" value="'.$s['id_menu'].'" '.$cekListSm.'  /><label for="'.$s['cap_menu'].'">'.$s['cap_menu'].'</label>
                <ul>';

                foreach(getSubMenuButton($s['id_menu']) as $b){
                    $cekListSmb = '';
                    if (in_array($b['id_btn'], explode(",",$userAksesTombol))) {
                        $cekListSmb = "checked";
                    }
    
                    $htmlScript .= '
                    <li>
                    <input id="sub-menu" type="checkbox"name="subMenuBtn[]" value="'.$b['id_btn'].'" '.$cekListSmb.'  /><label for="'.$b['btn_name'].'">'.$b['btn_name'].'</label>
                    <ul>';
            
                    $htmlScript .= "</ul></li>";
                } // batas foreach sub menu 



                $htmlScript .= "</ul></li>";
            } // batas foreach sub menu 

            $htmlScript .= "</ul></li>";
         } // batas foreach menu master

         
       echo $htmlScript;
    }

    public function storeAksesMenuUser()
    {
        if(empty($this->request->getPost('subMenu[]'))){
            $data = [
                'akses_menu' =>  '-',
                'akses_tombol' =>   '-',
                
            ];
        }else{
            $aksesmenu = implode(",",$this->request->getPost('subMenu[]'));
            $aksesmenubtn = implode(",",$this->request->getPost('subMenuBtn[]'));
            $data = [
                'akses_menu' =>   $aksesmenu,
                'akses_tombol' =>   $aksesmenubtn,
               
            ];
        }

        
   
        if( $this->userModels->update($this->request->getPost('iduser'),$data)){
            session()->setFlashData("info",'Toastify({text: "Akses pengguna berhasil diperbaharui", duration: 4000,style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },}).showToast();');
            return  redirect()->back();
        }else{
            session()->setFlashData("info",'Toastify({text: "Akses pengguna Gagal diperbaharui", duration: 4000,style: {
                background: "linear-gradient(to right, #b00000, #f5b0b0)",
            },}).showToast();');
            return  redirect()->back();
        }
    }


    public function storeUser()
    {
       $store = $this->request->getPost();
       $userName = strtolower($store['username']);
     
       $data = [
            'nama' => $store['fullname'],
            'role' => $store['role'],
            'sts_aktif'=> $store['stsAktif'],
            'email'=> $store['email'],  
           // 'dashboard'=> $store['dashboard'],   
            'username' => strtolower($store['username']),
            'password' => strtolower($store['password'])
        ];

       if( $store['action'] == 'tambah'){

          // Coba simpan data
          if (!$this->userModels->save($data)) {
            // Jika validasi gagal, kembalikan error
            return redirect()->back()->withInput()->with('errors', $this->userModels->errors());
          }else{
            // Jika validasi berhasil, kembalikan pesan sukses
            session()->setFlashData("info",'Toastify({text: "Pengguna Berhasil Ditambahkan", duration: 4000,style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },}).showToast();');
             return  redirect()->back();
         }

       }elseif($store['action'] == 'edit'){
            $idUser = $this->request->getPost('iduser'); 
            // Cek apakah password diubah
            if (!empty($store['password'])) {
                $data['password'] = strtolower($store['password']); // Akan di-hash di model
            }
            // Mengganti placeholder {user_id} dengan ID pengguna yang sedang di-edit
            $this->userModels->setValidationRule('username', 'required|is_unique[tb_user.username,user_id,' . $idUser . ']');
            $this->userModels->setValidationRule('email', 'required|valid_email|is_unique[tb_user.email,user_id,' . $idUser . ']');
        
            if (!$this->userModels->update($this->request->getPost('iduser'), $data)) {
                return redirect()->back()->withInput()->with('errors', $this->userModels->errors());
            }else{
                session()->setFlashData("info",'Toastify({text: "Pengguna berhasil diperbaharui", duration: 4000,style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },}).showToast();');
                return  redirect()->back();
            }
        
       }
    }
   
    public function cekUser()
    {
        $userName = $this->request->getPost('username');
  
        $result = $this->userModels->where(['username' => $userName])->get()->getRow();
        if($result){
            return json_encode(true);
        }else{
            return json_encode(false);
        }

  
    }




    // ================================== Mode Maintenance==========================================================

    public function test()
    {
    //     // Mendapatkan alamat IP lokal client
    // $clientIP = $this->request->getIPAddress();

    // // Sekarang Anda dapat menggunakan $clientIP sesuai kebutuhan
    // echo "Alamat IP Lokal Client: " . $clientIP;


    // $totalRecords =  $this->db->table('tb_menu_master')->countAll();
    // dd($totalRecords);
    }
}
