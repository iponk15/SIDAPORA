<?php defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Faq extends MX_Controller {
        private $prefix = 'faq/faq_';
        private $url    = 'faq';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function index(){
            $data['slider']     = 0;
            $data['breadcrumb'] = ['Home' => base_url('home'), 'FAQ' => base_url($this->url)];
            $this->load->view($this->prefix.'index', $data);
        }
    
    }

?>