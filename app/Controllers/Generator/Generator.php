<?php

namespace App\Controllers\Generator;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Config\Database;
use App\Controllers\BaseController;
use App\Libraries\CrudGenerator;
use App\Models\Generator\Generator as GeneratorGenerator;
use App\Models\User\UserModels;
use App\Models\SubMenu\SubMenuModels;


class Generator extends BaseController
{
    protected $generator;
    protected $acMenuId;

    protected $subMenu;
    protected $masterMenu;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) 
    {
        parent::initController($request, $response, $logger);
        $this->masterMenu = 'Master';
        $this->subMenu = 'CRUD Generator';


        $this->generator = new GeneratorGenerator();

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
        $db = Database::connect();
        $data = [
            'masterMenu' => $this->masterMenu,
            'subMenu' => $this->subMenu,
            'databaseName' =>$db->database,
            
        ];
       
        return view('dashboard/generator',$data);

    }
    public function GetTableName()
    {
        $db = Database::connect();
        $table = $this->generator->getTableNames($db->database);
  
        echo json_encode($table);

    }

    public function GetTableKey()
    {  
        $primaryKey = $this->generator->getPrimaryKey($this->request->getPost('gettable'));
        echo json_encode($primaryKey);
    }

    public function GetTableField()
    {  
        $tableField = $this->generator->getTableColumns($this->request->getPost('tbname'));
        $htmlTag = '<div class="row">';
        $no=0;
        foreach($tableField as $tf){
            $no++;

            if($no == 1){
                $htmlTag .= '<div class="col-4 '.$tf.''.$no.'" >';
                $htmlTag .= '<h6>Nama Label </h6>
                            <input type="text" class="form-control" id="'.$tf.''.$no.'"  value="'.$tf.'" name="data-colom[]" readonly>  
                            <input type="hidden" class="form-control" name="data-field[]" value="'.$tf.'" >  ';
                $htmlTag .= '</div>';
                $htmlTag .= '<div class="col-4 '.$tf.''.$no.'">';
                $htmlTag .= '<h6>Input Type</h6>';
                $htmlTag .= '<fieldset class="form-group">
                                <select class="form-select" id="gettables"  name="data-type[]" readonly>
                                    <option value="">Tidak dapat di pilih</option>           
                                </select>
                            </fieldset> ';
                $htmlTag .= '</div>';
            }else{
          
            $htmlTag .= '<div class="col-4 '.$tf.''.$no.'" >';
            $htmlTag .= '<h6>Nama Label </h6>
                        <input type="text" class="form-control" id="'.$tf.''.$no.'"  value="'.$tf.'" name="data-colom[]">  
                        <input type="hidden" class="form-control" name="data-field[]" value="'.$tf.'" >  ';
            $htmlTag .= '</div>';

            if(strpos($tf, 'password') !== false){
                $htmlTag .= '<div class="col-4 '.$tf.''.$no.'">';
                $htmlTag .= '<h6>Input Type</h6>';
                $htmlTag .= '<fieldset class="form-group">
                                <select class="form-select" id="gettables"  name="data-type[]">
                                    <option value="">Silahkan Pilih</option>
                                    <option value="password" selected>Password</option>   
                                    <option value="email">Email</option>             
                                </select>
                            </fieldset> ';
                $htmlTag .= '</div>';
            } elseif(strpos($tf, 'email') !== false){
                $htmlTag .= '<div class="col-4 '.$tf.''.$no.'">';
                $htmlTag .= '<h6>Input Type</h6>';
                $htmlTag .= '<fieldset class="form-group">
                                <select class="form-select" id="gettables"  name="data-type[]">
                                    <option value="">Silahkan Pilih</option>
                                    <option value="password">Password</option>   
                                    <option value="email" selected>Email</option>             
                                </select>
                            </fieldset> ';
                $htmlTag .= '</div>';
            }else{
                $htmlTag .= '<div class="col-4 '.$tf.''.$no.'">';
                $htmlTag .= '<h6>Input Type</h6>';
                $htmlTag .= '<fieldset class="form-group">
                                <select class="form-select" id="gettables" name="data-type[]">
                                    <option value="">Silahkan Pilih</option>
                                    <option value="text">Text</option>
                                    <option value="password">Password</option>
                                    <option value="email">Email</option>                                
                                    <option value="select">Select Option</option>
                                    <option value="number">Number</option>
                                    <option value="date">Date</option>                              
                                    <option value="time">Time</option>
                                    <option value="datetime-local">Datetime Local</option>                                
                                    <option value="checkbox">Checkbox</option>
                                    <option value="radio">Radio</option>
                                    <option value="file">File</option>                                         
                                </select>
                            </fieldset> ';
                $htmlTag .= '</div>';
            }
        }

        if($no == 1){
            $htmlTag .= '<div class="col-4 '.$tf.''.$no.'">';
            $htmlTag .= '<button class="btn btn-danger mt-3 " type="button" data-id="'.$tf.''.$no.'" > Remove</button>';
            $htmlTag .= '</div>';
        }else{
            $htmlTag .= '<div class="col-4 '.$tf.''.$no.'">';
            $htmlTag .= '<button class="btn btn-danger mt-3 btn-remove" data-id="'.$tf.''.$no.'" > Remove</button>';
            $htmlTag .= '</div>';
        }
           
          
        }
        $htmlTag .= '</div>';
        $htmlTag .= '<button type="submit" class="btn btn-primary">Generate</button>';
        // $htmlTag .= '';
        
        echo json_encode($htmlTag);
    }

    public function generate()
    {
        
        $store = $this->request->getPost();
        //dd( $store);
       
        $modelFolderName = $store['nmcm'];
        $modelFileName = $store['nmcm']; 
        $fileNameView =  $store['nmview'];
        $file = 'app/Config/Routes.php';

        $modelCreator = new CrudGenerator();
        $fileModel = $modelCreator->createModel($modelFolderName, $modelFileName,$store['table'],$store['data-field'],$store['primary-key']);

        if ($fileModel) {
           
            $fileController = $modelCreator->createController($modelFolderName, $modelFileName,$store['data-field']);
            if ($fileController) {
                //echo 'File controller berhasil dibuat.';
                $fileView = $modelCreator->createView($fileNameView,$store['data-colom'],$store['table'],$store['data-field'],$store['data-type']);
                if($fileView){

                    $newRoute = '
                    $routes->group(\''.strtolower($modelFileName).'\', [\'filter\' => \'authfilter\'] function ($routes) {
                        $routes->get(\'/\', \''.strtolower($modelFileName).'\\'.strtolower($modelFileName). 'Controller::index\');
                        $routes->post(\'all-data\', \''.strtolower($modelFileName).'\\'.strtolower($modelFileName).'Controller::allData\'); 
                        $routes->post(\'get-data-one\', \''.strtolower($modelFileName).'\\'.strtolower($modelFileName).'Controller::getDataOne\');  
                        $routes->post(\'store\',  \''.strtolower($modelFileName).'\\'.strtolower($modelFileName).'Controller::storeData\'); 
                        $routes->post(\'delete-data\',\''.strtolower($modelFileName).' \\'.strtolower($modelFileName).'Controller::remove\');
                    });
                    ';

                    // Cek apakah file dapat dibuka
                    if (is_writable($file)) {
                        // Baca isi file ke dalam string
                        $contents = file_get_contents($file);

                        // Tambahkan teks ke bagian akhir file (atau sesuai dengan kebutuhan)
                        $contents .= "\n" . $newRoute . "\n";

                        // Tulis kembali isi file
                        if (file_put_contents($file, $contents) === false) {
                    
                            session()->setFlashData("info",'Toastify({text: "Gagal menambahkan teks ke file.", duration: 4000,style: {
                                background: "linear-gradient(to right, #b00000, #f5b0b0)",
                            },}).showToast();');
                            return  redirect()->back();
                        } else {     
                            
                            session()->setTempdata('item', '
                            <div>
                                <div class="alert alert-info " role="alert">
                                akses Url berikut <code class="text-light fw-bold">'.base_url(''.strtolower($modelFileName).'').'</code>
                                </div>                                   
                            </div>
                            ', 300);

                            session()->setFlashData("info",'Toastify({text: "File CRUD Berhasil Dibuat", duration: 4000,style: {
                                background: "linear-gradient(to right, #00b09b, #96c93d)",
                            },}).showToast();');

                            return  redirect()->back();
                        }
                    } else {
                  
                        session()->setFlashData("info",'Toastify({text: "File tidak dapat ditulis.", duration: 4000,style: {
                            background: "linear-gradient(to right, #b00000, #f5b0b0)",
                        },}).showToast();');
                        return  redirect()->back();
                    }
                   
                    

                }else{
                    session()->setFlashData("info",'Toastify({text: "File View Gagal Dibuat", duration: 4000,style: {
                        background: "linear-gradient(to right, #b00000, #f5b0b0)",
                    },}).showToast();');
                    return  redirect()->back();
                }
            } else {
               // echo 'Gagal membuat file controller.';
                session()->setFlashData("info",'Toastify({text: "File Controller Gagal Dibuat", duration: 4000,style: {
                    background: "linear-gradient(to right, #b00000, #f5b0b0)",
                },}).showToast();');
                return  redirect()->back();
            }

        } else {
           // echo 'Gagal membuat file model.';
            session()->setFlashData("info",'Toastify({text: "File Model Gagal Dibuat", duration: 4000,style: {
                background: "linear-gradient(to right, #b00000, #f5b0b0)",
            },}).showToast();');
            return  redirect()->back();
        }

    }
}
