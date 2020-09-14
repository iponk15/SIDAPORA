<div class="main-card mb-3 card">
	<div class="card-header"><h5><b><?php echo $header; ?></b></h5></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('kecamatan_update/'.$kecamatan_id); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Provinsi</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" readonly value="<?php echo $records->provinsi_nama ?>">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kabupaten / Kota</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" readonly value="<?php echo $records->kabkot_nama ?>">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kode Kecamatan</label>
						<div class="col-sm-4">
							<input required name="kecamatan_kode" placeholder="Input kode kecamatan" type="text" class="form-control" value="<?php echo $records->kecamatan_kode ?>">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kecamatan</label>
						<div class="col-sm-4">
							<input value="<?php echo $records->kecamatan_nama ?>" required name="kecamatan_nama" placeholder="Input provinsi" type="text" class="form-control">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Latitude</label>
						<div class="col-sm-4">
							<input name="kecamatan_latitude" placeholder="Input latitude" type="text" class="form-control" value="<?php echo $records->kecamatan_latitude; ?>">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Longtitude</label>
						<div class="col-sm-4">
							<input name="kecamatan_longtitude" placeholder="Input longtitude" type="text" class="form-control" value="<?php echo $records->kecamatan_longtitude; ?>">
						</div>
					</div>
					<div class="position-relative row form-check">
						<div class="col-sm-4 offset-sm-3">
							<a href="<?php echo base_url($url); ?>" class="mb-2 mr-2 btn btn-light active">Kembali</a>
							<button type="submit" class="mb-2 mr-2 btn btn-success active">Submit</button>
						</div>
					</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</form>
	</div>
</div>