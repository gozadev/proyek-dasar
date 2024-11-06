<!DOCTYPE html>
<html lang="en">
<head>
	<title><?= getEnv('app_title')?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="icon" type="image/png"  href="<?=base_url('public/login1/images/icons/favicon.ico')?>">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="<?=base_url('public/login1/vendor/bootstrap/css/bootstrap.min.css')?>">
<!--===============================================================================================-->
	
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/login1/fonts/font-awesome-4.7.0/css/font-awesome.min.css')?>">
<!--===============================================================================================-->

    <link rel="stylesheet" type="text/css" href="<?=base_url('public/login1/vendor/animate/animate.css')?>">
<!--===============================================================================================-->	
	
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/login1/vendor/css-hamburgers/hamburgers.min.css')?>">
<!--===============================================================================================-->
	
   
<!--===============================================================================================-->

    <link rel="stylesheet" type="text/css" href="<?=base_url('public/login1/css/util.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/login1/css/main.css')?>">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?=base_url('public/login1/images/img-01.png')?>" alt="IMG">
				</div>

				<form class="login100-form validate-form"  action="<?= base_url('proseslogin') ?>" method="post">
					<span class="login100-form-title">
						<?= getEnv('app_name')?> Login
					</span>
					<?= session()->get('info') ?>
					<div class="wrap-input100 validate-input" data-validate = "Valid username is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="mb-2 ml-5 wrap-input100">
					<img src=<?=base_url('captcha/code')?> id="capt">  <button class="btn btn-primary ml-2 reload"  type="button" >Reload</button>
					</div>
				
					<div class="wrap-input100 validate-input" data-validate = "Captcha is required">
						<input class="input100" type="text" name="captcha" placeholder="Captcha" oninput="this.value = this.value.toUpperCase()">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
				
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<!-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div> -->
				
					<?php if($signUp == 'Y') :?>
						<div class="text-center p-t-50">
							<a class="font-weight-bold" href="<?= base_url('daftar') ?>">
								Create your Account
								<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
							</a>
						</div>
					<?php endif; ?>
					
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<!-- <script src="<?=base_url('public/login1/vendor/jquery/jquery-3.2.1.min.js')?>"></script> -->
	<script src="<?=base_url('public/login1/vendor/jquery/jquery-3.7.1.slim.min.js')?>"></script>
<!--===============================================================================================-->
    <script src="<?=base_url('public/login1/vendor/bootstrap/js/popper.js')?>"></script>
    <script src="<?=base_url('public/login1/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<!--===============================================================================================-->


<!--===============================================================================================-->
	
    <script src="<?=base_url('public/login1/vendor/tilt/tilt.jquery.min.js')?>"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->

    <script src="<?=base_url('public/login1/js/main.js')?>"></script>
	<script >
			// function reload() {
          
			// alert('aaa')
			// }
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