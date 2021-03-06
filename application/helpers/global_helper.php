<?php 

function pre( $var, $exit = null ){
    $CI = &get_instance();
    echo '<pre>';
    if ( $var == 'lastdb' ){
        print_r($CI->db->last_query());
    } else if ( $var == 'post' ){
        print_r($CI->input->post());
    } else if ( $var == 'get' ){
        print_r($CI->input->get());
    } else {
        print_r( $var );
    }
    echo '</pre>';

    if ( $exit )
    {
        exit();
    }
}

function md56($param,$tipe = null,$jml = null){
	if(empty($tipe)){
		return substr(md5($param),0, ( empty($jml) ? 6 : $jml  ) );
	}else{
		return 'SUBSTRING(md5('.$param.'),true,6)';
	}
}

function getCtrl(){
    $CI =& get_instance();
    return $CI->router->fetch_class(); 
}

function getUserIP(){
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }else{
        $ip = $remote;
    }

    return $ip;
}

function md5_mod($str, $salt){

    $str = md5(md5($str).$salt);
    return $str;
}

function getSession($field = ''){
    $CI   =& get_instance();

    if(!empty($field)){
        $result = ($CI->session->userdata('sidaporaSes')->$field == '' ? '-' : $CI->session->userdata('sidaporaSes')->$field);
    }else{
        $result = $CI->session->userdata('sidaporaSes');
    }

    return $result;
}

function uang( $var, $tipe=null, $dec = "0" ){
    if ( empty($var) ) return 0;
    return 'Rp. ' . number_format(str_replace(',','.',$var), $dec,',','.');
    // . ( $dec == "0" ? ( $tipe == true ? ',-' : ",00" ) : '' );
}

function getGaleriPusdat($tahun){
    $CI   =& get_instance();
    $getKategori = $CI->m_global->get('sdp_master_kategori',null,['kategori_status' => '1'],'kategori_id,kategori_nama');

    foreach ($getKategori as $galeri) {
        $join = [
            ['sdp_rekap_detail','rekap_id = rekdet_rekap_id','left'],
            ['sdp_rekap_dokumen','rekdet_id = rekdok_rekdet_id','left']
        ];
        $select    = 'rekdok_ringkasan,rekdok_file';
        $getGaleri = $CI->m_global->get('sdp_rekap',$join,['rekap_kategori_id' => $galeri->kategori_id],$select,null,null,null,2);
        $hasil[]   = $getGaleri;
    }

    return $hasil;
}

function get_bidang($param){
    $CI        =& get_instance();
    $gettipe   = $CI->input->get('tipe');
    $getbidang = $CI->input->get('bidang');
    $rekap     = ['1' => 'Rekap', '2' => 'Sarana'];
    $where     = ( $param->user_role == 1 ? ['kategori_status' => '1'] : ['kategori_id' => $param->user_kategori_id, 'kategori_status' => '1'] );
    $bidang    =  $CI->m_global->get('sdp_master_kategori',null,$where,'kategori_id,kategori_nama',null,['kategori_nama','ASC']);
    $menu      = '';
    $hrrk      = [];

    foreach ($rekap as $key => $rkp) {
        if($param->user_role == 1){
            $menu .= '<li>
                        <a href="'.strtolower($rkp).'#" class="'.(getCtrl() == strtolower($rkp) ? 'mm-active' : '').'">
                            <i class="metismenu-icon pe-7s-diamond"></i>'.( $rkp == 'Rekap' ? 'Prasarana' : $rkp ).'<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul class="'.(getCtrl() == strtolower($rkp) ? 'mm-show mm-collapse' : '').'">';

                            foreach ($bidang as $bdg) {
                                $menu .= '<li style="margin-bottom: 2%;">
                                            <a href="'.( $key == 1 ? base_url( 'rekap?tipe=' . $key .'&bidang=' . $bdg->kategori_id ) : base_url( 'sarana?tipe=' . $key .'&bidang=' . $bdg->kategori_id ) ).'"  class="'.(getCtrl() == strtolower($rkp) && $key == $gettipe && $bdg->kategori_id == $getbidang ? 'mm-active' : '').'" >
                                                <i class="metismenu-icon"></i> '. $bdg->kategori_nama .'
                                            </a>
                                        </li>';
                            }

            $menu .= '  </ul>
                    </li>';
        }else{
            $menu .= '<li>
                        <a href="'.( $key == 1 ? base_url( 'rekap?tipe=' . $key .'&bidang=' . $param->user_kategori_id ) : base_url( 'sarana?tipe=' . $key .'&bidang=' . $param->user_kategori_id ) ).'" class="'.(getCtrl() == strtolower($rkp) ? 'mm-active' : '').'">
                            <i class="metismenu-icon pe-7s-news-paper"></i> '.( $rkp == 'Rekap' ? 'Prasarana' : $rkp ).'
                        </a>
                    </li>';
        }
    }

    return $menu;
}

function getInfo($field){
    $CI     =& get_instance();
    $result = $CI->m_global->get('sdp_master_user',null,[ 'user_id' => $CI->session->userdata('sidaporaSes')->user_id, 'user_status' => '1' ],$field)[0];
    return $result;
}

function getListItem($sarbor_id){
    $CI     =& get_instance();
    $select = 'sarbortem_item,sarbortem_jml,sarbortem_satuan';
    $result = $CI->m_global->get('sdp_rekap_caboritem',null,[md56('sarbortem_sarbor_id',1) => $sarbor_id],$select);
    
    return $result;
}

?>