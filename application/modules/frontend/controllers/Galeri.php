<?php defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Galeri extends MX_Controller {
        private $prefix      = 'galeri/galeri_';
        private $url         = 'galeri';
        private $tableRekap  = 'sdp_rekap';
        private $tableGaleri = 'sdp_rekap_dokumen';
        private $tableRekdet = 'sdp_rekap_detail';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function index(){
            $data['slider']     = 0;
            $data['breadcrumb'] = ['Home' => base_url('home'), 'Galeri' => base_url($this->url)];
            $data['tahun']      = $this->m_global->get($this->tableRekap,null,['rekap_status' => '1'],'rekap_tahun',null,null,null,null,'rekap_tahun');

            // get data galeri
            $join = [
                [$this->tableRekdet,'rekdok_rekdet_id = rekdet_id','left'],
                [$this->tableRekap,'rekdet_rekap_id = rekap_id']
            ];
            $data['galeri']     = $this->m_global->get($this->tableGaleri,$join,['rekdok_is_public' => '1'],'rekap_tahun,rekdok_deskripsi,rekdok_file,rekdok_ringkasan');
            $this->templates->frontend($this->prefix.'index', $data);
        }
    
    }

?>