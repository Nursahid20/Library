$(function() {

    // jQuery DATA BUKU

    $('.tambahBuku').on('click', function(){
        $('#formModalLabel').html('Tambah data Buku');
        $(".modal-footer button[type=submit]").html('Tambah data');
        $('#kodeBuku').val('');
        $('#judul').val('');
        $('#pengarang').val('');
        $('#penerbit').val('');
        $('#tahunTerbit').val('');
        $('#stok').val('');
            
    });

    $('.editBuku').on('click', function(){
        $('#formModalLabel').html('Ubah data Buku');    
        $('.modal-footer button[type=submit]').html('Ubah data');
        $('.modal-body form' ).attr('action', 'http://localhost/library/public/book/updateBook');
    
        const id = $(this).data('id');
        $.ajax({
            url: "http://localhost/library/public/book/getBook",
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#kodeBuku').val(data.kodeBuku);
                $('#judul').val(data.judul);
                $('#pengarang').val(data.pengarang);
                $('#penerbit').val(data.penerbit);
                $('#tahunTerbit').val(data.tahunTerbit);
                $('#stok').val(data.stok);
                $('#gambarLama').val(data.gambar);
                $('#id').val(data.idBuku);
                console.log(data);
            }

        });
    });

    // jQuery DATA ANGGOTA
    $('.tambahAnggota').on('click', function(){
        $('#formModalLabel').html('Tambah data Anggota');
        $(".modal-footer button[type=submit]").html('Tambah data');
        $('#id').val('');
        $('#nis').val('');
        $('#nama').val('');
        $('#jk').val('');
        $('#kelas').val('');
        $('#nomor').val('');
        $('#alamat').val('');
    });

    $('.editAnggota').on('click', function(){
        $('#formModalLabel').html('Ubah data anggota');    
        $('.modal-footer button[type=submit]').html('Ubah data');
        $('.modal-body form' ).attr('action', 'http://localhost/library/public/member/updateMember');
    
        const id = $(this).data('id');
        $.ajax({
            url: "http://localhost/library/public/member/getMember",
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#id').val(data.idAnggota);
                $('#nis').val(data.nis);
                $('#nama').val(data.nama_anggota);
                $('#jk').val(data.jenis_kelamin);
                $('#kelas').val(data.kelas);
                $('#nomor').val(data.no_telepon);
                $('#alamat').val(data.alamat);
                console.log(data);
            }

        });
    });




});






 
/*===== SHOW NAVBAR  =====*/ 
const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId),
    bodypd = document.getElementById(bodyId),
    headerpd = document.getElementById(headerId)

    // Validate that all variables exist
    if(toggle && nav && bodypd && headerpd){
        toggle.addEventListener('click', ()=>{
            // show navbar
            nav.classList.toggle('show')
            // change icon
            toggle.classList.toggle('bx-x')
            // add padding to body
            bodypd.classList.toggle('body-pd')
            // add padding to header
            headerpd.classList.toggle('body-pd')
        })
    }
}

showNavbar('header-toggle','nav-bar','body-pd','header')


/*===== LINK ACTIVE  =====*/ 
const linkColor = document.querySelectorAll('.nav__link')

function colorLink(){
    if(linkColor){
        linkColor.forEach(l=> l.classList.remove('active'))
        this.classList.add('active')
    }
}
linkColor.forEach(l=> l.addEventListener('click', colorLink))









