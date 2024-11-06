<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login SIM-EPK RSUD AWS</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?=base_url('public/assets/compiled/login/fonts/material-icon/css/material-design-iconic-font.min.css')?>">

    <!-- Main css -->
    <link rel="stylesheet" href="<?=base_url('public/assets/compiled/login/css/style.css')?>">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form"  action="<?= base_url('proses-daftar') ?>">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nama" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-account-box"></i></label>
                                <input type="username" name="username" id="username" placeholder="Your username"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                            <img src=<?=base_url('captcha/code')?> id="capt">  <button type="button"  onClick=reload(); value='Reload'>Reload</button>
                            
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-key"></i></label>
                                <input type="text" name="captcha" id="captcha" placeholder="captcha" oninput="this.value = this.value.toUpperCase()" required/>
                            </div>
                            <!-- <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div> -->
                            <?= session()->get('info') ?>
                            <div class="form-group form-button">
                                <button type="button" id="btn-daftar" class="form-submit">Register</button>
                                <a href="<?=base_url()?>" class="signup-image-link" style="font-weight:bold;margin-top :20px;color:red;text-decoration: none;" >Saya sudah memiliki akun</a>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="<?=base_url('public/assets/compiled/login/images/signup-image.jpg')?>" alt="sing up image"></figure>
                        
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="<?=base_url('public/assets/compiled/login/vendor/jquery/jquery.min.js')?>"></script>
    <script src="<?=base_url('public/assets/compiled/login/js/main.js')?>"></script>
    <script>
       function reload() {
             img = document.getElementById("capt");
             img.src="<?=base_url('captcha')?>/" + Math.random();
         }
    </script>

    <script>
        $(document).ready(function () {
            $('#btn-daftar').click(function () { 
                
                let pass = $('#pass').val();
                let repass = $('#re_pass').val();

                if(pass === repass){
                    $('#register-form').submit();
                }else{
                    alert('password')
                }
                
            });
        });
    </script>
</body>
</html>