<?php

namespace App\Controllers\UserProfile;

use App\Controllers\BaseController;
use App\Models\User\UserModels;

class UserProfileController extends BaseController
{
    protected $userModels;
   

    public function __construct()
    {
        $this->userModels = new UserModels();
     
    }

    public function index()
    {
        $data = [
            'masterMenu' => 'Master',
            'subMenu' => 'User Management',
            'userData' => $this->userModels->where(['user_id' => session()->get('iduser')])->get()->getRow()
        ];
        
       
        return view('dashboard/halaman_profile',$data);
    }

    public function updateProfile()
    {
       $dataPost = $this->request->getPost();
        $data = [];

       if($this->request->getPost('action') =='data-pribadi'){

            $data['nama'] = $this->request->getPost('fullname');
            $email = $dataPost['email'];

            if($email !== $this->request->getPost('cacheemail')){

                if($this->validate($this->userModels->getValidationRules())){
                   
                    $data['email'] =  $email;

                }else{
                        session()->setFlashData("info","Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Email sudah tersedia, silahkan gunakan Email yang lain',
                        })");
                      return redirect()->to($_SERVER['HTTP_REFERER']);
                }
            
            }

     
       }else{

            $userName = strtolower($dataPost['username']);
            $pass = strtolower($dataPost['password']);

            if($userName !== $this->request->getPost('cacheusername')){

                if($this->validate($this->userModels->getValidationRules())){
                   
                    $data['username'] =  $userName;

                }else{
                        session()->setFlashData("info","Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Username sudah tersedia, silahkan gunakan username yang lain',
                        })");
                      return redirect()->to($_SERVER['HTTP_REFERER']);
                }
            
            }
          
            if($pass !== $this->request->getPost('cahcepassword')){
                $data['password'] =  password_hash(strval($pass), PASSWORD_BCRYPT);
            }
  
       }

       if( $this->userModels->update($this->request->getPost('iduser'),$data)){
            session()->setFlashData("info",'Toastify({text: "Akses pengguna berhasil diperbaharui", duration: 4000,style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },}).showToast();');
            return redirect()->to($_SERVER['HTTP_REFERER']);
        }else{
            session()->setFlashData("info",'Toastify({text: "Akses pengguna Gagal diperbaharui", duration: 4000,style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },}).showToast();');
            return redirect()->to($_SERVER['HTTP_REFERER']);
        }
     
    }
}
