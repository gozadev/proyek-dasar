<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    

    <!-- Icons font CSS-->
    <link rel="stylesheet" media="all" type="text/css" href="<?=base_url('public/form1/vendor/mdi-font/css/material-design-iconic-font.min.css')?>">
   
    <link rel="stylesheet" media="all" type="text/css" href="<?=base_url('public/form1/vendor/font-awesome-4.7/css/font-awesome.min.css')?>">

    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <!-- <link rel="stylesheet" media="all" type="text/css" href="<?=base_url('public/form1/vendor/select2/select2.min.css')?>"> -->
    <link rel="stylesheet" media="all" type="text/css" href="<?=base_url('public/form1/vendor/datepicker/daterangepicker.css')?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/extensions/sweetalert2/sweetalert2.css')?>" /> 

    <!-- Main CSS-->
    <link rel="stylesheet" media="all" type="text/css" href="<?=base_url('public/form1/css/main.css')?>">

</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Registration Form</h2>
                    <?= session()->get('info') ?>
                    <form method="POST" id="register-form"  action="<?= base_url('proses-daftar') ?>">
                        <div class="input-group">                        
                            <div class="input-group">
                                <label class="label">Nama Lengkap</label>
                                <input class="input--style-4" type="text" name="nama" id="nama" required>
                            </div>
                        </div>
                        <div class="row row-space">
                            <!-- <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Birthday</label>
                                    <div class="input-group-icon">
                                        <input class="input--style-4 js-datepicker" type="text" name="birthday">
                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                    </div>
                                </div>                              
                            </div> -->
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Username</label>
                                    <input class="input--style-4" type="email" name="username" id="username" required>
                                </div>
                            </div>

                         
                            <!-- <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Gender</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Male
                                            <input type="radio" checked="checked" name="gender">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Female
                                            <input type="radio" name="gender">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="row row-space">
                        <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <input class="input--style-4" type="password" name="password" id="password" required>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Ulangi Password</label>
                                    <input class="input--style-4" type="password" name="re_pass" id="re_pass" required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                        <div class="col-2">
                            <img src=<?=base_url('captcha/code')?> id="capt">  <button type="button" class="btn-captcha btn--radius-2 btn--green"  onClick=reload(); value='Reload'>Reload</button>
                        </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Captcha</label>
                                    <input class="input--style-4" type="text" name="captcha" id="captcha" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="input-group">
                            <label class="label">Subject</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="subject">
                                    <option disabled="disabled" selected="selected">Choose option</option>
                                    <option>Subject 1</option>
                                    <option>Subject 2</option>
                                    <option>Subject 3</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div> -->

                        <div class="p-t-15">
                        <button class="btn btn--radius-2 btn--blue" type="button">Sudah punya akun</button>
                            <button class="btn btn--radius-2 btn--green" id="btn-daftar" type="button">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="<?=base_url('public/form1/vendor/jquery/jquery.min.js')?>"></script>
    <!-- Vendor JS-->
    <script src="<?=base_url('public/form1/vendor/select2/select2.min.js')?>"></script>
    <script src="<?=base_url('public/form1/vendor/datepicker/moment.min.js')?>"></script>
    <script src="<?=base_url('public/form1/vendor/datepicker/daterangepicker.js')?>"></script>
    <script src="<?=base_url('public/assets/extensions/sweetalert2/sweetalert2.all.min.js')?>"></script>
    <!-- Main JS-->
    <script src="<?=base_url('public/form1/js/global.js')?>"></script>

    <script>
       function reload() {
             img = document.getElementById("capt");
             img.src="<?=base_url('captcha')?>/" + Math.random();
         }

         function isValidEmail(email) {
            // Ekspresi reguler untuk format email
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return emailPattern.test(email);
        }

    </script>

<script>
        $(document).ready(function () {
            $('#btn-daftar').click(function () { 
                
                let pass = $('#password').val();
                let repass = $('#re_pass').val();
                let nama = $('#nama').val();
                let email = $('#email').val();
                let username = $('#username').val();
                let captcha = $('#captcha').val();
             
                    if(nama == "" || email == "" || username == "" || pass == "" || repass == "" || captcha == ""){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Data harus diisi semua !',
                            })
                    }else{
                        if(isValidEmail(email)){

                            if(pass.length >= 8){
                                if(pass === repass){
                                    $('#register-form').submit();
                                }else{   
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Pastikan Password anda sama !',
                                        })
                                }
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Password minimal 8 karakter !',
                                    })
                            }

                            
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Pastikan Email anda benar !',
                                })
                        }
                    }

                 
                
            });
        });
    </script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->