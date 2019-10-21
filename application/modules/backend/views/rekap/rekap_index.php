<div class="main-card mb-3 card">
	<div class="card-header">
		<h4><b>Import Data</b></h4>
	</div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('rekap_import'); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Kategori</label>
						<div class="col-sm-3">
							<select name="data_kategori" class="form-control">
								<option value="">Pilih Kategori</option>
								<?php 
									foreach ($kategori as $ktgrs) {
										echo '<option value="'.$ktgrs->kategori_id.'"> '.$ktgrs->kategori_nama.' </option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">Masukan file excel</label>
						<div class="col-sm-3">
							<input type="file" class="form-control" name="data_rekap" placeholder="import data excel">
						</div>
						<button type="submit" class="mb-2 mr-2 btn btn-success active">Submit</button>
					</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</form>
	</div>
</div>
<br>
<div class="main-card mb-3 card">
	<div class="card-header">
		<h4><b><?php echo $header; ?></b></h4>
	</div>
	<div class="card-body">
		<div class="text-right"> 
			<a href="<?php echo base_url('rekap_tambah'); ?>" class="mb-2 mr-2 btn btn-primary active">Tambah Data Rekap</a> 
		</div>
		<table class="mb-0 table table-bordered table_user">
			<thead>
				<tr>
					<th><center>No.</center></th>
					<th><center>Judul</center></th>
					<th><center>Kategori</center></th>
					<th><center>Tahun</center></th>
					<th><center>Status</center></th>
					<th><center>Action</center></th>
				</tr>
			</thead>
			<tbody>
				<?php 
                    $i = 1;
                    foreach($records as $row){
                        echo '
                        <tr>
                            <td scope="row" width="3%"><center>'.$i++.'</center></td>
                            <td>'.$row->rekap_judul.'</td>
                            <td align="center">'.$row->kategori_nama.'</td>
                            <td align="center">'.$row->rekap_tahun.'</td>
                            <td align="center">'.($row->rekap_status == 1 ? '<div class="mb-2 mr-2 badge badge-success">Aktif</div>' : '<div class="mb-2 mr-2 badge badge-danger">Tidak Aktif</div>').'</td>
                            <td width="15%">
								<center>
									<a href="'.base_url('rekap_detail/'.md56($row->rekap_id)).'" class="mb-2 mr-2 btn-transition btn btn-outline-info"><i class="nav-link-icon fa fa-book"></i></a>
                                    <a href="'.base_url('rekap_ubah/'.md56($row->rekap_id)).'" class="mb-2 mr-2 btn-transition btn btn-outline-primary"><i class="nav-link-icon fa fa-edit"></i></a>
                                    <a href="'.base_url('rekap_hapus/'.md56($row->rekap_id)).'" class="mb-2 mr-2 btn-transition btn btn-outline-danger"><i class="nav-link-icon fa fa-trash"></i></a>
                                </center>
                            </td>
                        </tr>';
                    }
				?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.datepicker').datepicker({
			orientation : "bottom right",
			minViewMode : 2,
			format      : "yyyy",
			autoclose   : true
		});

		$('.table_user').DataTable();
	});
</script>