<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Step extends MX_Controller {
    private $url           = 'step';
    private $prefix        = 'step/step_';
    private $table         = 'sdp_master_step';
    private $prefix_table  = 'step_';
    private $tableKategori = 'sdp_master_kategori';

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['pagetitle'] = 'Halaman Step';
		$data['subtitle']  = 'Daftar Step';
		$data['icon']      = 'box2';
		$data['header']    = 'Table Step';
		
        // get data
		$select          = 'step_id,step_kode,step_nama,step_deskripsi,step_status,step_order';
        $data['records'] = $this->m_global->get($this->table,null,null,$select,null,['step_lastupdate','DESC']);
        
        $this->templates->backend($this->prefix.'index', $data);
    }

    function tambah(){
        $data['pagetitle'] = 'Halaman Step';
		$data['subtitle']  = 'Tambah Data Step';
		$data['icon']      = 'step';
        $data['header']    = 'Form step';
        $data['url']       = $this->url;
		
		$this->templates->backend($this->prefix.'tambah',$data);
    }

    function simpan(){
        $post                     = $this->input->post();
        $data['step_kode']        = $post['step_kode'];
        $data['step_nama']        = $post['step_nama'];
        $data['step_order']       = $post['step_order'];
        $data['step_deskripsi']   = $post['step_deskripsi'];
        $data['step_createdby']   = getSession('user_id');
        $data['step_createddate'] = date('Y-m-d H:i:s');
        $data['step_ip']          = getUserIp();
        
        $input = $this->m_global->insert($this->table, $data); 
        
        if($input){
            redirect('step_tambah');
        }else{
            pre('data gagal disimpan');
        }
    }

    function ubah($step_id){
        $data['pagetitle'] = 'Halaman step';
		$data['subtitle']  = 'Edit data step';
		$data['icon']      = 'step';
        $data['header']    = 'Form step';
        $data['step_id']   = $step_id;
        $data['url']       = $this->url;
        $select            = 'step_kode,step_nama,step_deskripsi,step_order';
		$data['records']   = $this->m_global->get($this->table,null,[md56('step_id',1) => $step_id],$select)[0];
		
		$this->templates->backend('step/step_ubah',$data);
    }

    function update($step_id){
        $post                   = $this->input->post();
		$data['step_kode']      = $post['step_kode'];
		$data['step_nama']      = $post['step_nama'];
		$data['step_order']     = $post['step_order'];
        $data['step_deskripsi'] = $post['step_deskripsi'];
        $data['step_updatedby'] = getSession('user_id');
        $data['step_ip']        = getUserIp();
		
		$update = $this->m_global->update($this->table,$data,[md56('step_id',1) => $step_id]);
		
		if($update == TRUE){
			redirect('step_ubah/'.$step_id);
		}else{
			pre('data gagal disimpan');
		}
    }
    
    function hapus($step_id){
		$delete = $this->m_global->delete($this->table,[md56('step_id',1) => $step_id]);
		
		if($delete == TRUE){
			redirect('step');
		}else{
			pre('data gagal disimpan');
		}
    }
}

/* End of file Controllername.php */


?>