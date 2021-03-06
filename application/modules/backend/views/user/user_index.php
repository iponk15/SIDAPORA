<div class="main-card mb-3 card">
	<div class="card-header"><h5><b><?php echo $header; ?></b></h5></div>
	<div class="card-body">
		<div class="text-right"> 
			<a href="<?php echo base_url('user_tambah'); ?>" class="mb-2 mr-2 btn btn-primary active">Tambah Data User</a> 
		</div>
		<table class="mb-0 table table-bordered table_user">
			<thead>
				<tr>
					<th><center>No.</center></th>
					<th><center>Nama</center></th>
					<th><center>Email</center></th>
					<th><center>Role</center></th>
					<th><center>Bidang</center></th>
					<th><center>Cabang</center></th>
                    <th><center>Status</center></th>
					<th><center>Action</center></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 1;
					$role = [null => '-', 1 => 'Superadmin', 2 => 'Admin Bidang'];
                    foreach($records as $row){
                        echo '
                        <tr>
                            <td scope="row" width="3%"><center>'.$i++.'</center></td>
                            <td>'.$row->user_nama.'</td>
                            <td>'.$row->user_email.'</td>
							<td class="text-center">'.$role[$row->user_role].'</td>
							<td class="text-center">'.( empty($row->kategori_nama) ? '-' : $row->kategori_nama ).'</td>
							<td class="text-center">'.( empty($row->cabang_nama) ? '-' : $row->cabang_nama ).'</td>
                            <td class="text-center">'.($row->user_status == 1 ? '<div class="mb-2 mr-2 badge badge-success">Aktif</div>' : '<div class="mb-2 mr-2 badge badge-danger">Tidak Aktif</div>').'</td>
                            <td width="10%">
                                <center>
                                    <a href="'.base_url('user_ubah/'.$row->user_id).'" class="mb-2 mr-2 btn-transition btn btn-outline-info"><i class="nav-link-icon fa fa-edit"></i></a>
                                    <a href="'.base_url('user_hapus/'.$row->user_id).'" class="mb-2 mr-2 btn-transition btn btn-outline-danger"><i class="nav-link-icon fa fa-trash"></i></a>
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