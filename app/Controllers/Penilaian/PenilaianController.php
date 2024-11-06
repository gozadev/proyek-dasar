<?php  namespace App\Controllers\Penilaian;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\Penilaian\PenilaianModel;
use App\Models\Penilaian\QuisonerModel;

use App\Models\User\UserModels;
use App\Models\SubMenu\SubMenuModels;

class PenilaianController extends BaseController {
    
    protected $PenilaianModels;
    Protected $QuisonerModels;
   
    protected $acMenuId;
    protected $subMenu;
    protected $masterMenu;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)  {
        parent::initController($request, $response, $logger);

        $this->masterMenu = "Transaksi";
        $this->subMenu = "Penilaian";
        $this->PenilaianModels = new PenilaianModel();
        $this->QuisonerModels = new QuisonerModel();
        

        // ==============akses menu======================
        $uri = $this->request->getUri();
        $this->userModels = new UserModels();
        $this->subMenuModels = new SubMenuModels();
        $userAkses = $this->userModels->select("akses_menu")->where(["user_id" => session()->get("iduser")])->get()->getRow()->akses_menu;
        $this->acMenuId = $this->subMenuModels->select("id_menu")->where(["cap_menu" => $this->subMenu])->get()->getRow()->id_menu;
        
        if(session()->get("role") != "Super Admin"){
            if(strpos( $userAkses ,$this->acMenuId) === false){
                $response->redirect(base_url(session()->get("dashboard")));
            }
        }
                
    }

    public function index(){             
        $data = [
            "masterMenu" => $this->masterMenu,
            "subMenu" => $this->subMenu,
            "menuId" => 5,// harap isi dengan id menu sesuai dengan yang ada di database
            "getBulan" => $this->PenilaianModels->getBulan(),
            ];
              
            //dd($this->PenilaianModels->getBulan());
        return view("Penilaian/PenilaianView",$data);     
    }

    public function quesioner($pg){             

        // jika id tidak ada maka redirect ke halaman default user
        if( $this->PenilaianModels->where(["Id_pn" => $pg])->countAllResults() < 1){
            if(session()->get('role') != 'Super Admin'){    
                return redirect()->to(base_url(session()->get("dashboard")."/penilaian"));
            }else{
                return redirect()->to(base_url('dashboard'));
            }
           
        }
        
        $getDataOne = $this->PenilaianModels->where(["Id_pn" => $pg])->get()->getRow();
   
        $data = [
             "masterMenu" => $this->masterMenu,
             "subMenu" => $this->subMenu,
             "quis" => $this->QuisonerModels->findAll(),
             "dataOne" => $getDataOne,
            ];
              
         //   dd($data["quis"]);
        return view("Penilaian/Quesioner",$data);     
    }

    public function allData(){
        // Menghitung jumlah total data
        //$totalRecords = $this->PenilaianModels->where(["role !=" => "super admin"])->countAll();
        // Konfigurasi pagination
            
       $perPage = intval($this->request->getPost("length")); // Jumlah data per halaman
       $start = intval($this->request->getPost("start")); // Indeks data awal
       $search = $this->request->getPost("search")["value"]; // Kata kunci pencarian (opsional)
        $filter = $this->request->getPost("filter"); 

        // $perPage =10; // Jumlah data per halaman
        // $start = 0; // Indeks data awal
        // $search = ''; // Kata kunci pencarian (opsional)
            
        // Mengambil data dengan pagination
        $data = $this->PenilaianModels->getData($perPage, $start, $search,$filter);
        $totalFiltered = $this->PenilaianModels->getDataCount($search,$filter);

        // Format data yang akan dikirimkan ke DataTables
        $result = [
            "draw" => $this->request->getPost("draw"), // Nomor draw (harus dikirimkan kembali ke DataTables)
            "recordsTotal" => $totalFiltered, // Jumlah total data
            "recordsFiltered" => $totalFiltered, // Jumlah data setelah diterapkan filter (jika ada)
            "data" => $data // Data yang akan ditampilkan di tabel
        ];
        // Mengirimkan data dalam format JSON
        return $this->response->setJSON($result);        
        }

        public function getDataOne() {
            $idField = $this->request->getPost("fieldId");
            $result = $this->PenilaianModels->where(["nik" => $idField])->get()->getRow();
            return json_encode($result); 
        }

        public function storeData(){
            try {
                 $store = $this->request->getPost();   
                //  $store["radio_value"]
                //  $store["nilai"]

                $data = [
                    "tgl" =>date('Y-m'),
                    "jb" =>implode(",", str_replace(' ', '', $store["radio_value"])),
                    "nljb" =>implode(",", str_replace(' ', '', $store["nilai"])),
                ];
              // dd($store);
               // dd(implode(",", $store["nilai"]));
                    // if($store["action"] =="tambah"){
                       
                  
                        // if($this->PenilaianModels->save($data)){
                        //         session()->setFlashData("info","Toastify({text: 'Data Berhasil Ditambahkan', duration: 4000,style: {
                        //             background: 'linear-gradient(to right, #00b09b, #96c93d)',
                        //         },}).showToast();");
                        //         return redirect()->back();
                        // }else{
                        //         session()->setFlashData("info","Toastify({text: 'Pengguna Gagal Ditambahkan', duration: 4000,style: {
                        //             background: 'linear-gradient(to right, #b00000, #f5b0b0)',
                        //         },}).showToast();");
                        //         return redirect()->back();
                        // }
                                                
                    // }elseif($store["action"] =="edit"){ // edit data
                    //     $data = [
                         
                    //    ];
                        
                        if( $this->PenilaianModels->update(4,$data)){
                            session()->setFlashData("info","Toastify({text: 'Data berhasil diperbaharui', duration: 4000,style: {
                                    background: 'linear-gradient(to right, #00b09b, #96c93d)',
                             },}).showToast();");
                             return redirect()->back();
                        }else{
                            session()->setFlashData("info","Toastify({text: 'Data Gagal diperbaharui', duration: 4000,style: {
                                    background: 'linear-gradient(to right, #b00000, #f5b0b0)',
                            },}).showToast();");
                            return redirect()->back();
                        }
                           
                      
                    // }
                    

                } catch (\CodeIgniter\Security\Exceptions\SecurityException $e) {
                        // Tangani pengecualian CSRF
                        echo "CSRF validation failed: " . $e->getMessage();
                        // Atau, lakukan tindakan lain yang sesuai, seperti mengarahkan pengguna kembali ke formulir dengan pesan kesalahan
                }                                           
        }

        public function remove(){
            if($this->PenilaianModels->delete(["nik" , $this->request->getPost("fieldId")])){
                 echo json_encode("success");
            }else{
                echo json_encode("failed");
            }
        }

}