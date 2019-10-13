<div class="main-card mb-3 card">
	<div class="card-header"><?php echo $header; ?></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('kabkot_simpan'); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Provinsi</label>
						<div class="col-sm-4">
							<select name="kabkot_provinsi_id" class="form-control">
								<option value="">Pilih Provinsi</option>
								<?php 
									foreach ($provinsi as $prov) {
										echo '<option value="'.$prov->provinsi_id.'"> '.$prov->provinsi_nama.' </option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kabupaten / Kota</label>
						<div class="col-sm-4">
							<input required name="kabkot_nama" placeholder="Input provinsi" type="text" class="form-control">
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