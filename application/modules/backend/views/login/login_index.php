<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
		<meta name="generator" content="Jekyll v3.8.5">
		<title>Halaman Login</title>

		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url('assets/backend/css/bootstrap.min.css'); ?>" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<style>
			.bd-placeholder-img {
				font-size: 1.125rem;
				text-anchor: middle;
			}

			@media (min-width: 768px) {
				.bd-placeholder-img-lg {
					font-size: 3.5rem;
				}
			}

			body {
				margin: 0;
				width: 100%;
				height: 100vh;
				font-family: "Exo", sans-serif;
				color: #fff;
				/* background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab); */
				background: linear-gradient(-45deg, red, yellow, green, blue);
				background-size: 400% 400%;
				animation: gradientBG 15s ease infinite;
			}

			@keyframes gradientBG {
				0% {
					background-position: 0% 50%;
				}
				50% {
					background-position: 100% 50%;
				}
				100% {
					background-position: 0% 50%;
				}
			}

			.container {
				width: 100%;
				position: absolute;
				top: 35%;
				text-align: center;
			}

			h1 {
				font-weight: 300;
			}

			h3 {
				color: #eee;
				font-weight: 100;
			}

			h5 {
				color:#eee;
				font-weight:300;
			}

			a,
			a:hover {
				text-decoration: none;
				color: #ddd;
			}

		</style>
		<!-- Custom styles for this template -->
		<link href="<?php echo base_url('assets/backend/css/floating-labels.css'); ?>" rel="stylesheet">
	</head>
	<body>
		<form class="form-signin" method="POST" action="<?php echo base_url('login/masuk'); ?>">
			<div class="text-center mb-4">
				<!-- <img class="mb-4" src="<?php echo base_url('assets/backend/img/bl.png'); ?>" alt="" width="110" height="80"> -->
				<h1><b> SIDAPORA </b></h1>
				<br>
				<br>
				<!-- <h1 class="h3 mb-3 font-weight-normal">Halaman Login</h1> -->
			</div>

			<div class="form-label-group">
				<input type="text" name="user_email" class="form-control" placeholder="Email" required>
				<label for="inputEmail">Email</label>
			</div>

			<div class="form-label-group">
				<input type="password" name="user_password" class="form-control" placeholder="Password" required>
				<label for="inputPassword">Password</label>
			</div>

			<div class="checkbox mb-3">
				<!-- <label><input type="checkbox" value="remember-me"> Remember me</label> -->
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			<!-- <p class="mt-5 mb-3 text-muted text-center"> &copy; Irfan Isma Somantri || Theme By : <a href="https://getbootstrap.com/docs/4.0/getting-started/introduction/" target="_blank"> Bootstrap </a> <?php echo date('Y'); ?></p> -->
		</form>
	</body>
</html>
