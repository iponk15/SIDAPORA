<div class="main-card mb-3 card">
	<div class="card-header"><h5><b><?php echo $header; ?></b></h5></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('kabkot_update/'.$kabkot_id); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Provinsi</label>
						<div class="col-sm-4">
							<select name="kabkot_provinsi_kode" class="form-control">
								<option value="">Pilih Provinsi</option>
								<?php 
									foreach ($provinsi as $prov) {
										echo '<option '.($prov->provinsi_kode == $records->kabkot_provinsi_kode ? "selected" : "").' value="'.$prov->provinsi_kode.'"> '.$prov->provinsi_nama.' </option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kode Kabupaten / Kota</label>
						<div class="col-sm-4">
							<input required name="kabkot_kode" placeholder="Input kode kabupaten / kota" type="text" class="form-control" value="<?php echo $records->kabkot_kode ?>">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kabupaten / Kota</label>
						<div class="col-sm-4">
							<input value="<?php echo $records->kabkot_nama ?>" required name="kabkot_nama" placeholder="Input provinsi" type="text" class="form-control">
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