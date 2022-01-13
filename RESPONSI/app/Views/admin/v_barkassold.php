<?php $this->extend('admin/layout/_template'); ?>

<?php $this->section('content'); ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Buket Soldout</h1>
                    </div>
                    <div class="col-sm-6">
                        <!-- <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('/admin') ?>">Home</a></li>
                            <li class="breadcrumb-item active">Partai</li>
                        </ol> -->
                        <div class="float-sm-right">
                            <button data-bs-toggle="modal" data-bs-target="#tambahModal" type="button" class="btn btn-dark me-2">Tambah Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="content">
            <div class="container-fluid">
                <div class="bg-white p-3 shadow-sm" style="min-height: 600px;">
                    
                    <div class="table-responsive mt-3">
                    <table id="data-tabel" class="table">
                        <thead class="blue-saphire text-black">
                            <tr>
                                <th scope="col">Buket</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Pemilik</th>
                                <th scope="col">Kontak</th>
                                <th scope="col">foto</th>
                                <!-- <th scope="col">Action</th> -->
                            </tr>
                        </thead>
                        <tbody class="bg-white text-dark">
                            <?php 
                                // perulangan foreach
                                foreach ($_sold as $isi) :
                            ?>
                            <tr id="<?= $isi['buket_id'];?>" gambar="<?= $isi['bauket_gambar'];?>">
                                <td><?= $isi['buket_nama'];?></td>
                                <td><?php echo 'Rp '.number_format($isi['buket_harga'] ,2,',','.'); ?></td>
                                <td><?= $isi['buket_pemilik'];?></td>
                                <td><?= $isi['buket_kontak'];?></td>
                                <td>
                                    <img src="assets/buket/<?= $isi['buket_gambar'];?>" width="100">
                                </td>
                                
                                <!-- <td style="width: 100px;" class="pl-4">
                                    <a href="<?= base_url('admin/news/'.$isi['bukat_id'].'/edit') ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <a href="<?= base_url('admin/news/'.$isi['bukan_id'].'/edit') ?>" class="btn btn-sm btn-outline-secondary">Sold</a>
                                    <a href="#" data-href="<?= base_url('admin/news/'.$isi['barkas_id'].'/delete') ?>" onclick="confirmToDelete(this)" class="btn btn-sm btn-outline-danger">Delete</a>
                                </td> -->
                            </tr>
                            <?php 
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->endSection(); ?>