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

?>