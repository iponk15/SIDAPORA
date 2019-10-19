<div class="row ">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">Form Pencarian</div>
                <div class="tools">
                    <a href="" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="" class="reload"></a>
                    <a href="" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="alert alert-warning alert-dismissable notifWarning" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <strong>Notifikasi!</strong> Ada kesalahan, inputan Tahun tidak boleh kosong. Terima kasih
                </div>
                <form class="form-inline form-cari" role="form" method="POST" action="javascript:void(0);">
                    <div class="form-group">
                        <label class="sr-only"></label>
                        <input type="text" readonly class="form-control tahun input-sm input-xsmall" placeholder="Tahun *" name="tahun">
                    </div> &nbsp;
                    <div class="form-group">
                        <label class="sr-only"></label>
                        <input type="text" placeholder="--- Pilih Provinsi * ---" name="provinsi" class="form-control input-sm provinsi">
                    </div> &nbsp;
                    <div class="form-group formKabupaten" style="display:none">
                        <label class="sr-only"></label>
                        <input type="text" placeholder="--- Pilih Kabupaten ---" name="kabupaten" class="form-control input-sm kabupaten">
                    </div> &nbsp;
                    <button class="btn yellow btn-sm buttonSubmit" title="Cari Data"><i class="fa fa-search"></i></button> 
                    <a href="<?php echo base_url('pusatdata_pdf') ?>" target="_blank" class="btn red btn-sm buttonExportPdf" title="Export PDF" style="display:none;"><i class="fa fa-file-pdf-o"></i></a>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row margin-bottom-40 kontenBlock">
    <!-- BEGIN CONTENT -->
    <div class="col-md-12 col-sm-12">
        <div class="content-page page-404">
            <div class="number">
                500
            </div>
            <div class="details">
                <h3>Oops!  Konten kosong.</h3>
                <p>
                    Data belum bisa di tampilkan .<br>
                    Silahkan input form pencarian di atas untuk mencari data. Terima kasih
                </p>
            </div>
        </div>
    </div>
    <!-- END CONTENT -->
</div>

<div id="contentRekap"></div>

<script>
    $( function() {
        $('.buttonSubmit').on('click', function(){
            $('.kontenBlock').hide();
            var tahun    = $('.tahun').val();
            var provinsi = $('.proinsi').val();

            if(tahun == ''){
                $('.notifWarning').fadeIn('slow');
            }else{
                $('.notifWarning').fadeOut('slow');
                $('.buttonExportPdf').fadeIn('slow').attr('href',base_url + 'pusatdata_pdf/' + tahun);
                var url  = base_url + 'pusatdata_cari';
                var xdta = $('.form-cari').serializeArray();

                $.post(url,xdta,function(html){
                    $('#contentRekap').html(html);
                })

            }
        });

        $('.provinsi').on('change', function(){
            $('.formKabupaten').fadeIn('slow');
            var provId = $(this).val();
            var tahun  = $('.tahun').val();

            if(provId == ''){
                $('.formKabupaten').fadeOut('slow');
            }

            if(tahun != ''){
                $('.notifWarning').fadeOut('slow');
            }

            global.init_select2('.kabupaten','fetch/getKabkotFromProvinsi/sdp_master_kabkot/' + provId, true);
            
        });

        global.init_select2('.provinsi','fetch/globalFetch/sdp_master_provinsi/provinsi_id/provinsi_nama',true);

        var prm = {
            format      : "yyyy",
            minViewMode : 2,
            autoclose   : true
        };
        global.init_dtrp(1,'.tahun',prm);
    });
    // ComponentsDropdowns.init();
</script>