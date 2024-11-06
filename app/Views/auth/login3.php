<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('/public/login3/css/style.css') ?>">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="<?= base_url('/public/login3/img/wave.png') ?>">

	<div class="container">
	
		<div class="img">
			<img src="<?= base_url('/public/login3/img/bg.svg') ?>">
		</div>
		
		<div class="login-content">
			<form action="index.html">
				<img src="<?= base_url('/public/login3/img/avatar.svg') ?>">
				<h2 class="title">Welcome</h2>
				<span class="alert">Username tidak ditemukan</span>

           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input">
            	   </div>
            	</div>

				
					<div>
						<img src=<?=base_url('captcha/code')?> id="capt" width="200" height="50">  
					</div>
					
				 <button class="btn-reload"  type="button" >Reload</button>
				
				
           		
				
				 

				<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input">
           		   </div>
           		</div>

            	<a href="#">Forgot Password?</a>
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script>
		const inputs = document.querySelectorAll(".input");


		function addcl(){
			let parent = this.parentNode.parentNode;
			parent.classList.add("focus");
		}

		function remcl(){
			let parent = this.parentNode.parentNode;
			if(this.value == ""){
				parent.classList.remove("focus");
			}
		}


		inputs.forEach(input => {
			input.addEventListener("focus", addcl);
			input.addEventListener("blur", remcl);
		});

		const reload = document.querySelector('.btn-reload');

		reload.addEventListener('click', function(e) {
			e.preventDefault();
				   img = document.getElementById("capt");
             	   img.src="<?=base_url('captcha')?>/" + Math.random();
		});

	</script>
</body>
</html>
