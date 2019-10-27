<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends MX_Controller {
    private $url           = 'landing';
    private $prefix        = 'landing/landing_';
    private $viewSumRegion = 'summary_region';
    private $viewD2        = 'summary_d2';

    public function __construct(){
        parent::__construct();
        auth();
    }
    
    public function index(){
        $data['breadcrumb'] = null;
        $data['sumRegin']   = $this->m_global->get($this->viewSumRegion,null,null,'*');
        $data['sumD2']      = $this->m_global->get($this->viewD2,null,null,'*');
        $this->templates->backend($this->prefix.'index', $data);
    }

}

/* End of file Controllername.php */


?>