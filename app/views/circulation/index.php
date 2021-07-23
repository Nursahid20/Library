<div class="card-body">
	<h4>Sirkulasi</h4>
	<br>

	<div class="row mb-3">
		<div class="col-lg-6">
			<button type="button" class="btn btn-primary tambahSirkulasi" data-toggle="modal" data-target="#formModal">
				<i class='bx bx-plus-medical'></i> Tambah Data
			</button>
		</div>
	</div>

	<div class="row" style="margin-left:7px">
		<?php Flasher::flash(); ?>
	</div>
	<div id="container">
		<table id="example" class="table table-striped" style="width:100%">
			<thead>
				<tr class="table-secondary">
					<th scope="col">No</th>
					<th scope="col">Buku</th>
					<th scope="col">Peminjam</th>
					<th scope="col">Tgl Pinjam</th>
					<th scope="col">Tgl Kembali</th>
					<th scope="col" style="padding-left:48px;">Denda</th>
					<th scope="col" style="padding-left:30px;">aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				foreach ($data['sirkulasi'] as $sirkulasi) { ?>
					<tr>
						<td><?= $i; ?></td>
						<td><?= $sirkulasi['buku']; ?></td>
						<td><?= $sirkulasi['peminjam']; ?></td>
						<td><?= $sirkulasi['tgl_pinjam']; ?></td>
						<td><?= $sirkulasi['tgl_kembali']; ?></td>
						<td>

							<?php

							$a = $sirkulasi['tgl_kembali'];
							$e = explode("-", $a);
							$tgl = $e[2] . $e[1] . $e[0];
							$tgl = (int)$tgl;
							$now = (int)date('Ymd');
							$hari = $now - $tgl;
							$denda = "Rp." . $hari * 500;

							if ($now > $tgl) { ?>
								<button class="btn btn-sm btn-danger" disabled="disabled"><?= $denda; ?> </button>
								<div>Terlambat <?= $hari; ?> hari</div>
							<?php } else { ?>
								<button class="btn btn-sm btn-primary" disabled="disabled">Masa Peminjaman</button>
							<?php } ?>
						</td>
						<td>
							<div class="row">
								<a href="<?= BASEURL; ?>/circulation/extend/<?= $sirkulasi['idSkl']; ?>" class='btn btn-sm btn-info editSirkulasi'><i class='bx bxs-extension' title="Perpanjang"></i></a>
								<a href="<?= BASEURL; ?>/circulation/delete/<?= $sirkulasi['idSkl']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"><i class='bx bx-trash' title="Hapus"></i></a>
								<a href="<?= BASEURL; ?>/circulation/clear/<?= $sirkulasi['idSkl']; ?>" class="btn btn-sm btn-success" onclick="return confirm('Apakah Buku sudah dikembalikan?');"><i class='bx bxs-check-circle' title="dikembalikan"></i></a>
							</div>
						</td>
					</tr>
				<?php $i++;
				}  ?>
			</tbody>
		</table>
	</div>
</div>



<!-- modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-tabelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="formModalLabel">Tambah Data Mahasiswa</h5>
				<button type="button" class="role" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= BASEURL; ?>/circulation/addCirculation" method="post" enctype="multipart/form-data">
					<input type="hidden" class="form-control col-5" id="idSkl" name="idSkl" autocomplete="off">
					<div class="form-group">
						<label for="nama">Nama peminjam</label>
						<input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="buku">buku</label>
						<select class="custom-select" id="buku" name="buku">
							<option selected>Choose...</option>
							<?php
							foreach ($data['sirkulasi'] as $sirkulasi) { ?>
								<option value="<?= $sirkulasi['buku']; ?>"><?= $sirkulasi['buku']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="tgl_pinjam">Tanggal pinjam</label>
						<input type="date" class="form-control col-5" id="tgl_pinjam" name="tgl_pinjam" autocomplete="off">
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Tambah Data</button>
				</form>
			</div>
		</div>
	</div>
</div>









<!-- <div class="body">
		<div class="row">
				        <?php Flasher::flash(); ?>
				    </div>
		<div class="card-body">
			<div class="row">
				<div class="card-header col-md-12"><h4>Data Peminjaman</h4></div>
				<div class="col-md-6">
				  <div class="card-body text-info">
				  	
				    <form action="<?= BASEURL; ?>/take/takeAdd" method="post">
					  <div class="form-group">
					    <label for="kode">Kode Buku</label>
					    	<select class="form-control" style="width: 20%" name="kode" id="kode">
					    		<option></option>
					    <?php foreach ($data['buku'] as $buku) { ?>
								<option value="<?= $buku['kodeBuku']; ?>"><?= $buku['kodeBuku']; ?></option>
					    <?php } ?>
							</select>
					  </div>
					  <div class="form-group" style="width: 100%">
					    <label for="nama">Nama Siswa</label>
					    <input type="nama" class="form-control" required id="nama" name="nama" autocomplete="off" >
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

					  <button type="submit" name="submit" class="btn btn-success" style="float: right;">Simpan</button>
					
					</form>

				  </div>
				</div>
			</div>
		</div>

		<br><br><br>

		<div class="card-body">
			<div class="card-header" style="text-align: center;">
				<div class="btn-group" role="group" aria-label="Basic example">
				  <button type="button" id="anggota" class="btn btn-secondary mr-2">Data Anggota Perpustakaan</button>
				  <button type="button" id="pinjam" class="btn btn-secondary">Data Siswa yang Pinjam</button>
				</div>
			</div>

			<div id="page">	
				<br>	<br>	<hr>	
			</div>

		</div>
	<br><br>
</div>	 -->