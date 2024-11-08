<?php

namespace App\Controllers;

use App\Models\Indikator\OpenCloseModel;
use App\Models\Maintenance\SettingsModels;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Config\Maintenance;
use CodeIgniter\I18n\Time;
use App\Libraries\Captcha;
use App\Models\User\UserModels;
use CodeIgniter\Database\Exceptions\DatabaseException;


class Home extends BaseController
{
   
    protected $settingsModels;

    protected $captcha;
   
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) 
    {
        parent::initController($request, $response, $logger);

       $this->captcha = new Captcha(session()); 
        $this->settingsModels = new SettingsModels();
    
      
        
    }
    public function index()
    {
  
        try {
            // Mencoba untuk terhubung ke database
            $db = \Config\Database::connect();
            $dbName = getEnv("database.default.database");
            $result = $db->query("SHOW DATABASES LIKE '$dbName'")->getResult();
            $MM = $this->settingsModels->select('value,ip_address_access,dr_maintenance')->where("uraian" , 'mode_maintenance')->get()->getRow();
            $settings = $this->settingsModels->select('value as signUp')->where("uraian" , 'signUp')->get()->getRow();
            $tLogin = $this->settingsModels->select('value as tLogin')->where("uraian" , 'Login')->get()->getRow();
            $data = [
                'durasi' => $MM->dr_maintenance,
                'signUp' => $settings->signUp,             
            ];
          
            if($MM->value == 'Y'){
             //   dd($this->request->getIPAddress());
                if(strpos($MM->ip_address_access,$this->request->getIPAddress()) !== false){
                    // return view('FrontEnd/index');
                   // return view('auth/index',$data);
                   return view('auth/login/login'.$tLogin->tLogin,$data);
                }else{
                
                    return view('errors/maintance',$data);
                }
            
            }else{
               
                //return view('auth/index',$data);
                return view('auth/login/login'.$tLogin->tLogin,$data);
            }

            } catch (DatabaseException $e) {
                // Tangkap pengecualian koneksi database
                log_message('error', 'DatabaseException: ' . $e->getMessage());
            
                return view('errors/databaseNotFound');
            } 
   
    }


    public function daftar()
    {

        // $MM = $this->maintenanceodels->select('mode_maintenance,ip_access,dr_maintenance')->get()->getRow();
        $MM = $this->settingsModels->select('value,ip_address_access,dr_maintenance')->where("uraian" , 'mode_maintenance')->get()->getRow();
            
        if($MM->value == 'Y'){
            if(strpos($MM->ip_address_access,$this->request->getIPAddress()) !== false){
                // return view('FrontEnd/index');
                return view('auth/daftar');
            }else{
                $data = [
                    'durasi' => $MM->dr_maintenance
                ];
                return view('errors/maintance',$data);
            }
           
        }else{
            // return view('FrontEnd/index');
            return view('auth/daftar');
        }
        
    }

   


    public function hashPassword()
    {
       
        $hashedPassword = password_hash('a', PASSWORD_BCRYPT);
        echo $hashedPassword;
    }

    public function test()
    {

     
    }

    private function incrementLoginAttempts($userId)
    {
        // Tambahkan logika untuk menghitung percobaan login yang gagal
        // Misalnya dengan menggunakan session atau database untuk menyimpan jumlah percobaan

        // Contoh sederhana:
        $attempts = session()->get('login_attempts_' . $userId) ?? 0;
        $attempts++;
        session()->set('login_attempts_' . $userId, $attempts);

        if ($attempts >= 5) { // Batas percobaan login gagal adalah 5
            session()->remove('login_attempts_' . $userId);
            return true; // Kunci akun
        }

        return false; // Jangan kunci akun
    }

    private function reconnectDatabase(string $databaseName)
    {
        // Mengambil konfigurasi database
        $config = config('Database');

        // Mengubah nama database yang terhubung
        $config->defaultGroup = 'default';
        $config->default['database'] = $databaseName;

        // Membuat koneksi baru dengan database yang telah dibuat
        \Config\Database::connect($config->defaultGroup);
     
    }

    public function displayCaptcha() {
      //  $captcha = new Captcha(session());
       
      }

        
}
