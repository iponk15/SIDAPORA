<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sugges extends MX_Controller {
    public function __construct(){
        parent::__construct();
    }

    function getCabang(){
        $get     = $this->input->get();
        $where_e = 'cabang_nama LIKE "%' . $get['term'] . '%"';
        $records = $this->m_global->get('sdp_master_cabang',null,null,'*',$where_e); 
        $data    = [];

        foreach ($records as $value) {
            $data[] = ['id' => $value->cabang_id, 'value' => $value->cabang_nama];
        }

        echo json_encode($data);
    }
    
    function getKategori(){
        $get     = $this->input->get();
        $where_e = 'kategori_nama LIKE "%' . $get['term'] . '%"';
        $records = $this->m_global->get('sdp_master_kategori',null,null,'*',$where_e); 
        $data    = [];

        foreach ($records as $value) {
            $data[] = ['id' => $value->kategori_id, 'value' => $value->kategori_nama];
        }

        echo json_encode($data);
    }

    function getJenisBantuan(){
        $get     = $this->input->get();
        $where_e = 'jnsbtn_nama LIKE "%' . $get['term'] . '%"';
        $where   = ['jnsbtn_status' => '1','jnsbtn_tipe' => '1', md56('jnsbtn_kategori_id',1) => $get['bidang']];
        $records = $this->m_global->get('sdp_master_jenis_bantuan',null,$where,'jnsbtn_kode,jnsbtn_nama',$where_e); 
        $data    = [];

        foreach ($records as $value) {
            $data[] = ['id' => $value->jnsbtn_kode, 'value' => $value->jnsbtn_kode .' - '. $value->jnsbtn_nama];
        }

        echo json_encode($data);
    }

    function getProvinsi(){
        $get     = $this->input->get();
        $where_e = 'provinsi_nama LIKE "%' . $get['term'] . '%"';
        $records = $this->m_global->get('sdp_master_provinsi',null,null,'provinsi_kode,provinsi_nama',$where_e,['provinsi_nama', 'ASC']); 
        $data    = [];

        foreach ($records as $value) {
            $data[] = ['id' => $value->provinsi_kode, 'value' => $value->provinsi_nama . ' (' .$value->provinsi_kode . ')'];
        }

        echo json_encode($data);
    }

    function getKabkot(){
        $get     = $this->input->get();
        $where   = ['kabkot_provinsi_kode' => $get['provinsi']];
        $where_e = 'kabkot_nama LIKE "%' . $get['term'] . '%"';
        $records = $this->m_global->get('sdp_master_kabkot',null,$where,'kabkot_kode,kabkot_nama',$where_e); 
        $data    = [];

        foreach ($records as $value) {
            $data[] = ['id' => $value->kabkot_kode, 'value' => $value->kabkot_nama . ' (' .$value->kabkot_kode . ')'];
        }

        echo json_encode($data);
    }

    function sugges_getKecamatan(){
        $get     = $this->input->get();
        $where   = ['kecamatan_provinsi_kode' => $get['provinsi'], 'kecamatan_kabkot_kode' => $get['kabkot']];
        $where_e = 'kecamatan_nama LIKE "%' . $get['term'] . '%"';
        $records = $this->m_global->get('sdp_master_kecamatan',null,$where,'kecamatan_kode,kecamatan_nama',$where_e);
        $data    = [];

        foreach ($records as $value) {
            $data[] = ['id' => $value->kecamatan_kode, 'value' => $value->kecamatan_nama . ' (' .$value->kecamatan_kode . ')'];
        }

        echo json_encode($data);
    }

    function sugges_getKeldes(){
        $get     = $this->input->get();
        $where   = ['keldes_provinsi_kode' => $get['provinsi'], 'keldes_kabkot_kode' => $get['kabkot'], 'keldes_kecamatan_kode' => $get['kecamatan']];
        $where_e = 'keldes_nama LIKE "%' . $get['term'] . '%"';
        $records = $this->m_global->get('sdp_master_keldes',null,$where,'keldes_kode,keldes_nama',$where_e);
        $data    = [];

        foreach ($records as $value) {
            $data[] = ['id' => $value->keldes_kode, 'value' => $value->keldes_nama . ' (' .$value->keldes_kode . ')'];
        }

        echo json_encode($data);
    }
}

/* End of file Controllername.php */


?>