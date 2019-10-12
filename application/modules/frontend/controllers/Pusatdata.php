<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pusatdata extends MX_Controller {
    private $prefix = 'pusatdata/pusatdata_';
    private $url    = 'pusatdata';

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['slider']     = 0;
        $data['breadcrumb'] = ['Home' => base_url('home'), 'Pusat Data' => base_url($this->url)];
        $this->templates->frontend($this->prefix.'index', $data);
    }

}

/* End of file Controllername.php */
 ?>