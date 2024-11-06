<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\User\UserModels;

class DashboardController extends BaseController
{
   // protected $userModels;
   

    public function __construct()
    {
      //  $this->userModels = new UserModels();
     
    }

    public function index()
    {
        $data = [
            'masterMenu' => 'Dashboard',
            'subMenu' => '',
           // 'userData' => $this->userModels->where(['user_id' => session()->get('iduser')])->get()->getRow()
        ];
        
       // dd($data);
       
        return view('Dashboard/Dashboardsocket',$data);
    }

}
