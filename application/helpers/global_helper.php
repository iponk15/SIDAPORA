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

function uang( $var, $tipe=null, $dec="0" ){
    if ( empty($var) ) return 0;
    return 'Rp. ' . number_format(str_replace(',','.',$var), $dec,',','.').($dec=="0"?($tipe == true ? ',-' : ",00" ):'');
}

?>