<?php $this->extend('layout/_template'); ?>

<?php $this->section('content'); ?>
<div class="container">
    <center><h3>Daftar Buket</h3></center>
        <div class="row">
            <?php foreach ($buket as $buket) { ?>
            <div class="col-lg-3 col-sm-12">
                <div class="card border-0 w-100 p-0">
                    <div class="border rounded bg-light py-2 px-3" style="height: 200px;">
                        <img src="assets/gambar/<?= $buket['buket_gambar']; ?>" class="card-img-top h-100">

                        <a href="#" class="stretched-link"></a>
                    </div>

                    <div class="mt-1 text-center">
                        <a href="#" class="text-decoration-none"><?php echo $buket['buket_nama']." (".$buket['buket_kontak'].")"; ?></a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

<?php $this->endSection(); ?>