
<?= $this->extend("Template/main_template"); ?>

<?= $this->section("css"); ?>
            
<style>
     /* Menggeser kolom pencarian ke sebelah kanan */
    .dataTables_wrapper .dataTables_filter {
        float: right;
    }
            
    /* Menyelaraskan teks "Search" dengan kolom pencarian dan memberikan jarak */
    .dataTables_wrapper .dataTables_filter label {
        display: flex;
        align-items: center;
    }
            
    /* Memberikan jarak di antara teks dan kolom pencarian */
    .dataTables_wrapper .dataTables_filter input[type="search"] {
        margin-left: 5px; /* Sesuaikan nilai margin sesuai dengan kebutuhan Anda */
    }
</style>

<?= $this->endSection(); ?>

<?= $this->section("title-content"); ?>
    <?=$subMenu?>
<?= $this->endSection(); ?> 

<?= $this->section("content"); ?>

<section class="section">

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>
            
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">
            <button class="btn btn-primary mb-3" id="btn-add">Tambah Data</button>

    
                <table class="table" table-striped style="width: 100%;"  id="table-tb_test">
                    <thead>
                        <tr>
                            <th>id</th>
<th>input1</th>
<th>input2</th>
<th>input3</th>
<th>input4</th>
<th>input5</th>
<th>input6</th>
<th>Aksi</th>          
                        </tr>
                        </thead>              
                </table>
         

        </div>
    </div>
 </section>

 <!-- modal-add-user -->
<div class="modal fade" id="modal-store" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-storeLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-storeLabel">Store Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">

          <form class=""  action="<?= base_url(' test/store')?>" method="post" id="form-store">
              <div class="form-body row">
                <div class='col'> 
<div class='mb-2'> 
<label for='input1'>Input1</label> 
<input type='text' class='form-control' id='input1' name='input1'  placeholder='input1'> 
</div> 
<div class='mb-2'> 
<label for='input2'>Input2</label> 
<input type='text' class='form-control' id='input2' name='input2'  placeholder='input2'> 
</div> 
<div class='mb-2'> 
<label for='input3'>Input3</label> 
<input type='text' class='form-control' id='input3' name='input3'  placeholder='input3'> 
</div> 
</div> 
<div class='col'> 
<div class='mb-2'> 
<label for='input4'>Input4</label> 
<input type='text' class='form-control' id='input4' name='input4'  placeholder='input4'> 
</div> 
<div class='mb-2'> 
<label for='input5'>Input5</label> 
<input type='text' class='form-control' id='input5' name='input5'  placeholder='input5'> 
</div> 
<div class='mb-2'> 
<label for='input6'>Input6</label> 
<input type='text' class='form-control' id='input6' name='input6'  placeholder='input6'> 
</div> 
</div> 

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
        let tabletb_test = $("#table-tb_test").DataTable({
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "ajax": {
                        "url": '<?= base_url("test/all-data"); ?>', // sesuaikan linknya
                        "type": "POST",
                    },
                    "columns": [
                        
                        { data: "id" , visible: false},
                        { data: "input1" },
                        { data: "input2" },
                        { data: "input3" },
                        { data: "input4" },
                        { data: "input5" },
                        { data: "input6" },

                        
                        {
                            "data": null,
                            "render": function(data, type, row) {
                            let menu = "";
                            
                              $.ajax({
                                type: "POST",
                                url: '<?= base_url("akses-tombol"); ?>',
                                data: { 
                              
                                      dataId: row.id,
                                      menuid: '<?= $menuId; ?>'
                                },
                                async: false,
                                success: function (response) {
                                  menu += response;
                                }
                              });
                               
                            return  '<button  class="btn btn-secondary btn-sm dropdown-toggle me-1" type="button" id="dropdownMenuButtonSec" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                    ' Pilihan Menu </button>'+
                                    '<div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSec" >'+                    
                                        menu  +                                                                       
                                    ' </div>';

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
      url: '<?= base_url("test/get-data-one"); ?>',
      data: {
        fieldId:fieldId
      },
      dataType: "json",
      success: function (response) {
     
        
    $('#input1').val(response.input1); 
$('#input2').val(response.input2); 
$('#input3').val(response.input3); 
$('#input4').val(response.input4); 
$('#input5').val(response.input5); 
$('#input6').val(response.input6); 


      $(".action").val("edit");
      $(".field-id").val(response.id);
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
          url: '<?= base_url("test/delete-data"); ?>',
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
                                 tabletb_test.ajax.reload();
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


