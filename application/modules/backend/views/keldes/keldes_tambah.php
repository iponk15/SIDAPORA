<div class="main-card mb-3 card">
	<div class="card-header"><?php echo $header; ?></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('keldes_simpan'); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Provinsi</label>
						<div class="col-sm-4">
							<select name="keldes_provinsi_id" class="form-control kecamatan_provinsi_id">
								<option value="">Pilih Provinsi</option>
								<?php 
									foreach ($provinsi as $prov) {
										echo '<option value="'.$prov->provinsi_id.'"> '.$prov->provinsi_nama.' </option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="position-relative row form-group formKabkot" style="display:none;">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kabupaten / Kota</label>
						<div class="col-sm-4">
							<div class="selectKabkot"></div>
						</div>
					</div>
					<div class="position-relative row form-group formKecamatan" style="display:none;">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kecamatan</label>
						<div class="col-sm-4">
							<div class="selectKecamatan"></div>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kelurahan / Desa</label>
						<div class="col-sm-4">
							<input required name="keldes_nama" placeholder="Input Kelurahan / Desa" type="text" class="form-control">
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
		$('.kecamatan_provinsi_id').on('change', function(){
			$('.formKabkot').fadeIn('slow');

			var provId = $(this).val();
			var url    = base_url + 'kecamatan_get_kabkot';
			var dta    = { 'provinsi_id' : provId };

			$.post(url,dta,function(res){
				$('.selectKabkot').html(res);

				$('.kecamatan_kabkot_id').on('change', function(){
					$('.formKecamatan').fadeIn('slow');

					var kabkotId = $(this).val();
					var url      = base_url + 'keldes_get_kecamatan';
					var dta      = { 'provinsi_id' : provId, 'kabkot_id' : kabkotId };

					$.post(url,dta,function(res){
						$('.selectKecamatan').html(res);
					});
				});
			});

			
		});

		
	});
</script>