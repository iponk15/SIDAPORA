<div class="main-card mb-3 card">
	<div class="card-header"><h5><b><?php echo $header; ?></b></h5></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('bantuan_update/'.$bantuan_id); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kategori</label>
						<div class="col-sm-4">
							<select name="bantuan_kategori_id" class="form-control">
								<option value="">Pilih Kategori</option>
								<?php 
									foreach ($kategori as $rows) {
										echo '<option '.( $rows->kategori_id == $records->bantuan_kategori_id ? "selected" : "" ).' value="'.$rows->kategori_id.'">'.$rows->kategori_nama.'</option>';
									} 
								?>
							</select>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kode Bantuan</label>
						<div class="col-sm-4">
							<input required name="bantuan_kode" placeholder="Input kode bantuan" type="text" class="form-control" value="<?php echo $records->bantuan_kode; ?>">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Janis Bantuan</label>
						<div class="col-sm-4">
							<input required name="bantuan_nama" placeholder="Input jenis bantuan" type="text" class="form-control" value="<?php echo $records->bantuan_nama; ?>">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Deskripsi</label>
						<div class="col-sm-4">
							<textarea name="bantuan_deskripsi" class="form-control" cols="30" rows="6" placeholder="Input deskripsi jenis bantuan"><?php echo $records->bantuan_deskripsi ?></textarea>
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