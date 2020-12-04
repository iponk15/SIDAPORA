
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login SIDAPORA</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="<?php echo base_url('assets/frontend/img/icons/favicon.ico'); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/bootstrap.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/font-awesome.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/icon-font.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/animate.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/hamburgers.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/animsition.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/select2.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/daterangepicker.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/util.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/main.css'); ?>">
	</head>
	<body>
		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100">
					<div class="login100-form-title" style="background-image: url(<?php echo base_url('assets/frontend/img/bg-01.jpg'); ?>);">
						<span class="login100-form-title-1">Sign In</span>
					</div>
					<form class="login100-form validate-form" action="<?php echo base_url('login/masuk'); ?>" method="POST">
						<div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
							<span class="label-input100">Email</span>
							<input class="input100" type="text" name="user_email" placeholder="Enter email">
							<span class="focus-input100"></span>
						</div>
						<div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
							<span class="label-input100">Password</span>
							<input class="input100" type="password" name="user_password" placeholder="Enter password">
							<span class="focus-input100"></span>
						</div>
						<div class="flex-sb-m w-full p-b-30">
							<!-- <div class="contact100-form-checkbox">
								<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
								<label class="label-checkbox100" for="ckb1">Remember me</label>
							</div>
							<div><a href="#" class="txt1">Forgot Password?</a></div> -->
						</div>
						<div class="container-login100-form-btn">
							<button type="submit" class="login100-form-btn">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<script src="<?php echo base_url('assets/frontend/js/jquery-3.2.1.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/frontend/js/animsition.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/frontend/js/popper.js'); ?>"></script>
		<script src="<?php echo base_url('assets/frontend/js/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/frontend/js/select2.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/frontend/js/moment.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/frontend/js/daterangepicker.js'); ?>"></script>
		<script src="<?php echo base_url('assets/frontend/js/countdowntime.js'); ?>"></script>
		<script src="<?php echo base_url('assets/frontend/js/main.js'); ?>"></script>
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-23581568-13');
		</script>
	</body>
</html>
