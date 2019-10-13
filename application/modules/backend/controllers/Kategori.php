<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends MX_Controller {
    private $url          = 'kategori';
    private $prefix       = 'kategori/kategori_';
    private $table        = 'sdp_master_kategori';
    private $prefix_table = 'kategori_';

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['pagetitle'] = 'Halaman kategori';
		$data['subtitle']  = 'Daftar kategori';
		$data['icon']      = 'kategori';
		$data['header']    = 'Table kategori';
		
		// get data
		$select          = 'kategori_id,kategori_nama,kategori_deskripsi,kategori_status';
        $data['records'] = $this->m_global->get($this->table,null,null,$select);
        
        $this->templates->backend($this->prefix.'index', $data);
    }

    function tambah(){
        $data['pagetitle'] = 'Halaman kategori';
		$data['subtitle']  = 'Tambah data kategori';
		$data['icon']      = 'kategori';
		$data['header']    = 'Form kategori';
		
		$this->templates->backend($this->prefix.'tambah',$data);
    }

    function simpan(){
        $post                         = $this->input->post();
        $data['kategori_nama']        = $post['kategori_nama'];
        $data['kategori_deskripsi']   = $post['kategori_deskripsi'];
        $data['kategori_createdby']   = getSession('user_id');
        $data['kategori_createddate'] = date('Y-m-d H:i:s');
        $data['kategori_ip']          = getUserIp();
        
        $input = $this->m_global->insert($this->table, $data); 
        
        if($input){
            redirect('kategori');
        }else{
            pre('data gagal disimpan');
        }
    }

    function ubah($kategori_id){
        $data['pagetitle'] = 'Halaman kategori';
		$data['subtitle']  = 'Edit data kategori';
		$data['icon']      = 'kategori';
		$data['header']    = 'Form kategori';
		$data['kategori']  = $this->m_global->get($this->table,null,['kategori_id' => $kategori_id]);
		
		$this->templates->backend('kategori/kategori_ubah',$data);
    }

    function update($kategori_id){
        $post                       = $this->input->post();
		$data['kategori_nama']      = $post['kategori_nama'];
        $data['kategori_deskripsi'] = $post['kategori_deskripsi'];
        $data['kategori_udpatedby'] = getSession('user_id');
        $data['kategori_ip']        = getUserIp();
		
		$update = $this->m_global->update($this->table,$data,['kategori_id' => $kategori_id]);
		
		if($update == TRUE){
			redirect('kategori');
		}else{
			pre('data gagal disimpan');
		}
    }
    
    function hapus($kategori_id){
		$delete = $this->m_global->delete($this->table,['kategori_id' => $kategori_id]);
		
		if($delete == TRUE){
			redirect('kategori');
		}else{
			pre('data gagal disimpan');
		}
	}

}

/* End of file Controllername.php */


?>