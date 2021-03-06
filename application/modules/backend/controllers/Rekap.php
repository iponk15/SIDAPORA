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
    private $tableDokumen      = 'sdp_rekap_dokumen';
    private $tableStep         = 'sdp_master_step';

    public function __construct(){
        parent::__construct();
        auth();
    }

    public function index(){
        $get = $this->input->get();
        $data['pagetitle'] = 'Halaman Rekap';
		$data['subtitle']  = 'Daftar Rekap';
		$data['icon']      = 'news-paper';
        $data['header']    = 'Table Rekap';
		
        // get data
        $join            = [[$this->tableKategori,'rekap_kategori_id = kategori_id','left']];
        $select          = 'rekap_id,rekap_judul,rekap_tahun,rekap_status,kategori_nama';
        $where           = ['rekap_tipe' => $get['tipe'], 'rekap_kategori_id' => $get['bidang']];
        $data['records'] = $this->m_global->get($this->table,$join,$where,$select,null,['rekap_lastupdate','DESC']);

        // get data kategori
        $data['kategori'] = $this->m_global->get($this->tableKategori,null,['kategori_status' => '1', 'kategori_id' => $get['bidang']],'kategori_id,kategori_nama')[0];
        
        $this->templates->backend($this->prefix.'index', $data);
    }

    function tambah(){
        $get = $this->input->get();
        $data['pagetitle'] = 'Halaman Form Rekap';
		$data['subtitle']  = 'Tambah data Rekap';
		$data['icon']      = 'news-paper';
        $data['bidang']    = $get['bidang'];
        $data['kategori']  = $this->m_global->get($this->tableKategori,null,['kategori_status' => '1', 'kategori_id' => $data['bidang']],'kategori_nama')[0];
        $data['header']    = 'Form Judul Rekapitulasi ' . $data['kategori']->kategori_nama;
        $data['url']       = $this->url . '?tipe=1&bidang=' . $data['bidang'];

        $this->templates->backend($this->prefix.'tambah', $data);
    }

    function simpan(){
        $post = $this->input->post();
        $data['rekap_kategori_id'] = $post['rekap_kategori_id'];
        $data['rekap_judul']       = $post['rekap_judul'];
        $data['rekap_tahun']       = $post['rekap_tahun'];
        $data['rekap_tipe']        = 1;
        $data['rekap_createdby']   = getSession('user_id');
        $data['rekap_createddate'] = date('Y-m-d H:i:s');
        $data['rekap_ip']          = getUserIp();
        $input                     = $this->m_global->insert($this->table, $data); 
        
        if($input){
            redirect('rekap_tambah?bidang=' . $post['rekap_kategori_id']);
        }else{
            pre('data gagal disimpan');
        }
    }

    function ubah($rekap_id){
        $data['pagetitle'] = 'Halaman Rekap';
		$data['subtitle']  = 'Edit data Rekap';
		$data['icon']      = 'news-paper';
        $data['header']    = 'Form Edit Judul Rekap';
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
        $data['rekap_tipe']        = 1;
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
		$data['icon']      = 'news-paper';
        $data['header']    = 'Detail Rekap';
        $data['rekap_id']  = $rekap_id;
        $data['url']       = $this->url;
		
		// get data rekap
		$joinRekap     = [ [$this->tableKategori,'rekap_kategori_id = kategori_id','left'] ];
		$selectRekap   = 'rekap_judul, kategori_id, kategori_nama, rekap_tahun';
        $data['rekap'] = $this->m_global->get($this->table,$joinRekap,[md56('rekap_id',1) => $rekap_id], $selectRekap )[0];
		
		// get data rekap detail
		$select = 'rekdet_id,rekdet_lembaga,rekdet_nominal,bantuan_nama,jnsbtn_nama,provinsi_nama,kabkot_nama,kecamatan_nama,keldes_nama,rekdet_luas,rekdet_tipe_bangunan';
		$join   = [
			[$this->tableBantuan,'rekdet_bantuan_kode = bantuan_kode','left'],
			[$this->tableJenisBantuan,'rekdet_jnsbtn_kode = jnsbtn_kode','left'],
			[$this->tableProvinsi,'rekdet_provinsi_kode = provinsi_kode', 'left'],
			[$this->tableKabkot,'(rekdet_kabkot_kode = kabkot_kode AND kabkot_provinsi_kode = provinsi_kode)','left'],
			[$this->tableKecamatan,'(rekdet_kecamatan_kode = kecamatan_kode AND kecamatan_provinsi_kode = provinsi_kode AND kecamatan_kabkot_kode = kabkot_kode)','left'],
			[$this->tableKeldes,'(rekdet_keldes_kode = keldes_kode AND keldes_provinsi_kode = provinsi_kode AND keldes_kabkot_kode = kabkot_kode AND keldes_kecamatan_kode = kecamatan_kode)','left']
		];
        $data['rkpDetail'] = $this->m_global->get($this->tableRekapDetail,$join,[md56('rekdet_rekap_id',1) => $rekap_id], $select, null, ['rekdet_lastupdate', 'DESC']);
		
		$this->templates->backend('rekap/rekap_detail',$data);
    }
    
    function detail_tambah($rekap_id,$kategori_id){
        $data['pagetitle'] = 'Halaman Rekap Detail';
		$data['subtitle']  = 'Tambah data Rekap Detail';
		$data['icon']      = 'news-paper';
        $data['header']    = 'Form Rekap Detail';
        $data['url']       = $this->url;
        $data['rekap_id']  = $rekap_id;
        $data['ktgrId']    = $kategori_id;

        // get data foreign
        $whereJnsbtn      = [
            'jnsbtn_status'              => '1', 
            md56('jnsbtn_kategori_id',1) => $kategori_id,
            'jnsbtn_tipe'                => '1'
        ];

        $data['step']     = $this->m_global->get($this->tableStep,null,['step_status' => '1'],'step_id,step_kode,step_nama');
        $data['bantuan']  = $this->m_global->get($this->tableBantuan,null,['bantuan_status' => '1', md56('bantuan_kategori_id',1) => $kategori_id],'bantuan_kode,bantuan_nama');
        $data['jnsbtn']   = $this->m_global->get($this->tableJenisBantuan,null,$whereJnsbtn,'jnsbtn_kode,jnsbtn_nama');
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
        $data['rekdet_kabkot_kode']    = $post['rekdet_kabkot_kode'];
        $data['rekdet_kecamatan_kode'] = $post['rekdet_kecamatan_kode'];
        $data['rekdet_keldes_kode']    = $post['rekdet_keldes_kode'];
        $data['rekdet_nominal']        = $post['rekdet_nominal'];
        $data['rekdet_luas']           = $post['rekdet_luas'];
        $data['rekdet_tipe_bangunan']  = $post['rekdet_tipe_bangunan'];
        $data['rekdet_createdby']      = getSession('user_id');
        $data['rekdet_createddate']    = date('Y-m-d H:i:s');
        
        $input  = $this->m_global->insert($this->tableRekapDetail, $data); 
        $lastId = $this->db->insert_id();
        $file   = $_FILES['rekdok_file']['name'];

        if(count($file) > 0){
            $config                  = array();
            $config['upload_path'] 	 = './assets/frontend/global/img/galeri';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            // $config['overwrite'] 	 = true;

            $this->load->library('upload');

            $files = $_FILES;
            for($i = 0; $i < count($file); $i++){
                $_FILES['rekdok_file']['name']     = $files['rekdok_file']['name'][$i];
                $_FILES['rekdok_file']['type']     = $files['rekdok_file']['type'][$i];
                $_FILES['rekdok_file']['tmp_name'] = $files['rekdok_file']['tmp_name'][$i];
                $_FILES['rekdok_file']['error']    = $files['rekdok_file']['error'][$i];
                $_FILES['rekdok_file']['size']     = $files['rekdok_file']['size'][$i];    

                $this->upload->initialize($config);
                $upload = $this->upload->do_upload('rekdok_file');

                $conRes['image_library']  = 'gd2';
                $conRes['source_image']	  = './assets/frontend/global/img/galeri/'.$this->upload->data()['file_name'];
                $conRes['create_thumb']	  = FALSE;
                $conRes['maintain_ratio'] = FALSE;
                $conRes['quality']		  = '50%';
                $conRes['width']		  = 800;
                $conRes['height']		  = 600;
                $conRes['new_image']	  = './assets/frontend/global/img/galeri/'.$this->upload->data()['file_name'];

                $this->load->library('image_lib', $conRes);
                $this->image_lib->initialize($conRes);
                $this->image_lib->resize();

                $dataGlr['rekdok_rekdet_id'] = $lastId;
                $dataGlr['rekdok_step_id']   = $post['rekdok_step_id'][$i];
                $dataGlr['rekdok_ringkasan'] = $post['rekdok_ringkasan'][$i];
                $dataGlr['rekdok_deskripsi'] = $post['rekdok_deskripsi'][$i];
                $dataGlr['rekdok_file']      = $conRes['new_image'];
                $dataGlr['rekdok_is_public'] = (empty($post['rekdok_is_public'][$i]) ? '0' : '1');

                $tempGaleri[] = $dataGlr;
            }
        }

        $this->db->insert_batch($this->tableDokumen, $tempGaleri);
        
        if($input){
            redirect('rekap_detail_tambah/'.md56($rekap_id).'/'.$kategori_id);
        }else{
            pre('data gagal disimpan');
        }
    }

    function detail_ubah($rekdet_id){
        $data['pagetitle'] = 'Halaman Rekap Detail';
		$data['subtitle']  = 'Tambah data Rekap Detail';
		$data['icon']      = 'news-paper';
        $data['header']    = 'Form Rekap Detail';
        $data['url']       = $this->url;
        $data['rekdet_id'] = $rekdet_id;

        $join              = [ 
            [$this->table,'rekdet_rekap_id = rekap_id','left'],
            [$this->tableBantuan,'rekdet_bantuan_kode = bantuan_kode','left'],
            [$this->tableJenisBantuan,'rekdet_jnsbtn_kode = jnsbtn_kode','left'],
            [$this->tableProvinsi,'rekdet_provinsi_kode = provinsi_kode','left'],
            [$this->tableKabkot,'rekdet_kabkot_kode = kabkot_kode AND kabkot_provinsi_kode = provinsi_kode','left'],
            [$this->tableKecamatan,'rekdet_kecamatan_kode = kecamatan_kode AND kecamatan_provinsi_kode = provinsi_kode AND kecamatan_kabkot_kode = kabkot_kode','left'],
            [$this->tableKeldes,'rekdet_keldes_kode = keldes_kode AND keldes_provinsi_kode = provinsi_kode AND keldes_kabkot_kode = kabkot_kode AND keldes_kecamatan_kode = kecamatan_kode','left']
        ];

        $select = 'rekdet_id,rekdet_rekap_id,rekdet_lembaga,rekdet_nominal,rekap_kategori_id,rekdet_bantuan_kode,rekdet_jnsbtn_kode,
                   rekdet_provinsi_kode,provinsi_nama,rekdet_kabkot_kode,kabkot_nama,rekdet_kecamatan_kode,kecamatan_nama,rekdet_keldes_kode,keldes_nama,rekdet_luas,rekdet_tipe_bangunan';
        $data['records'] = $this->m_global->get($this->tableRekapDetail,$join,[md56('rekdet_id',1) => $rekdet_id],$select)[0];

        // get data foreign
        $data['bantuan'] = $this->m_global->get($this->tableBantuan,null,['bantuan_status' => '1', 'bantuan_kategori_id' => $data['records']->rekap_kategori_id ],'bantuan_kode,bantuan_nama');
        $whereJnsbtn     = [
            'jnsbtn_status'      => '1', 
            'jnsbtn_kategori_id' => $data['records']->rekap_kategori_id,
            'jnsbtn_tipe'        => '1'
        ];
        $data['jnsbtn'] = $this->m_global->get($this->tableJenisBantuan,null,$whereJnsbtn,'jnsbtn_kode,jnsbtn_nama');
        $data['galeri'] = $this->m_global->get($this->tableDokumen,null,[md56('rekdok_rekdet_id',1) => $rekdet_id],'rekdok_id,rekdok_rekdet_id,rekdok_file,rekdok_ringkasan,rekdok_deskripsi,rekdok_is_public,rekdok_step_id');

        $this->templates->backend($this->prefix.'detail_ubah', $data);
    }

    function update_detail($rekdet_id){
        $post = $this->input->post();
        $file = $_FILES['rekdok_file']['name'];

        if(count($file) > 0){
            $config                  = array();
            $config['upload_path'] 	 = './assets/frontend/global/img/galeri';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->load->library('upload');

            $files = $_FILES;
            for($i = 0; $i < count($file); $i++){
                $_FILES['rekdok_file']['name']     = $files['rekdok_file']['name'][$i];
                $_FILES['rekdok_file']['type']     = $files['rekdok_file']['type'][$i];
                $_FILES['rekdok_file']['tmp_name'] = $files['rekdok_file']['tmp_name'][$i];
                $_FILES['rekdok_file']['error']    = $files['rekdok_file']['error'][$i];
                $_FILES['rekdok_file']['size']     = $files['rekdok_file']['size'][$i];

                if(empty($_FILES['rekdok_file']['name'])){
                    $dataGlr['rekdok_file']  = (empty($post['rekdok_file_old'][$i]) ? null : $post['rekdok_file_old'][$i]);
                }else{
                    $this->upload->initialize($config);
                    $upload = $this->upload->do_upload('rekdok_file');

                    $conRes['image_library']  = 'gd2';
                    $conRes['source_image']	  = './assets/frontend/global/img/galeri/'.$this->upload->data()['file_name'];
                    $conRes['create_thumb']	  = FALSE;
                    $conRes['maintain_ratio'] = FALSE;
                    $conRes['quality']		  = '50%';
                    $conRes['width']		  = 800;
                    $conRes['height']		  = 600;
                    $conRes['new_image']	  = './assets/frontend/global/img/galeri/'.$this->upload->data()['file_name'];

                    $this->load->library('image_lib', $conRes);
                    $this->image_lib->initialize($conRes);
                    $this->image_lib->resize();

                    $dataGlr['rekdok_file'] = $conRes['new_image'];

                    if(!empty($post['rekdok_file_old'][$i])){
                        unlink(FCPATH.$post['rekdok_file_old'][$i]);
                    }
                }

                $dataGlr['rekdok_step_id']   = $post['rekdok_step_id'][$i];
                $dataGlr['rekdok_ringkasan'] = $post['rekdok_ringkasan'][$i];
                $dataGlr['rekdok_deskripsi'] = $post['rekdok_deskripsi'][$i];
                $dataGlr['rekdok_is_public'] = (empty($post['rekdok_is_public'][$i]) ? '0' : '1');

                if(!empty($post['rekdok_file_old'][$i])){
                    $this->m_global->update($this->tableDokumen,$dataGlr,[ md56('rekdok_id',1) => $post['rekdok_id'][$i], md56('rekdok_rekdet_id',1) => $rekdet_id ]);
                }else{
                    $dataGlr['rekdok_rekdet_id'] = $post['rekdet_id'];
                    $this->m_global->insert($this->tableDokumen,$dataGlr);
                }
                
            }
        }

        $data['rekdet_lembaga']        = $post['rekdet_lembaga'];
        $data['rekdet_bantuan_kode']   = $post['rekdet_bantuan_id'];
        $data['rekdet_jnsbtn_kode']    = $post['rekdet_jnsbtn_id'];
        $data['rekdet_provinsi_kode']  = $post['rekdet_provinsi_id'];
        $data['rekdet_kabkot_kode']    = $post['rekdet_kabkot_kode'];
        $data['rekdet_kecamatan_kode'] = $post['rekdet_kecamatan_kode'];
        $data['rekdet_keldes_kode']    = $post['rekdet_keldes_kode'];
        $data['rekdet_nominal']        = $post['rekdet_nominal'];
        $data['rekdet_luas']           = $post['rekdet_luas'];
        $data['rekdet_tipe_bangunan']  = $post['rekdet_tipe_bangunan'];
        $data['rekdet_updatedby']      = getSession('user_id');
        
        $input = $this->m_global->update($this->tableRekapDetail, $data, [md56('rekdet_id',1) => $rekdet_id]); 
        
        if($input){
            redirect('rekap_detail_ubah/'.$rekdet_id);
        }else{
            pre('data gagal disimpan');
        }
    }

    function hapus_detail($rekap_id, $rekdet_id){

        $delRekdet     = $this->m_global->delete($this->tableRekapDetail,[md56('rekdet_id',1) => $rekdet_id]);
        $getDataRekDok = $this->m_global->get($this->tableDokumen,null,[md56('rekdok_rekdet_id',1) => $rekdet_id],'rekdok_file');

        foreach ($getDataRekDok as $doks) {
           unlink(FCPATH . $doks->rekdok_file);
        }
        
        $delRekDok = $this->m_global->delete($this->tableDokumen,[md56('rekdok_rekdet_id',1) => $rekdet_id]);
		
		if($delRekdet && $delRekDok){
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

    public function template()
    {
        $this->load->library('excel');
        $phpExcel   = new PHPExcel();
        
        $phpExcel->getActiveSheet()->getStyle('A4:I4')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'FFFFFF')
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                ),
                'bold'  => TRUE
            )
        );

        $phpExcel->getActiveSheet()->getStyle('E5:H5')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'FFFFFF')
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                ),
                'bold'  => TRUE
            )
        );

        $phpExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray(
            array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                )
            )
        );

        $phpExcel->getActiveSheet()->getStyle('A4:I4')->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );

        $phpExcel->getActiveSheet()->getStyle('A5:I5')->applyFromArray(
            array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('rgb' => '000000')
                    )
                )
            )
        );
        
        foreach(range('B','N') as $columnID) {
            $phpExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(19);
        }

        $phpExcel->getActiveSheet()->mergeCells('A1:I1');
        $phpExcel->getActiveSheet()->setCellValue('A1', 'judul_rekapitulasi');

        $phpExcel->getActiveSheet()->mergeCells('A4:A5');
        $phpExcel->getActiveSheet()->setCellValue('A4', 'No');

        $phpExcel->getActiveSheet()->mergeCells('B4:B5');
        $phpExcel->getActiveSheet()->setCellValue('B4', 'Nama Lembaga');

        $phpExcel->getActiveSheet()->mergeCells('C4:C5');
        $phpExcel->getActiveSheet()->setCellValue('C4', 'Jenis Bantuan');

        $phpExcel->getActiveSheet()->mergeCells('D4:D5');
        $phpExcel->getActiveSheet()->setCellValue('D4', 'Spesifikasi Bantuan');

        $phpExcel->getActiveSheet()->mergeCells('E4:H4');
        $phpExcel->getActiveSheet()->setCellValue('E4', 'Lokasi Bantuan');

        $phpExcel->getActiveSheet()->setCellValue('E5', 'Desa');
        $phpExcel->getActiveSheet()->setCellValue('F5', 'Kelurahan');
        $phpExcel->getActiveSheet()->setCellValue('G5', 'Kabupaten');
        $phpExcel->getActiveSheet()->setCellValue('H5', 'Provinsi');

        $phpExcel->getActiveSheet()->mergeCells('I4:I5');
        $phpExcel->getActiveSheet()->setCellValue('I4', 'Nilai Bantuan');

        $phpExcel->getActiveSheet()->setTitle('Tahun');

        $phpExcel->createSheet();
        $phpExcel->setActiveSheetIndex(0);
        // exit;
        $objWriter = PHPExcel_IOFactory::createWriter($phpExcel,'Excel2007');
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Template Import Data Rekapitulasi.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
    }

    function apus_galeri(){
        $post    = $this->input->post();
        unlink(FCPATH.$post['rekdok_file']);
        $apusGlr = $this->m_global->delete($this->tableDokumen,[md56('rekdok_id',1) => $post['rekdok_id']]);

        if($apusGlr){
            $data['status'] = '1';
        }else{
            $data['status'] = '0';
        }

        echo json_encode($data);
    }

}

/* End of file Controllername.php */

?>