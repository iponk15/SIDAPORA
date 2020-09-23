<div class="main-card mb-3 card">
	<div class="card-header"><h5><b><?php echo $header; ?></b></h5></div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('user_simpan'); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8 box">
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-4">
							<input required name="user_nama" placeholder="Input Nama" type="text" class="form-control">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-4">
							<input required name="user_email" placeholder="Input Email" type="email" class="form-control">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Role</label>
						<div class="col-sm-4">
							<select name="user_role" class="form-control user_role">
								<option>Pilih Role</option>
								<option value="1">Superadmin</option>
								<option value="2">Admin Bidang</option>
							</select>
						</div>
					</div>
					<div class="position-relative row form-group formAdminBidang" style="display: none;">
						<label for="user_bidang" class="col-sm-2 col-form-label">Kategori Bidang</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="user_kategori_id" placeholder="Input kategori bidang">
							<input type="hidden" class="temp_user_kategori_id" name="user_kategori_id">
						</div>
					</div>
					<div class="position-relative row form-group formAdminBidang" style="display: none;">
						<label for="user_kategori_id" class="col-sm-2 col-form-label">Cabang</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="user_cabang_id" placeholder="Input Cabang">
							<input type="hidden" class="temp_user_cabang_id" name="user_cabang_id">
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Password</label>
						<div class="col-sm-4">
							<input required name="user_password" placeholder="Input Password" type="password" class="form-control">
						</div>
					</div>
					<div class="position-relative row form-check">
						<div class="col-sm-4 offset-sm-3">
							<a href="<?php echo base_url('user'); ?>" class="mb-2 mr-2 btn btn-light active">Kembali</a>
							<button type="submit" class="mb-2 mr-2 btn btn-success active">Submit</button>
						</div>
					</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</form>
	</div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>

<script>
	$(document).ready(function() {
		$("#user_kategori_id").autocomplete({
			source    : base_url + 'sugges_getkategroi',
			minLength : 2,
			select: function (event, ui) {
				$('.temp_user_kategori_id').val(ui.item.id);
			}
		});

		$("#user_cabang_id").autocomplete({
			source    : base_url + 'sugges_getcabang',
			minLength : 2,
			select: function (event, ui) {
				$('.temp_user_cabang_id').val(ui.item.id);
			}
		});

		$('.user_role').on('change', function(){
			var val = $(this).val();

			if(val == 2){
				$('.formAdminBidang').fadeIn('slow');
			}else{
				$('.formAdminBidang').fadeOut('slow');
			}
		});
	});
</script>