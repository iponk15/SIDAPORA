<div class="main-card mb-3 card">
	<div class="card-header"><h5><b><?php echo $header; ?></b></h5></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('sarana_detail_update/'.$rekdet_id); ?>">
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
						<label for="exampleEmail" class="col-sm-2 col-form-label">Jumla Barang</label>
						<div class="col-sm-3">
							<input type="number" class="form-control" name="rekdet_jmlbarang" placeholder="Input jumlah barang" value="<?php echo $records->rekdet_jmlbarang; ?>" >
						</div>
					</div>
					<input type="hidden" value="<?php echo $records->rekdet_id; ?>" name="rekdet_id">
					<hr> <h4><b> Upload Galeri ( Foto ) </b></h4> <hr>
					<div class="input_fields_wrap">
						<?php 
							foreach ($galeri as $glrs) {
						?>
								<input type="hidden" value="<?php echo md56($glrs->rekdok_id); ?>" name="rekdok_id[]" class="bewokAjag">
								<div class="row formDel" data-rekdok_id="<?php echo md56($glrs->rekdok_id); ?>" data-rekdok_file="<?php echo $glrs->rekdok_file; ?>">
									<div class="col-md-3">
										<div class="position-relative form-group">
											<label for="exampleFile" class=""> Ringkasan </label>
											<input value="<?php echo $glrs->rekdok_ringkasan; ?>" name="rekdok_ringkasan[]" type="text" class="form-control">
										</div>
									</div>
									<div class="col-md-3">
										<div class="position-relative form-group">
											<label for="exampleFile" class=""> Deskripsi </label>
											<textarea name="rekdok_deskripsi[]" class="form-control" cols="30" rows="2"><?php echo $glrs->rekdok_deskripsi; ?></textarea>
										</div>
									</div>
									<div class="col-md-3">
										<div class="position-relative form-group">
											<label for="exampleFile" class="">File Gambar </label>
											<input name="rekdok_file[]" type="file" class="form-control-file">
											<input type="hidden" value="<?php echo $glrs->rekdok_file; ?>" name="rekdok_file_old[]">
											<?php echo $glrs->rekdok_file; ?>
										</div>
									</div>
									<div class="col-md-2" style="margin-left: -1%;">
										<div class="position-relative form-group">
											<label for="exampleFile" class=""> &nbsp; </label>
											<div class="custom-checkbox custom-control">
												<input <?php echo ($glrs->rekdok_is_public == '1' ? 'checked' : ''); ?> type="checkbox" name="rekdok_is_public[]">
												<label> <div style="margin-top: -10%;"> &nbsp; Tampil Galeri </div> </label>
											</div>
										</div>
									</div>
									<div><a style="margin-top: 40%;" data-repeater-delete class="mb-2 mr-2 btn btn-danger active btn-sm remove_field" data-swall="true">Hapus</a></div>
								</div>
							<?php } ?>
					</div>

					<a class="mb-2 mr-2 btn btn-info active btn-sm add_field_button">Tambah</a>

					<div class="position-relative row form-check">
						<div class="col-sm-4 offset-sm-3">
							<a href="<?php echo base_url('sarana_detail/' . md56($records->rekdet_rekap_id)); ?>" class="mb-2 mr-2 btn btn-light active">Kembali</a>
							<button type="submit" class="mb-2 mr-2 btn btn-success active">Submit</button>
						</div>
					</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</form>
	</div>
</div>

<a href="<?php echo base_url('sarana_detail_ubah/'.$rekdet_id) ?>" class="reload"></a>

<script>
    $(document).ready(function(){
		var max_fields      = 10; //maximum input boxes allowed
		var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
		var add_button      = $(".add_field_button"); //Add button ID
		
		var x = 1; //initlal text box count
		$(add_button).click(function(e){ //on add input button click
			e.preventDefault();
			if(x < max_fields){ //max input box allowed
				x++; //text box increment
				var content = '<div class="row formDel">' +
									'<div class="col-md-3">' +
										'<div class="position-relative form-group">' +
											'<label for="exampleFile" class=""> Ringkasan </label>' +
											'<input name="rekdok_ringkasan[]" type="text" class="form-control">' +
										'</div>' +
									'</div>' +
									'<div class="col-md-3">' +
										'<div class="position-relative form-group">' +
											'<label for="exampleFile" class=""> Deskripsi </label>' +
											'<textarea name="rekdok_deskripsi[]" class="form-control" cols="30" rows="2"></textarea>' +
										'</div>' +
									'</div>' +
									'<div class="col-md-3">' +
										'<div class="position-relative form-group">' +
											'<label for="exampleFile" class="">File Gambar </label>' +
											'<input name="rekdok_file[]" type="file" class="form-control-file">' +
										'</div>' +
									'</div>' +
									'<div class="col-md-2" style="margin-left: -1%;">' +
										'<div class="position-relative form-group">' +
											'<label for="exampleFile" class=""> &nbsp; </label>' +
											'<div class="custom-checkbox custom-control">' +
												'<input type="checkbox" name="rekdok_is_public[]">' +
												'<label> <div style="margin-top: -10%;"> &nbsp; Tampil Galeri </div> </label>' +
											'</div>' +
										'</div>' +
									'</div>' +
									'<div><a style="margin-top: 40%;" data-repeater-delete class="mb-2 mr-2 btn btn-danger active btn-sm remove_field data-swall="false"">Hapus</a></div>' +
								'</div>';
				$(wrapper).append(content); //add input box
			}
		});
		
		$(wrapper).on("click",".remove_field", function(e){
			var dtSwl = $(this).attr('data-swall');

			if(dtSwl == 'true'){
				Swal.fire({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
					if (result.value) {
						var rekdok_id   = $(this).parent('div').parent('.formDel').attr('data-rekdok_id');
						var rekdok_file = $(this).parent('div').parent('.formDel').attr('data-rekdok_file');
						var url         = base_url + 'rekap_apus_galeri';
						var xdta        = { 'rekdok_id' : rekdok_id, 'rekdok_file' : rekdok_file };
						var redirect    = '<?php echo base_url('sarana_detail_ubah/'.$rekdet_id) ?>';

						$.post(url,xdta,function(res){
							if(res.status == '1'){
								window.location.href = redirect;
							}
						},'json');
					}
				})
			}else{
				e.preventDefault(); 
				$(this).parent('div').parent('.formDel').remove();
				x--;
			}
		});

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
