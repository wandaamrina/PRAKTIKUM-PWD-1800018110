<?php $this->extend('admin/layout/_template'); ?>

<?php $this->section('content'); ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Bucket <?= $buket['buket_nama'] ?></h1>
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
                    <div class="table-responsive mt-3">
                    <?php if(session()->getFlashdata('pesan')) : ?>
                        <div class="swal-pesan" data-swal="<?php echo session()->getFlashdata('pesan') ?>"></div>
                    <?php endif; ?>
                    <form class="form" method="post" action="<?php echo base_url('admin/update') ?>"  enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="mb-2">Nama Barang</label>
                            <input type="hidden" name="id" value="<?= $buket['buket_id'] ?>">
                            <input type="text" name="nama" class="form-control <?php if(session('validation.nama')) : ?>is-invalid<?php endif ?>" value="<?= $buket['buket_nama'] ?>">
                            <div class="invalid-feedback">
                                <?php echo session('validation.nama'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Harga</label>
                            <input type="text" name="harga" class="form-control <?php if(session('validation.harga')) : ?>is-invalid<?php endif ?>" value="<?= $buket['buket_harga'] ?>">
                            <div class="invalid-feedback">
                                <?php echo session('validation.harga'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Pemilik</label>
                            <input type="text" name="pemilik" class="form-control <?php if(session('validation.pemilik')) : ?>is-invalid<?php endif ?>" value="<?= $buket['buket_pemilik'] ?>">
                            <div class="invalid-feedback">
                                <?php echo session('validation.pemilik'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Kontak</label>
                            <input type="text" name="kontak" class="form-control <?php if(session('validation.kontak')) : ?>is-invalid<?php endif ?>" value="<?= $buket['buket_kontak'] ?>">
                            <div class="invalid-feedback">
                                <?php echo session('validation.kontak'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Deskripsi</label>
                            <textarea name="desc" id="" cols="30" rows="10" class="form-control"><?= $buket['buket_desc'] ?></textarea>
                        </div>
                        <div class="mb-3 mt-5 text-center">
                            <button type="submit" value="submit" class="btn btn-light">Simpan </button>
                            <!-- <a href="#" >Sampaikan</a> -->
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->endSection(); ?>