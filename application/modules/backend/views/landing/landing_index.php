<div class="row">
    <div class="col-md-4 col-xl-3">
        <div class="card mb-3 widget-content bg-midnight-bloom">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Data</div>
                    <div class="widget-subheading">Data Provinsi saat ini</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span><?php echo $sumRegin[0]->jml_provinsi; ?></span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-xl-3">
        <div class="card mb-3 widget-content bg-arielle-smile">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Data</div>
                    <div class="widget-subheading">Data Kabupaten dan Kota saat ini</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span><?php echo $sumRegin[0]->jml_kabkot; ?></span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-xl-3">
        <div class="card mb-3 widget-content bg-grow-early">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Data</div>
                    <div class="widget-subheading">Data Kecamatan saat ini</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span><?php echo $sumRegin[0]->jml_kecamatan; ?></span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-xl-3">
        <div class="card mb-3 widget-content bg-strong-bliss">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Data</div>
                    <div class="widget-subheading">Data Kelurahan dan Desa saat ini</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span><?php echo $sumRegin[0]->jml_keldes; ?></span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">
                <h5><b>Data Rekap Per Tahun & Per Region</b></h5>
            </div>
            <div class="card-body">
                <table class="mb-0 table table-sm table-bordered">
                    <thead style="background-color: #00A843;">
                        <tr>
                            <th class="text-center">No. </th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Provinsi</th>
                            <th class="text-center">Kabupaten / Kota</th>
                            <th class="text-center">Kecamatan</th>
                            <th class="text-center">Kelurahan / Desa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(empty($sumD2)){
                                echo '<tr>
                                        <td colspan="6" class="text-center"><i>Tidak ada data yang di tampilkan</i></td>
                                    </tr>';
                            }else{
                                $i = 1;
                                foreach ($sumD2 as $sums) {
                        ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td class="text-center"><?php echo $sums->rekap_tahun ?></td>
                                        <td class="text-center"><?php echo $sums->jmlPerProvinsi ?></td>
                                        <td class="text-center"><?php echo $sums->jmlPerKabkot ?></td>
                                        <td class="text-center"><?php echo $sums->jmlPerKecamatan ?></td>
                                        <td class="text-center"><?php echo $sums->jmlPerKeldes ?></td>
                                    </tr>
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>