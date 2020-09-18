<div class="main-card mb-3 card">
	<div class="card-header"> <h5><b> Detail Rekap </b></h5></div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-8">
			<br>
			<table class="mb-0 table table-bordered" style="width:70%;margin-left: -10%;">
				<tbody>
				<tr>
					<th scope="row"><b>Judul</b></th>
					<td><?php echo $rekap->rekap_judul; ?></td>
				</tr>
				<tr>
					<th scope="row"><b>Kategori</b></th>
					<td><?php echo $rekap->kategori_nama; ?></td>
				</tr>
				<tr>
					<th scope="row"><b>Tahun</b></th>
					<td><?php echo $rekap->rekap_tahun; ?></td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
	<hr/>
	<div class="card-header"> <h5><b> Data Rekap Detail </b></h5></div>
	<div class="card-body">
		<div class="text-right"> 
			<a href="<?php echo base_url('rekap_detail_tambah/'.$rekap_id.'/'.md56($rekap->kategori_id)); ?>" class="mb-2 mr-2 btn btn-primary active">Tambah Detail Rekap</a> 
		</div>
		<table class="mb-0 table table-bordered table_user">
			<thead>
				<tr>
					<th><center>No.</center></th>
					<th><center>Lembaga</center></th>
					<th><center>Jenis Bantuan</center></th>
					<th><center>Bantuan</center></th>
					<th><center>Desa</center></th>
					<th><center>Kecamatan</center></th>
					<th><center>Kabupaten</center></th>
					<th><center>Provinsi</center></th>
					<th><center>Nominal</center></th>
					<th><center>Luas</center></th>
					<th><center>Kat. Bangunan</center></th>
					<th><center>Action</center></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 1;
					$bangunan = [ null => '-', 1 => 'Pembangunan Baru', 2 => 'Rehabilitasi', 3 => 'Renovasi', 4 => 'Pembangunan Lanjutan' ];
                    foreach($rkpDetail as $row){
                        echo '
                        <tr>
                            <td scope="row" width="3%"><center>'.$i++.'</center></td>
                            <td>'.$row->rekdet_lembaga.'</td>
                            <td width="10%">'.$row->jnsbtn_nama.'</td>
                            <td>'.$row->bantuan_nama.'</td>
							<td>'.$row->keldes_nama.'</td>
							<td>'.$row->kecamatan_nama.'</td>
							<td>'.$row->kabkot_nama.'</td>
							<td>'.$row->provinsi_nama.'</td>
							<td width="10%">'.uang($row->rekdet_nominal).'</td>
							<td class="text-center">'.(!empty($row->rekdet_luas) ? $row->rekdet_luas . ' m' : '' ).'</td>
							<td>'.$bangunan[$row->rekdet_tipe_bangunan].'</td>
                            <td width="10%">
								<center>
                                    <a href="'.base_url('rekap_detail_ubah/'.md56($row->rekdet_id)).'" class="mb-2 mr-2 btn-transition btn btn-outline-primary"><i class="nav-link-icon fa fa-edit"></i></a>
                                    <a href="'.base_url('rekap_detail_hapus/'.$rekap_id.'/'.md56($row->rekdet_id)).'" class="mb-2 mr-2 btn-transition btn btn-outline-danger"><i class="nav-link-icon fa fa-trash"></i></a>
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