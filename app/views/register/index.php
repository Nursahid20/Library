<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/css/bootstrap.css">
</head>
<body style="background-image: url(<?= BASEURL; ?>/img/register-min-min.jpg); background-size: cover ;">
	<div class="card" style="width: 30rem; margin-top: 5px; margin-left: 100px; background-color: rgba(0, 150, 0, 0);">
		<div class="card-body">
			<form action="<?= BASEURL; ?>/register/registerAdd" method="post">
			  <h1 style="text-align: center">Register</h1>
			  <div class="form-group">
			    <label for="nis">NIS</label>
			    <input type="text" class="form-control" required name="nis" id="nis" autocomplete="off" autofocus>
			  </div>
			  <div class="form-group">
			    <label for="name">Nama Lengkap</label>
			    <input type="text" class="form-control" required name="name" id="name" autocomplete="off" autofocus>
			  </div>
			  <div class="form-group">
					<label for="kelas">Jenis kelamin</label>
						<select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
							<option></option>
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
				</div>
			  <div class="form-group" style="width: 20%">
					<label for="kelas">Kelas</label>
						<select class="form-control" name="kelas" id="kelas">
							<option></option>
							<option value="X IPA">X IPA</option>
							<option value="X IPS">X IPS</option>
							<option value="X AGAMA">X AGAMA</option>
							<option value="XI IPA">XI IPA</option>
							<option value="XI IPS">XI IPS</option>
							<option value="XI AGAMA">XI AGAMA</option>
							<option value="XII IPA">XII IPA</option>
							<option value="XII IPS">XII IPS</option>
							<option value="XII AGAMA">XII AGAMA</option>
						</select>
				</div>
			  <div class="form-group">
			    <label for="no_telepon">Nomor telepon</label>
			    <input type="text" class="form-control" required name="no_telepon" id="no_telepon" autocomplete="off" autofocus>
			  </div>
			  <div class="form-group">
			    <label for="alamat">Alamat</label>
			    <input type="text" class="form-control" required name="alamat" id="alamat" autocomplete="off" autofocus>
			  </div>
			  <button type="submit" name="submit" class="btn btn-primary" style="float: right;">Register</button>
			</form>
		</div>
	</div>	

	<script src="js/jquery-3.5.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js" ></script>
</body>
</html>