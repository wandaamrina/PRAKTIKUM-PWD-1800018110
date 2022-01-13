<?php $this->extend('admin/layout/_template'); ?>

<?php $this->section('content'); ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Barkas</h1>
                    </div>
                    <div class="col-sm-6">
                        <!-- <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('/admin') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Partai</li>
                        </ol> -->
                    </div>
                </div>
            </div>
        </div>
    
        <div class="content">
            <div class="container-fluid">
                <div class="bg-white p-3 shadow-sm" style="min-height: 600px;">
                    
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Cetak Data Laporan</h6>
                        </div>
                        <div class="card-body">
                        <form action="cetak_laporan.php" method="get" target="_blank">
                        	<input type="date" name="awal" class="form-control mb-2">
                        	<input type="date" name="akhir" class="form-control mb-2">
                        	<button type="submit" class="btn btn-primary" name="cetak">Cetak</button>
                        </form>
</div>
                </div>
            </div>
        </div>
    </div>

<?php $this->endSection(); ?>