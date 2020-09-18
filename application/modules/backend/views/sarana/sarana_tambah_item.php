<div class="main-card mb-3 card">
	<div class="card-header"> <h5><b> Form Tambah Item </b></h5></div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-4">
			<br>
			<table class="mb-0 table table-bordered">
				<tbody>
				<tr>
					<th scope="row"><b>Lembaga</b></th>
					<td><?php echo $records->rekdet_lembaga; ?></td>
				</tr>
                <tr>
					<th scope="row"><b>Provinsi</b></th>
					<td><?php echo $records->provinsi_nama; ?></td>
				</tr>
                <tr>
					<th scope="row"><b>Kabupaten</b></th>
					<td><?php echo $records->kabkot_nama; ?></td>
				</tr>
                <tr>
					<th scope="row"><b>Kecamatan</b></th>
					<td><?php echo $records->kecamatan_nama; ?></td>
				</tr>
                <tr>
					<th scope="row"><b>Desa</b></th>
					<td><?php echo $records->keldes_nama; ?></td>
				</tr>
				</tbody>
			</table>
		</div>
        <div class="col-md-7">
            <form enctype="multipart/form-data" class="" method="POST" action="<?php echo base_url('sarana_item_simpan/'.$rekdet_id); ?>">
                <div class="row">
                    <div class="col-sm-12">
                        <h4><b> <?php echo $header; ?> </b></h4> <hr>
                        <div class="position-relative row form-group">
                            <label class="col-sm-3 col-form-label">Jenis Bantuan</label>
                            <div class="col-sm-4">
                                <select name="sartem_jnsbtn_kode" class="form-control">
                                    <option value="">Pilih Jenis Bantuan</option>
                                    <?php
                                        foreach ($jnsbtn as $jenis) {
                                            echo '<option value="'. $jenis->jnsbtn_kode .'">'. $jenis->jnsbtn_nama .'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label class="col-sm-3 col-form-label">Jumlah Item</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="sartem_jml" placeholder="Jumlah Item">
                            </div>
                        </div>
                        <div class="position-relative row form-check">
                            <div class="col-sm-4 offset-sm-3">
                                <a href="<?php echo base_url('sarana_detail/' . md56($records->rekdet_rekap_id)); ?>" class="mb-2 mr-2 btn btn-light active">Kembali</a>
                                <button type="submit" class="mb-2 mr-2 btn btn-success active">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
	</div>
	<hr/>
	<div class="card-header"> <h5><b> Daftar Jenis Bantuan </b></h5></div>
	<div class="card-body">
		<table class="mb-0 table table-bordered table_item_sarana">
			<thead>
				<tr>
					<th><center>No.</center></th>
					<th><center>Kode</center></th>
					<th><center>Jenis Sarana</center></th>
					<th><center>Jumlah Sarana</center></th>
					<th><center>Action</center></th>
				</tr>
			</thead>
			<tbody>
				<?php
                    $i = 1;
                    foreach ($items as $value) {
                        echo '<tr>
                                <td class="text-center">'.$i++.'</td>
                                <td class="text-center">'.$value->jnsbtn_kode.'</td>
                                <td class="text-center">'.$value->jnsbtn_nama.'</td>
                                <td class="text-center">'.$value->sartem_jml.'</td>
                                <td class="text-center">
                                    <a href="" class="mb-2 mr-2 btn-transition btn btn-outline-primary"><i class="nav-link-icon fa fa-edit"></i></a>
                                    <a href="'.base_url('sarana_item_hapus/'.md56($value->sartem_id)).'" class="mb-2 mr-2 btn-transition btn btn-outline-danger"><i class="nav-link-icon fa fa-trash"></i></a>
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
		$('.table_item_sarana').DataTable();
	} );
</script>