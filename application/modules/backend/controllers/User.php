<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {
    private $url          = 'user';
    private $prefix       = 'user/user_';
    private $table        = 'sdp_master_user';
    private $prefix_table = 'user_';

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['pagetitle'] = 'Halaman User';
		$data['subtitle']  = 'Daftar User';
		$data['icon']      = 'user';
		$data['header']    = 'Table User';
		
        // get data
        $recordsJoin     = [
            ['sdp_master_kategori','user_kategori_id = kategori_id', 'left'],
            ['sdp_master_cabang','user_cabang_id = cabang_id', 'left']
        ];
		$select          = 'user_id,user_nama,user_email,user_status,user_role,kategori_nama,cabang_nama';
        $data['records'] = $this->m_global->get($this->table,$recordsJoin,null,$select);
        
        $this->templates->backend($this->prefix.'index', $data);
    }

    function tambah(){
        $data['pagetitle'] = 'Halaman User';
		$data['subtitle']  = 'Tambah data user';
		$data['icon']      = 'user';
		$data['header']    = 'Form User';
		
		$this->templates->backend($this->prefix.'tambah',$data);
    }

    function simpan(){
        $post                     = $this->input->post();
        $data['user_nama']        = $post['user_nama'];
        $data['user_email']       = $post['user_email'];
        $data['user_role']        = $post['user_role'];
        $data['user_kategori_id'] = $post['user_kategori_id'];
        $data['user_cabang_id']   = $post['user_cabang_id'];
        $data['user_password']    = md5_mod($post['user_password'], $post['user_email']);
        $data['user_createdby']   = getSession('user_id');
        $data['user_createddate'] = date('Y-m-d H:i:s');
        $data['user_ip']          = getUserIP();
        
        $input = $this->m_global->insert($this->table, $data); 
        
        if($input){
            redirect('user');
        }else{
            pre('data gagal disimpan');
        }
    }

    function ubah($user_id){
        $data['pagetitle'] = 'Halaman User';
		$data['subtitle']  = 'Edit data user';
		$data['icon']      = 'user';
        $data['header']    = 'Form User';
        $userJoin          = [
            ['sdp_master_kategori','user_kategori_id = kategori_id', 'left'],
            ['sdp_master_cabang','user_cabang_id = cabang_id', 'left']
        ];
        $userSelect        = 'user_id,user_nama,user_email,user_role,kategori_id,kategori_nama,cabang_id,cabang_nama';
		$data['user']      = $this->m_global->get($this->table,$userJoin,['user_id' => $user_id],$userSelect);
		
		$this->templates->backend('user/user_ubah',$data);
    }

    function update($user_id){
        $post                     = $this->input->post();
		$data['user_nama']        = $post['user_nama'];
		$data['user_email']       = $post['user_email'];
		$data['user_role']        = $post['user_role'];
        $data['user_kategori_id'] = ( $post['user_role'] == '1' ? null : $post['user_kategori_id'] );
        $data['user_cabang_id']   = ( $post['user_role'] == '1' ? null : $post['user_cabang_id'] );
		$data['user_updatedby']   = getSession('user_id');
		$data['user_ip']          = getUserIP();
		
		if(!empty($post['user_password'])){
			$data['user_password'] = md5_mod($post['user_password'], $post['user_email']);
		}
		
		$update = $this->m_global->update($this->table,$data,['user_id' => $user_id]);
		
		if($update == TRUE){
			redirect('user');
		}else{
			pre('data gagal disimpan');
		}
    }
    
    function hapus($user_id){
		$delete = $this->m_global->delete($this->table,['user_id' => $user_id]);
		
		if($delete == TRUE){
			redirect('user');
		}else{
			pre('data gagal disimpan');
		}
	}

}

/* End of file Controllername.php */


?>