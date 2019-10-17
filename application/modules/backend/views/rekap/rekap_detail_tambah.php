<div class="main-card mb-3 card">
	<div class="card-header"><h4><b><?php echo $header; ?></b></h4></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('rekap_detail_simpan/'.$rekap_id.'/'.$ktgrId); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Lembaga</label>
						<div class="col-sm-6">
							<textarea class="form-control" name="rekdet_lembaga" placeholder="input lembaga"></textarea>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Spesifikasi Bantuan</label>
						<div class="col-sm-3">
							<select name="rekdet_bantuan_id" class="form-control">
								<option value="">Pilih Bantuan</option>
								<?php 
									foreach ($bantuan as $btn) {
										echo '<option value="'.$btn->bantuan_id.'"> '.$btn->bantuan_nama.' </option>';
									}
								?>
							</select>
						</div>
					</div>
                    <div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Jenis Bantuan</label>
						<div class="col-sm-3">
							<select name="rekdet_jnsbtn_id" class="form-control">
								<option value="">Pilih Jenis Bantuan</option>
								<?php 
									foreach ($jnsbtn as $jns) {
										echo '<option value="'.$jns->jnsbtn_id.'"> '.$jns->jnsbtn_nama.' </option>';
									}
								?>
							</select>
						</div>
					</div>
                    <div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Provinsi</label>
						<div class="col-sm-3">
							<select name="rekdet_provinsi_id" class="form-control rekdet_provinsi_id">
								<option value="">Pilih Provinsi</option>
								<?php 
									foreach ($provinsi as $prv) {
										echo '<option value="'.$prv->provinsi_id.'"> '.$prv->provinsi_nama.' </option>';
									}
								?>
							</select>
						</div>
					</div>
                    <div class="position-relative row form-group formKabkot" style="display:none;">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kabupaten</label>
						<div class="col-sm-3">
							<div class="selectKabkot"></div>
						</div>
					</div>
                    <div class="position-relative row form-group formkecamatan" style="display:none;">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kecamatan</label>
						<div class="col-sm-3">
							<div class="selectKecamatan"></div>
						</div>
					</div>
                    <div class="position-relative row form-group formKeldes" style="display:none;">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kelurahan</label>
						<div class="col-sm-3">
							<div class="selectKelurahan"></div>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Nominal</label>
						<div class="col-sm-3">
							<input type="number" class="form-control" name="rekdet_nominal" placeholder="Input Nominal">
						</div>
					</div>
					<div class="position-relative row form-check">
						<div class="col-sm-4 offset-sm-3">
							<a href="<?php echo base_url('rekap_detail/' . $rekap_id); ?>" class="mb-2 mr-2 btn btn-light active">Kembali</a>
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
        // get select kabupaten berdasarkan provinsi
        $('.rekdet_provinsi_id').on('change', function(){
            $('.formKabkot').fadeIn('slow');

            var provId = $(this).val();
            var url    = base_url + 'kecamatan_get_kabkot';
			var dta    = { 'provinsi_id' : provId };

			$.post(url,dta,function(res){
				$('.selectKabkot').html(res);

                // get select kecamatan berdasarkan provinsi dan kabupatern
                $('.kecamatan_kabkot_id').on('change', function(){
					$('.formkecamatan').fadeIn('slow');

					var kabkotId = $(this).val();
					var url      = base_url + 'keldes_get_kecamatan';
					var dta      = { 'provinsi_id' : provId, 'kabkot_id' : kabkotId };

					$.post(url,dta,function(res){
						$('.selectKecamatan').html(res);

                        // get select kelurahan berdasran provinsi, kabupaten dan kecamatan
                        $('.keldes_kecamatan_id').on('change', function(){
                            $('.formKeldes').fadeIn('slow');

                            var kecamatanId = $(this).val();
                            var url      = base_url + 'rekap_get_kelurahan';
                            var dta      = { 'provinsi_id' : provId, 'kabkot_id' : kabkotId, 'kecamtan_id' : kecamatanId };

                            $.post(url,dta,function(res){
                                $('.selectKelurahan').html(res);
                            });
                        });
					});
				});
			});

        }); 
    });
</script>
