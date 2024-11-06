<?= $this->extend('Template/main_template'); ?>

<?= $this->section('css'); ?>


<?= $this->endSection(); ?>

<?= $this->section('title-content'); ?>
<h3>Profile Pengguna</h3>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
     <!-- Basic Horizontal form layout section start -->
     <section id="basic-horizontal-layouts">
            <div class="row match-height">
              <div class="col-md-6 col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Data Pribadi</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      <form class="form form-horizontal" id="form-data-pribadi" action="<?=base_url('user/updateprofile')?>" method="post">
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-4">
                              <label for="first-name-horizontal">Nama Lengkap</label>
                            </div>
                            <div class="col-md-8 form-group">
                              <input type="text" class="form-control"name="fullname" placeholder="Nama Lengkap" id="fullname" value="<?= $userData->nama?>"/>
                            </div>
                            <div class="col-md-4">
                              <label for="email-horizontal">Email</label>
                            </div>
                            <div class="col-md-8 form-group">
                              <input type="email" class="form-control" name="email" placeholder="Email" id="email" value="<?= $userData->email?>"/>
                              <input type="hidden" name="cacheemail"id="cacheemail" value="<?= $userData->email?>"/>
                            </div>
                            <input type="hidden" name="action" value="data-pribadi">
                            <input type="hidden" name="iduser"  value="<?= $userData->user_id?>">
                            </form>
                            <div class="col-sm-12 d-flex justify-content-end">
                             
                              <button type="button" class="btn btn-primary me-1 mb-1 btn-pribadi" > Submit </button>
                            </div>
                          </div>
                        </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Data login aplikasi</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      <form class="form form-horizontal"  id="form-data-login" action="<?=base_url('user/updateprofile')?>" method="post">
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-4">
                              <label for="username" >username</label>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group has-icon-left">
                                <div class="position-relative">
                                  <input type="text" class="form-control" placeholder="username"name="username"id="username" value="<?= $userData->username?>"/>
                                  <input type="hidden" name="cacheusername"id="cacheusername" value="<?= $userData->username?>"/>
                                  <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                       
                            <div class="col-md-4">
                              <label for="password-horizontal-icon">Password</label>
                            </div>
                            <div class="col-md-8">
                              <div class="form-group has-icon-left">
                                <div class="position-relative">
                                  <input  type="password" class="form-control" name="password" placeholder="Password" id="password" value="<?= $userData->password?>"/>
                                  <input type="hidden" name="cahcepassword"  value="<?= $userData->password?>">
                                  <div class="form-control-icon">
                                    <i class="bi bi-lock"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          
                            <div class="col-12 d-flex justify-content-end">
                            <input type="hidden" name="action" value="data-login">
                            <input type="hidden" name="iduser"  value="<?= $userData->user_id?>">
                            </form>
                              <button type="button" class="btn btn-primary me-1 mb-1  btn-user-login" >Submit</button>
                            </div>

                          </div>
                        </div>
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- // Basic Horizontal form layout section end -->
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $(document).ready(function () {

        $('.btn-pribadi').click(function (e) { 
            let fullName =  $('#nama').val();
            let email =  $('#email').val();

            if(fullName === "" || email === ""){
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Form Tidak Boleh Kosong !',
                })
            }else{
                $('#form-data-pribadi').submit();
            }
          
        });

        $('.btn-user-login').click(function (e) { 
            let username =  $('#username').val();
            let password =  $('#password').val();

            if(username === "" || password === ""){
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Form Tidak Boleh Kosong !',
                })
            }else{
                if(!isValidPassword(password)){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Password Minimal harus 6 karakter !',
                    })
                }else{
                    $('#form-data-login').submit();
                }
               
            }
          
        });
    });
</script>
<?= $this->endSection(); ?>