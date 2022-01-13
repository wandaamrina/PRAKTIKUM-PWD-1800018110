<?php $this->extend('admin/layout/_template'); ?>

<?php $this->section('content'); ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Buket</h1>
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
                                <!-- <th scope="col">foto</th> -->
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white text-dark">
                            <?php 
                                // perulangan foreach
                                foreach ($buket_ada as $isi) :
                            ?>
                            <tr id="<?= $isi['buket_id'];?>" gambar="<?= $isi['buket_gambar'];?>">
                                <td><?= $isi['buket_nama'];?></td>
                                <td><?php echo 'Rp '.number_format($isi['buket_harga'] ,2,',','.'); ?></td>
                                <td><?= $isi['buket_pemilik'];?></td>
                                <td><?= $isi['buket_kontak'];?></td>
                                <!-- <td>
                                    <img src="assets/barkas/<?= $isi['buket_gambar'];?>" width="100">
                                </td> -->
                                
                                <td style="width: 100px;" class="pl-4">
                                    <a href="<?= base_url('edit-buket/'.$isi['buket_id']) ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <a href="<?= base_url('/soldout/'.$isi['buket_id']) ?>" class="btn btn-sm btn-outline-secondary">Sold</a>
                                    <a href="#" data-href="<?= base_url('admin/news/'.$isi['barkas_id'].'/delete') ?>" onclick="confirmToDelete(this)" class="btn btn-sm btn-outline-danger">Delete</a>
                                </td>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-l">
                <div class="modal-header px-4 bg-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Partai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form id="editForm" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_partai">
                        <div class="mb-3">
                            <label for="nama_edit">Nama partai<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_edit">
                            <div class="invalid-feedback" id="invalid-nama-edit">
                                    
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="singkatan_lama">
                            <label for="singkatan_edit">Singkatan<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="singkatan_edit">
                            <div class="invalid-feedback" id="invalid-singkatan-edit">
                                    
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="foto_edit">Foto<span class="text-danger">*</span></label> 

                            <div>
                                <div class="custom-file">
                                    <input type="hidden" id="foto_lama" name="foto_lama">
                                    <input type="file" id="inputFile_edit" class="imgFile custom-file-input" aria-describedby="inputGroupFileAddon01" name="foto_edit">

                                    <label class="custom-file-label" id="foto_edit" for="inputFile_edit">Choose file</label>
                                </div>

                                <img id="imgPreview_edit" class="w-100 mt-3 border" src="" alt="default">
                            </div>
                        </div>
                </div>
                <div class="modal-footer bg-light">
                        <div class="d-flex flex-row-reverse">
                            <input type="submit" class="btn btn-dark ms-2" value="Tambah">
                            <button type="button" class="btn btn-outline-dark" id="btn-batal-tambah" data-bs-dismiss="modal">Batal</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Foto -->
    <div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body p-0 position-relative">
					<div class="position-absolute top-0 end-0 pe-3 pt-2" style="font-size: 24px;">
						<a type="button" class=" text-white" data-bs-dismiss="modal" aria-label="Close"> <i class="fas fa-times"></i> </a>
					</div>
					<img class="w-100" id="tampil-foto-modal" src="">		
				</div>
			</div>
		</div>
	</div>
    

<script type="text/javascript">
	$(document).on("click", ".tombol-hapus", function(e) {
		e.preventDefault();
		var id = $(this).parents("tr").attr("id");
		var gambar = $(this).parents("tr").attr("gambar");

		// console.log(gambar)

  		Swal.fire({
	        title: 'Hapus Buket Bungs',
	        icon: 'warning',
	        showConfirmButton: false,
	        showCloseButton: true,
	        html: '<form action="<?php echo base_url('admin/delete_buket'); ?>" method="post">'+
	        		'<div>Apakah Anda yakin ? </div>'+
	        	  	'<input type="hidden" name="id" value="'+id+'">'+
	        	  	'<input type="hidden" value="'+gambar+'" name="buket_gambar">'+
	        	  	'<button type="submit" class="btn text-white custom-btn shadow-sm mt-4 p-2">Delete</button>'+
	        	  '</form>',
	    })
	});
</script>

<?php $this->endSection(); ?>