<div class="main-card mb-3 card">
	<div class="card-header"><h5><b><?php echo $header; ?></b></h5></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('cabang_update/'.$cabang_id); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="osition-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Cabang</label>
						<div class="col-sm-4">
							<input required name="cabang_nama" placeholder="Input cabang" type="text" class="form-control" value="<?php echo $records->cabang_nama; ?>" >
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Deskripsi</label>
						<div class="col-sm-4">
							<textarea name="cabang_deskripsi" class="form-control" cols="30" rows="6" placeholder="Input deskripsi cabang"><?php echo $records->cabang_deskripsi; ?></textarea>
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