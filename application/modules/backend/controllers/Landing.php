<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends MX_Controller {
    private $url    = 'landing';
    private $prefix = 'landing/landing_';

    public function __construct(){
        parent::__construct();
        auth();
    }
    
    public function index(){
        $data['breadcrumb'] = null;
        $this->templates->backend($this->prefix.'index', $data);
    }

}

/* End of file Controllername.php */


?>