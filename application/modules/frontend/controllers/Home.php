<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {
    
    public function __construct(){
        parent::__construct();
    }
    
    public function index()
    {
        $data['breadcrumb'] = null;
        $this->templates->frontend('home/home_index', $data);
    }

}

/* End of file Controllername.php */


?>