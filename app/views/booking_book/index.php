<div class="card-body">
    <h4>Pemesanan Buku</h4>
    <br>

    <div class="row" style="margin-left:7px">
        <?php Flasher::flash(); ?>
    </div>

    <div id="container">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Peminjam</th>
                    <th scope="col">Buku</th>
                    <th scope="col">Tanggal Pesan</th>
                    <th scope="col" style="padding-left: 30px;">aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($data['booking'] as $booking) { ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $booking['nama']; ?></td>
                        <td><?= $booking['buku']; ?></td>
                        <td><?= $booking['tgl_pesan']; ?></td>
                        </td>
                        <td>
                            <a href="<?= BASEURL; ?>/booking_book/clear/<?= $booking['id']; ?>" class="btn btn-sm btn-success" onclick="return confirm('Apakah Anggota jadi Memesan Buku?');"><i class='bx bxs-check-circle' title="pemesanan berhasil"></i></a>
                            <a href="<?= BASEURL; ?>/booking_book/delete/<?= $booking['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"><i class='bx bx-trash' title="Hapus"></i></a>
                        </td>
                    </tr>
                <?php $i++;
                }  ?>
            </tbody>
        </table>

    </div>
</div>