<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates
{
	protected $ci;

	public function __construct()
	{
        $this->_ci =& get_instance();
	}

	function frontend( $template, $data = NULL, $js = NULL, $css = NULL ){
        $data = '';
        // $data['_header']    = $this->_ci->load->view('frontend/templates/header', $data, TRUE);
        // $data['_sidebar']   = $this->_ci->load->view('frontend/templates/sidebar', $data, TRUE);
        // $data['_breadcumb'] = $this->_ci->load->view('frontend/templates/breadcumb', $data, TRUE);
        // $data['_content']   = $this->_ci->load->view($template, $data, TRUE);
        // $data['_footer']    = $this->_ci->load->view('frontend/templates/footer', $data, TRUE);

        $this->_ci->load->view('frontend/templates/template.php', $data);
    }
	

}

/* End of file Templates.php */
/* Location: ./application/libraries/Templates.php */
