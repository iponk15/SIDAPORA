<div id="main-wrapper">
    <div id="main" style="margin-top: 4%;">
        <div id="main-inner">
            <!-- MAP -->
            <div class="block-content no-padding">
                <div class="block-content-inner">
                    <div class="map-wrapper">
                        <div id="googleMap" data-style="1" style="height: 673px !important;"></div><!-- /#map -->
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-8 col-md-3 col-md-offset-9 map-navigation-positioning">
                                    <div class="map-navigation-wrapper">
                                        <div class="map-navigation" style="top: -650px !important;">
                                            <form method="get" action="<?php echo base_url('pusatdata') ?>" class="clearfix">


                                                <div class="form-group col-sm-6">
                                                    <label>Tahun</label>
                                                    <input type="text" readonly class="form-control tahun" placeholder="e.g. 2015" name="tahun" value="<?php echo $tahun ?>" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group col-sm-12">
                                                    <label>Tipe</label>

                                                    <div class="select-wrapper">
                                                        <select id="select-type" class="form-control" name="type" required>
                                                            <option value="3" <?php echo ($type == 3 ? 'selected' : '') ?>>Semua</option>
                                                            <option value="1" <?php echo ($type == 1 ? 'selected' : '') ?>>Prasarana</option>
                                                            <option value="2" <?php echo ($type == 2 ? 'selected' : '') ?>>Sarana</option>
                                                        </select>
                                                    </div><!-- /.select-wrapper -->
                                                </div><!-- /.form-group -->
                                                <div class="form-group col-sm-12">
                                                    <label>Provinsi</label>

                                                    <div class="select-wrapper">
                                                        <select id="select-country" class="form-control" name="provinsi">
                                                            <option value="">Pilih Provinsi</option>
                                                            <?php foreach ($provinsis as $prov) { ?>
                                                                <option value="<?php echo $prov['provinsi_kode'] ?>" <?php echo ($prov['provinsi_kode'] == $provinsi ? 'selected' : '') ?>><?php echo $prov['provinsi_nama'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div><!-- /.select-wrapper -->
                                                </div><!-- /.form-group -->

                                                <div class="form-group col-sm-12">
                                                    <label>Kabupaten</label>

                                                    <div class="select-wrapper">
                                                        <select id="select-location" class="form-control" name="kabupaten">
                                                            <option value="">Pilih Kabupaten</option>
                                                            <?php foreach ($kabupatens as $kabkot) { ?>
                                                                <option value="<?php echo $kabkot['kabkot_kode'] ?>" <?php echo ($kabkot['kabkot_kode'] == $kabupaten ? 'selected' : '') ?> class="<?php echo $kabkot['provinsi_kode'] ?>"><?php echo $kabkot['kabkot_nama'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div><!-- /.select-wrapper -->
                                                </div><!-- /.form-group -->

                                                <div class="form-group col-sm-12">
                                                    <label>Kecamatan</label>

                                                    <div class="select-wrapper">
                                                        <select id="select-kecamatan" class="form-control" name="kecamatan" <?php echo ($kabupaten == '' ? 'disabled' : '') ?>>
                                                            <option value="" class="parent">Pilih Kecamatan</option>
                                                            <?php foreach ($kecamatans as $kec) { ?>
                                                                <option value="<?php echo $kec->kecamatan_kode ?>" <?php echo ($kec->kecamatan_kode == $kecamatan && $kec->kecamatan_kabkot_kode == $kabupaten ? 'selected' : '') ?> class="<?php echo $kec->kecamatan_kabkot_kode ?>" data-kabkot=""><?php echo $kec->kecamatan_nama ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div><!-- /.select-wrapper -->
                                                </div><!-- /.form-group -->

                                                <div class="form-group col-sm-12">
                                                    <input type="submit" class="btn btn-primary btn-inversed btn-block" value="Filter Properties">
                                                </div><!-- /.form-group -->
                                            </form>
                                        </div><!-- /.map-navigation -->
                                    </div><!-- /.map-navigation-wrapper -->
                                </div><!-- /.col-sm-3 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->

                    </div><!-- /.map-wrapper -->
                </div><!-- /.block-content-inner -->
            </div><!-- /.block-content -->
        </div><!-- /#main-inner -->
    </div><!-- /#main -->
</div><!-- /#main-wrapper -->

<div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:1550px;">
        <div class="modal-content" style="top: 60px;">
            <div class="modal-header" style="background-color: turquoise;">
                <button type="button" class="btn default" data-dismiss="modal" style="float: right;">Close</button>
                <h4 class="modal-title" style="color: black;"><i class="fa fa-info-circle"></i> <b>Detail Informasi</b></h4>
            </div>
            <div class="modal-body">
                <div class="listDataRekap"></div>
            </div>
            <div class="modal-footer"> <button type="button" class="btn default" data-dismiss="modal">Close</button> </div>
        </div>
    </div>
</div>

<div class="modal fade bs-modal-lg" id="dokumentasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width:1350px;">
        <div class="modal-content" style="top: 120px;">
            <div class="modal-header" style="background-color: turquoise;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" style="color: black;"><i class="fa fa-file-image-o"></i> <b>Dokumentasi</b></h4>
            </div>
            <div class="modal-body">
                <div id="ctnDokumentasi"></div>
            </div>
            <div class="modal-footer"> <button type="button" class="btn default" data-dismiss="modal">Close</button> </div>
        </div>
    </div>
</div>

<div class="modal fade" id="list_item" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="top: 120px;">
            <div class="modal-header" style="background-color: turquoise;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" style="color: black;"><i class="fa fa-file-image-o"></i> <b>List Item</b></h4>
            </div>
            <div class="modal-body">
                <div id="ctnListItem"></div>
            </div>
            <div class="modal-footer"> <button type="button" class="btn default" data-dismiss="modal">Close</button> </div>
        </div>
    </div>
</div>

<script>
    function cek_kecamatan() {
        var kab = $('#select-location').val() == '' ? false : true;
        if (kab == false) {
            $('#select-kecamatan').attr('disabled');
        } else {
            $('#select-kecamatan').removeAttr('disabled');
        };
    }

    function initialize() {
        var latitude = '<?php echo $latitude ?>';
        var longtitude = '<?php echo $longtitude ?>';
        var zoomdef = parseInt('<?php echo $zoom ?>');
        var datamap = $.parseJSON('<?php echo $datamap ?>');
        var type = '<?php echo $type ?>';
        var propertiPeta = {
            center: new google.maps.LatLng(latitude, longtitude),
            zoom: zoomdef,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

        // membuat Marker
        for (i = 0; i < datamap.length; i++) {
            var kabkot_kode = typeof(datamap[i].kabkot_kode) != "undefined" && datamap[i].kabkot_kode !== null ? datamap[i].kabkot_kode : '';
            var kecamatan_kode = typeof(datamap[i].kecamatan_kode) != "undefined" && datamap[i].kecamatan_kode !== null ? datamap[i].kecamatan_kode : '';
            var keldes_kode = typeof(datamap[i].keldes_kode) != "undefined" && datamap[i].keldes_kode !== null ? datamap[i].keldes_kode : '';
            var jumlah_prasarana = typeof(datamap[i].jumlah_prasarana) != "undefined" && datamap[i].jumlah_prasarana !== null ? datamap[i].jumlah_prasarana : 0;
            var jumlah_sarana = typeof(datamap[i].jumlah_sarana) != "undefined" && datamap[i].jumlah_sarana !== null ? datamap[i].jumlah_sarana : 0;
            var jumlah_semua = typeof(datamap[i].jumlah_semua) != "undefined" && datamap[i].jumlah_semua !== null ? datamap[i].jumlah_semua : 0;


            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(datamap[i].latitude, datamap[i].longtitude),
                map: peta,
                title: 'Jumlah = ' + jumlah_prasarana + ' bantuan'
            });
            if (type == 1) {
                var body_content = '<p><b>' + datamap[i].nama + '</b>, jumlah bantuan pada provinsi ini ada <a href="">' + jumlah_prasarana + '</a> Bantuan.</p>';
            } else if (type == 2) {
                var body_content = '<p><b>' + datamap[i].nama + '</b>, jumlah bantuan pada provinsi ini ada <a href="">' + jumlah_sarana + '</a> Bantuan.</p>';
            } else {
                var body_content = '<p><b>' + datamap[i].nama + '</b>, jumlah bantuan pada provinsi ini ada <a href="">' + jumlah_semua + '</a> Bantuan.</p> (<b>Prasarana = ' + jumlah_prasarana + '</b>, <b>Sarana = ' + jumlah_sarana + '</b>)';

            }

            var content = '<div id="content">' +
                '<div id="siteNotice"></div>' +
                '<h2 id="firstHeading" class="firstHeading">' +
                datamap[i].nama +
                ' <a data-toggle="modal" href="#large" class="btn btn-xs bg-yellow-gold detailInfromasi" data-type="' + type + '" data-tahun="<?php echo $tahun; ?>" data-provinsi="' + datamap[i].provinsi_kode + '" data-kabupaten="' + kabkot_kode + '" data-kecamatan="' + kecamatan_kode + '" data-keldes="' + keldes_kode + '" title="Detail"> ' +
                'Detail <i class="fa fa-sign-in"></i>' +
                '</a>' +
                '</h2> ' +
                '<div id="bodyContent">' + body_content + '</div>' +
                '</div>';

            var infowindow = new google.maps.InfoWindow();

            google.maps.event.addListener(marker, 'click', (function(marker, content, infowindow) {
                return function() {
                    infowindow.setContent(content);
                    infowindow.open(peta, marker);
                };
            })(marker, content, infowindow));
        }
    };

    $(document).ready(function() {
        initialize();
        disablekecamatan();
        var kecamatan = '<?php echo $kecamatan ?>';
        var kabupaten = '<?php echo $kabupaten ?>';
        if (kecamatan != '') {
            $('#select-kecamatan.' + kabupaten).val(kecamatan);
        }
        var prm = {
            format: "yyyy",
            minViewMode: 2,
            autoclose: true
        };
        global.init_dtrp(1, '.tahun', prm);

        $('#select-country').on('change', function() {
            disablekecamatan();
        });

        $('#select-location').on('change', function() {
            disablekecamatan();
        });
    });

    function disablekecamatan() {
        var val = $('#select-location').val();
        var option = $('#select-kecamatan').find('option');
        cek_kecamatan();
        $.each(option, function(index, value) {
            var clas = $(this).attr('class');
            if (clas != val && clas != 'parent') {
                $(this).attr('style', "display:none;");
            } else {
                $(this).removeAttr('style');
            }
        });
    }

    $(document).on('click', '.detailInfromasi', function() {
        var tahun = $(this).attr('data-tahun');
        var provinsi = $(this).attr('data-provinsi');
        var kabupaten = $(this).attr('data-kabupaten');
        var kecamatan = $(this).attr('data-kecamatan');
        var keldes = $(this).attr('data-keldes');
        var type = $(this).attr('data-type');
        var url = base_url + 'pusatdata_cari/2';
        var xdta = {
            'tahun': tahun,
            'type': type,
            'provinsi': provinsi,
            'kabupaten': kabupaten,
            'kecamatan': kecamatan,
            'keldes': keldes,
        };

        $.post(url, xdta, function(html) {
            $('.listDataRekap').html(html);
        });
    });

    $(document).on('click', '.listDokumentasi', function() {
        var id = $(this).attr('data-id');
        var url = base_url + 'pusatdata_dokumentasi';
        var xdt = {
            'rekdet_id': id
        };

        $.post(url, xdt, function(res) {
            $('#ctnDokumentasi').html(res);
        });
    });

    $(document).on('click', '.listItem', function() {
        var id = $(this).attr('data-id');
        var url = base_url + 'pusatdata_item_sarana';
        var xdt = {
            'rekdet_id': id
        };

        $.post(url, xdt, function(res) {
            $('#ctnListItem').html(res);
        });
    });
</script>