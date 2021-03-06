<div class="main-card mb-3 card">
	<div class="card-header"><h5><b><?php echo $header; ?></b></h5></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('jenis_bantuan_simpan'); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="position-relative row form-group">
						<label class="col-sm-2 col-form-label">Tipe</label>
						<div class="col-sm-4">
							<select name="jnsbtn_tipe" class="form-control jnsbtn_tipe">
								<option value="">Pilih Tipe</option>
								<option value="1">Prasarana</option>
								<option value="2">Sarana</option>
							</select>
						</div>
					</div>
					<div class="position-relative row form-group" id="jnsbtn_kategori_id" style="display:none;">
						<label class="col-sm-2 col-form-label">Kategori</label>
						<div class="col-sm-4">
							<select name="jnsbtn_kategori_id" class="form-control">
								<option value="">Pilih Kategori</option>
								<?php 
									foreach ($kategori as $rows) {
										echo '<option value="'.$rows->kategori_id.'">'.$rows->kategori_nama.'</option>';
									} 
								?>
							</select>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-2 col-form-label">Kode Janis Bantuan</label>
						<div class="col-sm-4">
							<input required name="jnsbtn_kode" placeholder="Input kode jenis bantuan" type="text" class="form-control">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-2 col-form-label">Janis Bantuan</label>
						<div class="col-sm-4">
							<input required name="jnsbtn_nama" placeholder="Input jenis bantuan" type="text" class="form-control">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label class="col-sm-2 col-form-label">Deskripsi</label>
						<div class="col-sm-4">
							<textarea name="jnsbtn_deskripsi" class="form-control" cols="30" rows="6" placeholder="Input deskripsi jenis bantuan"></textarea>
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
		$('.jnsbtn_tipe').on('change', function(){
			var val = $(this).val();

			if(val == 1){
				$('#jnsbtn_kategori_id').fadeIn('slow');
			}else{
				$('#jnsbtn_kategori_id').fadeOut('slow');
			}
		});
	});
</script>