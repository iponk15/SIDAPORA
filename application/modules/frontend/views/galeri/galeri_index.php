<div class="row margin-bottom-40">
    <!-- BEGIN CONTENT -->
    <div class="col-md-12 col-sm-12">
        <h1>Galeri</h1>
        <div class="content-page">
            <div class="filter-v1">
                <ul class="mix-filter">
                    <li data-filter="all" class="filter active">All</li>
                    <?php 
                        foreach ($tahun as $thn) {
                            echo '<li data-filter="category_'.$thn->rekap_tahun.'" class="filter">Tahun '.$thn->rekap_tahun.'</li>';
                        }
                    ?>
                    <!-- <li data-filter="category_1" class="filter">Tahun 2016</li>
                    <li data-filter="category_2" class="filter">Tahun 2017</li>
                    <li data-filter="category_3" class="filter">Tahun 2018</li>
                    <li data-filter="category_3 category_1" class="filter">Tahun 2019 </li> -->
                </ul>
                <div class="row mix-grid thumbnails">
                    <?php $i = 1; foreach ($galeri as $rows) { ?>
                        <div class="col-md-4 col-sm-6 mix category_<?php echo $rows->rekap_tahun; ?> mix_all" style="display: block;  opacity: 1;">
                            <div class="mix-inner">
                                <img alt="" src="<?php echo base_url($rows->rekdok_file) ?>" class="img-responsive">
                                <div class="mix-details">
                                    <h4>Foto Galeri Dokumentasi <?php echo $i++ ?></h4>
                                    <p><?php echo $rows->rekdok_deskripsi; ?>.</p>
                                    <a class="mix-link"><i class="fa fa-link"></i></a>
                                    <a data-rel="fancybox-button" title="Project Name" href="<?php echo base_url($rows->rekdok_file) ?>" class="mix-preview fancybox-button"><i class="fa fa-search"></i></a>
                                </div>           
                            </div>                       
                        </div>
                    <?php } ?>
                    <!-- <div class="col-md-4 col-sm-6 mix category_2 mix_all" style="display: block;  opacity: 1;">
                        <div class="mix-inner">
                            <img alt="" src="<?php echo base_url('') ?>assets/frontend/pages/img/img2.jpg" class="img-responsive">
                            <div class="mix-details">
                                <h4>Cascusamus et iusto odio</h4>
                                <p>At vero eos et accusamus et iusto odio digniss imos duc sasdimus qui sint blanditiis prae sentium voluptatum deleniti atque corrupti quos dolores.</p>
                                <a class="mix-link"><i class="fa fa-link"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="<?php echo base_url('') ?>assets/frontend/pages/img/img2.jpg" class="mix-preview fancybox-button"><i class="fa fa-search"></i></a>
                            </div>               
                        </div>                    
                    </div>
                    <div class="col-md-4 col-sm-6 mix category_3 mix_all" style="display: block;  opacity: 1;">
                        <div class="mix-inner">
                            <img alt="" src="<?php echo base_url('') ?>assets/frontend/pages/img/img3.jpg" class="img-responsive">
                            <div class="mix-details">
                                <h4>Cascusamus et iusto odio</h4>
                                <p>At vero eos et accusamus et iusto odio digniss imos duc sasdimus qui sint blanditiis prae sentium voluptatum deleniti atque corrupti quos dolores.</p>
                                <a class="mix-link"><i class="fa fa-link"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="<?php echo base_url('') ?>assets/frontend/pages/img/img3.jpg" class="mix-preview fancybox-button"><i class="fa fa-search"></i></a>
                            </div>              
                        </div>      
                    </div>
                    <div class="col-md-4 col-sm-6 mix category_1 category_2 mix_all" style="display: block;  opacity: 1;">
                        <div class="mix-inner">
                            <img alt="" src="<?php echo base_url('') ?>assets/frontend/pages/img/img4.jpg" class="img-responsive">
                            <div class="mix-details">
                                <h4>Cascusamus et iusto odio</h4>
                                <p>At vero eos et accusamus et iusto odio digniss imos duc sasdimus qui sint blanditiis prae sentium voluptatum deleniti atque corrupti quos dolores.</p>
                                <a class="mix-link"><i class="fa fa-link"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="<?php echo base_url('') ?>assets/frontend/pages/img/img4.jpg" class="mix-preview fancybox-button"><i class="fa fa-search"></i></a>                            
                            </div>                  
                        </div>                      
                    </div>
                    <div class="col-md-4 col-sm-6 mix category_2 category_1 mix_all" style="display: block;  opacity: 1;">
                        <div class="mix-inner">
                            <img alt="" src="<?php echo base_url('') ?>assets/frontend/pages/img/img5.jpg" class="img-responsive">
                            <div class="mix-details">
                                <h4>Cascusamus et iusto odio</h4>
                                    <p>At vero eos et accusamus et iusto odio digniss imos duc sasdimus qui sint blanditiis prae sentium voluptatum deleniti atque corrupti quos dolores.</p>
                                    <a class="mix-link"><i class="fa fa-link"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="<?php echo base_url('') ?>assets/frontend/pages/img/img5.jpg" class="mix-preview fancybox-button"><i class="fa fa-search"></i></a>                            
                            </div>     
                        </div>                                   
                    </div>
                    <div class="col-md-4 col-sm-6 mix category_1 category_2 mix_all" style="display: block;  opacity: 1;">
                        <div class="mix-inner">
                            <img alt="" src="<?php echo base_url('') ?>assets/frontend/pages/img/img6.jpg" class="img-responsive">
                            <div class="mix-details">
                                <h4>Cascusamus et iusto odio</h4>
                                    <p>At vero eos et accusamus et iusto odio digniss imos duc sasdimus qui sint blanditiis prae sentium voluptatum deleniti atque corrupti quos dolores.</p>
                                    <a class="mix-link"><i class="fa fa-link"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="<?php echo base_url('') ?>assets/frontend/pages/img/img6.jpg" class="mix-preview fancybox-button"><i class="fa fa-search"></i></a>                            
                            </div>     
                        </div>                                   
                    </div>
                    <div class="col-md-4 col-sm-6 mix category_2 category_3 mix_all" style="display: block;  opacity: 1;">
                        <div class="mix-inner">
                            <img alt="" src="<?php echo base_url('') ?>assets/frontend/pages/img/img1.jpg" class="img-responsive">
                            <div class="mix-details">
                                <h4>Cascusamus et iusto odio</h4>
                                    <p>At vero eos et accusamus et iusto odio digniss imos duc sasdimus qui sint blanditiis prae sentium voluptatum deleniti atque corrupti quos dolores.</p>
                                    <a class="mix-link"><i class="fa fa-link"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="<?php echo base_url('') ?>assets/frontend/pages/img/img1.jpg" class="mix-preview fancybox-button"><i class="fa fa-search"></i></a>                            
                            </div>    
                        </div>                                    
                    </div>
                    <div class="col-md-4 col-sm-6 mix category_1 category_2 mix_all" style="display: block;  opacity: 1;">
                        <div class="mix-inner">
                            <img alt="" src="<?php echo base_url('') ?>assets/frontend/pages/img/img2.jpg" class="img-responsive">
                            <div class="mix-details">
                                <h4>Cascusamus et iusto odio</h4>
                                    <p>At vero eos et accusamus et iusto odio digniss imos duc sasdimus qui sint blanditiis prae sentium voluptatum deleniti atque corrupti quos dolores.</p>
                                    <a class="mix-link"><i class="fa fa-link"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="<?php echo base_url('') ?>assets/frontend/pages/img/img2.jpg" class="mix-preview fancybox-button"><i class="fa fa-search"></i></a>                            
                            </div>   
                        </div>                                     
                    </div>
                    <div class="col-md-4 col-sm-6 mix category_3 mix_all" style="display: block;  opacity: 1;">
                        <div class="mix-inner">
                            <img alt="" src="<?php echo base_url('') ?>assets/frontend/pages/img/img4.jpg" class="img-responsive">
                            <div class="mix-details">
                                <h4>Cascusamus et iusto odio</h4>
                                    <p>At vero eos et accusamus et iusto odio digniss imos duc sasdimus qui sint blanditiis prae sentium voluptatum deleniti atque corrupti quos dolores.</p>
                                    <a class="mix-link"><i class="fa fa-link"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="<?php echo base_url('') ?>assets/frontend/pages/img/img4.jpg" class="mix-preview fancybox-button"><i class="fa fa-search"></i></a>                            
                            </div>    
                        </div>                                    
                    </div>
                    <div class="col-md-4 col-sm-6 mix category_1 mix_all" style="display: block;  opacity: 1;">
                        <div class="mix-inner">
                            <img alt="" src="<?php echo base_url('') ?>assets/frontend/pages/img/img3.jpg" class="img-responsive">
                            <div class="mix-details">
                                <h4>Cascusamus et iusto odio</h4>
                                    <p>At vero eos et accusamus et iusto odio digniss imos duc sasdimus qui sint blanditiis prae sentium voluptatum deleniti atque corrupti quos dolores.</p>
                                    <a class="mix-link"><i class="fa fa-link"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="<?php echo base_url('') ?>assets/frontend/pages/img/img3.jpg" class="mix-preview fancybox-button"><i class="fa fa-search"></i></a>
                            </div> 
                        </div>                                       
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT -->
</div>