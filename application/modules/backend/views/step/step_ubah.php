<div class="main-card mb-3 card">
	<div class="card-header"><h5><b><?php echo $header; ?></b></h5></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('step_update/'.$step_id); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kode</label>
						<div class="col-sm-4">
							<input required name="step_kode" placeholder="Input kode" type="text" class="form-control" value="<?php echo $records->step_kode; ?>" >
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Step</label>
						<div class="col-sm-4">
							<input required name="step_nama" placeholder="Input step" type="text" class="form-control" value="<?php echo $records->step_nama; ?>" >
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Order</label>
						<div class="col-sm-4">
							<input required name="step_order" placeholder="Input order" type="number" class="form-control" value="<?php echo $records->step_order; ?>" >
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Deskripsi</label>
						<div class="col-sm-4">
							<textarea name="step_deskripsi" class="form-control" cols="30" rows="6" placeholder="Input deskripsi bantuan"><?php echo $records->step_deskripsi; ?></textarea>
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