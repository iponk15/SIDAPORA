<div class="main-card mb-3 card">
	<div class="card-header"><?php echo $header; ?></div>
	<div class="card-body">
		<div class="text-right"> 
			<a href="<?php echo base_url('kategori_tambah'); ?>" class="mb-2 mr-2 btn btn-primary active">Tambah Data User</a> 
		</div>
		<table class="mb-0 table table-bordered table_user">
			<thead>
				<tr>
					<th><center>No.</center></th>
					<th><center>Nama</center></th>
					<th><center>Deskripsi</center></th>
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
                            <td>'.$row->kategori_nama.'</td>
                            <td>'.$row->kategori_deskripsi.'</td>
                            <td align="center">'.($row->kategori_status == 1 ? '<div class="mb-2 mr-2 badge badge-success">Aktif</div>' : '<div class="mb-2 mr-2 badge badge-danger">Tidak Aktif</div>').'</td>
                            <td width="10%">
                                <center>
                                    <a href="'.base_url('kategori_ubah/'.$row->kategori_id).'" class="mb-2 mr-2 btn-transition btn btn-outline-info"><i class="nav-link-icon fa fa-edit"></i></a>
                                    <a href="'.base_url('kategori_hapus/'.$row->kategori_id).'" class="mb-2 mr-2 btn-transition btn btn-outline-danger"><i class="nav-link-icon fa fa-trash"></i></a>
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