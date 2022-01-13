<?php $this->extend('layout/_template'); ?>

<?php $this->section('content'); ?>

    <div class="buket">
        <div style="background-image: url(../assets/pexels-fauxels-3184291.jpg); background-size: cover; background-position: center; width: 100%; height: 500px;">
        </div>
        <div class="msk-banner-2"></div>

    </div>

<?= $this->include('layout/_navbar') ?>

    <div class="partai-section-1 py-4">
        <div class="container ">
        <div class="card shadow mb-4">
        <div class="card-body">
            <form action="" method="get">
            <table class="table">
                <tr>
                    <td></td>
                    <td></td>
                    <td><input type="text" name="nisn" placeholder="Masukan Kata Kunci Pencarian" class="form-control"></td>
                    <td><button type="submit" class="btn btn-primary" name="cari">Search</button></td>
                </tr>    	        	
            </table>
                </form>
        </div>
        </div>
            <?php foreach ($buket as $buket) { ?>
            <div class="card px-3 rounded-0 border-0 shadow-sm mb-3">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-sm-12 py-3">
                        <img class="w-100" src="<?php echo base_url('assets/buket/'.$buket['buket_gambar']) ?>" alt="<?php echo $buket['buket_nama']; ?>">      
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-3">
                        <?php echo $buket['buket_nama']; ?>
                        <br>
                        <?php echo 'Rp '.number_format($buket['buket_harga'] ,2,',','.'); ?>
                        <br>
                        <br>
                        <?php echo $buket['buket_kontak']." ( ".$buket['buket_pemilik']." ) "; ?>
                        <br>
                         <a href="<?php echo $buket['buket_wa']; ?>">Hubungi penjual</a> 
                        <br>
                    </div>
                    <div class="col-lg-2 col-sm-12 py-3">
                        <div class="d-flex me-5">
                            <div>
                                <i class="fas fa-user"></i>
                            </div> 
                            <!-- <div class="ms-2">
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-12 py-3">
                        <div class="text-center">
                            <i class="fas fa-chevron-circle-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

<?php $this->endSection(); ?>