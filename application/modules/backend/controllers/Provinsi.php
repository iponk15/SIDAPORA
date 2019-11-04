<?php defined('BASEPATH') OR exit('No direct script access allowed');

class provinsi extends MX_Controller {
    private $url           = 'provinsi';
    private $prefix        = 'provinsi/provinsi_';
    private $table         = 'sdp_master_provinsi';
    private $prefix_table  = 'provinsi_';

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['pagetitle'] = 'Halaman Provinsi';
		$data['subtitle']  = 'Daftar Provinsi';
		$data['icon']      = 'map-marker';
		$data['header']    = 'Table Provinsi';
		
        // get data
		$select          = 'provinsi_id,provinsi_kode,provinsi_nama,provinsi_status';
        $data['records'] = $this->m_global->get($this->table,null,null,$select,null,['provinsi_lastupdate','DESC']);
        
        $this->templates->backend($this->prefix.'index', $data);
    }

    function tambah(){
        $data['pagetitle'] = 'Halaman Provinsi';
		$data['subtitle']  = 'Tambah Data Provinsi';
		$data['icon']      = 'provinsi';
        $data['header']    = 'Form Provinsi';
        $data['url']       = $this->url;
		
		$this->templates->backend($this->prefix.'tambah',$data);
    }

    function simpan(){
        $post                         = $this->input->post();
        $data['provinsi_kode']        = $post['provinsi_kode'];
        $data['provinsi_nama']        = $post['provinsi_nama'];
        $data['provinsi_latitude']    = $post['provinsi_latitude'];
        $data['provinsi_longtitude']  = $post['provinsi_longtitude'];
        $data['provinsi_createdby']   = getSession('user_id');
        $data['provinsi_createddate'] = date('Y-m-d H:i:s');
        $data['provinsi_ip']          = getUserIp();
        
        $input = $this->m_global->insert($this->table, $data); 
        
        if($input){
            redirect('provinsi_tambah');
        }else{
            pre('data gagal disimpan');
        }
    }

    function ubah($provinsi_id){
        $data['pagetitle']   = 'Halaman Provinsi';
		$data['subtitle']    = 'Edit Data Provinsi';
		$data['icon']        = 'map-marker';
        $data['header']      = 'Form Provinsi';
        $data['provinsi_id'] = $provinsi_id;
        $data['url']         = $this->url;

        // get data janei provinsi
        $select          = 'provinsi_kode, provinsi_nama, provinsi_latitude, provinsi_longtitude';
		$data['records'] = $this->m_global->get($this->table,null,[md56('provinsi_id',1) => $provinsi_id],$select)[0];
		
		$this->templates->backend('provinsi/provinsi_ubah',$data);
    }

    function update($provinsi_id){
        $post                        = $this->input->post();
        $data['provinsi_kode']       = $post['provinsi_kode'];
        $data['provinsi_nama']       = $post['provinsi_nama'];
        $data['provinsi_latitude']   = $post['provinsi_latitude'];
        $data['provinsi_longtitude'] = $post['provinsi_longtitude'];
        $data['provinsi_updatedby']  = getSession('user_id');
        $data['provinsi_ip']         = getUserIp();
		
		$update = $this->m_global->update($this->table,$data,[md56('provinsi_id',1) => $provinsi_id]);
		
		if($update == TRUE){
			// redirect('provinsi_ubah/'.$provinsi_id);
			redirect('provinsi');
		}else{
			pre('data gagal disimpan');
		}
    }
    
    function hapus($provinsi_id){
		$delete = $this->m_global->delete($this->table,[md56('provinsi_id',1) => $provinsi_id]);
		
		if($delete == TRUE){
			redirect('provinsi');
		}else{
			pre('data gagal disimpan');
		}
    }
}

/* End of file Controllername.php */


?>