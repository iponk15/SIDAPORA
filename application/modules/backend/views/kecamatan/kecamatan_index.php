<div class="main-card mb-3 card">
	<div class="card-header"><?php echo $header; ?></div>
	<div class="card-body">
		<div class="text-right"> 
			<a href="<?php echo base_url('kecamatan_tambah'); ?>" class="mb-2 mr-2 btn btn-primary active">Tambah Data Kecamatan</a> 
		</div>
		<table class="mb-0 table table-bordered table_user">
			<thead>
				<tr>
					<th><center>No.</center></th>
					<th><center>Provinsi</center></th>
					<th><center>Kabupaten / Kota</center></th>
					<th><center>Kode Kecamatan</center></th>
					<th><center>Kecamatan</center></th>
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
                            <td>'.$row->provinsi_nama.' (<b> '.$row->provinsi_kode.' </b>)</td>
                            <td>'.$row->kabkot_nama.' (<b> '.$row->kabkot_kode.' </b>)</td>
                            <td align="center" width="13%">'.$row->kecamatan_kode.'</td>
                            <td>'.$row->kecamatan_nama.'</td>
                            <td align="center" width="10%">'.($row->kecamatan_status == 1 ? '<div class="mb-2 mr-2 badge badge-success">Aktif</div>' : '<div class="mb-2 mr-2 badge badge-danger">Tidak Aktif</div>').'</td>
                            <td width="10%">
                                <center>
                                    <a href="'.base_url('kecamatan_ubah/'.md56($row->kecamatan_id)).'" class="mb-2 mr-2 btn-transition btn btn-outline-info"><i class="nav-link-icon fa fa-edit"></i></a>
                                    <a href="'.base_url('kecamatan_hapus/'.md56($row->kecamatan_id)).'" class="mb-2 mr-2 btn-transition btn btn-outline-danger"><i class="nav-link-icon fa fa-trash"></i></a>
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