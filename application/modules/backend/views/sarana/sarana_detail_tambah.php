<div class="main-card mb-3 card">
	<div class="card-header"><h5><b><?php echo $header; ?></b></h5></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('sarana_detail_simpan/'.$rekap_id.'/'.$ktgrId); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<h4><b> <?php echo $header; ?> </b></h4> <hr>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Lembaga</label>
						<div class="col-sm-6">
							<textarea class="form-control" name="rekdet_lembaga" placeholder="input lembaga"></textarea>
						</div>
					</div>
                    <div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Jenis Bantuan</label>
						<div class="col-sm-3">
							<select name="rekdet_jnsbtn_id" class="form-control">
								<option value="">Pilih Jenis Bantuan</option>
								<?php 
									foreach ($jnsbtn as $jns) {
										echo '<option value="'.$jns->jnsbtn_kode.'"> '.$jns->jnsbtn_nama.' </option>';
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
										echo '<option value="'.$prv->provinsi_kode.'"> '.$prv->provinsi_nama.' </option>';
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
						<label for="exampleEmail" class="col-sm-2 col-form-label">Jumla Barang</label>
						<div class="col-sm-3">
							<input type="number" class="form-control" name="rekdet_jmlbarang" placeholder="Input jumlah barang">
						</div>
					</div>

					<hr> <h4><b> Upload Galeri ( Foto ) </b></h4> <hr>
					<div class="input_fields_wrap">
						<div class="row">
							<div class="col-md-3">
								<div class="position-relative form-group">
									<label for="exampleFile" class=""> Ringkasan </label>
									<input name="rekdok_ringkasan[]" type="text" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="position-relative form-group">
									<label for="exampleFile" class=""> Deskripsi </label>
									<textarea name="rekdok_deskripsi[]" class="form-control" cols="30" rows="2"></textarea>
								</div>
							</div>
							<div class="col-md-3">
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
							<a href="<?php echo base_url('sarana_detail/' . $rekap_id); ?>" class="mb-2 mr-2 btn btn-light active">Kembali</a>
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

        // get select kabupaten berdasarkan provinsi
        $('.rekdet_provinsi_id').on('change', function(){
            $('.formKabkot').fadeIn('slow');

            var provId = $(this).val();
            var url    = base_url + 'kecamatan_get_kabkot';
			var dta    = { 'provinsi_id' : provId, 'message' : true };

			$.post(url,dta,function(res){
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
                            var url      = base_url + 'sarana_get_kelurahan';
                            var dta      = { 'provinsi_id' : provId, 'kabkot_id' : kabkotId, 'kecamtan_id' : kecamatanId };

                            $.post(url,dta,function(res){
                                $('.selectKelurahan').html(res);
                            });
                        });
					});
				});
			},'json');

        }); 
    });
</script>
