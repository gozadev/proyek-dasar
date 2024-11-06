<?php  namespace App\Controllers\Test;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\Test\TestModel;

class TestController extends BaseController {
    
    protected $testModels;
    protected $validation;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)  {
        parent::initController($request, $response, $logger);

        $this->testModels = new TestModel();
        
        $this->validation = service('validation');


                // ==============akses menu======================
                // $userAkses = $this->userModels->select("akses_menu")->where(["user_id" => session()->get("iduser")])->get()->getRow()->akses_menu;
                // if(session()->get("role") != "Super Admin"){

                //     if(strpos( $userAkses ,"1") === false){
                //         $response->redirect(base_url("dashboard"));
                //     }
            
                // }
                
    }

    public function index(){             
        $data = [
            "masterMenu" => "Master",
            "subMenu" => "Tanpa nama",
            "menuId" => 5
            ];
              
        return view("test/testView",$data);     
    }

    public function allData(){
        // Menghitung jumlah total data
        $totalRecords = $this->testModels->where(["role !=" => "super admin"])->countAll();
        // Konfigurasi pagination
            
        $perPage = intval($this->request->getPost("length")); // Jumlah data per halaman
        $start = intval($this->request->getPost("start")); // Indeks data awal
        $search = $this->request->getPost("search")["value"]; // Kata kunci pencarian (opsional)
            
        // Mengambil data dengan pagination
        $data = $this->testModels->getData($perPage, $start, $search);
        $totalFiltered = $this->testModels->getDataCount($search);

        // Format data yang akan dikirimkan ke DataTables
        $result = [
            "draw" => $this->request->getPost("draw"), // Nomor draw (harus dikirimkan kembali ke DataTables)
            "recordsTotal" => $totalRecords, // Jumlah total data
            "recordsFiltered" => $totalFiltered, // Jumlah data setelah diterapkan filter (jika ada)
            "data" => $data // Data yang akan ditampilkan di tabel
        ];
        // Mengirimkan data dalam format JSON
        return $this->response->setJSON($result);        
        }

        public function getDataOne() {
            $idField = $this->request->getPost("fieldId");
            $result = $this->testModels->where(["id" => $idField])->get()->getRow();
            return json_encode($result); 
        }

        public function storeData(){
            try {
                 $store = $this->request->getVar();   
                    if($store["action"] =="tambah"){
                       
                       $data = [
                            "input1"=> $store["input1"],
                            "input2"=> $store["input2"],
                            "input3"=> $store["input3"],
                            "input4"=> $store["input4"],
                            "input5"=> $store["input5"],
                            "input6"=> $store["input6"],

                       ];
                     

                       $this->validation->setRules([
                            "input1" => "required|is_unique[tb_test.input3]",
                            "input2" => "required|valid_email",
                            "input3" => "required",
                            "input4" => "required",
                            "input5" => "required",
                            "input6" => "required",
                       ],
                       [
                        "input1" =>[                  
                            'required'   => 'Username wajib diisi.',
                            'is_unique'  => 'Username sudah digunakan, silakan pilih yang lain.'                          
                        ],
                        "input2" => [
                            'required'   => 'Password wajib diisi.',
                            'valid_email' => 'Masukkan email yang valid.'                          
                        ],
                       ]
                    );

                       if (!$this->validate($this->validation->getRules())) {
                            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
                        }

                        if($this->testModels->save($data)){
                                session()->setFlashData("info","Toastify({text: 'Data Berhasil Ditambahkan', duration: 4000,style: {
                                    background: 'linear-gradient(to right, #00b09b, #96c93d)',
                                },}).showToast();");
                                return redirect()->to($_SERVER["HTTP_REFERER"]);
                        }else{
                                session()->setFlashData("info","Toastify({text: 'Pengguna Gagal Ditambahkan', duration: 4000,style: {
                                    background: 'linear-gradient(to right, #b00000, #f5b0b0)',
                                },}).showToast();");
                                return redirect()->to($_SERVER["HTTP_REFERER"]);
                        }
                                                
                    }elseif($store["action"] =="edit"){ // edit data
                        $data = [
                            "input1"=> $store["input1"],
                            "input2"=> $store["input2"],
                            "input3"=> $store["input3"],
                            "input4"=> $store["input4"],
                            "input5"=> $store["input5"],
                            "input6"=> $store["input6"],

                       ];
                        
                        if( $this->testModels->update($store["fieldId"],$data)){
                            session()->setFlashData("info","Toastify({text: 'Data berhasil diperbaharui', duration: 4000,style: {
                                    background: 'linear-gradient(to right, #00b09b, #96c93d)',
                             },}).showToast();");
                            return redirect()->to($_SERVER["HTTP_REFERER"]);
                        }else{
                            session()->setFlashData("info","Toastify({text: 'Data Gagal diperbaharui', duration: 4000,style: {
                                    background: 'linear-gradient(to right, #b00000, #f5b0b0)',
                            },}).showToast();");
                             return redirect()->to($_SERVER["HTTP_REFERER"]);
                        }
                           
                      
                    }
                    

                } catch (\CodeIgniter\Security\Exceptions\SecurityException $e) {
                        // Tangani pengecualian CSRF
                        echo "CSRF validation failed: " . $e->getMessage();
                        // Atau, lakukan tindakan lain yang sesuai, seperti mengarahkan pengguna kembali ke formulir dengan pesan kesalahan
                }                                           
        }

        public function remove(){
            if($this->testModels->delete(["id" , $this->request->getPost("fieldId")])){
                 echo json_encode("success");
            }else{
                echo json_encode("failed");
            }
        }

}