<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/css/bootstrap.css">
</head>
<body style="background-image: url(<?= BASEURL; ?>/img/background.jpg); background-size: cover ">
	<div class="card" style="width: 30rem; margin-top: 100px; margin-left: 100px">
		<div class="card-body">
			<form action="<?= BASEURL; ?>/admin/registerAd" method="post">
			  <h1 style="text-align: center">Register Admin</h1>
			  <div class="form-group">
			    <label for="username">username</label>
			    <input type="text" class="form-control" required name="username" id="username" autocomplete="off" autofocus>
			  </div>
			  <div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" class="form-control" required name="password" id="password" autocomplete="off" autofocus>
			  </div><button type="submit" name="submit" class="btn btn-primary" style="float: right;">Register</button>
			</form>
		</div>
	</div>	

	<script src="js/jquery-3.5.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js" ></script>
</body>
</html>