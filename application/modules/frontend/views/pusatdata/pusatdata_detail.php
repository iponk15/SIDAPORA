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
                        <div class="col-md-7 quote-v1-inner" id="googleMap" style="width:100%;height:680px;">
                        </div>
                    </div>
                    <!-- <div class="row margin-bottom-30">      
                        <div class="col-md-5 front-carousel">
                            <div class="carousel slide" id="myCarousel">
                                <div class="carousel-inner">
                                    <?php 
                                        // foreach ($galeri as $key => $value) {
                                        //     if(!empty($value)){
                                        //         foreach ($value as $rows) {
                                        //             $temp[] = ['rekdok_ringkasan' => $rows->rekdok_ringkasan, 'rekdok_file' => $rows->rekdok_file];
                                        //         }
                                        //     }
                                        // }

                                        // $i = 1;
                                        // foreach ($temp as $datas) {
                                        //     echo '<div class="item '.($i == 1 ? "active" : "" ).'">
                                        //             <img alt="" src="'.base_url($datas["rekdok_file"]).'">
                                        //             <div class="carousel-caption"><p>'.$datas["rekdok_ringkasan"].'</p></div>
                                        //         </div>';
                                        //     $i++;
                                        // }
                                    ?>
                                </div>
                                <a data-slide="prev" href="#myCarousel" class="carousel-control left">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a data-slide="next" href="#myCarousel" class="carousel-control right">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>                
                        </div> -->
                        <!-- END CAROUSEL -->                             
                        <!-- BEGIN PORTFOLIO DESCRIPTION -->            
                        <!-- <div class="col-md-7">
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
                        </div> -->
                        <!-- END PORTFOLIO DESCRIPTION -->            
                    </div>
                   
                    <!-- <div class="row quote-v1 margin-bottom-30" style="background: #553A1F;">
                        <div class="col-md-7 quote-v1-inner">
                            <span>Berdasarkan Kategori Data</span>
                        </div>
                    </div> -->
                    <div id="accordion1" class="panel-group"></div>   
                    <!-- END RECENT WORKS -->
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- BEGIN SIDEBAR & CONTENT -->
<?php } ?>
<div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:1550px;">
        <div class="modal-content" style="top: 60px;">
            <div class="modal-header" style="background-color: turquoise;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
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

<script>
    function initialize() {
        var datamap = $.parseJSON('<?php echo $datamap ?>');

        var propertiPeta = {
            center    : new google.maps.LatLng(-1.203564, 118.285458),
            zoom      : 5,
            mapTypeId : google.maps.MapTypeId.ROADMAP
        };

        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

        // membuat Marker
        for (i = 0; i < datamap.length; i++) {  
            var marker=new google.maps.Marker({
              position : new google.maps.LatLng(datamap[i].provinsi_latitude,datamap[i].provinsi_longtitude),
              map      : peta,
              title    : 'Jumlah = '+datamap[i].jumlah+' bantuan'
            });

             var content = '<div id="content">'+
                                '<div id="siteNotice"></div>'+
                                '<h2 id="firstHeading" class="firstHeading">' +
                                    datamap[i].provinsi_nama +
                                    ' <a data-toggle="modal" href="#large" class="btn btn-xs bg-yellow-gold detailInfromasi" data-tahun="<?php echo $tahun; ?>" data-provinsi="'+datamap[i].provinsi_kode+'" data-kabupaten="<?php echo $kabupaten; ?>" title="Detail"> ' + 
                                        'Detail <i class="fa fa-sign-in"></i>' +
                                    '</a>' +
                                '</h2> ' +
                                '<div id="bodyContent">'+
                                    '<p><b>'+datamap[i].provinsi_nama+'</b>, jumlah bantuan pada provinsi ini ada <a href="">'+datamap[i].jumlah+'</a> Bantuan.</p>'+
                                '</div>'+
                            '</div>';

            var infowindow = new google.maps.InfoWindow();

            google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
                return function() {
                   infowindow.setContent(content);
                   infowindow.open(peta,marker);
                };
            })(marker,content,infowindow));
        }
    }

    $(document).ready(function(){
        initialize();
    });

    $(document).on('click', '.detailInfromasi', function(){
        var tahun = $(this).attr('data-tahun');
        var prov  = $(this).attr('data-provinsi');
        var url   = base_url + 'pusatdata_cari/2';
        var xdta  = {'tahun' : tahun, 'provinsi' : prov};

        $.post(url,xdta,function(html){
            $('.listDataRekap').html(html);
        })
    });

    $(document).on('click', '.listDokumentasi', function(){
        var id  = $(this).attr('data-id');
        var url = base_url + 'pusatdata_dokumentasi';
        var xdt = { 'rekdet_id' : id };

        $.post(url,xdt,function(res){
            $('#ctnDokumentasi').html(res);
        });
    });

    
</script>