<style>
    .header {
        text-align : center;
    }

    .header h1{
        margin-bottom : -1.5%;
        font-size: 2.88em;
    }

    .table1 {
        font-family: sans-serif;
        color: #232323;
        border-collapse: collapse;
        width: 90%;
    }
    
    .table1, th, td {
        border: 1px solid #999;
        padding: 8px;
    }

    .cstmBody, td{
        font-size : 12px;
    }
    
    br {
        display: block;
        margin: 10px 0;
    }
</style>

<div class="header">
    <p> 
        <h1> <b> SIDAPORA </b> </h1> <br>
        Laporan Rekapitulasi Data Tahun <?php echo $tahun; ?>
    </p>
    ===================================================================================================================================== <br><br>
</div>

<?php 
    $i = 1;
    foreach ($records as $rekap) {
        $html = '
            <table class="table1" align="center">
                <tr>
                    <td colspan="9" align="center"><h2><b>'.$rekap['rekap_judul'].'</b></h2></td>
                </tr>
                <thead>
                    <tr>
                        <th><center>No. </center></th>
                        <th><center>Lembaga</center></th>
                        <th><center>Jenis Bantuan</center></th>
                        <th><center>Bantuan</center></th>
                        <th><center>Desa</center></th>
                        <th><center>Kecamatan</center></th>
                        <th><center>Kabupaten</center></th>
                        <th><center>Provinsi</center></th>
                        <th><center>Nominal</center></th>
                    </tr>
                </thead>
                <tbody>';
                if(empty($rekap['rekap_detail'])){
                    $html .= '<tr><td colspan="9"> <center><i>Data rekap masih Kosong</i></center> </td></tr>';
                }else{
                    $a = 1;
                    foreach ($rekap['rekap_detail'] as $rows) {
                        $html .= '<tr class="cstmBody">
                                    <td>'.$a.'. </td>
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
        $html .='</tbody>
            </table>';
        
        $i++;
        echo $html;
        echo '<br>';
    }
?>

