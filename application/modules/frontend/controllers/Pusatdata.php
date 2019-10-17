<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pusatdata extends MX_Controller {
    private $prefix         = 'pusatdata/pusatdata_';
    private $url            = 'pusatdata';
    private $tableKategori  = 'sdp_master_kategori';
    private $tableRekdet    = 'sdp_rekap_detail';
    private $tableBantuan   = 'sdp_master_bantuan';
    private $tableJnsbtn    = 'sdp_master_jenis_bantuan';
    private $tableProvinsi  = 'sdp_master_provinsi';
    private $tableKabkot    = 'sdp_master_kabkot';
    private $tableKecamatan = 'sdp_master_kecamatan';
    private $tableKeldes    = 'sdp_master_keldes';

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $data['slider']     = 0;
        $data['breadcrumb'] = ['Home' => base_url('home'), 'Pusat Data' => base_url($this->url)];
        $this->templates->frontend($this->prefix.'index', $data);
    }

    function cariData(){
        $post  = $this->input->post();

        // get data rekap
        $selectJoin = '(
            SELECT
                kategori_id,
                kategori_nama,
                rekap_id,
                rekap_judul,
                rekap_tahun
            FROM sdp_master_kategori 
            LEFT JOIN sdp_rekap ON kategori_id = rekap_kategori_id
            WHERE kategori_status = "1" AND rekap_tahun = "'.$post['tahun'].'"
            GROUP BY kategori_id
        ) temp';
        $join       = [ [$selectJoin,'smk.kategori_id = temp.kategori_id','left'] ];
        $select     = 'smk.kategori_id,smk.kategori_nama,temp.rekap_id,temp.rekap_judul,temp.rekap_tahun';
        $rekap      = $this->m_global->get($this->tableKategori . ' smk',$join,null,$select);

        foreach ($rekap as $rows) {
            if(!empty($rows->rekap_id)){

                $join           = [
                    [$this->tableBantuan,'rekdet_bantuan_id = bantuan_id','left'],
                    [$this->tableJnsbtn,'rekdet_jnsbtn_id = jnsbtn_id','left'],
                    [$this->tableProvinsi,'rekdet_provinsi_id = provinsi_id','left'],
                    [$this->tableKabkot,'rekdet_kabkot_id = kabkot_id','left'],
                    [$this->tableKecamatan,'rekdet_kecamatan_id = kecamatan_id','left'],
                    [$this->tableKeldes,'rekdet_keldes_id = keldes_id','left'],
                ];

                $select                   = 'rekdet_lembaga,bantuan_nama,jnsbtn_nama,provinsi_nama,kabkot_nama,kecamatan_nama,keldes_nama,rekdet_nominal';
                $where['rekdet_rekap_id'] = $rows->rekap_id;

                if($post['provinsi'] != ''){
                    $where['provinsi_id'] = $post['provinsi'];
                }

                if($post['kabupaten'] != ''){
                    $where['kabkot_id']   = $post['kabupaten'];
                }

                $getRekapDetail = $this->m_global->get($this->tableRekdet,$join,$where,$select);
                $tempRekDet     = [];
                foreach ($getRekapDetail as $rekdet) {
                    $tempRekDet[] = [
                        'rekdet_lembaga'   => $rekdet->rekdet_lembaga,
                        'rekdet_bantuan'   => $rekdet->bantuan_nama,
                        'rekdet_jnsbtn'    => $rekdet->jnsbtn_nama,
                        'rekdet_provinsi'  => $rekdet->provinsi_nama,
                        'rekdet_kabkot'    => $rekdet->kabkot_nama,
                        'rekdet_kecamatan' => $rekdet->kecamatan_nama,
                        'rekdet_keldes'    => $rekdet->keldes_nama,
                        'rekdet_nominal'   => $rekdet->rekdet_nominal
                    ];
                }

                $tempRekap[] = [
                    'rekap_judul'    => $rows->rekap_judul,
                    'rekap_kategori' => $rows->kategori_nama,
                    'rekap_tahun'    => $rows->rekap_tahun,
                    'rekap_detail'   => $tempRekDet
                ];

            }
        }

        $data['tahun']   = $post['tahun'];
        $data['records'] = $tempRekap;
        $this->load->view($this->prefix.'detail', $data);
    }

}

/* End of file Controllername.php */
 ?>