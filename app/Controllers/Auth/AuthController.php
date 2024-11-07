<?php

namespace App\Controllers\Auth;
use CodeIgniter\Log\Logger;
use App\Controllers\BaseController;
use App\Models\User\UserModels;
use App\Models\Menu\MenuModels;
use App\Libraries\Captcha;
use CodeIgniter\I18n\Time;
class AuthController extends BaseController
{

    protected $userModels;
    protected $logger;
    protected $menuModels;
    protected $throttler;


    protected $captcha;

    public function __construct()
    {
        $this->userModels = new UserModels();
        $this->menuModels = new MenuModels();
        $this->captcha = new Captcha(session()); 
            // ===================================================
        $this->throttler = service('throttler');
        $this->logger = service('logger');
      
    }

    public function index()
    {
        //
    }


    public function akunLook($waktu)
    {
        return view('auth/AkunLook', ['waktu' => $waktu]);
    }

    public function tidakAdaAkses()
    {
        return view('auth/TidakAdaAkses');
    }

    public function generateCaptcha()
    {
        $this->captcha->draw(); // Menampilkan CAPTCHA sebagai gambar
    }

    public function prosesLogin()
    {
        // proses login 
        try {
            
                $user = strtolower($this->request->getVar('username'));
                $pass = strtolower($this->request->getVar('password'));
                $throttler = \Config\Services::throttler();
                $captcha = $this->request->getVar('captcha');
                $ipAddress = $this->request->getIPAddress();
                if ($ipAddress === '::1') {
                    $ipAddress = '127.0.0.1';
                }
    
                if($this->captcha->verify( $captcha)){
                    // ================================================ 
                   
                    $result = $this->userModels->where("email= '$user' OR username = '$user'" )->get()->getRowArray();
                   
                    $baseURL = base_url('dashboard');
                    $redirectUrl = base_url();
                    if($result){

                        // Cek apakah akun terkunci
                        if ($result['locked_until'] && $result['locked_until'] && Time::now()->isBefore($result['locked_until'])) {
                            $remainingTime = Time::now()->difference($result['locked_until'])->humanize();
                            session()->setFlashdata('info', '<div class="alert alert-success" role="alert">Akun Anda terkunci. Coba lagi setelah ' . $remainingTime.'</div>');
                            return redirect()->to(base_url());
                            
                        }
                       
                        if (password_verify($pass, $result['password'])) {
                            // berhasil login
                         
                            session()->set('isLoggedIn', true);
                            session()->set('fullname', $result['nama']);
                            session()->set('iduser', $result['user_id']);
                            session()->set('aksesMenu', $result['akses_menu']);
                            session()->set('aksesTombol', $result['akses_tombol']);
                            session()->set('role', $result['role']);
                            session()->set('bagian', $result['bagian']);
                            session()->set('unit', $result['unit']);
                 
                            if($result['sts_aktif'] == 'Y'){
                                // Pengguna Aktif
                                if($result['role'] != 'Super Admin'){       
                                    // bukan Super Admin
                                    if($result['akses_menu'] == '-'){
                                        // belum memiliki akses menu
                                        return redirect()->to(base_url('akun-akses'));
                                    }else{
                                        $dash = $this->menuModels->select('link')->where('id_menu',substr($result['akses_menu'],0,1))->get()->getRowArray();
                                       
                                        session()->set('dashboard', $dash['link']);
                                    }                                           
                                    return redirect()->to(base_url($dash['link']));
                                }else{
                                    // Super Admin
                                    return redirect()->to(base_url('dashboard'));
                                }
                                
                               //pengguna tidak aktif
                            }else{
                                session()->setFlashdata('info', '<div class="alert alert-danger" role="alert">Pengguna sudah tidak aktif</div>'); 
                                return redirect()->to(base_url());
                          }
                         
                          //password Salah
                        } else {
                          
                            // Tambah logika untuk menghitung percobaan login yang gagal
                            if ($this->incrementLoginAttempts($result['user_id'])) {
                                // Kunci akun jika percobaan login gagal mencapai batas
                                $lockTime = Time::now()->addMinutes(3); // Kunci akun selama 5 menit                      
                                if($this->userModels->update($result['user_id'], [
                                    'locked_until' => $lockTime
                                ])){
                                    session()->setFlashdata('info', '<div class="alert alert-danger" role="alert">Akun Anda telah dikunci. Coba lagi setelah 3 menit.</div>');
                                   // return redirect()->to(base_url('akun-look/'.$lockTime));
                                    return redirect()->to(base_url());
                                }else{
                                    return redirect()->to(base_url());
                                }

                               
                             
                            } else {
                                session()->setFlashdata('info', '<div class="alert alert-danger" role="alert">Harap isi password dengan benar </div>'); 
                                return redirect()->to(base_url());
                            }

                            
                           
                        }
                        
                    }else{


                            if (!$this->throttler->check(md5($ipAddress), 2, 120)) { // 5 percobaan login per 5 menit
                                session()->setFlashdata('info', '<div class="alert alert-warning" role="alert">Terlalu banyak percobaan login. Silakan coba lagi setelah 2 menit.</div>');
                                return redirect()->to(base_url());
                            }


                                session()->setFlashdata('info', '<div class="alert alert-danger" role="alert">Harap isi username  dengan benar </div>');
                                return redirect()->to(base_url());
                    }

                }else{
                    session()->setFlashdata('info', '<div class="alert alert-danger" role="alert">Code Captcha tidak sesuai </div>');
                    return redirect()->to(base_url());
                }
        } catch (\CodeIgniter\Security\Exceptions\SecurityException $e) {
            // Tangani pengecualian CSRF
            echo "CSRF validation failed: " . $e->getMessage();
            // Atau, lakukan tindakan lain yang sesuai, seperti mengarahkan pengguna kembali ke formulir dengan pesan kesalahan
        }
    }

    public function prosesDaftar()
    {
        // proses login 
        try {
            
                $nama = $this->request->getVar('nama');
                $email = $this->request->getVar('email');
                $pass = strtolower($this->request->getVar('password'));
                $username = strtolower($this->request->getVar('username'));

                // $user = $this->request->getVar('username');
                // $pass = $this->request->getVar('password');

            
                $captcha = $this->request->getVar('captcha');

                if ($captcha == session()->get('my_captcha')) {

                    // ================================================
                    $result = $this->userModels->where(['email' => $email])->get()->getRowArray();
                  
                   
                    if($result){
                        session()->setFlashdata('info', '<div class="alert alert-danger" role="alert">Email sudah terdaftar silahkan login</div>');
                        return redirect()->to(base_url('daftar'));
                    }else{
                        $data = [
                            'nama' => $nama,
                            'email' => $email,
                            'username' => $username,
                            'password' => password_hash(strval($pass), PASSWORD_BCRYPT),
                            'sts_aktif' => 'Y'
                        ];
                        if( $this->userModels->save($data)){
                            session()->setFlashdata('info', '<div class="alert alert-success" role="alert">Anda berhasil mendaftar</div>');
                            return redirect()->to(base_url());
                        }else{
                            session()->setFlashdata('info', '<div class="alert alert-danger" role="alert">Gagal dalam melakukan mendaftar</div>');
                            return redirect()->to(base_url('daftar'));
                        }
                      //  dd($data);
                    }

                }else{
                    session()->setFlashdata('info', '<div class="alert alert-danger" role="alert">Code Captcha tidak sesuai </div>');
                    return redirect()->to(base_url('daftar'));
                }
        } catch (\CodeIgniter\Security\Exceptions\SecurityException $e) {
            // Tangani pengecualian CSRF
            echo "CSRF validation failed: " . $e->getMessage();
            // Atau, lakukan tindakan lain yang sesuai, seperti mengarahkan pengguna kembali ke formulir dengan pesan kesalahan
        }
    }

    public function logout()
    {
        
       
        $user = session()->get('fullname');
          
        $this->logger->info("[USER] Pengguna dengan user $user logout.");
        session()->destroy();
        return redirect()->to(base_url());
  
		
    }

    private function incrementLoginAttempts($userId)
    {
        // Tambahkan logika untuk menghitung percobaan login yang gagal
        // Misalnya dengan menggunakan session atau database untuk menyimpan jumlah percobaan

        // Contoh sederhana:
        $attempts = session()->get('login_attempts_' . $userId) ?? 0;
        $attempts++;
        session()->set('login_attempts_' . $userId, $attempts);

        if ($attempts >= 3) { // Batas percobaan login gagal adalah 5
            session()->remove('login_attempts_' . $userId);
            return true; // Kunci akun
        }

        return false; // Jangan kunci akun
    }

    public function aksesTombol()
    {
        $dataId = $this->request->getPost("dataId");
        $menuId = $this->request->getPost("menuid");
        // $dataId = 2;
        // $menuId = 5;
       return getAcctombol(session()->get("iduser"),$dataId,$menuId);
       //dd( getAcctombol(7,$dataId,$menuId));

    }

   
}
