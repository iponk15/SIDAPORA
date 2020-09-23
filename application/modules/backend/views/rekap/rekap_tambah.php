<div class="main-card mb-3 card">
	<div class="card-header"><h5><b><?php echo $header; ?></b></h5></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('rekap_simpan'); ?>" enctype="multipart/form-data">
			<input type="hidden" name="rekap_kategori_id" value="<?php echo $bidang; ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Judul</label>
						<div class="col-sm-6">
							<textarea class="form-control" name="rekap_judul" placeholder="input judul rekap"></textarea>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Tahun</label>
						<div class="col-sm-3">
							<input type="text" class="form-control datepicker" name="rekap_tahun" placeholder="Input tahun" autocomplete="off">
						</div>
					</div>
					<div class="position-relative row form-check">
						<div class="col-sm-5 offset-sm-2">
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