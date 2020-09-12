<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates
{
	protected $ci;

	public function __construct(){
                $this->_ci =& get_instance();
	}

	// function frontend( $template, $data = NULL, $js = NULL, $css = NULL ){
        //         $data['_header']     = $this->_ci->load->view('frontend/templates/header', $data, TRUE);
        //         $data['_breadcrumb'] = $this->_ci->load->view('frontend/templates/breadcrumb', $data, TRUE);
        //         $data['_slider']     = $this->_ci->load->view('frontend/templates/slider', $data, TRUE);
        //         $data['_content']    = $this->_ci->load->view($template, $data, TRUE);
        //         $data['_footer']     = $this->_ci->load->view('frontend/templates/footer', $data, TRUE);

        //         $this->_ci->load->view('frontend/templates/template.php', $data);
        // }

        function frontend( $template, $data = NULL, $js = NULL, $css = NULL ){
                $data['_header']  = $this->_ci->load->view('frontend/layouts/header', $data, TRUE);
                $data['_footer']  = $this->_ci->load->view('frontend/layouts/footer', $data, TRUE);
                $data['_content'] = $this->_ci->load->view($template, $data, TRUE);
                $this->_ci->load->view('frontend/layouts/layout.php', $data);
        }

        function backend( $template, $data = NULL, $js = NULL, $css = NULL ){
                $data['_header']      = $this->_ci->load->view('backend/templates/header', $data, TRUE);
                $data['_theme']       = $this->_ci->load->view('backend/templates/theme', $data, TRUE);
                $data['_sidebar']     = $this->_ci->load->view('backend/templates/sidebar', $data, TRUE);
                $data['_page_header'] = $this->_ci->load->view('backend/templates/page_header', $data, TRUE);
                $data['_content']     = $this->_ci->load->view($template, $data, TRUE);
                $data['_footer']      = $this->_ci->load->view('backend/templates/footer', $data, TRUE);

                $this->_ci->load->view('backend/templates/template.php', $data);
        }
	

}

/* End of file Templates.php */
/* Location: ./application/libraries/Templates.php */
