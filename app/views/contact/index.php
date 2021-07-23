<div class="container">
	<br>
	<h3>Kontak Kami</h3>
	<br>
	<div class="row" style="margin-left:4px;">
		<?php Flasher::flash(); ?>
    </div>
	<form action="<?= BASEURL; ?>/contact/send" method="post">
	  <div class="form-group">
	    <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" autocomplete="off" placeholder="Nama">
	  </div>
	  <div class="form-group">
	    <input type="text" class="form-control" id="no_telepon" name="no_telepon" autocomplete="off" placeholder="Nomor Telepon">
	  </div>
	  <div class="form-group">
	    <input type="email" class="form-control" id="email" name="email" autocomplete="off" placeholder="E-mail">
	  </div>
	  <div class="form-group">
	    <textarea class="form-control" id="pesan" name="pesan" rows="3" autocomplete="off" placeholder="Pesan"></textarea>
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>

</div>		