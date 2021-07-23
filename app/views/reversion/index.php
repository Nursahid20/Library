<div class="card-body">
    <h4>Log Data Pengembalian</h4>
    <br>
    <button type="button" class="btn btn-info mb-2">
        <a href="<?= BASEURL; ?>/reversion/report" target="_blank"><i class='bx bx-printer' title="cetak laporan buku"></i>Cetak Data</a>
    </button>

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
                    <th scope="col">Tgl Kembali</th>
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
                        <td><?= $sirkulasi['tgl_kembali']; ?></td>
                    </tr>
                <?php $i++;
                }  ?>
            </tbody>
        </table>
    </div>
</div>