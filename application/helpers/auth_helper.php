<?php
	$CI = &get_instance();
	$CI->load->library( 'session' );

	$ex      = array('','login','home');
	$session = $CI->session->userdata('sidaporaSes');
    
	if ( !empty($session) AND ( ( in_array ( $CI->uri->segment(1), $ex) AND $CI->uri->segment(2) != "out") OR $CI->uri->segment(1) == "" ) ){
		redirect( base_url('landing') );
	} else if ( empty($session) AND ! in_array( $CI->uri->segment(1), $ex ) ) {
		redirect(base_url('login'));
	}
?>	