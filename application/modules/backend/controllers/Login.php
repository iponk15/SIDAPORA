<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {
    private $url    = 'login';
    private $prefix = 'login/login_';
    private $table  = 'sdp_master_user';

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $this->load->view($this->prefix.'index');
    }

    function masuk(){
        $post     = $this->input->post();
        $email    = $post['user_email'];
        $password = md5_mod( $post['user_password'], $post['user_email'] );

        // cek data user
        $select   = 'user_id,user_nama,user_email';
        $cekUser  = $this->m_global->get($this->table, null, [ 'user_email' => $email, 'user_password' => $password, 'user_status' => '1' ], $select);

        if(!empty($cekUser)){
			$this->session->set_userdata('sidaporaSes', $cekUser[0]);
			redirect(base_url('landing'));
		}else{
			redirect(base_url('login'));
		}
    }

    public function keluar(){
		$this->session->sess_destroy();
		redirect(base_url().'login');
	}

}

/* End of file Controllername.php */


?>