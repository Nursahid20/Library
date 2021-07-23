<div class="container">
  <br>
  <h3>Galery Buku</h3>
  <br>
  <form action="<?= BASEURL; ?>/galery/find" method="post">
    <div class="input-group">
      <input type="text" class="form-control col-lg-4" placeholder="cari buku.." name="keyword" id="keyword" autocomplete="off">
      <div class="input-group-append">
        <button class="btn btn-primary" style="display: none;" type="submit" id="tombolCari">Cari</button>
      </div>
    </div>
  </form>

  <br>

  <div class="row">
    <?php foreach ($data['buku'] as $buku) { ?>
      <div class="card" style="width: 15rem; margin-right: 5px; margin-bottom: 25px;margin-left: 25px; box-shadow: 0 0 15px #5e5b5b">
        <img class="card-img-top" src="<?= BASEURL; ?>/img/<?= $buku['gambar']; ?>" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title"><?= $buku['judul']; ?></h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <?php if ($buku['stok'] > 0) { ?>
            <button class="btn btn-success">tersedia</button>
          <?php } else { ?>
            <button class="btn btn-warning">dipinjam</button>
          <?php } ?>
        </div>

      </div>

    <?php } ?>
  </div>
</div>