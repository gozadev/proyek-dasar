<!DOCTYPE html>
<html lang="en">
<head>
<title><?= getEnv('app_title')?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?=base_url('public/login/login2/images/icons/favicon.ico')?>"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/login2/vendor/bootstrap/css/bootstrap.min.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/login2/fonts/font-awesome-4.7.0/css/font-awesome.min.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/login2/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/login2/vendor/animate/animate.css')?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/login2/vendor/css-hamburgers/hamburgers.min.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/login2/vendor/animsition/css/animsition.min.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/login2/vendor/select2/select2.min.css')?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/login2/vendor/daterangepicker/daterangepicker.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/login2/css/util.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('public/login/login2/css/main.css')?>">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form"  action="<?= base_url('proseslogin') ?>" method="post">
					<span class="login100-form-title p-b-43">
						Login to continue
					</span>
					
					<?= session()->get('info') ?>
					<div class="wrap-input100 validate-input" data-validate = "Username tidak boleh kosong">
						<input class="input100" type="text" name="username">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password tidak boleh kosong">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="mb-2" >
						<img src=<?=base_url('captcha/code')?> id="capt">  <button class="btn btn-primary ml-2 reload"  type="button" >Reload</button>
					
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Kode Captcha tidak boleh kosong">
						<input class="input100" type="text" name="captcha" oninput="this.value = this.value.toUpperCase()">
						<span class="focus-input100"></span>
						<span class="label-input100">Kode Captcha</span>
					</div>

					<!-- <div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div> -->
			

					<div class="container-login100-form-btn mt-5">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					

					<?php if($signUp == 'Y') :?>
						<div class="text-center p-t-46 p-b-20">
							<a class="txt2" href="<?= base_url('daftar') ?>">
								atau daftar
							</a>
						</div>
					<?php endif; ?>
					

					<!-- <div class="login100-form-social flex-c-m">
						<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-facebook-f" aria-hidden="true"></i>
						</a>

						<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div> -->
				</form>

				<div class="login100-more" style="background-image: url('<?=base_url('public/login/login2/images/bg-01.jpg')?>');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="<?=base_url('public/login/login2/vendor/jquery/jquery-3.2.1.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('public/login/login2/vendor/animsition/js/animsition.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('public/login/login2/vendor/bootstrap/js/popper.js')?>"></script>
	<script src="<?=base_url('public/login/login2/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('public/login/login2/vendor/select2/select2.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('public/login/login2/vendor/daterangepicker/moment.min.js')?>"></script>
	<script src="<?=base_url('public/login/login2/vendor/daterangepicker/daterangepicker.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('public/login/login2/vendor/countdowntime/countdowntime.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?=base_url('public/login/login2/js/main.js')?>"></script>
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