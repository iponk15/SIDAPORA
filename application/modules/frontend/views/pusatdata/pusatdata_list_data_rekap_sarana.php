<?php
$i = 1;
foreach ($records as $rekap) {
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
                                        <th class="numeric" width="10%"><center>Jumlah</center></th>
                                        <th width="10%"><center>Dokumentasi</center></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>';

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
            var pr = '<?php echo $provinsi; ?>';
            var tp = '<?php echo $type; ?>';
            var kk = '<?php echo $kabupaten; ?>';
            var id = $('#tableBantuan_' + <?php echo $i++; ?> + '_' + <?php echo $provinsi; ?>);
            var baseUrl = 'pusatdata_table/' + ri + '/' + tp + '/' + pr + '/' + kk;
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
                null,
                {
                    "sClass": "text-center"
                }
            ];
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