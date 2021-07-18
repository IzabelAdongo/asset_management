<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
    <link rel="icon" type="image/png" href="<?php echo base_url('login_libraries/images/icons/favicon.ico'); ?>"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('login_libraries/vendor/bootstrap/css/bootstrap.min.css'); ?>">  
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('login_libraries/fonts/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">  
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('login_libraries/vendor/animate/animate.css'); ?>">  
<!--===============================================================================================-->	
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('login_libraries/vendor/css-hamburgers/hamburgers.min.css'); ?>">   
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('login_libraries/vendor/vendor/select2/select2.min.css'); ?>">  
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('login_libraries/css/util.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('login_libraries/css/main.css'); ?>">   
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                
				<div class="login100-pic js-tilt" data-tilt>
                <span class="login100-form-title">
						Asset Management
                    </span>
					<img src="<?php echo base_url('login_libraries/images/img-01.png'); ?>" alt="IMG">
                </div>
                    
				<form class="login100-form validate-form" action="<?php echo base_url('auth/login'); ?>" method="post">
                <?php if(session()->getFlashdata('msg')):?>
                    <center><div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div></center>
                    <?php endif;?>
					
                    <center><h5 style="font-weight:600;">
						User Login
                    </h5><center>
                    <center><p>Use your email or national ID</p></center>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="login_input" placeholder="Email or National ID">     
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
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
						Password?
						</a>
					</div>

					
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
    <script src="<?php echo base_url('login_libraries/vendor/jquery/jquery-3.2.1.min.js'); ?>"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url('login_libraries/vendor/bootstrap/js/popper.js'); ?>"></script>
    <script src="<?php echo base_url('login_libraries/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url('login_libraries/vendor/select2/select2.min.js'); ?>"></script>
<!--===============================================================================================-->
    <script src="<?php echo base_url('login_libraries/vendor/tilt/tilt.jquery.min.js'); ?>"></script> 
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
    <script src="<?php echo base_url('login_libraries/js/main.js'); ?>"></script>
    

</body>
</html>