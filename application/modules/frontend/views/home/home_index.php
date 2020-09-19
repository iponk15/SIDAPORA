<style>
    /* START CSS FOR IMG CAROUSAL */
    .vertical .carousel-inner {
        height: 100%;
    }

    .carousel.vertical .item {
        -webkit-transition: 0.6s ease-in-out top;
        -moz-transition: 0.6s ease-in-out top;
        -ms-transition: 0.6s ease-in-out top;
        -o-transition: 0.6s ease-in-out top;
        transition: 0.6s ease-in-out top;
    }

    .carousel.vertical .active {
        top: 0;
    }

    .carousel.vertical .next {
        top: 400px;
    }

    .carousel.vertical .prev {
        top: -400px;
    }

    .carousel.vertical .next.left,
    .carousel.vertical .prev.right {
        top: 0;
    }

    .carousel.vertical .active.left {
        top: -400px;
    }

    .carousel.vertical .active.right {
        top: 400px;
    }

    .carousel.vertical .item {
        left: 0;
    }

    /* END CSS FOR IMG CAROUSAL */

    /* START CSS FOR IMG PREVIEW */
    .myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }

        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }

    /* END CSS FOR IMG PREVIEW */
</style>
<div id="main-wrapper">
    <div id="main" style="margin-top: 1%;">
        <div id="main-inner">
            <div class="row">
                <div id="myCarousal" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php foreach ($slider_utama as $key => $value) { ?>
                            <li data-target="#myCarousal" data-slide-to="<?php echo $key ?>" <?php echo ($key == 0 ? 'class="active"' : '') ?>></li>
                        <?php } ?>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php foreach ($slider_utama as $key => $value) { ?>
                            <div class="item  <?php echo $key == 0 ? 'active' : '' ?>">
                                <img class="center-block" src="<?php echo $records[$value]->rekdok_file ?>" alt="image slider" style="top: 0;left: 0;min-width: 90%;height: 700px;">
                                <div class="carousel-caption">
                                    <h3><?php echo $records[$value]->rekdok_ringkasan ?></h3>
                                    <p><?php echo $records[$value]->rekdok_deskripsi ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" id="left" href="#myCarousal" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" id="right" href="#myCarousal" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="row" style="margin-top: 25px;">
                <div class="container-fluid parent">

                </div>


                <div class="container wrapper">
                    <div class="row">
                        <div class="col-12-xs child">
                            <div class="carousel slide vertical" data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner hidden-xs" role="listbox">
                                    <?php for ($i = 0; $i < count($result[0]); $i++) { ?>
                                        <div class="item <?php echo ($i == 0 ? 'active' : '') ?>">
                                            <div class="row">
                                                <?php for ($j = 0; $j < count($result); $j++) { ?>
                                                    <div class="col-sm-3">
                                                        <a class="thumbnail fancybox<?php echo $j ?> img-fancy" data-fancy="fancybox<?php echo $j ?>" href="<?php echo $result[$j][$i]->rekdok_file ?>">
                                                            <img src="<?php echo $result[$j][$i]->rekdok_file ?>" alt="<?php echo $result[$j][$i]->rekdok_ringkasan ?>" />
                                                            <div class="carousel-caption"><?php echo $result[$j][$i]->step_nama ?></div>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 25px;padding: 40px;">
                <!-- BEGIN INTERACTIVE CHART PORTLET-->
                <div class="portlet box red">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Grafik
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row" style="padding: 15px;">
                            <form action="<?php echo base_url('load_grafik') ?>" class="horizontal-form" id="searchgrafik" method="POST">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label">Dari </label>
                                                <input type="text" readonly class="form-control tahun" placeholder="e.g. 2015" name="tahun_from" value="2015" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label class="control-label">Sampai </label>
                                                <input type="text" readonly class="form-control tahun" placeholder="e.g. 2015" name="tahun_to" value="2020" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Provinsi</label>
                                                <div class="select-wrapper">
                                                    <select id="select-country" class="form-control" name="provinsi">
                                                        <option value="">Pilih Provinsi</option>
                                                        <?php foreach ($provinsi as $prov) { ?>
                                                            <option value="<?php echo $prov->provinsi_kode ?>"><?php echo $prov->provinsi_nama ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div><!-- /.select-wrapper -->
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-sm-4">
                                            <div class="form-group has-error">
                                                <label class="control-label">Kabupaten</label>
                                                <div class="select-wrapper">
                                                    <select id="select-location" class="form-control" name="kabupaten">
                                                        <option value="">Pilih Kabupaten</option>
                                                        <?php foreach ($kabupaten as $kabkot) { ?>
                                                            <option value="<?php echo $kabkot->kabkot_kode ?>" class="<?php echo $kabkot->kabkot_provinsi_kode ?>"><?php echo $kabkot->kabkot_nama ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div><!-- /.select-wrapper -->
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <!--/span-->
                                        <div class="col-sm-4">
                                            <div class="form-group has-error">
                                                <label class="control-label">Kecamatan</label>
                                                <div class="select-wrapper">
                                                    <select id="select-kecamatan" class="form-control" name="kecamatan" disabled>
                                                        <option value="" class="parent">Pilih Kecamatan</option>
                                                        <?php foreach ($kecamatan as $kec) { ?>
                                                            <option value="<?php echo $kec->kecamatan_kode ?>" class="<?php echo $kec->kecamatan_kabkot_kode ?>"><?php echo $kec->kecamatan_nama ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div><!-- /.select-wrapper -->
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <button type="submit" class="btn blue" id="submitgrafik"><i class="fa fa-search"></i> Cari</button>
                                </div>
                            </form>
                        </div>
                        <div class="row" style="padding: 30px; margin-right: 30px;" id="loadgrafik">
                            <div id="chart_2" class="chart">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END INTERACTIVE CHART PORTLET-->
            </div>
        </div>
        <!-- /#main-inner -->
    </div><!-- /#main -->
</div><!-- /#main-wrapper -->
<!-- The Modal -->
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>

<script src="<?php echo base_url('assets\frontend\libraries\flot\jquery.flot.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('.img-fancy').on('click', function() {
            var fancy = $(this).data('fancy');
            $("." + fancy).fancybox();
        });
        $('.vertical').carousel({
            interval: 3000
        });
        // $('#submitgrafik').trigger('click');
        var prm = {
            format: "yyyy",
            minViewMode: 2,
            autoclose: true
        };
        global.init_dtrp(1, '.tahun', prm);

        $('#select-country').on('change', function() {
            var val = $('#select-location').val();
            var option = $('#select-kecamatan').find('option');
            $('#select-kecamatan').val('');
            cek_kecamatan();
            $.each(option, function(index, value) {
                var clas = $(this).attr('class');
                if (clas != val && clas != 'parent') {
                    $(this).attr('style', "display:none;");
                } else {
                    $(this).removeAttr('style');
                }
            });
        });

        $('#select-location').on('change', function() {
            var val = $(this).val();
            var option = $('#select-kecamatan').find('option');
            $('#select-kecamatan').val('');
            cek_kecamatan();
            $.each(option, function(index, value) {
                var clas = $(this).attr('class');
                if (clas != val && clas != 'parent') {
                    $(this).attr('style', "display:none;");
                } else {
                    $(this).removeAttr('style');
                }
            });
        });

        $("#searchgrafik").submit(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                beforeSend: function() {
                    Metronic.blockUI({
                        target: '#loadgrafik',
                        animate: true
                    });
                },
                success: function(data) {
                    $('#loadgrafik').html(data);
                },
                complete: function() {
                    window.setTimeout(function() {
                        Metronic.unblockUI('#loadgrafik');
                    }, 2000);
                },
            });
        });

        $("#searchgrafik").submit();
    });

    function cek_kecamatan() {
        var kab = $('#select-location').val() == '' ? false : true;
        if (kab == false) {
            $('#select-kecamatan').attr('disabled');
        } else {
            $('#select-kecamatan').removeAttr('disabled');
        };
    }
</script>