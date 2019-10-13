<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Page_error extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
    }
    

    public function index()
    {
        if(!empty(getSession())){
            $data['is_404'] = '';
            $this->templates->backend('error_index', $data);
        }else{
            $data['is_404'] = 1;
            $this->templates->frontend('error_index', $data);
        }
    }

}

/* End of file Controllername.php */
?>