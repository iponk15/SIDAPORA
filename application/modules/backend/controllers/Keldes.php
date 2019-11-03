<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Keldes extends MX_Controller {
    private $url            = 'keldes';
    private $prefix         = 'keldes/keldes_';
    private $table          = 'sdp_master_keldes';
    private $prefix_table   = 'keldes_';
    private $tableProvinsi  = 'sdp_master_provinsi';
    private $tableKabkot    = 'sdp_master_kabkot';
    private $tableKecamatan = 'sdp_master_kecamatan';

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['pagetitle'] = 'Halaman Kelurahan / Desa';
		$data['subtitle']  = 'Daftar Kelurahan / Desa';
		$data['icon']      = 'map-marker';
		$data['header']    = 'Table Kelurahan / Desa';
		
        // get data
        $join            = [ 
            [$this->tableProvinsi,'keldes_provinsi_kode = provinsi_kode','left'],
            [$this->tableKabkot,'(`keldes_kabkot_kode` = `kabkot_kode` AND kabkot_provinsi_kode = provinsi_kode)','left'],
            [$this->tableKecamatan,'(`keldes_kecamatan_kode` = `kecamatan_kode` AND kecamatan_kabkot_kode = kabkot_kode)','left']
        ];
		$select          = 'keldes_id,keldes_kode,keldes_nama,keldes_status,provinsi_kode,provinsi_nama,kabkot_kode,kabkot_nama,kecamatan_kode,kecamatan_nama';
        $data['records'] = $this->m_global->get($this->table,$join,null,$select,null,['keldes_lastupdate','DESC']);
        
        $this->templates->backend($this->prefix.'index', $data);
    }

    function tambah(){
        $data['pagetitle'] = 'Halaman Kelurahan / Desa';
		$data['subtitle']  = 'Tambah Data Kelurahan / Desa';
		$data['icon']      = 'map-marker';
        $data['header']    = 'Form Kelurahan / Desa';
        $data['url']       = $this->url;
        $data['provinsi']  = $this->m_global->get($this->tableProvinsi,null,['provinsi_status' => '1'],'provinsi_kode,provinsi_nama',null,['provinsi_nama','ASC']);
		
		$this->templates->backend($this->prefix.'tambah',$data);
    }

    function simpan(){
        $post                          = $this->input->post();
        $data['keldes_provinsi_kode']  = $post['keldes_provinsi_kode'];
        $data['keldes_kabkot_kode']    = $post['kecamatan_kabkot_id'];
        $data['keldes_kecamatan_kode'] = $post['keldes_kecamatan_id'];
        $data['keldes_kode']           = $post['keldes_kode'];
        $data['keldes_nama']           = $post['keldes_nama'];
        $data['keldes_createdby']      = getSession('user_id');
        $data['keldes_createddate']    = date('Y-m-d H:i:s');
        $data['keldes_ip']             = getUserIp();
        
        $input = $this->m_global->insert($this->table, $data); 
        
        if($input){
            redirect('keldes_tambah');
        }else{
            pre('data gagal disimpan');
        }
    }

    function ubah($keldes_id){
        $data['pagetitle'] = 'Halaman Kelurahan / Desa';
		$data['subtitle']  = 'Edit Data Kelurahan / Desa';
		$data['icon']      = 'map-marker';
        $data['header']    = 'Form Kelurahan / Desa';
        $data['keldes_id'] = $keldes_id;
        $data['url']       = $this->url;

        // get data janei provinsi
        $join            = [
            [$this->tableProvinsi,'keldes_provinsi_kode = provinsi_kode','left'],
            [$this->tableKabkot,'keldes_kabkot_kode = kabkot_kode','left'],
            [$this->tableKecamatan,'keldes_kecamatan_kode = kecamatan_kode','left']
        ];
        $select          = 'provinsi_nama,kabkot_nama,kecamatan_nama,keldes_kode,keldes_nama,keldes_provinsi_kode';
		$data['records'] = $this->m_global->get($this->table,$join,[md56('keldes_id',1) => $keldes_id],$select)[0];
		
		$this->templates->backend($this->prefix.'ubah',$data);
    }

    function update($keldes_id){
        $post                     = $this->input->post();
        $data['keldes_nama']      = $post['keldes_nama'];
		$data['keldes_nama']      = $post['keldes_nama'];
        $data['keldes_updatedby'] = getSession('user_id');
        $data['keldes_ip']        = getUserIp();
		
		$update = $this->m_global->update($this->table,$data,[md56('keldes_id',1) => $keldes_id]);
		
		if($update == TRUE){
			// redirect('keldes_ubah/'.$keldes_id);
			redirect('keldes');
		}else{
			pre('data gagal disimpan');
		}
    }
    
    function hapus($keldes_id){
		$delete = $this->m_global->delete($this->table,[md56('keldes_id',1) => $keldes_id]);
		
		if($delete == TRUE){
			redirect('keldes');
		}else{
			pre('data gagal disimpan');
		}
    }

    function getKecamatan(){
        $post = $this->input->post();
        
        $join    = [ 
            [$this->tableProvinsi,'kecamatan_provinsi_kode = provinsi_kode','left'],
            [$this->tableKabkot,'(kabkot_provinsi_kode = provinsi_kode AND kecamatan_provinsi_kode = provinsi_kode AND kecamatan_kabkot_kode = kabkot_kode)','left']
        ];
        $getData = $this->m_global->get($this->tableKecamatan,$join,['kecamatan_provinsi_kode' => $post['provinsi_id'], 'kecamatan_kabkot_kode' => $post['kabkot_id'] ],'kecamatan_kode,kecamatan_nama');

        if(!empty($getData)){
            $select = '<select name="keldes_kecamatan_id" class="form-control keldes_kecamatan_id">
                        <option value=""> Pilih Kecamatan </option>';
        
            foreach ($getData as $kecamatan) {
                $select .= '<option value="'.$kecamatan->kecamatan_kode.'"> '.$kecamatan->kecamatan_nama.' </option>';
            }

            echo $select .= '</select>';
        }else{
            echo 'Maaf data tidak di temukan';
        }
    }
}

/* End of file Controllername.php */


?>