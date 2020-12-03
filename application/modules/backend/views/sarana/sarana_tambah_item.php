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
                            <label class="col-sm-2 col-form-label">Cabor</label>
                            <div class="col-sm-4" style="margin-left: -8.4%;">
                                <input type="text" class="form-control" name="sarbor_cabor" placeholder="Cabor">
                            </div>
                        </div>
                        <div class="input_fields_wrap">
                            <div class="position-relative row form-group">
                                <label class="col-sm-1 col-form-label">Item</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="sarbortem_item[]" placeholder="Item">
                                </div>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" name="sarbortem_jml[]" placeholder="Jumlah">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="sarbortem_satuan[]" placeholder="Satuan">
                                </div>
                            </div>
                        </div>
                        <div class="position-relative row form-check">
                            <div class="col-sm-6 offset-sm-1">
                                <a style="margin-left: -3%;" href="<?php echo base_url('sarana_detail/' . md56($records->rekdet_rekap_id)); ?>" class="mb-2 mr-2 btn btn-light active">Kembali</a>
                                <button type="submit" class="mb-2 mr-2 btn btn-success">Submit</button>
                                <button type="submit" class="mb-2 mr-2 btn btn-success add_field_button"><i class="fa fa-plus"></i> Tambah Item</button>
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
					<th><center>Cabor</center></th>
					<th><center>Item Cabor</center></th>
					<th><center>Action</center></th>
				</tr>
			</thead>
			<tbody>
				<?php
                    $tr = '';
                    $i = 1;
                    foreach ($items as $value) {
                        $list = '['.$value->list.']';
                        $dec  = json_decode($list);
                        $tr .= '<tr>
                                <td class="text-center">'.$i++.'</td>
                                <td class="text-center">'.$value->sarbor_cabor.'</td>
                                <td class=""> ';

                                    foreach ($dec as $lst) {
                                        $tr .= '<ul>
                                            <li>'.$lst->item.' - '.$lst->jml.' '.$lst->satuan.'</li>
                                        </ul>';
                                    }      

                        $tr .=' </td>
                                <td class="text-center">
                                    <!-- <a href="" class="mb-2 mr-2 btn-transition btn btn-outline-primary"><i class="nav-link-icon fa fa-edit"></i></a> -->
                                    <a href="'.base_url('sarana_item_hapus/'.md56($value->sarbor_id)).'" class="mb-2 mr-2 btn-transition btn btn-outline-danger"><i class="nav-link-icon fa fa-trash"></i></a>
                                </td>
                            </tr>';
                    }

                    echo $tr;
                ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.table_item_sarana').DataTable();

        var max_fields      = 10; //maximum input boxes allowed
        var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            x++; //text box increment
            $(wrapper).append('<div class="position-relative row form-group set_'+ x +'">' +
                                '<label class="col-sm-1 col-form-label"></label>' +
                                '<div class="col-sm-4">' +
                                    '<input type="text" class="form-control" name="sarbortem_item[]" placeholder="Item">' +
                                '</div>' +
                                '<div class="col-sm-2">' +
                                    '<input type="number" class="form-control" name="sarbortem_jml[]" placeholder="Jumlah">' +
                                '</div>' +
                                '<div class="col-sm-2">' +
                                    '<input type="text" class="form-control" name="sarbortem_satuan[]" placeholder="Satuan">' +
                                '</div>' +
                                '<div class="col-sm-3">' +
                                    '<button data-set="'+ x +'" class="btn btn-sm btn-danger form-control remove_field" style="width: 25%;"><i class="fa fa-trash"></i></button>' +
                                '</div>' +
                            '</div>');
        });
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); 
            var set = $(this).data('set');
            $('.set_' + set).remove();

            x--;
        })
	} );
</script>