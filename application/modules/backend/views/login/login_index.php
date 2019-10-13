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
		</style>
		<!-- Custom styles for this template -->
		<link href="<?php echo base_url('assets/backend/css/floating-labels.css'); ?>" rel="stylesheet">
	</head>
	<body>
		<form class="form-signin" method="POST" action="<?php echo base_url('login/masuk'); ?>">
			<div class="text-center mb-4">
				<img class="mb-4" src="<?php echo base_url('assets/backend/img/bl.png'); ?>" alt="" width="110" height="80">
				<h1 class="h3 mb-3 font-weight-normal">Login to APP</h1>
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
				<label><input type="checkbox" value="remember-me"> Remember me</label>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			<p class="mt-5 mb-3 text-muted text-center"> &copy; Irfan Isma Somantri || Theme By : <a href="https://getbootstrap.com/docs/4.0/getting-started/introduction/" target="_blank"> Bootstrap </a> <?php echo date('Y'); ?></p>
		</form>
	</body>
</html>
