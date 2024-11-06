
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
                <div class="row">
                  <div class="col-2">
                    <h6>Bulan JP</h6>
                    <select class="form-select" id="filterBln">
                        <?php  
                         $bulan_sekarang = date('m');
                            // Array nama bulan
                                $bulan = array(
                                    "01" => "Januari",
                                    "02" => "Februari",
                                    "03" => "Maret",
                                    "04" => "April",
                                    "05" => "Mei",
                                    "06" => "Juni",
                                    "07" => "Juli",
                                    "08" => "Agustus",
                                    "09" => "September",
                                    "10" => "Oktober",
                                    "11" => "November",
                                    "12" => "Desember"
                                );
                        ?>

                        <?php foreach ($getBulan as $b) : ?>                       
                            <option value="<?= $b['tgl'] ?>"  <?= (str_replace(date('Y').'-', '', $b['tgl']) == $bulan_sekarang) ? 'selected' : '';?> ><?= $bulan[str_replace(date('Y').'-', '', $b['tgl'])]  ?></option>
                        <?php endforeach; ?>

                  
                    </select>
                  </div>
                </div>
                <table class="table table-striped table-hover table-bordered"  style="width: 100%;"  id="table-tb02_pg">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Bulan JP</th>
                            <th>Nilai Jabatan</th>
                            <th>aksi</th>
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

          <form class=""  action="<?= base_url(' Penilaian/store')?>" method="post" id="form-store">
              <div class="form-body row">
            

              </div>
        </div>
     
      <div class="modal-footer">
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
      let no = 0
        let tabletb02_pg = $("#table-tb02_pg").DataTable({
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "ajax": {
                        "url": '<?= base_url("penilaian/all-data"); ?>', // sesuaikan linknya
                        "type": "POST",
                        "data" : (data) =>{
                          data.filter = $('#filterBln').val()
                      
                        },
                        
                    },
                    "columns": [
               
                        { 
                          data: null,
                          render : function(data, type, row) {
                        

                              return ++no
                          }
                       
                          
                        },
                        { data: "nik" },
                        { data: "nm_pg" },
                        { 
                          data: null,
                          render : function(data, type, row) {
                           return getMonthName(row.tgl)
                          } 
                          
                        },
                        { data: "nj" },
                        // { data: "unit" },
                        // { data: "jbu" },

                        
                        {
                            "data": null,
                            "render": function(data, type, row) {
                            let menu = "";
                               $.ajax({
                                type: "POST",
                                url: '<?= base_url("akses-tombol"); ?>',
                                data: { 
                              
                                      dataId: row.Id_pn,
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
                    
                    ],
                    "ordering": false,
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
       
     
$('#filterBln').on('change', function() {
    var filterValue = $(this).val();
    tabletb02_pg.ajax.reload();             
});
$("#btn-add").click(function (e) { // tambah data
    $("#form-store")[0].reset();
    $(".action").val("tambah");
    $("#modal-storeLabel").text("Tambah Data");
    $("#modal-store").modal("show");
            
}); 

$(document).on("click", ".btn-nilai-pg", function(){ //edit data
      
    let fieldId = $(this).data("field-id");
    location.href = "<?= base_url('penilaian/quesioner/') ?>"+fieldId;
    
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
          url: '<?= base_url("Penilaian/delete-data"); ?>',
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
                                 tabletb02_pg.ajax.reload();
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

    function getMonthName(dateString) {
            // Parsing tanggal dari string
            var date = new Date(dateString + "-01");

            // Daftar nama bulan
            var monthNames = [
                "Januari", "Februari", "Maret",
                "April", "Mei", "Juni", "Juli",
                "Agustus", "September", "Oktober",
                "November", "Desember"
            ];

            // Mendapatkan indeks bulan dari tanggal
            var monthIndex = date.getMonth();

            // Mengembalikan nama bulan
            return monthNames[monthIndex];
        }
</script>
<?= $this->endSection(); ?>


