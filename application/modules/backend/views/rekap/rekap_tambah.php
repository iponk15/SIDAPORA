<div class="main-card mb-3 card">
	<div class="card-header"><h4><b> <?php echo $header; ?> </b></h4></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('rekap_simpan'); ?>" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Judul</label>
						<div class="col-sm-6">
							<textarea class="form-control" name="rekap_judul" placeholder="input judul rekap"> </textarea>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kategori</label>
						<div class="col-sm-3">
							<select name="rekap_kategori_id" class="form-control">
								<option value="">Pilih Kategori</option>
								<?php 
									foreach ($kategori as $ktgr) {
										echo '<option value="'.$ktgr->kategori_id.'"> '.$ktgr->kategori_nama.' </option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Tahun</label>
						<div class="col-sm-3">
							<input type="text" class="form-control datepicker" name="rekap_tahun" placeholder="Input tahun" autocomplete="off">
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

<script>
	$(document).ready(function(){
		$('.datepicker').datepicker({
			orientation : "bottom right",
			minViewMode : 2,
			format      : "yyyy",
			autoclose   : true
		});
	});
</script>