<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sarana extends MX_Controller {
    private $url               = 'sarana';
    private $prefix            = 'sarana/sarana_';
    private $table             = 'sdp_rekap';
    private $prefix_table      = 'rekap_';
    private $tableKategori     = 'sdp_master_kategori';
	private $tablesaranaDetail = 'sdp_rekap_detail';
	private $tableBantuan      = 'sdp_master_bantuan';
	private $tableJenisBantuan = 'sdp_master_jenis_bantuan';
	private $tableProvinsi     = 'sdp_master_provinsi';
	private $tableKabkot       = 'sdp_master_kabkot';
	private $tableKecamatan    = 'sdp_master_kecamatan';
    private $tableKeldes       = 'sdp_master_keldes';
    private $tableDokumen      = 'sdp_rekap_dokumen';

    public function __construct(){
        parent::__construct();
        auth();
    }

    public function index(){
        $get = $this->input->get();
        $data['pagetitle'] = 'Halaman sarana';
		$data['subtitle']  = 'Daftar sarana';
		$data['icon']      = 'news-paper';
		$data['header']    = 'Table sarana';
		
        // get data
        $join            = [[$this->tableKategori,'rekap_kategori_id = kategori_id','left']];
        $select          = 'rekap_id,rekap_judul,rekap_tahun,rekap_status,kategori_nama';
        $where           = ['rekap_tipe' => '2', 'rekap_kategori_id' => $get['bidang']];
        $data['records'] = $this->m_global->get($this->table,$join,$where,$select,null,['rekap_lastupdate','DESC']);

        // get data kategori
        $data['kategori'] = $this->m_global->get($this->tableKategori,null,['kategori_status' => '1'],'kategori_id,kategori_nama');
        
        $this->templates->backend($this->prefix.'index', $data);
    }

    function tambah(){
        $data['pagetitle'] = 'Halaman Form sarana';
		$data['subtitle']  = 'Tambah data sarana';
		$data['icon']      = 'news-paper';
        $data['header']    = 'Form Judul saranaitulasi';
        $data['url']       = $this->url;

        // get data kategoro
        $data['kategori']  = $this->m_global->get($this->tableKategori,null,['kategori_status' => '1'],'kategori_id,kategori_nama');

        $this->templates->backend($this->prefix.'tambah', $data);
    }

    function simpan(){
        $post = $this->input->post();
        $data['rekap_kategori_id'] = $post['rekap_kategori_id'];
        $data['rekap_judul']       = $post['rekap_judul'];
        $data['rekap_tahun']       = $post['rekap_tahun'];
        $data['rekap_tipe']        = 2;
        $data['rekap_createdby']   = getSession('user_id');
        $data['rekap_createddate'] = date('Y-m-d H:i:s');
        $data['rekap_ip']          = getUserIp();
        
        $input = $this->m_global->insert($this->table, $data); 
        
        if($input){
            redirect('sarana_tambah');
        }else{
            pre('data gagal disimpan');
        }
    }

    function ubah($rekap_id){
        $data['pagetitle'] = 'Halaman sarana';
		$data['subtitle']  = 'Edit data sarana';
		$data['icon']      = 'news-paper';
        $data['header']    = 'Form Edit Judul sarana';
        $data['rekap_id']  = $rekap_id;
        $data['url']       = $this->url;
		
		// get data kategoro
        $data['kategori']  = $this->m_global->get($this->tableKategori,null,['kategori_status' => '1'],'kategori_id,kategori_nama');
		
        // get data janei bantuan
        $select            = 'rekap_judul,rekap_kategori_id,rekap_tahun,rekap_status';
		$data['records']   = $this->m_global->get($this->table,null,[md56('rekap_id',1) => $rekap_id],$select)[0];
		
		$this->templates->backend('sarana/sarana_ubah',$data);
    }

    function update($rekap_id){
        $post                      = $this->input->post();
		$data['rekap_kategori_id'] = $post['rekap_kategori_id'];
        $data['rekap_judul']       = $post['rekap_judul'];
        $data['rekap_tahun']       = $post['rekap_tahun'];
        $data['rekap_tipe']        = 2;
        $data['rekap_updatedby']   = getSession('user_id');
        $data['rekap_ip']          = getUserIp();
		
		$update = $this->m_global->update($this->table,$data,[md56('rekap_id',1) => $rekap_id]);
		
		if($update == TRUE){
			redirect('sarana_ubah/'.$rekap_id);
		}else{
			pre('data gagal disimpan');
		}
    }
    
    function hapus($rekap_id){
		$delete = $this->m_global->delete($this->table,[md56('rekap_id',1) => $rekap_id]);
		
		if($delete == TRUE){
			redirect('sarana');
		}else{
			pre('data gagal disimpan');
		}
    }
	
	function detail($rekap_id){
		$data['pagetitle'] = 'Halaman sarana Detail';
		$data['subtitle']  = 'Data sarana Detail';
		$data['icon']      = 'news-paper';
        $data['header']    = 'Detail sarana';
        $data['rekap_id']  = $rekap_id;
        $data['url']       = $this->url;
		
		// get data sarana
		$joinsarana     = [ [$this->tableKategori,'rekap_kategori_id = kategori_id','left'] ];
		$selectsarana   = 'rekap_judul, kategori_id, kategori_nama, rekap_tahun';
        $data['sarana'] = $this->m_global->get($this->table,$joinsarana,[md56('rekap_id',1) => $rekap_id], $selectsarana )[0];
		
		// get data sarana detail
		$select            = 'rekdet_id,rekdet_lembaga,rekdet_nominal,bantuan_nama,jnsbtn_nama,provinsi_nama,kabkot_nama,kecamatan_nama,keldes_nama,rekdet_jmlbarang,tmp.jml';
		$join              = [
			[$this->tableBantuan,'rekdet_bantuan_kode = bantuan_kode','left'],
			[$this->tableJenisBantuan,'rekdet_jnsbtn_kode = jnsbtn_kode','left'],
			[$this->tableProvinsi,'rekdet_provinsi_kode = provinsi_kode', 'left'],
			[$this->tableKabkot,'(rekdet_kabkot_kode = kabkot_kode AND kabkot_provinsi_kode = provinsi_kode)','left'],
			[$this->tableKecamatan,'(rekdet_kecamatan_kode = kecamatan_kode AND kecamatan_provinsi_kode = provinsi_kode AND kecamatan_kabkot_kode = kabkot_kode)','left'],
            [$this->tableKeldes,'(rekdet_keldes_kode = keldes_kode AND keldes_provinsi_kode = provinsi_kode AND keldes_kabkot_kode = kabkot_kode AND keldes_kecamatan_kode = kecamatan_kode)','left'],
            ['(SELECT count(*) AS jml,sarbor_rekdet_id FROM sdp_rekap_cabor GROUP BY sarbor_rekdet_id) AS tmp', 'rekdet_id = tmp.sarbor_rekdet_id', 'left' ]
		];
        $data['rkpDetail'] = $this->m_global->get($this->tablesaranaDetail,$join,[md56('rekdet_rekap_id',1) => $rekap_id], $select, null, ['rekdet_lastupdate', 'DESC']);
		
		$this->templates->backend('sarana/sarana_detail',$data);
    }
    
    function detail_tambah($rekap_id,$kategori_id){
        $data['pagetitle'] = 'Halaman sarana Detail';
		$data['subtitle']  = 'Tambah data sarana Detail';
		$data['icon']      = 'news-paper';
        $data['header']    = 'Form sarana Detail';
        $data['url']       = $this->url;
        $data['rekap_id']  = $rekap_id;
        $data['ktgrId']    = $kategori_id;

        // get data foreign
        $whereJnsbtn      = [
            'jnsbtn_status'              => '1', 
            md56('jnsbtn_kategori_id',1) => $kategori_id,
            'jnsbtn_tipe'                => '2'
        ];
        $data['jnsbtn']   = $this->m_global->get($this->tableJenisBantuan,null,$whereJnsbtn,'jnsbtn_kode,jnsbtn_nama');
        $data['provinsi'] = $this->m_global->get($this->tableProvinsi,null,['provinsi_status' => '1'],'provinsi_kode,provinsi_nama');

        $this->templates->backend($this->prefix.'detail_tambah', $data);
    }

    function simpan_detail($rekap_id, $kategori_id){
        $post = $this->input->post();

        // get data sarana
        $where[md56('rekap_id',1)]          = $rekap_id;
        $where[md56('rekap_kategori_id',1)] = $kategori_id;
        $rekap_id = $this->m_global->get($this->table,null,$where,'rekap_id')[0]->rekap_id;

        $data['rekdet_rekap_id']       = $rekap_id;
        $data['rekdet_lembaga']        = $post['rekdet_lembaga'];
        $data['rekdet_provinsi_kode']  = $post['rekdet_provinsi_id'];
        $data['rekdet_kabkot_kode']    = $post['rekdet_kabkot_kode'];
        $data['rekdet_kecamatan_kode'] = $post['rekdet_kecamatan_kode'];
        $data['rekdet_keldes_kode']    = $post['rekdet_keldes_kode'];
        $data['rekdet_createdby']      = getSession('user_id');
        $data['rekdet_createddate']    = date('Y-m-d H:i:s');
        
        $input  = $this->m_global->insert($this->tablesaranaDetail, $data); 
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
            redirect('sarana_detail_tambahitem/'.md56($lastId));
        }else{
            pre('data gagal disimpan');
        }
    }

    function detail_ubah($rekdet_id){
        $data['pagetitle'] = 'Halaman sarana Detail';
		$data['subtitle']  = 'Tambah data sarana Detail';
		$data['icon']      = 'news-paper';
        $data['header']    = 'Form sarana Detail';
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
        $select = 'rekdet_id,rekdet_rekap_id,rekdet_lembaga,rekdet_nominal,rekap_kategori_id,rekdet_bantuan_kode,rekdet_jnsbtn_kode,rekdet_provinsi_kode,rekdet_kabkot_kode,rekdet_kecamatan_kode,rekdet_keldes_kode,rekdet_jmlbarang,
			       provinsi_nama,kabkot_nama,kecamatan_nama,keldes_nama';
        $data['records'] = $this->m_global->get($this->tablesaranaDetail,$join,[md56('rekdet_id',1) => $rekdet_id],$select)[0];

        // get data foreign
        $whereJnsbtn       = [
            'jnsbtn_status'      => '1', 
            'jnsbtn_kategori_id' => $data['records']->rekap_kategori_id,
            'jnsbtn_tipe'        => '2'
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
        $data['rekdet_provinsi_kode']  = $post['rekdet_provinsi_id'];
        $data['rekdet_kabkot_kode']    = $post['rekdet_kabkot_kode'];
        $data['rekdet_kecamatan_kode'] = $post['rekdet_kecamatan_kode'];
        $data['rekdet_keldes_kode']    = $post['rekdet_keldes_kode'];
        $data['rekdet_updatedby']      = getSession('user_id');
        
        $input = $this->m_global->update($this->tablesaranaDetail, $data, [md56('rekdet_id',1) => $rekdet_id]); 
        
        if($input){
            redirect('sarana_detail_ubah/'.$rekdet_id);
        }else{
            pre('data gagal disimpan');
        }
    }

    function hapus_detail($rekap_id, $rekdet_id){

        $delRekdet     = $this->m_global->delete($this->tablesaranaDetail,[md56('rekdet_id',1) => $rekdet_id]);
        $getDataRekDok = $this->m_global->get($this->tableDokumen,null,[md56('rekdok_rekdet_id',1) => $rekdet_id],'rekdok_file');

        foreach ($getDataRekDok as $doks) {
           unlink(FCPATH . $doks->rekdok_file);
        }
        
        $delRekDok = $this->m_global->delete($this->tableDokumen,[md56('rekdok_rekdet_id',1) => $rekdet_id]);
		
		if($delRekdet && $delRekDok){
			redirect('sarana_detail/'.$rekap_id);
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
        $fileName = $_FILES['data_sarana']['name'];
        $tmpFile  = $_FILES['data_sarana']['tmp_name'];

        $objPHPExcel     = PHPExcel_IOFactory::load($tmpFile);
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        $sheet           = $objPHPExcel->getSheetNames();

        $p = 0;
        $x = 1;
        foreach ($sheet as $sheets) {
            $rowExcel      = $objPHPExcel->getSheet($p++);
            $highestRow    = $rowExcel->getHighestRow();
            $highestColumn = $rowExcel->getHighestColumn();
            
            $dtsarana['rekap_judul']       = $rowExcel->rangeToArray('A1')[0][0];
            $dtsarana['rekap_kategori_id'] = $post['data_kategori'];
            $dtsarana['rekap_tahun']       = $sheets;
            $dtsarana['rekap_createdby']   = getSession('user_id');
            $dtsarana['rekap_createddate'] = date('Y-m-d H:i:s');
            $dtsarana['rekap_ip']          = getUserIp();

            $savesarana = $this->m_global->insert($this->table, $dtsarana);
            $lastId    = $this->db->insert_id();
            
            for($row = 6; $row <= $highestRow; $row++){
                $rowData = $rowExcel->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

                $dtsaranaDetail['rekdet_rekap_id']       = $lastId;
                $dtsaranaDetail['rekdet_lembaga']        = $rowData[0][1];
                $dtsaranaDetail['rekdet_bantuan_kode']   = $rowData[0][3];
                $dtsaranaDetail['rekdet_jnsbtn_kode']    = $rowData[0][2];
                $dtsaranaDetail['rekdet_keldes_kode']    = $rowData[0][4];
                $dtsaranaDetail['rekdet_kecamatan_kode'] = $rowData[0][5];
                $dtsaranaDetail['rekdet_kabkot_kode']    = $rowData[0][6];
                $dtsaranaDetail['rekdet_provinsi_kode']  = $rowData[0][7];
                $dtsaranaDetail['rekdet_nominal']        = $rowData[0][8];

                $tempData[] = $dtsaranaDetail;
            }
        }

        $inssaranaDetail = $this->db->insert_batch($this->tablesaranaDetail, $tempData);

        if($inssaranaDetail){
            redirect('sarana');          
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
        $phpExcel->getActiveSheet()->setCellValue('A1', 'judul_saranaitulasi');

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
        header('Content-Disposition: attachment;filename="Template Import Data saranaitulasi.xlsx"');
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

    function tambah_item($rekdet_id){
        $data['pagetitle'] = 'Halaman sarana Detail';
		$data['subtitle']  = 'Tambah data sarana Detail';
		$data['icon']      = 'news-paper';
        $data['header']    = 'Form Cabor';
        $data['url']       = $this->url;
        $data['rekdet_id'] = $rekdet_id;

        $whereRecords      = [md56('rekdet_id',1) => $rekdet_id];
        $joinRecords       = [
            [$this->tableProvinsi,'rekdet_provinsi_kode = provinsi_kode', 'left'],
			[$this->tableKabkot,'(rekdet_kabkot_kode = kabkot_kode AND kabkot_provinsi_kode = provinsi_kode)','left'],
			[$this->tableKecamatan,'(rekdet_kecamatan_kode = kecamatan_kode AND kecamatan_provinsi_kode = provinsi_kode AND kecamatan_kabkot_kode = kabkot_kode)','left'],
			[$this->tableKeldes,'(rekdet_keldes_kode = keldes_kode AND keldes_provinsi_kode = provinsi_kode AND keldes_kabkot_kode = kabkot_kode AND keldes_kecamatan_kode = kecamatan_kode)','left']
        ];
        $data['records']   = $this->m_global->get('sdp_rekap_detail',$joinRecords,$whereRecords,'rekdet_lembaga,rekdet_rekap_id,provinsi_nama,kabkot_nama,kecamatan_nama,keldes_nama')[0];

        $joinCabor     = [ ['sdp_rekap_caboritem', 'sarbortem_sarbor_id = sarbor_id', 'left'] ];
        $selectCabor   = "sarbor_id,sarbor_cabor";
        $data['items'] = $this->m_global->get('sdp_rekap_cabor',$joinCabor,[md56('sarbor_rekdet_id',1) => $rekdet_id],$selectCabor,null,null,null,null,'sarbor_id');

        $this->templates->backend($this->prefix.'tambah_item', $data);
    }

    function simpan_item($rekdet_id){
        $post = $this->input->post();

        // get data sarana
        $where[md56('rekdet_id',1)] = $rekdet_id;
        $ID = $this->m_global->get('sdp_rekap_detail',null,$where,'rekdet_id')[0]->rekdet_id;

        $data['sarbor_rekdet_id']   = $ID;
        $data['sarbor_cabor']       = $post['sarbor_cabor'];
        $data['sarbor_createdby']   = getSession('user_id');
        $data['sarbor_createddate'] = date('Y-m-d H:i:s');
        $data['sarbor_ip']          = getUserIP();
        
        $input = $this->m_global->insert('sdp_rekap_cabor', $data); 
        $lastId = $this->db->insert_id();

        foreach ($post['sarbortem_item'] as $key => $value) {
            $cbrtem['sarbortem_sarbor_id'] = $lastId;
            $cbrtem['sarbortem_item']        = $value;
            $cbrtem['sarbortem_jml']         = $post['sarbortem_jml'][$key];
            $cbrtem['sarbortem_satuan']      = $post['sarbortem_satuan'][$key];
            $cbrtem['sarbortem_createddate'] = date('Y-m-d H:i:s');
            $cbrtem['sarbortem_createdby']   = getSession('user_id');
            $cbrtem['sarbortem_ip']          = getUserIP();

            $tmpCbrtem[] = $cbrtem;
        }

        $inputItem =  $this->db->insert_batch('sdp_rekap_caboritem',$tmpCbrtem);
        
        if($input && $inputItem){
            redirect('sarana_detail_tambahitem/'.$rekdet_id);
        }else{
            pre('data gagal disimpan');
        }
    }

    function hapus_item($sarbor_id){
        $where[md56('sarbor_id',1)] = $sarbor_id;
        $gatData    = $this->m_global->get('sdp_rekap_cabor',null,$where,'sarbor_id, sarbor_rekdet_id')[0];
        $delete     = $this->m_global->delete('sdp_rekap_cabor',[md56('sarbor_id',1) => $sarbor_id]);
        $deleteItem = $this->m_global->delete('sdp_rekap_caboritem',[md56('sarbortem_sarbor_id',1) => $gatData->sarbor_id]);
        
        if($delete == TRUE){
            redirect('sarana_detail_tambahitem/'.md56($gatData->sarbor_rekdet_id));
        }else{
            pre('data gagal disimpan');
        }
    }

}

/* End of file Controllername.php */

?>