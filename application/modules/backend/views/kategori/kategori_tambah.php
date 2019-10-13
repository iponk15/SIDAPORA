<div class="main-card mb-3 card">
	<div class="card-header"><?php echo $header; ?></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('kategori_simpan'); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-4">
							<input required name="kategori_nama" placeholder="Input Nama kategori" type="text" class="form-control">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Deskripsi</label>
						<div class="col-sm-4">
							<textarea name="kategori_deskripsi" class="form-control" cols="30" rows="6"></textarea>
						</div>
					</div>
					<div class="position-relative row form-check">
						<div class="col-sm-4 offset-sm-3">
							<a href="<?php echo base_url('user'); ?>" class="mb-2 mr-2 btn btn-light active">Kembali</a>
							<button type="submit" class="mb-2 mr-2 btn btn-success active">Submit</button>
						</div>
					</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</form>
	</div>
</div>