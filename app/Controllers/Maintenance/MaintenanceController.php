<?php

namespace App\Controllers\Maintenance;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\Maintenance\SettingsModels;

use App\Controllers\BaseController;
use Config\Maintenance;
use App\Models\User\UserModels;
use App\Models\SubMenu\SubMenuModels;

class MaintenanceController extends BaseController
{

    protected $settingsModels;
    protected $acMenuId;
    protected $subMenu;
    protected $masterMenu;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) 
    {
        parent::initController($request, $response, $logger);

        $this->settingsModels = new SettingsModels();
        $this->masterMenu = 'Master';
        $this->subMenu = 'Maintenance Mode';
        

        // ==============akses menu======================
        $this->userModels = new UserModels();
        $this->subMenuModels = new SubMenuModels();

        // $userAkses = $this->userModels->select('akses_menu')->where(['user_id' => session()->get('iduser')])->get()->getRow()->akses_menu;
        // $this->acMenuId = $this->subMenuModels->select('id_menu')->where(['cap_menu' => $this->subMenu])->get()->getRow()->id_menu;
           
       
        // if(session()->get('role') != 'Super Admin'){

        //     if(strpos( $userAkses ,$this->acMenuId) === false){
        //         $response->redirect(base_url(session()->get('dashboard')));
        //     }
    
        // }
        
        
    }
    public function index()
    {

    
        $MM = $this->settingsModels->select('value,ip_address_access,dr_maintenance')->where("uraian" , 'mode_maintenance')->get()->getRow();
        if($MM->value == 'Y'){
            $mode = 'checked';
        }else{
            $mode = '';
        }
       
        $data = [
            'masterMenu' => $this->masterMenu,
            'subMenu' => $this->subMenu,
            'mode' => $mode,
            'ip' => $MM->ip_address_access,
            // 'logs' =>  array_reverse($matches[0])
        ];
        return view('errors/SetModeMaintance',$data);
        
    }

    public function setModeMaintenance()
    {

        if($this->request->getPost('action') == 'cmm'){
            $data = [
                'value' =>   $this->request->getPost('status')
           ];
        }else if($this->request->getPost('action') == 'ip'){
            $data = [
                'ip_address_access' =>   $this->request->getPost('ip')
           ];
        }
      
       
       if( $this->maintenanceodels->update('1',$data)){
                echo "berhasil";
        }else{
                echo "gagal";
        }
 
   
    }

    public function cekMaintenance()
    {
        $MM = $this->settingsModels->select('value,ip_address_access,dr_maintenance')->where("uraian" , 'mode_maintenance')->get()->getRow();
        //$waktuSekarang = date('Y-m-d H:i:s');
       // $waktuTarget = strtotime("2023-09-27 13:51:00");
        $waktuSekarang = time();

        
        if(strtotime($MM->dr_maintenance) < $waktuSekarang){

            $data = [
                     'value' =>   'T'
                ];
            if( $this->settingsModels->update('2',$data)){
                
                return redirect()->to(base_url(''));

            }
       
        }else{
            return redirect()->to(base_url(''));
        }
        
    }

    public function startServer()
    {
//         // // Jalankan Workerman WebSocket server
//         $output = shell_exec('php /workerman/WebSocketServer.php start');
//         // Display the list of all files and directories
// echo "<pre>$output</pre>";

        // return "Workerman server started!";
// Perintah yang akan dijalankan
$command = 'bash workerman/run-server.sh';

// Menjalankan perintah dan menyimpan hasilnya
$output = shell_exec($command);

// Menampilkan hasil output
if ($output) {
    echo "Versi PHP yang terinstal:<br>";
    echo nl2br($output);  // Menggunakan nl2br untuk memformat output dengan baris baru
} else {
    echo "Gagal menjalankan perintah php -v.";
}


    }
}
