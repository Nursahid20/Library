$(document).ready(function() {
	$('#anggota').on('click', function() {

		$('#page').load('http://localhost/perpustakaan/public/Member');

	});
	$('#pinjam').on('click', function() {
		
		$('#page').load('http://localhost/perpustakaan/public/Borrow');

	});

});

