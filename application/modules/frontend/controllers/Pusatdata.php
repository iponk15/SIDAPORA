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

    function cariData($tahun = null, $provinsi = null, $kabupaten = null){
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
            WHERE kategori_status = "1" AND rekap_tahun = "'.(empty($tahun) ? $post['tahun'] : $tahun).'"
            GROUP BY kategori_id
        ) temp';
        $join       = [ [$selectJoin,'smk.kategori_id = temp.kategori_id','left'] ];
        $select     = 'smk.kategori_id,smk.kategori_nama,temp.rekap_id,temp.rekap_judul,temp.rekap_tahun';
        $rekap      = $this->m_global->get($this->tableKategori . ' smk',$join,null,$select);

        foreach ($rekap as $rows) {
            if(!empty($rows->rekap_id)){

                $join           = [
                    [$this->tableBantuan,'rekdet_bantuan_kode = bantuan_kode','left'],
                    [$this->tableJnsbtn,'rekdet_jnsbtn_kode = jnsbtn_kode','left'],
                    [$this->tableProvinsi,'rekdet_provinsi_kode = provinsi_kode','left'],
                    [$this->tableKabkot,'rekdet_kabkot_kode = kabkot_kode','left'],
                    [$this->tableKecamatan,'rekdet_kecamatan_kode = kecamatan_kode','left'],
                    [$this->tableKeldes,'rekdet_keldes_kode = keldes_kode','left'],
                ];

                $select                   = 'rekdet_lembaga,bantuan_nama,jnsbtn_nama,provinsi_nama,kabkot_nama,kecamatan_nama,keldes_nama,rekdet_nominal';
                $where['rekdet_rekap_id'] = $rows->rekap_id;

                if(empty($tahun)){
                    if($post['provinsi'] != ''){
                        $where['provinsi_id'] = $post['provinsi'];
                    }

                    if($post['kabupaten'] != ''){
                        $where['kabkot_id']   = $post['kabupaten'];
                    }
                }else{
                    if($provinsi != ''){
                        $where['provinsi_id'] = $post['provinsi'];
                    }

                    if($kabupaten != ''){
                        $where['kabkot_id']   = $post['kabupaten'];
                    }
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

        if(empty($tahun)){
            $data['tahun']   = $post['tahun'];
            $data['records'] = ( empty($tempRekap) ? null : $tempRekap );
            $this->load->view($this->prefix.'detail', $data);
        }else{
            return ( empty($tempRekap) ? null : $tempRekap );
        }
    }

    function export_pdf($tahun, $provinsi = null, $kabupaten = null){
        $mpdf            = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A3-L']);
        $data['tahun']   = $tahun;
        $data['records'] = $this->cariData($tahun,$provinsi,$kabupaten);
        $html            = $this->load->view($this->prefix.'pdf',$data,true);
        $mpdf->WriteHTML($html);
        // $mpdf->Output(); // opens in browser
        $mpdf->Output('Laporan Rekapitulasi Tahun '.$tahun.'.pdf','D');
    }

}

/* End of file Controllername.php */
 ?>