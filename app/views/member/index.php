<div class="card-body">
    <h4>Data Anggota</h4>
    <br>

    <div class="row mb-3">
        <div class="col-lg-6">
            <button type="button" class="btn btn-primary tambahAnggota" data-toggle="modal" data-target="#formModal">
                <i class='bx bx-plus-medical'></i>Tambah Data
            </button>
            <button type="button" class="btn btn-info">
                <a href="<?= BASEURL; ?>/member/report" target="_blank"><i class='bx bx-printer' title="cetak laporan buku"></i>Cetak Data</a>
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
                    <th scope="col">NIS</th>
                    <th scope="col">Nama siswa</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Jenis kelamin</th>
                    <th scope="col">No telepon</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['siswa'] as $siswa) { ?>

                    <tr>
                        <td><?= $siswa['nis']; ?></td>
                        <td>
                            <?= $siswa['nama_anggota']; ?>
                        </td>
                        <td><?= $siswa['kelas']; ?></td>
                        <td><?= $siswa['jenis_kelamin']; ?></td>
                        <td><?= $siswa['no_telepon']; ?></td>
                        <td><?= $siswa['alamat']; ?></td>
                        <td>
                            <div class="row">
                                <a href="<?= BASEURL; ?>/member/update/<?= $siswa['idAnggota'] ?>" class='btn btn-sm btn-info editAnggota' data-toggle="modal" data-target="#formModal" data-id="<?= $siswa['idAnggota']; ?>"><i class='bx bx-edit' title="Edit"></i></a>

                                <a href="<?= BASEURL; ?>/member/delete/<?= $siswa['idAnggota'] ?>" class="btn btn-sm btn-danger  ml-1 " onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"><i class='bx bx-trash' title="Hapus"></i></a>
                            </div>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- modal -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-tabelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Ubah data </h5>
                    <button type="button" class="role" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASEURL; ?>/member/addMember" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control col-5" id="nis" name="nis" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Siswa</label>
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select class="custom-select" id="kelas" name="kelas">
                                <option selected>Choose...</option>
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
                            <label for="jk">Jenis Kelamin</label>
                            <select class="custom-select" id="jk" name="jk">
                                <option selected>Choose...</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nomor">Nomor Telepon</label>
                            <input type="number" class="form-control col-5" id="nomor" name="nomor" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" autocomplete="off">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>