<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_bantuan extends MX_Controller {
    private $url           = 'jenis_bantuan';
    private $prefix        = 'jenis_bantuan/jenis_bantuan_';
    private $table         = 'sdp_master_jenis_bantuan';
    private $prefix_table  = 'jnsbtn_';
    private $tableKategori = 'sdp_master_kategori';

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['pagetitle'] = 'Halaman Jenis Bantuan';
		$data['subtitle']  = 'Daftar Jenis Bantuan';
		$data['icon']      = 'plugin';
		$data['header']    = 'Table Jenis Bantuan';
		
        // get data
        $join            = [ ['sdp_master_kategori','jnsbtn_kategori_id = kategori_id','left']];
		$select          = 'kategori_nama,jnsbtn_id,jnsbtn_kode,jnsbtn_nama,jnsbtn_deskripsi,jnsbtn_status';
        $data['records'] = $this->m_global->get($this->table,$join,null,$select,null,['jnsbtn_lastupdate','DESC']);
        
        $this->templates->backend($this->prefix.'index', $data);
    }

    function tambah(){
        $data['pagetitle'] = 'Halaman Jenis Bantuan';
		$data['subtitle']  = 'Tambah data Jenis Bantuan';
		$data['icon']      = 'plugin';
        $data['header']    = 'Form jenis_bantuan';
        $data['url']       = $this->url;
        $data['kategori']  = $this->m_global->get($this->tableKategori,null,['kategori_status' => '1'],'kategori_id,kategori_nama');
		
		$this->templates->backend($this->prefix.'tambah',$data);
    }

    function simpan(){
        $post                       = $this->input->post();
        $data['jnsbtn_kategori_id'] = $post['jnsbtn_kategori_id'];
        $data['jnsbtn_kode']        = strtoupper($post['jnsbtn_kode']);
        $data['jnsbtn_nama']        = $post['jnsbtn_nama'];
        $data['jnsbtn_deskripsi']   = $post['jnsbtn_deskripsi'];
        $data['jnsbtn_createdby']   = getSession('user_id');
        $data['jnsbtn_createddate'] = date('Y-m-d H:i:s');
        $data['jnsbtn_ip']          = getUserIp();
        
        $input = $this->m_global->insert($this->table, $data); 
        
        if($input){
            redirect('jenis_bantuan_tambah');
        }else{
            pre('data gagal disimpan');
        }
    }

    function ubah($jenis_bantuan_id){
        $data['pagetitle'] = 'Halaman Jenis Bantuan';
		$data['subtitle']  = 'Edit data Jenis Bantuan';
		$data['icon']      = 'plugin';
        $data['header']    = 'Form Jenis Bantuan';
        $data['jnsbtn_id'] = $jenis_bantuan_id;
        $data['url']       = $this->url;

        // get data kategoro
        $data['kategori']  = $this->m_global->get($this->tableKategori,null,['kategori_status' => '1'],'kategori_id,kategori_nama');
        // get data janei bantuan
        $select          = 'jnsbtn_kategori_id,jnsbtn_kode,jnsbtn_nama,jnsbtn_deskripsi';
		$data['records'] = $this->m_global->get($this->table,null,[md56('jnsbtn_id',1) => $jenis_bantuan_id],$select)[0];
		
		$this->templates->backend('jenis_bantuan/jenis_bantuan_ubah',$data);
    }

    function update($jenis_bantuan_id){
        $post                       = $this->input->post();
        $data['jnsbtn_kategori_id'] = $post['jnsbtn_kategori_id'];
        $data['jnsbtn_kode']        = strtoupper($post['jnsbtn_kode']);
		$data['jnsbtn_nama']        = $post['jnsbtn_nama'];
        $data['jnsbtn_deskripsi']   = $post['jnsbtn_deskripsi'];
        $data['jnsbtn_updatedby']   = getSession('user_id');
        $data['jnsbtn_ip']          = getUserIp();
		
		$update = $this->m_global->update($this->table,$data,[md56('jnsbtn_id',1) => $jenis_bantuan_id]);
		
		if($update == TRUE){
			redirect('jenis_bantuan_ubah/'.$jenis_bantuan_id);
		}else{
			pre('data gagal disimpan');
		}
    }
    
    function hapus($jenis_bantuan_id){
		$delete = $this->m_global->delete($this->table,[md56('jnsbtn_id',1) => $jenis_bantuan_id]);
		
		if($delete == TRUE){
			redirect('jenis_bantuan');
		}else{
			pre('data gagal disimpan');
		}
    }
    
    function getBantuan(){
        $post = $this->input->post();
        // get data jenis bantuan
        $data = $this->m_global->get($this->tableBantuan,null,['jnsbtn_kategori_id' => $post['jnsbtn_kategori_id']],'jnsbtn_id,jnsbtn_nama');

        $select = ' <select class="form-control" name="bantuan_jnsbtn_id">
                        <option value=""> Pilih Jenis Bantuan </option>';
        
        foreach ($data as $rows) {
            $select .= '<option value="'.$rows->jnsbtn_id.'"> '.$rows->jnsbtn_nama.' </option>';
        }

        echo $select .= '</select>';
    }

}

/* End of file Controllername.php */


?>