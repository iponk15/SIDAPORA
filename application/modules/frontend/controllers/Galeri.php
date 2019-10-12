<?php defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Galeri extends MX_Controller {
        private $prefix = 'galeri/galeri_';
        private $url    = 'galeri';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function index(){
            $data['slider']     = 0;
            $data['breadcrumb'] = ['Home' => base_url('home'), 'Galeri' => base_url($this->url)];
            $this->templates->frontend($this->prefix.'index', $data);
        }
    
    }

?>