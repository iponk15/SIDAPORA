<div class="main-card mb-3 card">
	<div class="card-header"><h5><b><?php echo $header; ?></b></h5></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('rekap_detail_update/'.$rekdet_id); ?>">
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-11">
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
							<input type="text" class="form-control rekdet_provinsi_id" id="rekdet_provinsi_id" placeholder="Input Provinsi" value="<?php echo $records->provinsi_nama . ' ('.$records->rekdet_provinsi_kode.')'; ?>">
							<input type="hidden" class="temp_rekdet_provinsi_id" name="rekdet_provinsi_id" value="<?php echo $records->rekdet_provinsi_kode; ?>">
						</div>
					</div>
                    <div class="position-relative row form-group formKabkot" <?php echo (empty($records->rekdet_kabkot_kode) ? 'style="display:none;"' : '' ); ?> >
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kabupaten</label>
						<div class="col-sm-3">
							<input type="text" class="form-control rekdet_kabkot_kode" id="rekdet_kabkot_kode" placeholder="Input Kabupaten / Kota" value="<?php echo $records->kabkot_nama . ' ('.$records->rekdet_kabkot_kode.')'; ?>">
							<input type="hidden" class="temp_rekdet_kabkot_kode" name="rekdet_kabkot_kode" value="<?php echo $records->rekdet_kabkot_kode; ?>">
							<div class="selectKabkot"></div>
						</div>
					</div>
                    <div class="position-relative row form-group formkecamatan" <?php echo (empty($records->rekdet_kecamatan_kode) ? 'style="display:none;"' : '' ); ?>>
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kecamatan</label>
						<div class="col-sm-3">
							<input type="text" class="form-control rekdet_kecamatan_kode" id="rekdet_kecamatan_kode" placeholder="Input Provinsi" value="<?php echo $records->kecamatan_nama . ' ('.$records->rekdet_kecamatan_kode.')'; ?>">
							<input type="hidden" class="temp_rekdet_kecamatan_kode" name="rekdet_kecamatan_kode" value="<?php echo $records->rekdet_kecamatan_kode; ?>">
						</div>
					</div>
                    <div class="position-relative row form-group formKeldes" <?php echo (empty($records->rekdet_keldes_kode) ? 'style="display:none;"' : '' ); ?>>
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kelurahan</label>
						<div class="col-sm-3">
							<input type="text" class="form-control rekdet_keldes_kode" id="rekdet_keldes_kode" placeholder="Input Provinsi" value="<?php echo $records->keldes_nama . ' ('.$records->rekdet_keldes_kode.')'; ?>">
							<input type="hidden" class="temp_rekdet_keldes_kode" name="rekdet_keldes_kode" value="<?php echo $records->rekdet_keldes_kode; ?>" >
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Nominal</label>
						<div class="col-sm-3">
							<input type="number" class="form-control" name="rekdet_nominal" placeholder="Input Nominal" value="<?php echo $records->rekdet_nominal; ?>">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Luas (m)</label>
						<div class="col-sm-3">
							<input type="number" class="form-control" name="rekdet_luas" placeholder="Input Luas" value="<?php echo $records->rekdet_luas; ?>" >
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kat. Bangunan</label>
						<div class="col-sm-3">
							<select name="rekdet_tipe_bangunan" class="form-control">
								<option value="">Pilih Kategori Bangunan</option>
								<option <?php echo ($records->rekdet_tipe_bangunan == '1' ? 'selected' : '' ); ?> value="1">Pembangunan Baru</option>
								<option <?php echo ($records->rekdet_tipe_bangunan == '2' ? 'selected' : '' ); ?> value="2">Rehabilitasi</option>
								<option <?php echo ($records->rekdet_tipe_bangunan == '3' ? 'selected' : '' ); ?> value="3">Renovasi</option>
								<option <?php echo ($records->rekdet_tipe_bangunan == '4' ? 'selected' : '' ); ?> value="4">Pembangunan</option>
							</select>
						</div>
					</div>
					<input type="hidden" value="<?php echo $records->rekdet_id; ?>" name="rekdet_id">
					<hr> <h4><b> Upload Galeri ( Foto ) </b></h4> <hr>
					<div class="input_fields_wrap">
						<?php 
							foreach ($galeri as $glrs) {
						?>
							<input type="hidden" value="<?php echo md56($glrs->rekdok_id); ?>" name="rekdok_id[]">
							<div class="row formDel" data-rekdok_id="<?php echo md56($glrs->rekdok_id); ?>" data-rekdok_file="<?php echo $glrs->rekdok_file; ?>">
								<div class="col-md-2">
									<div class="position-relative form-group">
										<label for="exampleFile" class=""> Step </label>
										<select name="rekdok_step_id[]" class="form-control">
											<option value="">Pilih Step</option>
											<option <?php echo ($glrs->rekdok_step_id == '1' ? 'selected' : '' ); ?> value="1">Sebelum Pengerjaan</option>
											<option <?php echo ($glrs->rekdok_step_id == '2' ? 'selected' : '' ); ?> value="2">Waktu Pengerjaan</option>
											<option <?php echo ($glrs->rekdok_step_id == '3' ? 'selected' : '' ); ?> value="3">Setelah Pengerjaan</option>
											<option <?php echo ($glrs->rekdok_step_id == '4' ? 'selected' : '' ); ?> value="4">Serah Terima</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
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
								<div class="col-md-2">
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
							<a href="<?php echo base_url('rekap_detail/' . md56($records->rekdet_rekap_id)); ?>" class="mb-2 mr-2 btn btn-light active">Kembali</a>
							<button type="submit" class="mb-2 mr-2 btn btn-success active">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<a href="<?php echo base_url('rekap_detail_ubah/'.$rekdet_id) ?>" class="reload"></a>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>

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
									'<div class="col-md-2">' +
										'<div class="position-relative form-group">' +
											'<label for="exampleFile" class=""> Step </label>' +
											'<select name="rekdok_step_id[]" class="form-control">' +
												'<option value="">Pilih Step</option>' +
												'<option value="1">Sebelum Pengerjaan</option>' +
												'<option value="2">Waktu Pengerjaan</option>' +
												'<option value="3">Setelah Pengerjaan</option>' +
												'<option value="4">Serah Terima</option>' +
											'</select>' +
										'</div>' +
									'</div>' +
									'<div class="col-md-2">' +
										'<div class="position-relative form-group">' +
											'<label for="exampleFile" class=""> Ringkasan </label>' +
											'<input name="rekdok_ringkasan[]" type="text" class="form-control" placeholder="Ringkasan">' +
										'</div>' +
									'</div>' +
									'<div class="col-md-3">' +
										'<div class="position-relative form-group">' +
											'<label for="exampleFile" class=""> Deskripsi </label>' +
											'<textarea name="rekdok_deskripsi[]" class="form-control" cols="30" rows="2" placeholder="Deskripsi"></textarea>' +
										'</div>' +
									'</div>' +
									'<div class="col-md-2">' +
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

		// start autocomplete provinsi
		$("#rekdet_provinsi_id").autocomplete({
			source    : base_url + 'sugges_getprovinsi',
			minLength : 1,
			select: function (event, ui) {
				var provinsi = ui.item.id;
				$('.temp_rekdet_provinsi_id').val(ui.item.id);
				$('#rekdet_kabkot_kode').val('');
				$('.temp_rekdet_kabkot_kode').val('');
				$('#rekdet_kecamatan_kode').val('');
				$('.temp_rekdet_kecamatan_kode').val('');
				$('#rekdet_keldes_kode').val('');
				$('.temp_rekdet_keldes_kode').val('');

				// start get data kabko
				$('.formKabkot').fadeIn('slow');
				$("#rekdet_kabkot_kode").autocomplete({
					source    : base_url + 'sugges_getkabko?provinsi=' + provinsi,
					minLength : 1,
					select: function (event, ui) {
						var kabkot = ui.item.id;
						$('.temp_rekdet_kabkot_kode').val(kabkot);
						$('#rekdet_kecamatan_kode').val('');
						$('.temp_rekdet_kecamatan_kode').val('');
						$('#rekdet_keldes_kode').val('');
						$('.temp_rekdet_keldes_kode').val('');

						// start get data kecamatan
						$('.formkecamatan').fadeIn('slow');
						$("#rekdet_kecamatan_kode").autocomplete({
							source    : base_url + 'sugges_getkecamatan?provinsi=' + provinsi + '&kabkot=' + kabkot,
							minLength : 1,
							select: function (event, ui) {
								var kecamatan = ui.item.id;
								$('.temp_rekdet_kecamatan_kode').val(kecamatan);
								$('#rekdet_keldes_kode').val('');
								$('.temp_rekdet_keldes_kode').val('');

								// start get data kelurahan dan desa
								$('.formKeldes').fadeIn('slow');
								$("#rekdet_keldes_kode").autocomplete({
									source    : base_url + 'sugges_getkeldes?provinsi=' + provinsi + '&kabkot=' + kabkot + '&kecamatan=' + kecamatan,
									minLength : 1,
									select: function (event, ui) {
										var keldes = ui.item.id;
										$('.temp_rekdet_keldes_kode').val(keldes);
									}
								});
							}
						});
					}
				});
			}
		});
		// end autocomplete provinsi
		var provinsi  = '<?php echo $records->rekdet_provinsi_kode; ?>';
		var kabupaten = '<?php echo $records->rekdet_kabkot_kode; ?>';
		var kecamatan = '<?php echo $records->rekdet_kecamatan_kode; ?>';
		var keldes    = '<?php echo $records->rekdet_keldes_kode; ?>';
		
		getKabkot(provinsi);
		getKecamatan(provinsi,kabupaten);
		getKeldes(provinsi,kabupaten,keldes);

		function getKabkot(provinsi){
			$("#rekdet_kabkot_kode").autocomplete({
				source    : base_url + 'sugges_getkabko?provinsi=' + provinsi,
				minLength : 1,
				select: function (event, ui) {
					var kabkot = ui.item.id;
					$('.temp_rekdet_kabkot_kode').val(kabkot);
					$('#rekdet_kecamatan_kode').val('');
					$('.temp_rekdet_kecamatan_kode').val('');
					$('#rekdet_keldes_kode').val('');
					$('.temp_rekdet_keldes_kode').val('');
					$('.formKeldes').fadeIn('slow');
					getKecamatan(provinsi,kabkot);
				}
			});
		}

		function getKecamatan(provinsi,kabkot){
			$("#rekdet_kecamatan_kode").autocomplete({
				source    : base_url + 'sugges_getkecamatan?provinsi=' + provinsi + '&kabkot=' + kabkot,
				minLength : 1,
				select: function (event, ui) {
					var kecamatan = ui.item.id;
					$('.temp_rekdet_kecamatan_kode').val(kecamatan);
					$('#rekdet_keldes_kode').val('');
					$('.temp_rekdet_keldes_kode').val('');
					$('.formKeldes').fadeIn('slow');
					getKeldes(provinsi,kabkot,kecamatan);
				}
			});
		}

		function getKeldes(provinsi,kabkot,kecamatan){
			$("#rekdet_keldes_kode").autocomplete({
				source    : base_url + 'sugges_getkeldes?provinsi=' + provinsi + '&kabkot=' + kabkot + '&kecamatan=' + kecamatan,
				minLength : 1,
				select: function (event, ui) {
					var keldes = ui.item.id;
					$('.temp_rekdet_keldes_kode').val(keldes);
				}
			});
		}
		
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
						var redirect    = '<?php echo base_url('rekap_detail_ubah/'.$rekdet_id) ?>';

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
