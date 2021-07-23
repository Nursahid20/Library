	<?php 
	if ( isset($_SESSION["id"])) {
		header('location: ' . BASEURL . '/home');
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/css/bootstrap.css">
</head>
<body  style="background-image: url(<?= BASEURL; ?>/img/background1-min.jpg); background-size: cover ">
	<div class="card" style="width: 30rem; margin-top: 150px; margin-left: 420px">
		<div class="card-body">
			<form action="<?= BASEURL; ?>/login/LoginIn" method="post">
				<div class="row">
			        <?php Flasher::flash(); ?>
			    </div>
			  <h1 style="text-align: center">Login</h1><br>
			  <div class="form-group">
			  	<?php if (isset($error)) { ?>
					<p style="color: red; font-style: italic;">username / password salah</p>
				<?php } ?>
			    <label for="username">Username</label>
			    <input type="text" class="form-control" required name="username" id="username" autocomplete="off" autofocus>
			  </div>
			  <div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" class="form-control" required id="password" name="password">
			  </div>
			  <button type="submit" name="submit" class="btn btn-success" style="float: right;">Masuk</button>
			  
				<div  style="margin-top: 20px; margin-left: 140px; float: right;">
					<!-- <a href="<?= BASEURL; ?>/admin">Daftar untuk Admin</a> -->
					<a>Belum punya akun? <a href="<?= BASEURL; ?>/register">Daftar Untuk Siswa</a> </a>
				</div>
			</form>
		</div>
	</div>	

	<script src="js/jquery-3.5.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js" ></script>
</body>
</html>