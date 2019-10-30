<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends MX_Controller {
    private $url           = 'kecamatan';
    private $prefix        = 'kecamatan/kecamatan_';
    private $table         = 'sdp_master_kecamatan';
    private $prefix_table  = 'kecamatan_';
    private $tableProvinsi = 'sdp_master_provinsi';
    private $tableKabkot   = 'sdp_master_kabkot';

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['pagetitle'] = 'Halaman Kecamatan';
		$data['subtitle']  = 'Daftar Kecamatan';
		$data['icon']      = 'provinsi';
		$data['header']    = 'Table Kecamatan';
		
        // get data
        $join            = [ 
            [$this->tableProvinsi,'kecamatan_provinsi_kode = provinsi_kode','left'],
            [$this->tableKabkot,'kecamatan_kabkot_kode = kabkot_kode','left']
        ];
		$select          = 'kecamatan_id,kecamatan_kode,kecamatan_nama,kecamatan_status,provinsi_kode,provinsi_nama,kabkot_kode,kabkot_nama';
        $data['records'] = $this->m_global->get($this->table,$join,null,$select,null,['kecamatan_lastupdate','DESC']);
        
        $this->templates->backend($this->prefix.'index', $data);
    }

    function tambah(){
        $data['pagetitle'] = 'Halaman Provinsi';
		$data['subtitle']  = 'Tambah Data Provinsi';
		$data['icon']      = 'provinsi';
        $data['header']    = 'Form Provinsi';
        $data['url']       = $this->url;
        $data['provinsi']  = $this->m_global->get($this->tableProvinsi,null,['provinsi_status' => '1'],'provinsi_kode,provinsi_nama',null,['provinsi_nama','ASC']);
		
		$this->templates->backend($this->prefix.'tambah',$data);
    }

    function simpan(){
        $post                            = $this->input->post();
        $data['kecamatan_provinsi_kode'] = $post['kecamatan_provinsi_kode'];
        $data['kecamatan_kabkot_kode']   = $post['kecamatan_kabkot_id'];
        $data['kecamatan_kode']          = $post['kecamatan_kode'];
        $data['kecamatan_nama']          = $post['kecamatan_nama'];
        $data['kecamatan_createdby']     = getSession('user_id');
        $data['kecamatan_createddate']   = date('Y-m-d H:i:s');
        $data['kecamatan_ip']            = getUserIp();
        
        $input = $this->m_global->insert($this->table, $data); 
        
        if($input){
            redirect('kecamatan_tambah');
        }else{
            pre('data gagal disimpan');
        }
    }

    function ubah($kecamatan_id){
        $data['pagetitle']    = 'Halaman Kecamatan';
		$data['subtitle']     = 'Edit Data Kecamatan';
		$data['icon']         = 'provinsi';
        $data['header']       = 'Form Kecamatan';
        $data['kecamatan_id'] = $kecamatan_id;
        $data['url']          = $this->url;

        // get data janei provinsi
        $join            = [
            [$this->tableProvinsi,'kecamatan_provinsi_kode = provinsi_kode','left'],
            [$this->tableKabkot,'kecamatan_kabkot_kode = kabkot_kode','left']
        ];
        $select          = 'provinsi_nama,kecamatan_kode,kabkot_nama,kecamatan_nama,kecamatan_provinsi_kode';
		$data['records'] = $this->m_global->get($this->table,$join,[md56('kecamatan_id',1) => $kecamatan_id],$select)[0];
		
		$this->templates->backend($this->prefix.'ubah',$data);
    }

    function update($kecamatan_id){
        $post                        = $this->input->post();
        $data['kecamatan_kode']      = $post['kecamatan_kode'];
		$data['kecamatan_nama']      = $post['kecamatan_nama'];
        $data['kecamatan_updatedby'] = getSession('user_id');
        $data['kecamatan_ip']        = getUserIp();
		
		$update = $this->m_global->update($this->table,$data,[md56('kecamatan_id',1) => $kecamatan_id]);
		
		if($update == TRUE){
			redirect('kecamatan');
		}else{
			pre('data gagal disimpan');
		}
    }
    
    function hapus($kecamatan_id){
		$delete = $this->m_global->delete($this->table,[md56('kecamatan_id',1) => $kecamatan_id]);
		
		if($delete == TRUE){
			redirect('kecamatan');
		}else{
			pre('data gagal disimpan');
		}
    }

    function getKabkot(){
        $post = $this->input->post();

        // get data kabkot
        $dataKabkot = $this->m_global->get($this->tableKabkot,null,['kabkot_provinsi_kode' => $post['provinsi_id'], 'kabkot_status' => '1']);

        if(!empty($dataKabkot)){
            
            $select = '<select name="kecamatan_kabkot_id" class="form-control kecamatan_kabkot_id">
                            <option value=""> Pilih Kabupaten / Kota </option>';
            
            foreach ($dataKabkot as $kabkot) {
                $select .= '<option value="'.$kabkot->kabkot_kode.'"> '.$kabkot->kabkot_nama.' </option>';
            }

            $select .= '</select>';

            if($post['message'] != true){
                echo $select;
            }else{
                $data['status']  = 1;
                $data['message'] = $select;

                echo json_encode($data);
            }
        }else{
            if($post['message'] == true){
                $data['status']  = 0;
                $data['message'] = 'Maaf data tidak ditemukan';

                echo json_encode($data);
            }else{
                echo 'Maaf data tidak ditemukan';
            }
        }
    }
}

/* End of file Controllername.php */


?>