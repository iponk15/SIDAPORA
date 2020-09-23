<?php defined('BASEPATH') OR exit('No direct script access allowed');

class cabang extends MX_Controller {
    private $url           = 'cabang';
    private $prefix        = 'cabang/cabang_';
    private $table         = 'sdp_master_cabang';
    private $prefix_table  = 'cabang_';

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['pagetitle'] = 'Halaman cabang';
		$data['subtitle']  = 'Daftar cabang';
		$data['icon']      = 'box2';
		$data['header']    = 'Table cabang';
		
        // get data
		$select          = 'cabang_id,cabang_nama,cabang_deskripsi,cabang_status';
        $data['records'] = $this->m_global->get($this->table,null,null,$select,null,['cabang_lastupdate','DESC']);
        
        $this->templates->backend($this->prefix.'index', $data);
    }

    function tambah(){
        $data['pagetitle'] = 'Halaman cabang';
		$data['subtitle']  = 'Tambah data cabang';
		$data['icon']      = 'cabang';
        $data['header']    = 'Form cabang';
        $data['url']       = $this->url;
		
		$this->templates->backend($this->prefix.'tambah',$data);
    }

    function simpan(){
        $post                       = $this->input->post();
        $data['cabang_nama']        = $post['cabang_nama'];
        $data['cabang_deskripsi']   = $post['cabang_deskripsi'];
        $data['cabang_createdby']   = getSession('user_id');
        $data['cabang_createddate'] = date('Y-m-d H:i:s');
        $data['cabang_ip']          = getUserIp();
        
        $input = $this->m_global->insert($this->table, $data); 
        
        if($input){
            redirect('cabang_tambah');
        }else{
            pre('data gagal disimpan');
        }
    }

    function ubah($cabang_id){
        $data['pagetitle'] = 'Halaman cabang';
		$data['subtitle']  = 'Edit data cabang';
		$data['icon']      = 'cabang';
        $data['header']    = 'Form cabang';
        $data['cabang_id'] = $cabang_id;
        $data['url']       = $this->url;
        $select            = 'cabang_nama,cabang_deskripsi';
		$data['records']   = $this->m_global->get($this->table,null,[md56('cabang_id',1) => $cabang_id],$select)[0];
		
		$this->templates->backend('cabang/cabang_ubah',$data);
    }

    function update($cabang_id){
        $post                     = $this->input->post();
		$data['cabang_nama']      = $post['cabang_nama'];
        $data['cabang_deskripsi'] = $post['cabang_deskripsi'];
        $data['cabang_updatedby'] = getSession('user_id');
        $data['cabang_ip']        = getUserIp();
		
		$update = $this->m_global->update($this->table,$data,[md56('cabang_id',1) => $cabang_id]);
		
		if($update == TRUE){
			redirect('cabang_ubah/'.$cabang_id);
		}else{
			pre('data gagal disimpan');
		}
    }
    
    function hapus($cabang_id){
		$delete = $this->m_global->delete($this->table,[md56('cabang_id',1) => $cabang_id]);
		
		if($delete == TRUE){
			redirect('cabang');
		}else{
			pre('data gagal disimpan');
		}
    }
}

/* End of file Controllername.php */


?>