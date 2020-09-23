<div class="main-card mb-3 card">
	<div class="card-header"><h5><b><?php echo $header; ?></b></h5></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('rekap_detail_simpan/'.$rekap_id.'/'.$ktgrId); ?>">
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-11">
					<h4><b> <?php echo $header; ?> </b></h4> <hr>
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
										echo '<option value="'.$btn->bantuan_kode.'"> '.$btn->bantuan_nama.' </option>';
									}
								?>
							</select>
						</div>
					</div>
                    <div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Jenis Bantuan</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="rekdet_jnsbtn_id" placeholder="Input Jenis Bantuan">
							<input type="hidden" class="temp_rekdet_jnsbtn_id" name="rekdet_jnsbtn_id">
						</div>
					</div>
                    <div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Provinsi</label>
						<div class="col-sm-3">
							<input type="text" class="form-control rekdet_provinsi_id" id="rekdet_provinsi_id" placeholder="Input Provinsi">
							<input type="hidden" class="temp_rekdet_provinsi_id" name="rekdet_provinsi_id">
						</div>
					</div>
                    <div class="position-relative row form-group formKabkot" style="display:none;">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kabupaten</label>
						<div class="col-sm-3">
							<input type="text" class="form-control rekdet_kabkot_kode" id="rekdet_kabkot_kode" placeholder="Input Kabupaten / Kota">
							<input type="hidden" class="temp_rekdet_kabkot_kode" name="rekdet_kabkot_kode">
							<div class="selectKabkot"></div>
						</div>
					</div>
                    <div class="position-relative row form-group formkecamatan" style="display:none;">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kecamatan</label>
						<div class="col-sm-3">
							<input type="text" class="form-control rekdet_kecamatan_kode" id="rekdet_kecamatan_kode" placeholder="Input Provinsi">
							<input type="hidden" class="temp_rekdet_kecamatan_kode" name="rekdet_kecamatan_kode">
						</div>
					</div>
                    <div class="position-relative row form-group formKeldes" style="display:none;">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kelurahan</label>
						<div class="col-sm-3">
							<input type="text" class="form-control rekdet_keldes_kode" id="rekdet_keldes_kode" placeholder="Input Provinsi">
							<input type="hidden" class="temp_rekdet_keldes_kode" name="rekdet_keldes_kode">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Nominal</label>
						<div class="col-sm-3">
							<input type="number" class="form-control" name="rekdet_nominal" placeholder="Input Nominal">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Luas (m2)</label>
						<div class="col-sm-3">
							<input type="number" class="form-control" name="rekdet_luas" placeholder="Input Luas">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kat. Bangunan</label>
						<div class="col-sm-3">
							<select name="rekdet_tipe_bangunan" class="form-control">
								<option value="">Pilih Kategori Bangunan</option>
								<option value="1">Pembangunan Baru</option>
								<option value="2">Rehabilitasi</option>
								<option value="3">Renovasi</option>
								<option value="4">Pembangunan</option>
							</select>
						</div>
					</div>
					<hr> <h4><b> Upload Galeri ( Foto ) </b></h4> <hr>
					<div class="input_fields_wrap">
						<div class="row">
							<div class="col-md-2">
								<div class="position-relative form-group">
									<label for="exampleFile" class=""> Step </label>
									<select name="rekdok_step_id[]" class="form-control">
										<option value="">Pilih Step</option>
										<option value="1">Sebelum Pengerjaan</option>
										<option value="2">Waktu Pengerjaan</option>
										<option value="3">Setelah Pengerjaan</option>
										<option value="4">Serah Terima</option>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="position-relative form-group">
									<label for="exampleFile" class=""> Ringkasan </label>
									<input name="rekdok_ringkasan[]" type="text" class="form-control" placeholder="Ringkasan">
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative form-group">
									<label for="exampleFile" class=""> Deskripsi </label>
									<textarea name="rekdok_deskripsi[]" class="form-control" cols="30" rows="2" placeholder="Deskripsi"></textarea>
								</div>
							</div>
							<div class="col-md-2">
								<div class="position-relative form-group">
									<label for="exampleFile" class="">File Gambar </label>
									<input name="rekdok_file[]" type="file" class="form-control-file">
								</div>
							</div>
							<div class="col-md-2" style="margin-left: -1%;">
								<div class="position-relative form-group">
									<label for="exampleFile" class=""> &nbsp; </label>
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="rekdok_is_public[]">
										<label> <div style="margin-top: -10%;"> &nbsp; Tampil Galeri </div> </label>
									</div>
								</div>
							</div>
						</div>
					</div>

					<a class="mb-2 mr-2 btn btn-info active btn-sm add_field_button">Tambah</a>

					<div class="position-relative row form-check">
						<div class="col-sm-4 offset-sm-3">
							<a href="<?php echo base_url('rekap_detail/' . $rekap_id); ?>" class="mb-2 mr-2 btn btn-light active">Kembali</a>
							<button type="submit" class="mb-2 mr-2 btn btn-success active">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>

<script>
    $(document).ready(function(){
		// start autocomplete jenis bantuan
		var bidang = '<?php echo $ktgrId; ?>';
		$("#rekdet_jnsbtn_id").autocomplete({
			source    : base_url + 'sugges_getjenisbantuan?bidang=' + bidang,
			minLength : 1,
			select: function (event, ui) {
				$('.temp_rekdet_jnsbtn_id').val(ui.item.id);
			}
		});
		// end autocomplete jenis bantuan

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

		var max_fields = 10; //maximum input boxes allowed
		var wrapper    = $(".input_fields_wrap"); //Fields wrapper
		var add_button = $(".add_field_button"); //Add button ID
		
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
											'<textarea name="rekdok_deskripsi[]" class="form-control" cols="30" rows="2" placeholder="deskripsi"></textarea>' +
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
									'<div><a style="margin-top: 40%;" data-repeater-delete class="mb-2 mr-2 btn btn-danger active btn-sm remove_field">Hapus</a></div>' +
								'</div>';
				$(wrapper).append(content); //add input box
			}
		});
		
		$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
			e.preventDefault(); 
			$(this).parent('div').parent('.formDel').remove(); 
			x--;
		})
    });
</script>
