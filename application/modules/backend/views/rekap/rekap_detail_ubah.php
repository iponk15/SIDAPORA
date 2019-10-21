<div class="main-card mb-3 card">
	<div class="card-header"><h4><b><?php echo $header; ?></b></h4></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('rekap_detail_update/'.$rekdet_id); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Lembaga</label>
						<div class="col-sm-6">
							<textarea class="form-control" name="rekdet_lembaga" placeholder="input lembaga"><?php echo $records->rekdet_lembaga; ?></textarea>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Spesifikasi Bantuan</label>
						<div class="col-sm-3">
							<select name="rekdet_bantuan_id" class="form-control">
								<option value="">Pilih Bantuan</option>
								<?php 
									foreach ($bantuan as $btn) {
										echo '<option '.( $records->rekdet_bantuan_kode == $btn->bantuan_kode ? 'selected' : '' ).' value="'.$btn->bantuan_kode.'"> '.$btn->bantuan_nama.' </option>';
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
										echo '<option '.( $records->rekdet_jnsbtn_kode == $jns->jnsbtn_kode ? 'selected' : '' ).' value="'.$jns->jnsbtn_kode.'"> '.$jns->jnsbtn_nama.' </option>';
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
										echo '<option '.( $records->rekdet_provinsi_kode == $prv->provinsi_kode ? 'selected' : '' ).' value="'.$prv->provinsi_kode.'"> '.$prv->provinsi_nama.' </option>';
									}
								?>
							</select>
						</div>
					</div>
                    <div class="position-relative row form-group formKabkot" <?php echo (empty($records->rekdet_kabkot_kode) ? 'style="display:none;"' : '') ?> >
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kabupaten</label>
						<div class="col-sm-3">
                            <div class="selectKabkot">
                                <select name="kecamatan_kabkot_id" class="form-control kecamatan_kabkot_id">
                                    <option value="">Pilih Kabupaten / Kota</option>
                                    <?php 
                                        foreach ($kabkot as $kabkots) {
                                            echo '<option '.( $records->rekdet_kabkot_kode == $kabkots->kabkot_kode ? 'selected' : '' ).' value="'.$kabkots->kabkot_kode.'">'.$kabkots->kabkot_nama.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
						</div>
					</div>
                    <div class="position-relative row form-group formkecamatan" <?php echo (empty($records->rekdet_kecamatan_kode) ? 'style="display:none;"' : '') ?>>
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kecamatan</label>
						<div class="col-sm-3">
							<div class="selectKecamatan">
                                <select name="keldes_kecamatan_id" class="form-control keldes_kecamatan_id">
                                    <option value=""> Pilih Kecamatan </option>';
                                    <?php 
                                        foreach ($kecamatan as $kecamatans) {
                                            echo '<option '.( $records->rekdet_kecamatan_kode == $kecamatans->kecamatan_kode ? 'selected' : '' ).' value="'.$kecamatans->kecamatan_kode.'"> '.$kecamatans->kecamatan_nama.' </option>';
                                        }
                                    ?>
                                </select>
                            </div>
						</div>
					</div>
                    <div class="position-relative row form-group formKeldes" <?php echo (empty($records->rekdet_keldes_kode) ? 'style="display:none;"' : '' )  ?> >
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kelurahan</label>
						<div class="col-sm-3">
							<div class="selectKelurahan">
								<select name="rekap_keldes_id" class="form-control rekap_keldes_id">
									<option value=""> Pilih Kelurahan </option>';
									<?php 
										foreach ($kelurahan as $keldes) {
											echo '<option '.( $records->rekdet_keldes_kode == $keldes->keldes_kode ? 'selected' : '' ).' value="'.$keldes->keldes_kode.'"> '.$keldes->keldes_nama.' </option>';
										}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Nominal</label>
						<div class="col-sm-3">
							<input type="number" class="form-control" name="rekdet_nominal" placeholder="Input Nominal" value="<?php echo $records->rekdet_nominal; ?>">
						</div>
					</div>
					<div class="position-relative row form-check">
						<div class="col-sm-4 offset-sm-3">
							<a href="<?php echo base_url('rekap_detail/' . md56($records->rekdet_rekap_id)); ?>" class="mb-2 mr-2 btn btn-light active">Kembali</a>
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
			var dta    = { 'provinsi_id' : provId, 'message' : true };

			$.post(url,dta,function(res){
				if(res.status == 0){
					$('.selectKabkot').html(res.message);
					$('.formkecamatan').fadeOut('slow');
					$('.formKeldes').fadeOut('slow');

					$('.keldes_kecamatan_id').val();
					$('.rekap_keldes_id').val();
				}else{
					$('.selectKabkot').html(res.message);
					
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
				}
			},'json');
        }); 

        $('.kecamatan_kabkot_id').on('change', function(){
            $('.formkecamatan').fadeIn('slow');

            var kabkotId = $(this).val();
            var provId   = $('.rekdet_provinsi_id').val();
            var url      = base_url + 'keldes_get_kecamatan';
            var dta      = { 'provinsi_id' : provId, 'kabkot_id' : kabkotId };

            $.post(url,dta,function(res){
                $('.selectKecamatan').html(res);                
            });
        });

		$('.keldes_kecamatan_id').on('change', function(){
			$('.formKeldes').fadeIn('slow');

			var provId      = $('.rekdet_provinsi_id').val();
			var kabkotId    = $('.kecamatan_kabkot_id').val();
			var kecamatanId = $(this).val();
			var url         = base_url + 'rekap_get_kelurahan';
			var dta         = { 'provinsi_id' : provId, 'kabkot_id' : kabkotId, 'kecamtan_id' : kecamatanId };

			$.post(url,dta,function(res){
				$('.selectKelurahan').html(res);
			});
		});
    });
</script>
