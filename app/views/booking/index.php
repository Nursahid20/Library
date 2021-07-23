<?php
$username = $_SESSION['username'];
$this->db = new Database;
$this->db->query("SELECT * FROM anggota WHERE nis = $username");
$names =  $this->db->resultSet();
foreach ($names as $name) {
    $user = $name['nama_anggota'];
}


?>
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-4">
            <br>
            <h4>Pemesanan Buku</h4>
            <br>
            <div class="row" style="margin-left:7px">
                <?php Flasher::flash(); ?>
            </div>
            <div class="form-group names">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" value="<?= $user; ?>" disabled name="nama" autocomplete="off">
            </div>
            <form action="<?= BASEURL; ?>/booking/add" method="post">
                <input type="hidden" class="form-control" id="nama" value="<?= $user; ?>" name="nama" autocomplete="off">

                <div class="form-group">
                    <label for="buku">buku</label>
                    <select class="custom-select" id="buku" name="buku">
                        <option selected>Choose book...</option>
                        <?php
                        foreach ($data['book'] as $book) { ?>
                            <option value="<?= $book['judul']; ?>"><?= $book['judul']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <br>
                <button class="btn btn-primary" type="submit" style="float:right">Pesan</button>

            </form>
        </div>
    </div>

    <br><br>
    <h3>Buku yang dipesan</h3>
    <br>
    <table class="table table-hover">
        <thead>
            <tr class="table-secondary">
                <th scope="col">No</th>
                <th scope="col">Buku</th>
                <th scope="col">Tanggal Pemesanan</th>
            </tr>
        </thead>

        <?php
        $i = 1;
        foreach ($data['booking'] as $booking) { ?>
            <tbody>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $booking['buku']; ?></td>
                    <td><?= $booking['tgl_pesan']; ?></td>
                </tr>
            </tbody>
        <?php $i++;
        }  ?>
    </table>


</div>