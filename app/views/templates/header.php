<?php
if (!isset($_SESSION["id"])) {
	header("Location: login.php");
	exit;
}
$status = $_SESSION['status'];
$username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo $data['judul']; ?></title>
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
	<link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/css/main.css">
	<script src="<?= BASEURL; ?>/js/jquery-3.5.1.slim.min.js"></script>
	<script src="<?= BASEURL; ?>/js/jquery-3.2.1.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

</head>

<header class="header" id="header">
	<div class="header__toggle">
		<i class='bx bx-menu ' id="header-toggle"></i>
	</div>
</header>

<div class="l-navbar" id="nav-bar">
	<nav class="nav">
		<div>
			<?php if ($username === 'admin') { ?>
				<a href="<?= BASEURL; ?>/home" class="nav__logo">
					<i class='bx bx-user-circle bx-md nav__logo-icon'></i>
					<span class="nav__logo-name">Admin </span>
				</a>
			<?php } else { ?>
				<a href="<?= BASEURL; ?>/home" class="nav__logo">
					<i class='bx bx-layer bx-md nav__logo-icon'></i>
					<span class="nav__logo-name">Library</span>
				</a>
			<?php } ?>
			<ul class="list-unstyled components">
				<div class="nav__list">
					<a href="<?= BASEURL; ?>/home" class="nav__link">
						<i class='bx bx-grid-alt bx-sm'></i>
						<span class="nav__name">Beranda</span>
					</a>

					<a href="<?= BASEURL; ?>/galery" class="nav__link">
						<i class='bx bx-book bx-sm'></i>
						<span class="nav__name">Galeri Buku</span>
					</a>

					<?php if ($status ==  'admin') { ?>
						<a href="<?= BASEURL; ?>/booking_book" class="nav__link">
							<i class='bx bx-add-to-queue bx-sm'></i>
							<span class="nav__name">Pemesanan</span>
						</a>
						<a href="#homeSubmenu0" class="nav__link" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
							<i class='bx bx-data bx-sm'></i>
							<span class="nav__name">Kelola Data</span>
						</a>
						<ul class="collapse list-unstyled" id="homeSubmenu0">
							<li>
								<a href="<?= BASEURL; ?>/book">Data Buku</a>
							</li>
							<li>
								<a href="<?= BASEURL; ?>/member">Data Anggota</a>
							</li>
						</ul>

						<a href="<?= BASEURL; ?>/circulation" class="nav__link">
							<i class='bx bx-recycle bx-sm'></i>
							<span class="nav__name">Sirkulasi</span>
						</a>

						<a href="#homeSubmenu1" class="nav__link" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
							<i class='bx bx-log-in-circle bx-sm'></i>
							<span class="nav__name">Log Data</span>
						</a>
						<ul class="collapse list-unstyled" id="homeSubmenu1">
							<li>
								<a href="<?= BASEURL; ?>/borrowing">Peminjaman</a>
							</li>
							<li>
								<a href="<?= BASEURL; ?>/reversion">Pengembalian</a>
							</li>
						</ul>

						<!-- <a href="#homeSubmenu3" class="nav__link"  data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
							<i class='bx bx-grid-alt nav__icon' ></i>
								<span class="nav__name">Buku</span>
							</a>
							<ul class="collapse list-unstyled" id="homeSubmenu3">
								<li>
									<a href="<?= BASEURL; ?>/setting">Pengaturan Buku</a>
								</li>
								<li>
									<a href="<?= BASEURL; ?>/take">Pinjam Buku & Data Anggota</a>
								</li>
							</ul>  -->

					<?php } else { ?>

						<a href="<?= BASEURL; ?>/booking" class="nav__link">
							<i class='bx bx-add-to-queue bx-sm'></i>
							<span class="nav__name">Pemesanan buku</span>
						</a>

					<?php } ?>

					<a href="<?= BASEURL; ?>/contact" class="nav__link">
						<i class='bx bxs-contact bx-sm'></i>
						<span class="nav__name">Kontak Kami</span>
					</a>
				</div>
			</ul>
		</div>
		<a href="<?= BASEURL; ?>/logout" onclick='return confirm("Apakah ingin logout?");' class="nav__link">
			<i class='bx bx-log-out nav__icon'></i>
			<span class="nav__name">Log Out</span>
		</a>
	</nav>
</div>

<body id="body-pd" class="bg-light">