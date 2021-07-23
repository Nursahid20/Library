<div class="card-body">
    <h4>Data Buku</h4>
    <br>

    <div class="row mb-3">
        <div class="col-lg-6">
            <button type="button" class="btn btn-primary tambahBuku" data-toggle="modal" data-target="#formModal">
                <i class='bx bx-plus-medical'></i> Tambah Data
            </button>
            <button type="button" class="btn btn-info">
                <a href="<?= BASEURL; ?>/book/report" target="_blank"><i class='bx bx-printer' title="cetak laporan buku"></i>Cetak Data</a>
            </button>
        </div>
    </div>

    <div class="row" style="margin-left:7px">
        <?php Flasher::flash(); ?>
    </div>

    <div id="container">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Kode buku</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Pengarang</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Tahun Terbit</th>
                    <th scope="col">Stok</th>
                    <th scope="col">aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['buku'] as $buku) { ?>

                    <tr>
                        <td><?= $buku['kodeBuku']; ?></td>
                        <td>
                            <img src="<?= BASEURL; ?>/img/<?= $buku['gambar']; ?>" alt="pict" style="width: 130px; height: 170px;">
                        </td>
                        <td><?= $buku['judul']; ?></td>
                        <td><?= $buku['pengarang']; ?></td>
                        <td><?= $buku['penerbit']; ?></td>
                        <td><?= $buku['tahunTerbit']; ?></td>
                        <td><?= $buku['stok']; ?></td>
                        <td>

                            <div class="row">
                                <a href="<?= BASEURL; ?>/book/updateBook/id=<?= $buku['idBuku']; ?>" class='btn btn-sm btn-info mr-1 editBuku' data-toggle="modal" data-target="#formModal" data-id="<?= $buku['idBuku']; ?>"><i class='bx bx-edit' title="Edit"></i></a>

                                <a href="<?= BASEURL; ?>/book/delete/<?= $buku['idBuku']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"><i class='bx bx-trash' title="Hapus"></i></a>
                            </div>



                        </td>
                    </tr>

                <?php } ?>
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
                <form action="<?= BASEURL; ?>/book/addBook" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="gambarLama" id="gambarLama">

                    <div class="form-group">
                        <label for="kodeBuku">Kode Buku</label>
                        <input type="text" class="form-control col-5" id="kodeBuku" name="kodeBuku" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input type="text" class="form-control" id="pengarang" name="pengarang" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="tahunTerbit">Tahun Terbit</label>
                        <input type="text" class="form-control col-4" id="tahunTerbit" name="tahunTerbit" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control col-4" id="stok" name="stok" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label> <br>
                        <input type="file" name="gambar" id="gambar">

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