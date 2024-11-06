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
User Management
<?= $this->endSection(); ?> 

<?= $this->section('content'); ?>

<section class="section">
            
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"></h4>
              </div>
              <div class="card-body">
              <?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li> <span><i class="fas fa-info-circle"></i></span>   <?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>


<button class="btn btn-primary mb-3" id="btn-add-user">Tambah User</button>


    <table class="table table-striped"  style="width: 100%;" id="table-user">
      <thead>
         <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>User</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>aksi</th>           
          </tr>
      </thead>              
     </table>


<!-- modal-add-user -->
<div class="modal fade" id="modal-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-userLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-userLabel">Tambah Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row">
        <div class="col-6">
        <form class="form form-horizontal" id="form-user" action="<?= base_url('user/storeuser')?>" method="post">
           <div class="form-body">
              <div class="row">
                <div class="col-md-4">
                  <label for="fullname" >Nama Lengkap</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="fullname"class="form-control"name="fullname" value="<?= old('fullname') ?>" placeholder="Nama Lengkap" autocomplete="off"/>
                </div>
                <div class="col-md-4">
                  <label for="email">Email</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="email" class="form-control" name="email" value="<?= old('email') ?>" placeholder="email" autocomplete="off"/>
                  <input type="hidden" name="cahceemail"  id="cahceemail">
                </div>
                <div class="col-md-4">
                  <label for="username">Username</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" id="username" class="form-control " name="username" value="<?= old('username') ?>" placeholder="username" autocomplete="off"/>
                  <div id="validate-username" class="invalid-feedback">
                    Username sudah tersedia !
                  </div>
                </div>
                <div class="col-md-4">
                  <label for="password">Password</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="password" id="password" class="form-control" name="password" placeholder="password"/>
                  <div id="validate-username" class="invalid-feedback">
                    Password Minimal harus 6 karakter !
                  </div>
                </div>


                <div class="col-md-4">
                  <label for="password-horizontal">Role</label>
                </div>

                <div class="col-md-8 form-group">
                    <select class="form-control" id="role" name="role" required>              
                      <option value="" selected>Pilih Salah Satu</option>
                      <?php foreach ($role as $r) : ?>
                        <option value="<?=$r['role']?>" <?=$r['role'] == old('role') ? 'selected' : ''?> ><?=$r['role']?></option>
                      
                      <?php endforeach ; ?>
                      
                    </select>
                </div>

              </div>
            </div>
      
        </div>
        <div class="col-6 ">
          <div class="row">
          

            <div class="col-md-4">
                  <label for="password-horizontal">Status Aktif</label>
              </div>
                <div class="col-md-8 form-group">
                    <select class="form-select" id="sts-aktif" name="stsAktif">
                      <option value="Y" <?= old('stsAktif') == 'Y' ? 'selected' : ''?>>Aktif</option>
                      <option value="T" <?= old('stsAktif') == 'T' ? 'selected' : ''?> >Tidak Aktif</option>      
                    </select>
            </div>
          </div>
           
             
        </div>
      </div>
      <!-- </form> -->
      <div class="modal-footer">
        <!-- action -->
        <input type="hidden" name="iduser" class="iduser">
        <input type="hidden" name="action" class="action">
        <!-- action -->
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-store-user">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal-add-user -->
<div class="modal fade" id="modal-access-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-access-userLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-access-userLabel">Akses Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
          <form class="form form-horizontal"  action="<?= base_url('user/storeaksesuser')?>" method="post">
              <div class="form-body">
                  <div class="row">
                  
                    
                <div class="col-md-8 form-group">
                <?php helper("Menu") ?>
                  <ul class="checktree">
                
                  </ul>
                </div>
                  </div>
              </div>
          <!-- </form> -->
       
        </div>
     
      <div class="modal-footer">
        <input type="hidden" name="iduser" class="iduser">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-store-akses">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal-add-user -->
<!-- <div class="modal fade" id="modal-password-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-password-userLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-password-userLabel">Ganti Password Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
          <form class="form form-horizontal"  action="<?= base_url('user/storepassuser')?>" method="post">
              <div class="row">
                <div class="col-md-4">
                    <label for="password">Password Baru</label>
                  </div>
                  <div class="col-md-8 form-group">
                    <input type="password" id="password" class="form-control" name="password" placeholder="password"/>
                   
                  </div>
              </div>

        </div>
     
      <div class="modal-footer">
        <input type="hidden" name="iduser" class="iduser">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-store-akses">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div> -->

    </div>
              </div>
            </section>
              
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $(document).ready(function () {

   
      var originalUsername = '';

      $(document).on('click', 'ul.checktree', function() {
         $(this).checktree();
      })

    

        let tableUser = $('#table-user').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ajax": {
                    "url": "<?= base_url('user/datauser'); ?>",
                    "type": "POST",
                   

                              
                },		
                "columns": [
                    { data: 'user_id' , visible: false},
                    { data: 'nama' },
                    { data: 'username' },	
                    { data: 'email' },	
                    { data: 'role'},
                    { data: 'sts_aktif'},
					
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            return '<button class="btn btn-danger btn-sm btn-edit-user" data-userid="' + row.user_id + '" > Edit </button>'+
                       
                            '  <button class="btn btn-success btn-sm btn-aksesmenu-user" data-userid="' + row.user_id + '" > Akses Menu </button>';
                        }
                    }
              
                    // ...
                ],
				columnDefs: [
				  { targets: [5], render: function(data) {
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

    

    $('#btn-add-user').click(function (e) { // tambah user
      $('#form-user')[0].reset();
     originalUsername = ''
     // document.querySelector('#role').setValue([ "Verifkator", "Penilai" ]);
    //  role.setValue()
      $('.action').val('tambah');
      $('#modal-userLabel').text('Tambah User');
      $('#modal-user').modal('show');
      
    }); // batas tambah user

 

    $(document).on('click', '.btn-edit-user', function(e){ //edit user
      $('.is-invalid').removeClass('is-invalid');
      $('#form-user')[0].reset();
      e.preventDefault();
    // Menghapus nilai dari semua input yang menggunakan old()
    $('input[type="text"], input[type="email"], input[type="password"], select').val('');
      let userId = $(this).data('userid');
 
      $.ajax({
        type: "post",
        url: "<?=base_url('user/getdatauser')?>",
        data: {
          userId:userId
        },
        dataType: "json",
        success: function (response) {
          originalUsername = response.username; 
          $('#fullname').val(response.nama);
          $('#email').val(response.email);
          $('#cahceemail').val(response.email);
          $('#username').val(response.username);      
          $('#password').val(response.password);   
          $('#role').val(response.role);
          $('#dashboard').val(response.dashboard);
     
          // document.querySelector('#role').setValue(response.role.split(','));
          $('#sts-aktif').val(response.sts_aktif);
          $('#modal-userLabel').text('Edit User');
          $('.iduser').val(response.user_id);
          $('.action').val('edit');
          $('#modal-user').modal('show');

        }
      });
      
    }); // batas edit user

  

    $(document).on('click', '.btn-aksesmenu-user',function(){ // akses menu user
     
      let userId = $(this).data('userid');

      $.ajax({
        type: "post",
        url: "<?=base_url('user/cekmenuakses')?>",
        data: {
          userId:userId
        },
       
        success: function (response) {
          $('.checktree').html(response);
          $('.iduser').val(userId);
          $('#modal-access-user').modal('show');

         // console.log(response)

        }
      });

    }); // batas akses menu user
  
  
});

   
</script>
<?= $this->endSection(); ?>

