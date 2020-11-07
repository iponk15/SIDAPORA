<div class="main-card mb-3 card">
	<div class="card-header">
		<h5><b>Import Data</b></h5>
	</div>
	<div class="card-body">
		<form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('provinsi_import'); ?>">
			<div class="row">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="position-relative row form-group">
						<label for="exampleEmail" class="col-sm-2 col-form-label">File excel</label>
						<div class="col-sm-4">
							<input type="file" class="form-control" name="data_rekap" placeholder="import data excel">
						</div>
						<div class="col-sm-4">
						<button type="submit" class="mb-2 mr-2 btn btn-success active">Submit</button>
						</div>
					</div>
				</div>
				<div class="col-sm-2 text-right"></div>
			</div>
		</form>
	</div>
</div>
<br>
<div class="main-card mb-3 card">
	<div class="card-header"><h5><b><?php echo $header; ?></b></h5></div>
	<div class="card-body">
		<div class="text-right"> 
			<a href="<?php echo base_url('provinsi_tambah'); ?>" class="mb-2 mr-2 btn btn-primary active">Tambah Data Provinsi</a> 
		</div>
		<table class="mb-0 table table-bordered table_user">
			<thead>
				<tr>
					<th><center>No.</center></th>
					<th><center>Kode Provinsi</center></th>
					<th><center>Provinsi</center></th>
					<th><center>Latitude</center></th>
					<th><center>Longtitude</center></th>
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
                            <td align="center" width="10%">'.$row->provinsi_kode.'</td>
                            <td>'.$row->provinsi_nama.'</td>
                            <td class="text-center">'.$row->provinsi_latitude.'</td>
                            <td class="text-center">'.$row->provinsi_longtitude.'</td>
                            <td align="center" width="10%">'.($row->provinsi_status == 1 ? '<div class="mb-2 mr-2 badge badge-success">Aktif</div>' : '<div class="mb-2 mr-2 badge badge-danger">Tidak Aktif</div>').'</td>
                            <td width="10%">
                                <center>
                                    <a href="'.base_url('provinsi_ubah/'.md56($row->provinsi_id)).'" class="mb-2 mr-2 btn-transition btn btn-outline-info"><i class="nav-link-icon fa fa-edit"></i></a>
                                    <a href="'.base_url('provinsi_hapus/'.md56($row->provinsi_id)).'" class="mb-2 mr-2 btn-transition btn btn-outline-danger"><i class="nav-link-icon fa fa-trash"></i></a>
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
		$('.table_user').DataTable();
	} );
</script>