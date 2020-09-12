<?php if(empty($dok)){ ?>
    <div class="alert alert-warning">
        <strong>Mohon maaf !</strong> Untuk data dokumentasinya belum tersedia. Terima kasih
    </div>
<?php }else{ ?>
    <div class="row margin-bottom-40">
        <div class="col-md-12 col-sm-12">
            <!-- <h2>List data dokumentasi</h2> -->
            <div class="content-page">
                <div class="filter-v1">
                    <div class="row mix-grid thumbnails">
                        <?php 
                            foreach ($dok as $doks) {
                        ?>
                                <div class="col-md-4 col-sm-6 mix category_1 mix_all" style="display: block;  opacity: 1;">
                                    <div class="mix-inner">
                                        <img alt="" src="<?php echo base_url($doks->rekdok_file); ?>" class="img-responsive">
                                        <div class="mix-details">
                                            <h4><?php echo $doks->rekdok_ringkasan; ?></h4>
                                            <p><?php echo $doks->rekdok_deskripsi; ?></p>
                                        </div>           
                                    </div>                       
                                </div>
                        <?php 
                            } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>