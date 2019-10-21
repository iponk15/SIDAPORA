<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends MX_Controller {
    private $url               = 'rekap';
    private $prefix            = 'rekap/rekap_';
    private $table             = 'sdp_rekap';
    private $prefix_table      = 'rekap_';
    private $tableKategori     = 'sdp_master_kategori';
	private $tableRekapDetail  = 'sdp_rekap_detail';
	private $tableBantuan      = 'sdp_master_bantuan';
	private $tableJenisBantuan = 'sdp_master_jenis_bantuan';
	private $tableProvinsi     = 'sdp_master_provinsi';
	private $tableKabkot       = 'sdp_master_kabkot';
	private $tableKecamatan    = 'sdp_master_kecamatan';
	private $tableKeldes       = 'sdp_master_keldes';

    public function __construct(){
        parent::__construct();
        auth();
    }

    public function index(){
        $data['pagetitle'] = 'Halaman Rekap';
		$data['subtitle']  = 'Daftar Rekap';
		$data['icon']      = 'provinsi';
		$data['header']    = 'Table Rekap';
		
        // get data
        $join            = [[$this->tableKategori,'rekap_kategori_id = kategori_id','left']];
        $select          = 'rekap_id,rekap_judul,rekap_tahun,rekap_status,kategori_nama';
        $data['records'] = $this->m_global->get($this->table,$join,null,$select,null,['rekap_lastupdate','DESC']);

        // get data kategori
        $data['kategori'] = $this->m_global->get($this->tableKategori,null,['kategori_status' => '1'],'kategori_id,kategori_nama');
        
        $this->templates->backend($this->prefix.'index', $data);
    }

    function tambah(){
        $data['pagetitle'] = 'Halaman bantuan';
		$data['subtitle']  = 'Tambah data bantuan';
		$data['icon']      = 'bantuan';
        $data['header']    = 'Form bantuan';
        $data['url']       = $this->url;

        // get data kategoro
        $data['kategori']  = $this->m_global->get($this->tableKategori,null,['kategori_status' => '1'],'kategori_id,kategori_nama');

        $this->templates->backend($this->prefix.'tambah', $data);
    }

    function simpan(){
        $post                      = $this->input->post();
        $data['rekap_kategori_id'] = $post['rekap_kategori_id'];
        $data['rekap_judul']       = $post['rekap_judul'];
        $data['rekap_tahun']       = $post['rekap_tahun'];
        $data['rekap_createdby']   = getSession('user_id');
        $data['rekap_createddate'] = date('Y-m-d H:i:s');
        $data['rekap_ip']          = getUserIp();
        
        $input = $this->m_global->insert($this->table, $data); 
        
        if($input){
            redirect('rekap_tambah');
        }else{
            pre('data gagal disimpan');
        }
    }

    function ubah($rekap_id){
        $data['pagetitle'] = 'Halaman Rekap';
		$data['subtitle']  = 'Edit data Rekap';
		$data['icon']      = 'bantuan';
        $data['header']    = 'Form Edit Rekap';
        $data['rekap_id']  = $rekap_id;
        $data['url']       = $this->url;
		
		// get data kategoro
        $data['kategori']  = $this->m_global->get($this->tableKategori,null,['kategori_status' => '1'],'kategori_id,kategori_nama');
		
        // get data janei bantuan
        $select            = 'rekap_judul,rekap_kategori_id,rekap_tahun,rekap_status';
		$data['records']   = $this->m_global->get($this->table,null,[md56('rekap_id',1) => $rekap_id],$select)[0];
		
		$this->templates->backend('rekap/rekap_ubah',$data);
    }

    function update($rekap_id){
        $post                      = $this->input->post();
		$data['rekap_kategori_id'] = $post['rekap_kategori_id'];
        $data['rekap_judul']       = $post['rekap_judul'];
        $data['rekap_tahun']       = $post['rekap_tahun'];
        $data['rekap_updatedby']   = getSession('user_id');
        $data['rekap_ip']          = getUserIp();
		
		$update = $this->m_global->update($this->table,$data,[md56('rekap_id',1) => $rekap_id]);
		
		if($update == TRUE){
			redirect('rekap_ubah/'.$rekap_id);
		}else{
			pre('data gagal disimpan');
		}
    }
    
    function hapus($rekap_id){
		$delete = $this->m_global->delete($this->table,[md56('rekap_id',1) => $rekap_id]);
		
		if($delete == TRUE){
			redirect('rekap');
		}else{
			pre('data gagal disimpan');
		}
    }
	
	function detail($rekap_id){
		$data['pagetitle'] = 'Halaman Rekap Detail';
		$data['subtitle']  = 'Data Rekap Detail';
		$data['icon']      = 'rekap';
        $data['header']    = 'Detail Rekap';
        $data['rekap_id']  = $rekap_id;
        $data['url']       = $this->url;
		
		// get data rekap
		$joinRekap     = [ [$this->tableKategori,'rekap_kategori_id = kategori_id','left'] ];
		$selectRekap   = 'rekap_judul, kategori_id, kategori_nama, rekap_tahun';
		$data['rekap'] = $this->m_global->get($this->table,$joinRekap,[md56('rekap_id',1) => $rekap_id], $selectRekap )[0];
		
		// get data rekap detail
		$select            = 'rekdet_id,rekdet_lembaga,rekdet_nominal,bantuan_nama,jnsbtn_nama,provinsi_nama,kabkot_nama,kecamatan_nama,keldes_nama';
		$join              = [
			[$this->tableBantuan,'rekdet_bantuan_kode = bantuan_kode','left'],
			[$this->tableJenisBantuan,'rekdet_jnsbtn_kode = jnsbtn_kode','left'],
			[$this->tableProvinsi,'rekdet_provinsi_kode = provinsi_kode', 'left'],
			[$this->tableKabkot,'rekdet_kabkot_kode = kabkot_kode','left'],
			[$this->tableKecamatan,'rekdet_kecamatan_kode = kecamatan_kode','left'],
			[$this->tableKeldes,'rekdet_keldes_kode = keldes_kode','left']
		];
		$data['rkpDetail'] = $this->m_global->get($this->tableRekapDetail,$join,[md56('rekdet_rekap_id',1) => $rekap_id], $select);
		
		$this->templates->backend('rekap/rekap_detail',$data);
    }
    
    function detail_tambah($rekap_id,$kategori_id){
        $data['pagetitle'] = 'Halaman bantuan';
		$data['subtitle']  = 'Tambah data bantuan';
		$data['icon']      = 'bantuan';
        $data['header']    = 'Form bantuan';
        $data['url']       = $this->url;
        $data['rekap_id']  = $rekap_id;
        $data['ktgrId']    = $kategori_id;

        // get data foreign
        $data['bantuan']  = $this->m_global->get($this->tableBantuan,null,['bantuan_status' => '1', md56('bantuan_kategori_id',1) => $kategori_id],'bantuan_id,bantuan_nama');
        $data['jnsbtn']   = $this->m_global->get($this->tableJenisBantuan,null,['jnsbtn_status' => '1', md56('jnsbtn_kategori_id',1) => $kategori_id],'jnsbtn_kode,jnsbtn_nama');
        $data['provinsi'] = $this->m_global->get($this->tableProvinsi,null,['provinsi_status' => '1'],'provinsi_kode,provinsi_nama');

        $this->templates->backend($this->prefix.'detail_tambah', $data);
    }

    function simpan_detail($rekap_id, $kategori_id){
        $post = $this->input->post();

        // get data rekap
        $where[md56('rekap_id',1)]          = $rekap_id;
        $where[md56('rekap_kategori_id',1)] = $kategori_id;
        $rekap_id = $this->m_global->get($this->table,null,$where,'rekap_id')[0]->rekap_id;

        $data['rekdet_rekap_id']       = $rekap_id;
        $data['rekdet_lembaga']        = $post['rekdet_lembaga'];
        $data['rekdet_bantuan_kode']   = $post['rekdet_bantuan_id'];
        $data['rekdet_jnsbtn_kode']    = $post['rekdet_jnsbtn_id'];
        $data['rekdet_provinsi_kode']  = $post['rekdet_provinsi_id'];
        $data['rekdet_kabkot_kode']    = $post['kecamatan_kabkot_id'];
        $data['rekdet_kecamatan_kode'] = $post['keldes_kecamatan_id'];
        $data['rekdet_keldes_kode']    = $post['rekap_keldes_id'];
        $data['rekdet_nominal']        = $post['rekdet_nominal'];
        
        $input = $this->m_global->insert($this->tableRekapDetail, $data); 
        
        if($input){
            redirect('rekap_detail_tambah/'.md56($rekap_id).'/'.$kategori_id);
        }else{
            pre('data gagal disimpan');
        }
    }

    function detail_ubah($rekdet_id){
        $data['pagetitle'] = 'Halaman bantuan';
		$data['subtitle']  = 'Tambah data bantuan';
		$data['icon']      = 'bantuan';
        $data['header']    = 'Form bantuan';
        $data['url']       = $this->url;
        $data['rekdet_id'] = $rekdet_id;

        $join              = [ 
            [$this->table,'rekdet_rekap_id = rekap_id','left'],
            [$this->tableBantuan,'rekdet_bantuan_kode = bantuan_kode','left'],
            [$this->tableJenisBantuan,'rekdet_jnsbtn_kode = jnsbtn_kode','left'],
            [$this->tableProvinsi,'rekdet_provinsi_kode = provinsi_kode','left'],
            [$this->tableKabkot,'rekdet_kabkot_kode = kabkot_kode','left'],
            [$this->tableKecamatan,'rekdet_kecamatan_kode = kecamatan_kode','left'],
            [$this->tableKeldes,'rekdet_keldes_kode = keldes_kode','left']
        ];
        $select          = 'rekdet_rekap_id,rekdet_lembaga,rekdet_nominal,rekap_kategori_id,rekdet_bantuan_kode,rekdet_jnsbtn_kode,rekdet_provinsi_kode,rekdet_kabkot_kode,rekdet_kecamatan_kode,rekdet_keldes_kode';
        $data['records'] = $this->m_global->get($this->tableRekapDetail,$join,[md56('rekdet_id',1) => $rekdet_id],$select)[0];

        // get data foreign
        $data['bantuan']   = $this->m_global->get($this->tableBantuan,null,['bantuan_status' => '1', 'bantuan_kategori_id' => $data['records']->rekap_kategori_id ],'bantuan_kode,bantuan_nama');
        $data['jnsbtn']    = $this->m_global->get($this->tableJenisBantuan,null,['jnsbtn_status' => '1', 'jnsbtn_kategori_id' => $data['records']->rekap_kategori_id ],'jnsbtn_kode,jnsbtn_nama');
        $data['provinsi']  = $this->m_global->get($this->tableProvinsi,null,['provinsi_status' => '1'],'provinsi_kode,provinsi_nama');
        $data['kabkot']    = $this->m_global->get($this->tableKabkot,null,['kabkot_provinsi_kode' => $data['records']->rekdet_provinsi_kode ],'kabkot_kode,kabkot_nama');
        $data['kecamatan'] = $this->m_global->get($this->tableKecamatan,null,['kecamatan_provinsi_kode' => $data['records']->rekdet_provinsi_kode],'kecamatan_kode,kecamatan_nama');
        $data['kelurahan'] = $this->m_global->get($this->tableKeldes,null,['keldes_provinsi_kode' => $data['records']->rekdet_provinsi_kode],'keldes_kode,keldes_nama');

        $this->templates->backend($this->prefix.'detail_ubah', $data);
    }

    function update_detail($rekdet_id){
        $post = $this->input->post();

        $data['rekdet_lembaga']        = $post['rekdet_lembaga'];
        $data['rekdet_bantuan_kode']   = $post['rekdet_bantuan_id'];
        $data['rekdet_jnsbtn_kode']    = $post['rekdet_jnsbtn_id'];
        $data['rekdet_provinsi_kode']  = $post['rekdet_provinsi_id'];
        $data['rekdet_kabkot_kode']    = $post['kecamatan_kabkot_id'];
        $data['rekdet_kecamatan_kode'] = $post['keldes_kecamatan_id'];
        $data['rekdet_keldes_kode']    = $post['rekap_keldes_id'];
        $data['rekdet_nominal']        = $post['rekdet_nominal'];
        
        $input = $this->m_global->update($this->tableRekapDetail, $data, [md56('rekdet_id',1) => $rekdet_id]); 
        
        if($input){
            redirect('rekap_detail_ubah/'.$rekdet_id);
        }else{
            pre('data gagal disimpan');
        }
    }

    function hapus_detail($rekap_id, $rekdet_id){
        $delete = $this->m_global->delete($this->tableRekapDetail,[md56('rekdet_id',1) => $rekdet_id]);
		
		if($delete == TRUE){
			redirect('rekap_detail/'.$rekap_id);
		}else{
			pre('data gagal disimpan');
		}
    }

    function getKelurahan(){
        $post = $this->input->post();
        
        // get kelurahan 
        $where['keldes_provinsi_kode']  = $post['provinsi_id'];
        $where['keldes_kabkot_kode']    = $post['kabkot_id'];
        $where['keldes_kecamatan_kode'] = $post['kecamtan_id'];
        $getKeldes = $this->m_global->get($this->tableKeldes,null,$where,'keldes_kode,keldes_nama');

        if(!empty($getKeldes)){
            $select = '<select name="rekap_keldes_id" class="form-control rekap_keldes_id">
                            <option value=""> Pilih Kelurahan </option>';
            
            foreach ($getKeldes as $keldes) {
                $select .= '<option value="'.$keldes->keldes_kode.'"> '.$keldes->keldes_nama.' </option>';
            }

            echo $select .= '</select>';
        }else{
            echo 'Maaf data tidak di temukan';
        }
    }

    function importData(){
        $this->load->library('excel');

        $post     = $this->input->post();
        $fileName = $_FILES['data_rekap']['name'];
        $tmpFile  = $_FILES['data_rekap']['tmp_name'];

        $objPHPExcel     = PHPExcel_IOFactory::load($tmpFile);
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        $sheet           = $objPHPExcel->getSheetNames();

        $p = 0;
        $x = 1;
        foreach ($sheet as $sheets) {
            $rowExcel      = $objPHPExcel->getSheet($p++);
            $highestRow    = $rowExcel->getHighestRow();
            $highestColumn = $rowExcel->getHighestColumn();
            
            $dtRekap['rekap_judul']       = $rowExcel->rangeToArray('A1')[0][0];
            $dtRekap['rekap_kategori_id'] = $post['data_kategori'];
            $dtRekap['rekap_tahun']       = $sheets;
            $dtRekap['rekap_createdby']   = getSession('user_id');
            $dtRekap['rekap_createddate'] = date('Y-m-d H:i:s');
            $dtRekap['rekap_ip']          = getUserIp();

            $saveRekap = $this->m_global->insert($this->table, $dtRekap);
            $lastId    = $this->db->insert_id();
            
            pre('Data lastid '. $lastId);
            
            for($row = 6; $row <= $highestRow; $row++){
                $rowData = $rowExcel->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

                $dtRekapDetail['rekdet_rekap_id']       = $lastId;
                $dtRekapDetail['rekdet_lembaga']        = $rowData[0][1];
                $dtRekapDetail['rekdet_bantuan_kode']   = $rowData[0][3];
                $dtRekapDetail['rekdet_jnsbtn_kode']    = $rowData[0][2];
                $dtRekapDetail['rekdet_keldes_kode']    = $rowData[0][4];
                $dtRekapDetail['rekdet_kecamatan_kode'] = $rowData[0][5];
                $dtRekapDetail['rekdet_kabkot_kode']    = $rowData[0][6];
                $dtRekapDetail['rekdet_provinsi_kode']  = $rowData[0][7];
                $dtRekapDetail['rekdet_nominal']        = $rowData[0][8];

                $tempData[] = $dtRekapDetail;
            }
        }

        $insRekapDetail = $this->db->insert_batch($this->tableRekapDetail, $tempData);

        if($insRekapDetail){
            redirect('rekap');          
        }else{
            pre('data gagal disimpan');
        }
    }

}

/* End of file Controllername.php */

?>