<?= $this->extend('Template/main_template'); ?>

<?= $this->section('css'); ?>

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

<?= $this->section('title-content'); ?>
<h3><?=$subMenu?></h3>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
     <!-- Basic Horizontal form layout section start -->
     <!-- <section id="basic-horizontal-layouts">
            <div class="row match-height">
              <div class="col-md-6 col-12">

                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Master Menu</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      <form class="form form-horizontal" id="form-data-pribadi" >
                        <div class="form-body">
                          <div class="row">
                          
                            <div class="col-md-4">
                              <label for="first-name-horizontal">Nama Menu Master</label>
                            </div>
                            <div class="col-md-8 form-group">
                             <input type="text" class="form-control"name="nmm" placeholder="Nama menu master" id="nmm" />
                            </div>
                            <div class="col-md-4">
                              <label for="first-name-horizontal">Icon Menu Master</label>
                            </div>
                            <div class="col-md-8 form-group">
                             <input type="text" class="form-control"name="imm" placeholder="Nama menu master" id="imm" />
                            </div>

                            <div class="col-md-4">
                                <label for="password-horizontal">Status Aktif</label>
                            </div>
                        <div class="col-md-8 form-group">
                            <select class="form-select" id="sts-aktif-mm" name="stsmm">
                            <option value="Y" selected>Aktif</option>
                            <option value="T">Tidak Aktif</option>      
                            </select>
                        </div>
                            <div class="col-md-4">
                            
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="hidden" name="action" class="actionmastermenu" value="tambah">
                                <input type="hidden" name="optionstore" value="mastermenu">
                                <input type="hidden" name="idmastermenu" class="idmmenu">
                                <button type="button" class="btn btn-danger btn-sm" id="btn-strore-mm">Tambahkan Menu Master</button>
                            </div>
                  
                            </form>
                           
                          </div>
                        </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-12">

                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Sub Menu Master</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      <form class="form form-horizontal"  id="form-data-submenu" action="<?=base_url('menu/storsubmenu')?>" method="post">
                        <div class="form-body">
                          <div class="row">
                           
                        <div class="form-body">
                          <div class="row">
                          
                            <div class="col-md-4">
                              <label for="first-name-horizontal">Nama Submenu</label>
                            </div>
                            <div class="col-md-8 form-group">
                             <input type="text" class="form-control"name="nsm" placeholder="Nama submenu" id="nsm" />
                            </div>
                            <div class="col-md-4">
                              <label for="first-name-horizontal">Link</label>
                            </div>
                            <div class="col-md-8 form-group">
                             <input type="text" class="form-control"name="lsm" placeholder="Link sub menu" id="lsm" />
                            </div>

                            <div class="col-md-4">
                                <label for="password-horizontal">Master Menu</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="master-menu" name="idmastermenu">
                                  <option value="" selected >Silahkan Pilih</option>  
                                  <?php foreach($menumaster as $mm):?>
                                    <option value="<?=$mm['id_mm']?>" ><?=$mm['cap_menu']?></option>
                                  <?php endforeach;?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="password-horizontal">Status Aktif</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select class="form-select" id="sts-aktif" name="stsAktif">
                                <option value="Y" selected>Aktif</option>
                                <option value="T">Tidak Aktif</option>      
                                </select>
                            </div>


                            <div class="col-md-4">
                              
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="hidden" name="action" class="actionsubmenu" value="tambah" >
                                <input type="hidden" name="optionstore" value="submenu">
                                <input type="hidden" name="idsubmenu" class="idsubmenu">
                              <button type="button" class="btn btn-danger btn-sm" id="btn-submenu">Tambahkan Submenu</button>
                            </div>
                  
                            </form>

                          </div>
                        </div>
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section> -->
          <!-- //  section add -->

          <section class="section">        
            <div class="card">
                <div class="card-body">
                  <nav>
                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <button class="nav-link active" id="nav-menu-master-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Master Menu</button>
                          <button class="nav-link" id="nav-submenu-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Sub Menu</button>
              
                      </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">

                      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-menu-master-tab">
                        <!-- Menu Master -->
                          <form class="row mt-4" id="form-data-master-menu" action="<?=base_url('menu/storsubmenu')?>" method="post"  >
                          <div class="col-6">
                            <label for="validationServer01" class="form-label">Nama Menu Master</label>
                            <input type="text" class="form-control "  name="nmm" placeholder="Nama menu master" id="nmm"  required>
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                          </div>

                          <div class="col-6">
                            <label for="validationServer01" class="form-label">Status Aktif</label>
                              <select class="form-select" id="sts-aktif-mm" name="stsmm">
                                <option value="Y" selected>Aktif</option>
                                <option value="T">Tidak Aktif</option>      
                              </select>
                          </div>

                          <div class="col-6">
                            <label for="validationServer01" class="form-label">Icon Menu Master</label>
                            <input type="text" class="form-control " name="imm" placeholder="Nama menu master" id="imm" required>
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                          </div>

                          <div class="col-md-8 form-group mt-3">
                                <input type="hidden" name="action" class="actionmastermenu" value="tambah">
                                <input type="hidden" name="optionstore" value="mastermenu">
                                <input type="hidden" name="idmastermenu" class="idmmenu">
                                <button type="button" class="btn btn-primary btn-sm" id="btn-strore-mm">Tambahkan Menu Master</button>
                                <button type="button" class="btn btn-danger btn-sm" id="btn-strore-mm-batal">Batal</button>
                            </div>
                          </form>

                            <table class="table table-bordered table-striped " id="table-master-menu" style="width: 100%;">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Nama Menu</th>
                                      <th>Icon</th>
                                      <th>Status</th>
                                      <th>aksi</th>           
                                  </tr>
                              </thead>              
                            </table>                    
                      </div>

                      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-submenu-tab">  
                        <!-- Sub Menu Master  -->

                        <form class="row mt-4" id="form-data-submenu" action="<?=base_url('menu/storsubmenu')?>" method="post" >
                          <div class="col-6">
                            <label for="validationServer01" class="form-label">Nama Submenu</label>
                            <input type="text" class="form-control "  name="nsm" placeholder="Nama submenu" id="nsm" required>
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                          </div>

                          <div class="col-6">
                            <label for="validationServer01" class="form-label">Master Menu</label>
                            <select class="form-select" id="master-menu" name="idmastermenu">
                                  <option value="" selected >Silahkan Pilih</option>  
                                  <?php foreach($menumaster as $mm):?>
                                    <option value="<?=$mm['id_mm']?>" ><?=$mm['cap_menu']?></option>
                                  <?php endforeach;?>
                                </select>
                          </div>

                          <div class="col-6">
                            <label for="validationServer01" class="form-label">Link</label>
                            <input type="text" class="form-control " name="lsm" placeholder="Link sub menu" id="lsm"  required>
                            <div class="valid-feedback">
                              Looks good!
                            </div>
                          </div>

                          <div class="col-6">
                            <label for="validationServer01" class="form-label">Status Aktif</label>
                            <select class="form-select" id="sts-aktif" name="stsAktif">
                                <option value="Y" selected>Aktif</option>
                                <option value="T">Tidak Aktif</option>      
                                </select>
                          </div>


                          <div class="col-md-8 mt-3 form-group">
                                <input type="hidden" name="action" class="actionsubmenu" value="tambah" >
                                <input type="hidden" name="optionstore" value="submenu">
                                <input type="hidden" name="idsubmenu" class="idsubmenu">
                              <button type="button" class="btn btn-primary btn-sm" id="btn-submenu">Tambahkan Submenu</button>
                              <button type="button" class="btn btn-danger btn-sm" id="btn-submenu-batal">Batal</button>
                            </div>
                          </form>
                        

                              <table class="table table-bordered table-striped" id="table-submenu" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->
                                        <th>Nama Menu</th>
                                        <th>Link</th>
                                        <th>Menu Master</th>
                                        <th>Status</th>
                                        <th>aksi</th>           
                                    </tr>
                                </thead>              
                              </table>                     
                      </div>                  
                  </div>            
                </div>
            </div>
        </section>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $(document).ready(function () {
        let tableSubMenu = $('#table-submenu').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ajax": {
                    "url": "<?php echo base_url('menu/datasubmenu'); ?>",
                    "type": "POST",
                },		
                "columns": [
                  //  { data: 'id_menu' , visible: false},
                  { data: 'cap_menu' },
                  { data: 'link' },	
                  { data: 'id_mm'},
                    { data: 'sts_menu'},
					
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            return '<button class="btn btn-info btn-sm btn-edit-menu mr-2" data-menuid="' + row.id_menu + '" > Edit </button> ' + 
                            ' <button class="btn btn-danger btn-sm btn-delete-menu ml-2" data-menu="sub-menu" data-menuid="' + row.id_menu + '" > Hapus </button>';
                        }
                    }
              
                    // ...
                ],
				columnDefs: [
				  { targets: [4], render: function(data) {
					  return data == 'Y' ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>';
					}
				  }
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

            let tableMasterMenu = $('#table-master-menu').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ajax": {
                    "url": "<?php echo base_url('menu/datamastermenu'); ?>",
                    "type": "POST",
                },		
                "columns": [
                    { data: 'id_mm' , visible: false},
                    { data: 'cap_menu' },
                    { data: 'icon_menu' },	
                    { data: 'sts_menu'},
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            return '<button class="btn btn-danger btn-sm btn-edit-menu-master" data-menuid="' + row.id_mm + '" > Edit </button>' + 
                            ' <button class="btn btn-danger btn-sm btn-delete-menu ml-2" data-menu="master-menu" data-menuid="' + row.id_mm + '" > Hapus </button>';
                        }
                    }

                ],
				columnDefs: [
				  { targets: [3], render: function(data) {
					  return data == 'Y' ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>';
					}
				  }
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


        // tambah data 
        $(document).on('click', '#btn-submenu', function(){
                let namasubmenu =  $('#nsm').val();
                let link =  $('#lsm').val();
                let mastermenu =  $('#master-menu').val();
                let stsSubmenu =  $('#sts-aktif-submenu').val();

                if(namasubmenu ==="" ||link ===""||mastermenu ===""||stsSubmenu ==="" ){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Form Tidak Boleh Kosong !',
                        })
                }else{
                  $('#form-data-submenu').submit();
                }

            });

            $(document).on('click', '#btn-strore-mm', function(){
                let namaMastermenu =  $('#nmm').val();
                let iconMasterNebu =  $('#imm').val();           
                let stsMasterMenu =  $('#sts-aktif-mm').val();

                if(namaMastermenu ==="" ||iconMasterNebu ===""||stsMasterMenu ==="" ){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Form Tidak Boleh Kosong !',
                        })
                }else{
                  $('#form-data-master-menu').submit();
                }

            });
        // batas tambah data
            $('#btn-strore-mm-batal').hide();
            $('#btn-submenu-batal').hide();
            $(document).on('click', '.btn-edit-menu', function(){

                $.ajax({
                    type: "post",
                    url: "<?=base_url('menu/getdatasubmenu')?>",
                    data: {
                        menuid: $(this).data('menuid')
                    },
                    dataType: "json",
                    success: function (response) {
                       
                        $('#nsm').val(response.cap_menu);
                        $('#lsm').val(response.link);
                        $('#master-menu').val(response.id_mm);
                        $('#sts-aktif-submenu').val(response.sts_menu);
                        $('.idsubmenu').val(response.id_menu);
                        $('.actionsubmenu').val('edit');
                        $('#btn-submenu').text('Edit Sub Menu');
                        $('#btn-submenu-batal').show();
                        $("#btn-submenu").removeClass("btn-primary").addClass("btn-success");
                        $("html, body").animate({scrollTop: 0}, 1000);
                    }
                });
                
            });

            $(document).on('click', '#btn-submenu-batal', function(){
                $('#btn-submenu').text('Tambah Master Menu');
                $("#btn-submenu").removeClass("btn-success").addClass("btn-primary");
                $('.actionsubmenu').val('tambah');
                $('#nsm').val('');
                $('#lsm').val('');
                $('#master-menu').val('');
                $('#sts-aktif-submenu').val('T');
                $('.idsubmenu').val('');
                $(this).hide();
            });

            $(document).on('click', '.btn-edit-menu-master', function(){

              $.ajax({
                  type: "post",
                  url: "<?=base_url('menu/getdatamastermenu')?>",
                  data: {
                      menuid: $(this).data('menuid')
                  },
                  dataType: "json",
                  success: function (response) {
                    
                      $('#nmm').val(response.cap_menu);
                      $('#imm').val(response.icon_menu);
                      $('#sts-aktif-mm').val(response.sts_menu);
                      $('.idmmenu').val(response.id_mm);
                      $('.actionmastermenu').val('edit');
                      $('#btn-strore-mm-batal').show();
                      $('#btn-strore-mm').text('Edit Master Menu');
                      $("#btn-strore-mm").removeClass("btn-primary").addClass("btn-success");
                      $("html, body").animate({scrollTop: 0}, 1000);
                  }
              });

            });
            $(document).on('click', '#btn-strore-mm-batal', function(){
                $('#btn-strore-mm').text('Tambah Master Menu');
                $("#btn-strore-mm").removeClass("btn-success").addClass("btn-primary");
                $('.actionmastermenu').val('tambah');
                $('#nmm').val('');
                $('#imm').val('');
                $('#sts-aktif-mm').val('T');
                $('.idmmenu').val('');
                $(this).hide();
            });

            $(document).on('click', '.btn-delete-menu', function(){   

              let optionMenu = $(this).data('menu');
              let menuId = $(this).data('menuid');

              $.ajax({
                type: "post",
                url: "<?=base_url('menu/delete-menu')?>",
                data: {
                    optionMenu: optionMenu,
                    menuId: menuId
                },
                dataType: "json",
                success: function (response) {
                  if(response== 'success'){
                    location.reload();
                  }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal Menghapus Data !',
                        })
                  }
                }
              });
              
            });
          

    });
</script>
<?= $this->endSection(); ?>