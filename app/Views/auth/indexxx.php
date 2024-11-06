<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login SIM-EPK RSUD AWS</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?=base_url('public/assets/compiled/login/fonts/material-icon/css/material-design-iconic-font.min.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?=base_url('public/assets/extensions/bootstrap-icons-1110/bootstrap-icons.css')?>" /> 
    <!-- Main css -->
    <link rel="stylesheet" href="<?=base_url('public/assets/compiled/login/css/style.css')?>">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <!-- <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="<?=base_url('public/assets/compiled/login/images/signin-image.jpg')?>" class="img-fluid"  alt="sing up image"></figure>
                        
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <form method="POST" class="register-form" id="login-form"  action="<?= base_url('proseslogin') ?>" >
                        <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="your_name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                            <img src=<?=base_url('captcha/code')?> id="capt">  <button type="button" onClick=reload(); value='Reload'>Reload</button>
                            
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-key"></i></label>
                                <input type="text" name="captcha" id="captcha" placeholder="captcha" oninput="this.value = this.value.toUpperCase()" required/>
                            </div>
                            <!-- <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div> -->
                            <?= session()->get('info') ?>
                            <div class="form-group form-button row">
                                <div class="col-12">
                                <!-- <input type="submit" style="background-color: blue;font-weight:bold" name="signin" id="signin" class="form-submit" value="Log in"/> -->
                                <button type="submit" class="btn btn-primary ">Log in</button>
                                <button type="button" class="btn btn-danger btn-add">Buat akun</button>
                                </div>
                              
                               
                               
                            </div>

                          
                            
                        </form>
                        <div class="mt-3">
                            <span class="fs-6 text-danger user-select-none video-tutorial"> <i class="bi bi-youtube bi-sub "> </i>  Video Tutorial</span>                      
                        </div>
                
                    </div>
                </div>
            </div>
        </section>

        	<!-- Modal Hasil-->
      <div class="modal fade" id="myModalView" tabindex="-1" data-bs-keyboard="false"  data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
            
            <div class="modal-body">
          <iframe id='frame-video' width="100%" height="400"  title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
            </div>
            </div>
        </div>
    </div>
 <!-- Batas Modal Hasil-->

    </div>

    <!-- JS -->

    <script src="<?=base_url('public/assets/compiled/login/vendor/jquery/jquery.min.js')?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
   
    <script src="<?=base_url('public/assets/compiled/login/js/main.js')?>"></script>
    <script>
       function reload() {
             img = document.getElementById("capt");
             img.src="<?=base_url('captcha')?>/" + Math.random();
         }

         $(document).ready(function () {

            $(document).on("click", ".video-tutorial", function () {
            $('#frame-video').attr('src','https://www.youtube.com/embed/sWPllEi8URQ?si=vGHJwdzH3ocnFfan')
            $('#myModalView').modal('show');
       
          });

          $(function(){
  $('.modal').on('hidden.bs.modal', function (e) {
    $iframe = $(this).find("iframe");
    $iframe.attr("src", $iframe.attr("src"));
  });
});

            $('.btn-add').click(function (e) { 
                e.preventDefault();
                window.location = '<?=base_url("daftar")?>'
                
            });
         });
    </script>
</body>
</html>