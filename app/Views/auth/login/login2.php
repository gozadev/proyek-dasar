<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?=base_url('public/login-form-07/fonts/icomoon/style.css')?>">

 
    <link rel="stylesheet" href="<?=base_url('public/login-form-07/css/owl.carousel.min.css')?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url('public/login-form-07/css/bootstrap.min.css')?>">
  
    
    <!-- Style -->
    <link rel="stylesheet" href="<?=base_url('public/login-form-07/css/style.css')?>">
    <title><?= getEnv('app_title')?></title>
  </head>
  <body>
  

  
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="<?=base_url('public/login-form-07/images/undraw_remotely_2j6y.svg')?>" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign In</h3>
              <?= session()->get('info') ?>
            </div>
            <form  action="<?= base_url('proseslogin') ?>" method="post">
              <div class="form-group first mb-2">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username">
              </div>
              <div class="form-group last mb-2">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">           
              </div>

              <div class="  mb-2">
              <img src=<?=base_url('captcha/code')?> id="capt">  <button class="btn btn-primary ml-2 reload"  type="button" >Reload</button>
					
              </div>

              <div class="form-group last mb-4">
                <label for="password">Kode Captcha</label>
                <input type="test" class="form-control" id="captcha" name="captcha" oninput="this.value = this.value.toUpperCase()">
              </div>
              
              <!-- <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
              </div> -->

              <input type="submit" value="Log In" class="btn btn-block btn-primary">

              <!-- <span class="d-block text-left my-4 text-muted">&mdash; or login with &mdash;</span> -->
             
            <?php if($signUp == 'Y') :?>
              <a class="d-block text-left my-4 text-muted text-decoration-none" href="<?= base_url('daftar') ?>">
							&mdash; daftar &mdash;
						</a>
            <?php endif; ?>
              <!-- <div class="social-login">
                <a href="#" class="facebook">
                  <span class="icon-facebook mr-3"></span> 
                </a>
                <a href="#" class="twitter">
                  <span class="icon-twitter mr-3"></span> 
                </a>
                <a href="#" class="google">
                  <span class="icon-google mr-3"></span> 
                </a>
              </div> -->
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

    <script src="<?=base_url('public/login-form-07/js/jquery-3.3.1.min.js')?>"></script>
    <script src="<?=base_url('public/login-form-07/js/popper.min.js')?>"></script>
    <script src="<?=base_url('public/login-form-07/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('public/login-form-07/js/main.js')?>"></script>
    <script >
		
		$(document).ready(function () {

			$('.reload').click(function (e) { 
				e.preventDefault();
				   img = document.getElementById("capt");
             	   img.src="<?=base_url('captcha')?>/" + Math.random();
				
			});
		
      
		});
	</script>
  </body>
</html>