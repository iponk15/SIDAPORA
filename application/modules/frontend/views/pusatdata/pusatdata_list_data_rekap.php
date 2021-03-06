<?php
// pre($records, 1);
$i = 1;
foreach ($records as $rekap) {
    if ($rekap['rekap_tipe'] == 1) {
        //PRASARANA
        $html = '<div class="panel panel-success">
                        <div class="panel-heading" style="background: #E69C39;">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_' . $i . '" style="color: #EDEDED;">
                                    <b>' . $rekap['rekap_judul'] . '</b>
                                </a>
                            </h4>
                        </div>
                        <div id="accordion1_' . $i . '" class="panel-collapse collapse in">
                            <div class="panel-body flip-scroll">
                                <table class="table table-striped table-bordered table-hover" id="tableBantuan_' . $i . '_' . $provinsi . '">
                                    <thead role="row" class="heading">
                                        <tr>
                                            <th width="1%"><center>No. </center></th>
                                            <th width="23%"><center>Lembaga</center></th>
                                            <th width="14%" ' . ($rekap['rekap_tipe'] == 2 ? 'style="display:none;"' : '') . '><center>Jenis Bantuan</center></th>
                                            <th width="10%"><center>Bantuan</center></th>
                                            <th width="10%"><center>Desa</center></th>
                                            <th width="10%"><center>Kecamatan</center></th>
                                            <th width="10%"><center>Kabupaten</center></th>
                                            <th width="10%"><center>Provinsi</center></th>
                                            <th width="10%"><center>Luas(m2)</center></th>
                                            <th class="numeric" width="10%"><center>Nominal</center></th>
                                            <th width="10%"><center>Dokumentasi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>';
    } else {
        // SARANA
        $html = '<div class="panel panel-success">
                        <div class="panel-heading" style="background: #E69C39;">
                            <h4 class="panel-title">
                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_' . $i . '" style="color: #EDEDED;">
                                    <b>' . $rekap['rekap_judul'] . '</b>
                                </a>
                            </h4>
                        </div>
                        <div id="accordion1_' . $i . '" class="panel-collapse collapse in">
                            <div class="panel-body flip-scroll">
                                <table class="table table-striped table-bordered table-hover" id="tableBantuan_' . $i . '_' . $provinsi . '">
                                    <thead role="row" class="heading">
                                        <tr>
                                            <th width="1%"><center>No. </center></th>
                                            <th width="23%"><center>Lembaga</center></th>
                                            <th width="10%"><center>Desa</center></th>
                                            <th width="10%"><center>Kecamatan</center></th>
                                            <th width="10%"><center>Kabupaten</center></th>
                                            <th width="10%"><center>Provinsi</center></th>
                                            <th width="10%"><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>';
    }


    $i++;
    echo $html;
}
?>

<script>
    $(function() {
        // console.log('hallo');
        <?php
        $i = 1;
        foreach ($records as $rowsJs) {
        ?>
            var ri = '<?php echo md56($rowsJs['rekap_id']); ?>';
            var tp = '<?php echo $rowsJs['rekap_tipe']; ?>';
            var pr = '<?php echo $provinsi; ?>';
            var kk = '<?php echo $kabupaten; ?>';
            var kc = '<?php echo $kecamatan; ?>';
            var kd = '<?php echo $keldes; ?>';
            var id = $('#tableBantuan_' + <?php echo $i++; ?> + '_' + <?php echo $provinsi; ?>);
            var baseUrl = 'pusatdata_table/' + ri + '/' + tp + '/' + pr + '/' + kk + '/' + kc + '/' + kd;
            <?php if ($rowsJs['rekap_tipe'] == 2) { ?>
                var header = [
                    null,
                    {
                        "sClass": "text-center"
                    },
                    {
                        "sClass": "text-center"
                    },
                    {
                        "sClass": "text-center"
                    },
                    {
                        "sClass": "text-center"
                    },
                    {
                        "sClass": "text-center"
                    },
                    {
                        "sClass": "text-center"
                    },
                ];
            <?php } else { ?>
                var header = [
                    null,
                    null,
                    {
                        "sClass": "text-center"
                    },
                    {
                        "sClass": "text-center"
                    },
                    {
                        "sClass": "text-center"
                    },
                    {
                        "sClass": "text-center"
                    },
                    {
                        "sClass": "text-center"
                    },
                    {
                        "sClass": "text-center"
                    },
                    null,
                    null,
                    {
                        "sClass": "text-center"
                    }
                ];

            <?php } ?>
            var order = [
                [2, "asc"]
            ];
            var sort = [-1, 0, 1];

            global.init_da(id, baseUrl, header, order, sort);
        <?php
        }
        ?>
    });
</script>