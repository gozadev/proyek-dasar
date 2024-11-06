<?php
namespace App\Libraries;


class CrudGenerator {

    public function createModel($modelFolderName, $modelFileName,$tableName,$fields,$key){

        // Inisialisasi string kosong
        $resultString = '';

        // Iterasi dimulai dari indeks 1 untuk menghindari elemen pertama
        for ($i = 1; $i < count($fields); $i++) {
            $resultString .= '"' . $fields[$i] . '",';
        }

        // Menghapus koma terakhir
        $resultString = rtrim($resultString, ',');

        $modelDirectory = APPPATH . 'Models/' . ucwords($modelFolderName ). '/';
        
        if (!is_dir($modelDirectory)) {
            mkdir($modelDirectory, 0755, true);
        }
        
$modelContent = '<?php namespace App\Models\\' . ucwords($modelFolderName) . ';
use CodeIgniter\Model;

class ' . ucwords($modelFileName) . 'Model extends Model
{
    protected $DBGroup          = "default";
    protected $table            = "'.$tableName.'";
    protected $primaryKey       = "'.$key.'";
    protected $allowedFields    = [' .$resultString. '];
    // Definisi model Anda di sini

    public function getData($perPage, $start, $search = ""){
        
        $builder = $this->table($this->table);
                    
            if (!empty($search)) {
                $builder->like("", $search); // silahkan sesuaikan sendiri filter pencarian 
                // ->orLike("", $search);        
                // ...
            }

        $builder->orderBy("'.$fields[0].'", "DESC")->limit($perPage, $start);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getDataCount($search = ""){	
        $builder = $this->table($this->table);
        if (!empty($search)) {
            $builder->like("", $search); // silahkan sesuaikan sendiri filter pencarian 
            // ->orLike("", $search);
        }
        return $builder->countAllResults();
    }


}';

        $fileCreated = file_put_contents($modelDirectory . ucwords($modelFileName)."Model.php", $modelContent);

        return $fileCreated !== false;
    }

    public function createController($modelFolderName, $modelFileName,$fields){

        // $data = [];
    
        //  foreach ($fields as $key) {
        //     $data[$key] = $key;
        // }

        $html = "";
        for($i=1; $i <= (sizeof($fields,1)-1); $i++){
	
            $html .= '"'.$fields[$i].'"=> $store["'.$fields[$i].'"],'. "\xA";
        }
        

        $modelDirectory = APPPATH . 'Controllers/' . ucwords($modelFolderName) . '/';
        
        if (!is_dir($modelDirectory)) {
            mkdir($modelDirectory, 0755, true);
        }
        
$modelContent = '<?php  namespace App\Controllers\\' . ucwords($modelFolderName) . ';
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\\' . ucwords($modelFolderName) . '\\' . ucwords($modelFileName) . 'Model;
use App\Models\User\UserModels;
use App\Models\SubMenu\SubMenuModels;

class ' . ucwords($modelFileName) . 'Controller extends BaseController {
    
    protected '.'$'.''.$modelFileName.'Models;
    protected $acMenuId;
    protected $subMenu;
    protected $masterMenu;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)  {
        parent::initController($request, $response, $logger);

        $this->masterMenu = "Tanpa Nama";
        $this->subMenu = "Tanpa Nama";
        $this->'.$modelFileName.'Models = new ' . ucwords($modelFileName) . 'Model();
        
          
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
            "menuId" =>  // harap isi dengan id menu sesuai dengan yang ada di database
            ];
              
        return view("' . $modelFolderName . '/' . $modelFileName . 'View",$data);     
    }

    public function allData(){
        // Menghitung jumlah total data
        //$totalRecords = $this->'.$modelFileName.'Models->where(["role !=" => "super admin"])->countAll();
        // Konfigurasi pagination
            
        $perPage = intval($this->request->getPost("length")); // Jumlah data per halaman
        $start = intval($this->request->getPost("start")); // Indeks data awal
        $search = $this->request->getPost("search")["value"]; // Kata kunci pencarian (opsional)
            
        // Mengambil data dengan pagination
        $data = $this->'.$modelFileName.'Models->getData($perPage, $start, $search);
        $totalFiltered = $this->'.$modelFileName.'Models->getDataCount($search);

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
            $result = $this->'.$modelFileName.'Models->where(["'.$fields[0].'" => $idField])->get()->getRow();
            return json_encode($result); 
        }

        public function storeData(){
            try {
                 $store = $this->request->getVar();   
                    if($store["action"] =="tambah"){
                       
                       $data = [
                            '.$html.'
                       ];
                        if($this->'.$modelFileName.'Models->save($data)){
                                session()->setFlashData("info","Toastify({text: \'Data Berhasil Ditambahkan\', duration: 4000,style: {
                                    background: \'linear-gradient(to right, #00b09b, #96c93d)\',
                                },}).showToast();");
                                return redirect()->back();
                        }else{
                                session()->setFlashData("info","Toastify({text: \'Pengguna Gagal Ditambahkan\', duration: 4000,style: {
                                    background: \'linear-gradient(to right, #b00000, #f5b0b0)\',
                                },}).showToast();");
                                return redirect()->back();
                        }
                                                
                    }elseif($store["action"] =="edit"){ // edit data
                        $data = [
                            '.$html.'
                       ];
                        
                        if( $this->'.$modelFileName.'Models->update($store["fieldId"],$data)){
                            session()->setFlashData("info","Toastify({text: \'Data berhasil diperbaharui\', duration: 4000,style: {
                                    background: \'linear-gradient(to right, #00b09b, #96c93d)\',
                             },}).showToast();");
                            return redirect()->back();
                        }else{
                            session()->setFlashData("info","Toastify({text: \'Data Gagal diperbaharui\', duration: 4000,style: {
                                    background: \'linear-gradient(to right, #b00000, #f5b0b0)\',
                            },}).showToast();");
                             return redirect()->back();
                        }
                           
                      
                    }
                    

                } catch (\CodeIgniter\Security\Exceptions\SecurityException $e) {
                        // Tangani pengecualian CSRF
                        echo "CSRF validation failed: " . $e->getMessage();
                        // Atau, lakukan tindakan lain yang sesuai, seperti mengarahkan pengguna kembali ke formulir dengan pesan kesalahan
                }                                           
        }

        public function remove(){
            if($this->'.$modelFileName.'Models->delete(["'.$fields[0].'" , $this->request->getPost("fieldId")])){
                 echo json_encode("success");
            }else{
                echo json_encode("failed");
            }
        }

}';

        $fileCreated = file_put_contents($modelDirectory . ucwords($modelFileName)."Controller.php", $modelContent);

        return $fileCreated !== false;
    }

    public function createView($modelFileName,$coloms,$tableName,$fields,$dataType){

        if(strpos($modelFileName, '/') !== false){
            // Memecah string berdasarkan tanda '/' menjadi array
            $parts = explode('/', $modelFileName);
            $modelDirectory = APPPATH . 'Views/' . $parts[0] . '/';
            $modelFileName =  $parts[1];
        } else{
            
            $modelDirectory = APPPATH . 'Views/' . $modelFileName . '/';
        }
       
        if (!is_dir($modelDirectory)) {
            mkdir($modelDirectory, 0755, true);
        }

        $colomTable = "";
        for($i=0; $i <= (sizeof($coloms,1)-1); $i++){
	
            $colomTable .= '<th>'.$coloms[$i].'</th>'. "\xA";
        }
        $colomTable .= '<th>Aksi</th>';

        $colomDataTabels = "";
        $colomDataTabels .= '{ data: "'.$fields[0].'" , visible: false},'. "\xA";
        for($i=1; $i <= (sizeof($fields,1)-1); $i++){
	
            $colomDataTabels .= '{ data: "'.$fields[$i].'" },'. "\xA";
        }
        
        $countInput = '';
        $htmlInput = '';
        $jqInpputVal = '';

        for($i=1; $i <= (sizeof($fields,1)-1); $i++){
            $jqInpputVal .= "$('#".$fields[$i]."').val(response.".$fields[$i]."); \xA";    //'{ data: "'.$fields[$i].'" },'. "\xA";
        }
        



        if(count($fields) > 10){
            $countInput = 'xl';
        }elseif(count($fields) >= 5 && count($fields) <= 10){
            $countInput = 'lg';
        }else{
            $countInput = 'md';
        }
        
        if (count($fields) > 5) {
         
            $htmlInput ='';
            $half = ceil(count($coloms) / 2);
            // Kolom pertama untuk setengah dari inputan
            $htmlInput .= "<div class='col'> \xA";
            for ($i = 1; $i < $half; $i++) {

                if($dataType[$i] == "select"){
                    $htmlInput .= "<div class='mb-2'> \xA";
                    $htmlInput .= "<label for='".$fields[$i]."'>".ucwords($coloms[$i])."</label> \xA";
                    $htmlInput .= " <select class='form-select' id='".$fields[$i]."' name='".$fields[$i]."'>  \xA";
                    $htmlInput .= " <option selected>Open this select menu</option> \xA";
                    $htmlInput .= " </select> \xA";
                    $htmlInput .= "</div> \xA";
                }else{
                    $htmlInput .= "<div class='mb-2'> \xA";
                    $htmlInput .= "<label for='".$fields[$i]."'>".ucwords($coloms[$i])."</label> \xA";
                    $htmlInput .= "<input type='".$dataType[$i]."' class='form-control' id='".$fields[$i]."' name='".$fields[$i]."'  placeholder='".$coloms[$i]."'> \xA";
                    $htmlInput .= "</div> \xA";
                }

                
            }
            $htmlInput .= "</div> \xA"; // Tutup kolom pertama

            // Kolom kedua untuk setengah inputan berikutnya
            $htmlInput .=  "<div class='col'> \xA";
            for ($i = $half; $i < count($coloms); $i++) {
                if($dataType[$i] == "select"){
                    $htmlInput .= "<div class='mb-2'> \xA";
                    $htmlInput .= "<label for='".$fields[$i]."'>".ucwords($coloms[$i])."</label> \xA";
                    $htmlInput .= " <select class='form-select' id='".$fields[$i]."' name='".$fields[$i]."'>  \xA";
                    $htmlInput .= " <option selected>Open this select menu</option> \xA";
                    $htmlInput .= " </select> \xA";
                    $htmlInput .= "</div> \xA";
                }else{
                    $htmlInput .=  "<div class='mb-2'> \xA";
                    $htmlInput .=  "<label for='".$fields[$i]."'>".ucwords($coloms[$i])."</label> \xA";
                    $htmlInput .=  "<input type='".$dataType[$i]."' class='form-control' id='".$fields[$i]."' name='".$fields[$i]."'  placeholder='".$coloms[$i]."'> \xA";
                    $htmlInput .=  "</div> \xA";
                }
              
            }
            $htmlInput .=  "</div> \xA";

        }else{
            $htmlInput = '';
            for ($i = 1; $i < count($coloms); $i++) {
                if($dataType[$i] == "select"){
                    $htmlInput .= "<div class='mb-2'> \xA";
                    $htmlInput .= "<label for='".$fields[$i]."'>".ucwords($coloms[$i])."</label> \xA";
                    $htmlInput .= " <select class='form-select' id='".$fields[$i]."' name='".$fields[$i]."'>  \xA";
                    $htmlInput .= " <option selected>Open this select menu</option> \xA";
                    $htmlInput .= " </select> \xA";
                    $htmlInput .= "</div> \xA";
                }else{
                    $htmlInput .= "<div class='mb-2'> \xA";
                    $htmlInput .= "<label for='".$fields[$i]."'>".ucwords($coloms[$i])."</label> \xA";
                    $htmlInput .= "<input type='".$dataType[$i]."' class='form-control' id='".$fields[$i]."' name='".$fields[$i]."'  placeholder='".$coloms[$i]."'> \xA";
                    $htmlInput .= "</div> \xA";
                }

               
            }
        }

        // foreach ($coloms as $key => $value) {   
        //     dd($value);
        // }



         $viewsContent = '
<?= $this->extend("Template/main_template"); ?>

<?= $this->section("css"); ?>
            
<style>
  table.dataTable thead th {
    text-align: left !important; /* Memaksa header tetap rata kiri */
  }
</style>

<?= $this->endSection(); ?>

<?= $this->section("title-content"); ?>
    <?=$subMenu?>
<?= $this->endSection(); ?> 

<?= $this->section("content"); ?>

<section class="section">
            
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">
            <button class="btn btn-primary mb-3" id="btn-add">Tambah Data</button>

    
                <table class="table table-striped table-hover table-bordered"  style="width: 100%;"  id="table-'.$tableName.'">
                    <thead>
                        <tr>
                            '.$colomTable.'          
                        </tr>
                        </thead>              
                </table>
         
        </div>
    </div>
 </section>

 <!-- modal-add-user -->
<div class="modal fade" id="modal-store" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-storeLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-'.$countInput.' ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-storeLabel">Store Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">

          <form class=""  action="<?= base_url(\''.strtolower($modelFileName).'/store\')?>" method="post" id="form-store">
              <div class="form-body row">
                '.$htmlInput.'
              </div>
        </div>
     
      <div class="modal-footer">
        <input type="hidden" name="action" class="action">
        <input type="hidden" name="fieldId" class="field-id">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-store">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
                    
<?= $this->endSection(); ?>
<?= $this->section("js"); ?>
<script>
    $(document).ready(function () {
        let table'.$tableName.' = $("#table-'.$tableName.'").DataTable({
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "ajax": {
                        "url": \'<?= base_url("'.strtolower($modelFileName).'/all-data"); ?>\', // sesuaikan linknya
                        "type": "POST",
                    },
                    "columns": [                   
                        '.$colomDataTabels.'                       
                        {
                            "data": null,
                            "render": function(data, type, row) {
                            let menu = "";
                               $.ajax({
                                type: "POST",
                                url: \'<?= base_url("akses-tombol"); ?>\',
                                data: {                             
                                    dataId: row.id,
                                    menuid: \'<?= $menuId; ?>\'
                                },
                                async: false,
                                success: function (response) {
                                  menu += response;
                                }
                              });
                               
                            return  \'<button  class="btn btn-secondary btn-sm dropdown-toggle me-1" type="button" id="dropdownMenuButtonSec" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\' +
                                    \' Pilihan Menu </button>\'+
                                    \'<div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSec" >\'+                    
                                        menu  +                                                                       
                                    \' </div>\';
                            }
                        }                 
                        // ...
                    ],
                    columnDefs: [
                        //   { targets: [4], render: function(data) {
                        // 	  return data == "Y" ? "<span class="badge bg-success">Aktif</span>" : "<span class="badge bg-danger">Tidak Aktif</span>";
                        // 	}
                        //   }
                    ],
                    "lengthMenu": [10, 25, 50, 100],
                    "pageLength": 10,
                    "pagingType": "full",
                    "language": {
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecords": "Data tidak ditemukan",
                        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                        "infoEmpty": "Tidak ada data yang tersedia",
                        "infoFiltered": "(disaring dari total _MAX_ data)",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        }
                    },
        });
$("#btn-add").click(function (e) { // tambah data
    $("#form-store")[0].reset();
    $(".action").val("tambah");
    $("#modal-storeLabel").text("Tambah Data");
    $("#modal-store").modal("show");
            
}); 

$(document).on("click", ".btn-edit-field", function(){ //edit data
      
    let fieldId = $(this).data("field-id");

    $.ajax({
      type: "post",
      url: \'<?= base_url("'.strtolower($modelFileName).'/get-data-one"); ?>\',
      data: {
        fieldId:fieldId
      },
      dataType: "json",
      success: function (response) {
     
        
    '.$jqInpputVal.'

      $(".action").val("edit");
      $(".field-id").val(response.'.$fields[0].');
      $("#modal-storeLabel").text("Edit Data");
      $("#modal-store").modal("show");
              

      }
    });
    
}); // batas edit data

$(document).on("click", ".btn-hapus-field", function(){ //Hapus Data
      
    let fieldId = $(this).data("field-id");

    Swal.fire({
        title: "Apakah anda yakin ingin menghapus?", 
        showCancelButton: true,
        confirmButtonText: "Iya, hapus", 
    }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      $.LoadingOverlay("show");
        $.ajax({
          type: "post",
          url: \'<?= base_url("'.strtolower($modelFileName).'/delete-data"); ?>\',
          data: {
              fieldId:fieldId
          },
          dataType: "json",
          success: function (response) {
            $.LoadingOverlay("hide");
              if(response == "success"){
                      Toastify({text: "Data berhasil Dihapus", duration: 4000,style: {
                                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                                },}).showToast();
                                 table'.$tableName.'.ajax.reload();
              }else{
                      Toastify({text: "Data Gagal Dihapus", duration: 4000,style: {
                                background: "linear-gradient(to right, #00b09b, #96c93d)",
                            },}).showToast();
              }
          }
      });
    } 
  });
  
            
});


    }); 
</script>
<?= $this->endSection(); ?>


';

        $fileCreated = file_put_contents($modelDirectory . $modelFileName."View.php", $viewsContent);

        return $fileCreated !== false;
    }

   
}