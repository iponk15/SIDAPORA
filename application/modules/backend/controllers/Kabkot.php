<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kabkot extends MX_Controller {
    private $url           = 'kabkot';
    private $prefix        = 'kabkot/kabkot_';
    private $table         = 'sdp_master_kabkot';
    private $prefix_table  = 'kabkot_';
    private $tableProvinsi = 'sdp_master_provinsi';

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['pagetitle'] = 'Halaman Kabupaten / Kota';
		$data['subtitle']  = 'Daftar Kabupaten / Kota';
		$data['icon']      = 'provinsi';
		$data['header']    = 'Table Kabupaten / Kota';
		
        // get data
        $join            = [ ['sdp_master_provinsi','kabkot_provinsi_kode = provinsi_kode','left'] ];
		$select          = 'kabkot_id,kabkot_kode,kabkot_nama,kabkot_status,provinsi_kode,provinsi_nama';
        $data['records'] = $this->m_global->get($this->table,$join,null,$select,null,['kabkot_lastupdate','DESC']);
        
        $this->templates->backend($this->prefix.'index', $data);
    }

    function tambah(){
        $data['pagetitle'] = 'Halaman Provinsi';
		$data['subtitle']  = 'Tambah Data Provinsi';
		$data['icon']      = 'provinsi';
        $data['header']    = 'Form Provinsi';
        $data['url']       = $this->url;
        $data['provinsi']  = $this->m_global->get($this->tableProvinsi,null,['provinsi_status' => '1'],'provinsi_kode,provinsi_nama');
		
		$this->templates->backend($this->prefix.'tambah',$data);
    }

    function simpan(){
        $post                         = $this->input->post();
        $data['kabkot_provinsi_kode'] = $post['kabkot_provinsi_kode'];
        $data['kabkot_kode']          = $post['kabkot_kode'];
        $data['kabkot_nama']          = $post['kabkot_nama'];
        $data['kabkot_createdby']     = getSession('user_id');
        $data['kabkot_createddate']   = date('Y-m-d H:i:s');
        $data['kabkot_ip']            = getUserIp();
        
        $input = $this->m_global->insert($this->table, $data); 
        
        if($input){
            redirect('kabkot_tambah');
        }else{
            pre('data gagal disimpan');
        }
    }

    function ubah($kabkot_id){
        $data['pagetitle'] = 'Halaman Kabupaten / Kota';
		$data['subtitle']  = 'Edit Data Kabupaten / Kota';
		$data['icon']      = 'provinsi';
        $data['header']    = 'Form Kabupaten / Kota';
        $data['kabkot_id'] = $kabkot_id;
        $data['url']       = $this->url;
        // get data provinsi
        $data['provinsi']  = $this->m_global->get($this->tableProvinsi,null,['provinsi_status' => '1'],'provinsi_kode,provinsi_nama');

        // get data janei provinsi
        $join            = [[$this->tableProvinsi,'kabkot_provinsi_kode = provinsi_kode','left']];
        $select          = 'kabkot_kode,kabkot_nama,kabkot_provinsi_kode';
		$data['records'] = $this->m_global->get($this->table,null,[md56('kabkot_id',1) => $kabkot_id],$select)[0];
		
		$this->templates->backend($this->prefix.'ubah',$data);
    }

    function update($kabkot_id){
        $post                       = $this->input->post();
		$data['kabkot_provinsi_kode'] = $post['kabkot_provinsi_kode'];
        $data['kabkot_kode']        = $post['kabkot_kode'];
        $data['kabkot_nama']        = $post['kabkot_nama'];
        $data['kabkot_updatedby']   = getSession('user_id');
        $data['kabkot_ip']          = getUserIp();
		
		$update = $this->m_global->update($this->table,$data,[md56('kabkot_id',1) => $kabkot_id]);
		
		if($update == TRUE){
			// redirect('kabkot_ubah/'.$kabkot_id);
			redirect('kabkot');
		}else{
			pre('data gagal disimpan');
		}
    }
    
    function hapus($kabkot_id){
		$delete = $this->m_global->delete($this->table,[md56('kabkot_id',1) => $kabkot_id]);
		
		if($delete == TRUE){
			redirect('kabkot');
		}else{
			pre('data gagal disimpan');
		}
    }
}

/* End of file Controllername.php */


?>