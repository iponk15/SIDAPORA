<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends MX_Controller {
    private $url           = 'landing';
    private $prefix        = 'landing/landing_';
    private $viewSumRegion = 'summary_region';
    private $viewD2        = 'summary_d2';
	private $viewPerKat    = 'summary_perkategori';

    public function __construct(){
        parent::__construct();
        auth();
    }
    
    public function index(){
        $data['breadcrumb'] = null;
        $data['sumRegin']   = $this->m_global->get($this->viewSumRegion,null,null,'*');
		$data['sumPerKat']  = $this->m_global->get($this->viewPerKat,null,null,'*');
        $this->templates->backend($this->prefix.'index', $data);
    }

}

/* End of file Controllername.php */


?>