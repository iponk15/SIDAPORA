<?php 
    if(empty($records)){
        echo '<div class="row margin-bottom-40 kontenBlock">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <div class="content-page page-404">
                        <div class="number">
                            404
                        </div>
                        <div class="details">
                            <h3>Oops!  Mohon maaf.</h3>
                            <p>
                                Data yang anda cari tidak di temukan.<br>
                                Terima kasih
                            </p>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div> ';
    }else{
?>
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
                                    <?php 
                                        foreach ($galeri as $key => $value) {
                                            if(!empty($value)){
                                                foreach ($value as $rows) {
                                                    $temp[] = ['rekdok_ringkasan' => $rows->rekdok_ringkasan, 'rekdok_file' => $rows->rekdok_file];
                                                }
                                            }
                                        }

                                        $i = 1;
                                        foreach ($temp as $datas) {
                                            echo '<div class="item '.($i == 1 ? "active" : "" ).'">
                                                    <img alt="" src="'.base_url($datas["rekdok_file"]).'">
                                                    <div class="carousel-caption"><p>'.$datas["rekdok_ringkasan"].'</p></div>
                                                </div>';
                                            $i++;
                                        }
                                    ?>
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
                            <p style="text-align: justify;">
                                Pelaksanaan Bantuan Pemerintah untuk Pembangunan dan/atau Rehabilitasi Lapangan Olahraga didasarkan pada komitmen peningkatan mutu, 
                                tata kelola dan optimalisasi layanan yang efektif dan efisien. 
                            </p>
                            <p style="text-align: justify;">
                                Oleh karenanya harus memiliki asas yang harus menjadi pegangan dalam pelaksanaan program. 
                                Adapun asas pelaksanaan Bantuan Pemerintah untuk Pembangunan dan/atau Rehabilitasi Lapangan Olahraga meliputi:
                            </p>
                            <ul>
                                <li><b>Efisien</b> <br>
                                    berarti harus diusahakan dengan menggunakan dana dan daya yang minimum untuk mencapai kualitas dan sasaran dalam waktu yang
                                    ditetapkan atau menggunakan dana yang telah ditetapkan untuk mencapai hasil dan sasaran dengan kualitas yang maksimum.   
                                </li>
                                <li><b>Efektif</b> <br>
                                    berarti sesuai dengan kebutuhan dan sasaran yang telah ditetapkan serta memberikan manfaat yang sebesar-besarnya.
                                </li>
                                <li><b>Transparan</b> <br>
                                    dilaksanakan secara terbuka baik pada perencanaan, pelaksanaan, dan pelaporan
                                </li>
                                <li><b>Akuntabel</b> <br>
                                    berarti sesuai dengan aturan dan ketentuan yang terkait dengan Pengadaan Barang/Jasa sehingga dapat dipertanggungjawabkan
                                </li>
                                <li><b>Manfaat</b> <br>
                                    dapat dirasakan manfaatnya oleh masyarakat untuk mendukung kegiatan keolahragaan       
                                </li>
                            </ul>
                        </div>
                        <!-- END PORTFOLIO DESCRIPTION -->            
                    </div>
                    <div class="row quote-v1 margin-bottom-30" style="background: #553A1F;">
                        <div class="col-md-7 quote-v1-inner">
                            <span>Berdasarkan Kategori Data</span>
                        </div>
                    </div>
                    <div id="accordion1" class="panel-group">
                         <!-- <table class="table table-striped table-bordered table-hover" id="datatable_ajax_1">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="5%">No.</th>
                                        <th width="15%">Kategori Nama</th>
                                        <th width="15%">Kategori Deskripsi</th>
                                        <th width="10%">Actions</th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td></td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="kategori_nama"></td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="kategori_deskripsi"></td>
                                        <td align="center">
                                            <button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i></button>
                                            <button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table> -->
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
                                                    <table class="table table-striped table-bordered table-hover" id="tableBantuan_'.$i.'">
                                                        <thead role="row" class="heading">
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
                                                            <tr role="row" class="filter">
                                                                <td></td>
                                                                <td><input type="text" class="form-control form-filter input-sm" name="rekdet_lembaga"></td>
                                                                <td><input type="text" class="form-control form-filter input-sm" name="bantuan_nama"></td>
                                                                <td><input type="text" class="form-control form-filter input-sm" name="jnsbtn_nama"></td>
                                                                <td><input type="text" class="form-control form-filter input-sm" name="keldes_nama"></td>
                                                                <td><input type="text" class="form-control form-filter input-sm" name="kecamatan_nama"></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
                                                        // if(empty($rekap['rekap_detail'])){
                                                        //     $html .= '<tr><td colspan="9"> <center><i>Data rekap masih Kosong</i></center> </td></tr>';
                                                        // }else{
                                                        //     $a = 1;
                                                        //     foreach ($rekap['rekap_detail'] as $rows) {
                                                        //         $html .= '<tr>
                                                        //                     <td>'.$a.'</td>
                                                        //                     <td>'.$rows['rekdet_lembaga'].'</td>
                                                        //                     <td><center>'.$rows['rekdet_bantuan'].'</center></td>
                                                        //                     <td><center>'.$rows['rekdet_jnsbtn'].'</center></td>
                                                        //                     <td>'.$rows['rekdet_keldes'].'</td>
                                                        //                     <td>'.$rows['rekdet_kecamatan'].'</td>
                                                        //                     <td>'.$rows['rekdet_kabkot'].'</td>
                                                        //                     <td>'.$rows['rekdet_provinsi'].'</td>
                                                        //                     <td>'.uang($rows['rekdet_nominal']).'</td>
                                                        //                 </tr>';
                                                        //         $a++;
                                                        //     }
                                                        // }
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
<?php } ?>

<script>
    $(document).ready(function(){
        <?php 
            $i = 1;    
            foreach ($records as $rowsJs) {
        ?>
                var ri      = '<?php echo md56($rowsJs['rekap_id']); ?>';
                var pr      = '<?php echo $provinsi; ?>';
                var kk      = '<?php echo $kabupaten; ?>';
                var id      = $('#tableBantuan_' + <?php echo $i++; ?>);
                var baseUrl = 'pusatdata_table/' + ri +'/'+ pr +'/'+ kk;
                var header  = [
                    ,
                    ,
                    { "sClass": "text-center" },
                    { "sClass": "text-center" },
                    { "sClass": "text-center" },
                    { "sClass": "text-center" },
                    { "sClass": "text-center" },
                    { "sClass": "text-center" },
                    {}
                ];
                var order = [ [2, "asc"] ];
                var sort  = [-1, 0, 1];
                
                global.init_da(id, baseUrl, header, order, sort);
        <?php
            }
        ?>
    });
</script>