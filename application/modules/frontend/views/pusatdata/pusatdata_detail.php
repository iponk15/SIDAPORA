<div class="row margin-bottom-40">
    <!-- BEGIN CONTENT -->
    <div class="col-md-12 col-sm-12">
        <div class="content-page">
            <div class="row margin-bottom-30">
                <!-- BEGIN CAROUSEL -->            
                <div class="col-md-5 front-carousel">
                    <div class="carousel slide" id="myCarousel">
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="item">
                                <img alt="" src="<?php echo base_url('assets/frontend/pages/img/img1.jpg') ?>">
                                <div class="carousel-caption"><p>Excepturi sint occaecati cupiditate non provident</p></div>
                            </div>
                            <div class="item active">
                                <img alt="" src="<?php echo base_url('assets/frontend/pages/img/img2.jpg') ?>">
                                <div class="carousel-caption"><p>Ducimus qui blanditiis praesentium voluptatum</p></div>
                            </div>
                            <div class="item">
                                <img alt="" src="<?php echo base_url('assets/frontend/pages/img/img3.jpg') ?>">
                                <div class="carousel-caption"><p>Ut non libero consectetur adipiscing elit magna</p></div>
                            </div>
                        </div>
                        <!-- Carousel nav -->
                        <a data-slide="prev" href="#myCarousel" class="carousel-control left">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a data-slide="next" href="#myCarousel" class="carousel-control right">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>                
                </div>
                <!-- END CAROUSEL -->                             
                <!-- BEGIN PORTFOLIO DESCRIPTION -->            
                <div class="col-md-7">
                    <h2>Deskripsi</h2>
                    <p>Molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa quis tempor incididunt ut et dolore et dolorum fuga. Ut non libero consectetur adipiscing elit magna. Sed et quam lacus.</p>
                    <p>Lorem ipsum dolor sit amet, dolore eiusmod quis tempor incididunt ut et dolore Ut veniam unde nostrudlaboris. Sed unde omnis iste natus error sit voluptatem.</p>
                </div>
                <!-- END PORTFOLIO DESCRIPTION -->            
            </div>
            <div class="row quote-v1 margin-bottom-30" style="background: #553A1F;">
                <div class="col-md-7 quote-v1-inner">
                    <span>Berdasarkan Kategori Data</span>
                </div>
            </div>
            <div id="accordion1" class="panel-group">
                
                <?php 
                    $i = 1;
                    foreach ($records as $rekap) {
                        $html = '<div class="panel panel-success">
                                    <div class="panel-heading" style="background: #E69C39;">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_'.$i.'" style="color: #EDEDED;">
                                                <b>'. $rekap['rekap_judul'] .'</b>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="accordion1_'.$i.'" class="panel-collapse collapse in">
                                        <div class="panel-body flip-scroll">
                                            <table class="table table-bordered table-striped table-condensed flip-content">
                                                <thead class="flip-content">
                                                    <tr>
                                                        <th width="1%"><center>No. </center></th>
                                                        <th width="23%"><center>Lembaga</center></th>
                                                        <th width="14%"><center>Jenis Bantuan</center></th>
                                                        <th><center>Bantuan</center></th>
                                                        <th><center>Desa</center></th>
                                                        <th><center>Kecamatan</center></th>
                                                        <th><center>Kabupaten</center></th>
                                                        <th><center>Provinsi</center></th>
                                                        <th class="numeric" width="10%"><center>Nominal</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                                if(empty($rekap['rekap_detail'])){
                                                    $html .= '<tr><td colspan="9"> <center><i>Data rekap masih Kosong</i></center> </td></tr>';
                                                }else{
                                                    $a = 1;
                                                    foreach ($rekap['rekap_detail'] as $rows) {
                                                        $html .= '<tr>
                                                                    <td>'.$a.'</td>
                                                                    <td>'.$rows['rekdet_lembaga'].'</td>
                                                                    <td><center>'.$rows['rekdet_bantuan'].'</center></td>
                                                                    <td><center>'.$rows['rekdet_jnsbtn'].'</center></td>
                                                                    <td>'.$rows['rekdet_keldes'].'</td>
                                                                    <td>'.$rows['rekdet_kecamatan'].'</td>
                                                                    <td>'.$rows['rekdet_kabkot'].'</td>
                                                                    <td>'.$rows['rekdet_provinsi'].'</td>
                                                                    <td>'.uang($rows['rekdet_nominal']).'</td>
                                                                </tr>';
                                                        $a++;
                                                    }
                                                }
                        $html .=                '</tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>';
                        
                        $i++;
                        echo $html;
                    }
                ?>
            </div>   
            <!-- END RECENT WORKS -->
        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- BEGIN SIDEBAR & CONTENT -->