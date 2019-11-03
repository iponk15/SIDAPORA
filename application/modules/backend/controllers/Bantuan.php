<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bantuan extends MX_Controller {
    private $url           = 'bantuan';
    private $prefix        = 'bantuan/bantuan_';
    private $table         = 'sdp_master_bantuan';
    private $prefix_table  = 'bantuan_';
    private $tableKategori = 'sdp_master_kategori';

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['pagetitle'] = 'Halaman Bantuan';
		$data['subtitle']  = 'Daftar Bantuan';
		$data['icon']      = 'box2';
		$data['header']    = 'Table Bantuan';
		
        // get data
        $join            = [ ['sdp_master_kategori','bantuan_kategori_id = kategori_id','left'] ];
		$select          = 'kategori_nama,bantuan_id,bantuan_kode,bantuan_nama,bantuan_deskripsi,bantuan_status';
        $data['records'] = $this->m_global->get($this->table,$join,null,$select,null,['bantuan_lastupdate','DESC']);
        
        $this->templates->backend($this->prefix.'index', $data);
    }

    function tambah(){
        $data['pagetitle'] = 'Halaman bantuan';
		$data['subtitle']  = 'Tambah data bantuan';
		$data['icon']      = 'bantuan';
        $data['header']    = 'Form bantuan';
        $data['url']       = $this->url;
        $data['kategori']  = $this->m_global->get($this->tableKategori,null,['kategori_status' => '1'],'kategori_id,kategori_nama');
		
		$this->templates->backend($this->prefix.'tambah',$data);
    }

    function simpan(){
        $post                        = $this->input->post();
        $data['bantuan_kategori_id'] = $post['bantuan_kategori_id'];
        $data['bantuan_kode']        = $post['bantuan_kode'];
        $data['bantuan_nama']        = $post['bantuan_nama'];
        $data['bantuan_deskripsi']   = $post['bantuan_deskripsi'];
        $data['bantuan_createdby']   = getSession('user_id');
        $data['bantuan_createdate']  = date('Y-m-d H:i:s');
        $data['bantuan_ip']          = getUserIp();
        
        $input = $this->m_global->insert($this->table, $data); 
        
        if($input){
            redirect('bantuan_tambah');
        }else{
            pre('data gagal disimpan');
        }
    }

    function ubah($bantuan_id){
        $data['pagetitle'] = 'Halaman Bantuan';
		$data['subtitle']  = 'Edit data Bantuan';
		$data['icon']      = 'bantuan';
        $data['header']    = 'Form Bantuan';
        $data['bantuan_id'] = $bantuan_id;
        $data['url']       = $this->url;

        // get data kategoro
        $data['kategori']  = $this->m_global->get($this->tableKategori,null,['kategori_status' => '1'],'kategori_id,kategori_nama');
        // get data janei bantuan
        $select          = 'bantuan_kategori_id,bantuan_kode,bantuan_nama,bantuan_deskripsi';
		$data['records'] = $this->m_global->get($this->table,null,[md56('bantuan_id',1) => $bantuan_id],$select)[0];
		
		$this->templates->backend('bantuan/bantuan_ubah',$data);
    }

    function update($bantuan_id){
        $post                       = $this->input->post();
		$data['bantuan_kategori_id'] = $post['bantuan_kategori_id'];
		$data['bantuan_kode']        = $post['bantuan_kode'];
		$data['bantuan_nama']        = $post['bantuan_nama'];
        $data['bantuan_deskripsi']   = $post['bantuan_deskripsi'];
        $data['bantuan_updatedby']   = getSession('user_id');
        $data['bantuan_ip']          = getUserIp();
		
		$update = $this->m_global->update($this->table,$data,[md56('bantuan_id',1) => $bantuan_id]);
		
		if($update == TRUE){
			redirect('bantuan_ubah/'.$bantuan_id);
		}else{
			pre('data gagal disimpan');
		}
    }
    
    function hapus($bantuan_id){
		$delete = $this->m_global->delete($this->table,[md56('bantuan_id',1) => $bantuan_id]);
		
		if($delete == TRUE){
			redirect('bantuan');
		}else{
			pre('data gagal disimpan');
		}
    }
}

/* End of file Controllername.php */


?>