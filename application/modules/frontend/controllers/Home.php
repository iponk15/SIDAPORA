<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $get  = $this->input->get();

        $data['tahun'] = $get['tahun'] ?? date('Y');
        $data['type']   = $get['type'] ?? 1;
        $data['provinsi']   = $this->m_global->get('sdp_master_provinsi', null, null, '*', null, ['provinsi_nama', 'asc']);
        $data['kabupaten']  = $this->m_global->get('sdp_master_kabkot', null, ['kabkot_provinsi_kode IS NOT NULL AND kabkot_kode IS NOT NULL' => NULL], '*', null, ['kabkot_nama', 'asc']);
        $data['kecamatan']  = $this->m_global->get('sdp_master_kecamatan', null, ['kecamatan_provinsi_kode IS NOT NULL AND kecamatan_kabkot_kode IS NOT NULL AND kecamatan_kode IS NOT NULL' => NULL], '*', null, ['kecamatan_nama', 'asc']);
        $data['slider']     = 1;
        $data['breadcrumb'] = null;
        $data['pagetitle']  = 'Beranda <br> Halaman Beranda';
        $join = [
            ['sdp_master_step', 'sdp_master_step.step_id = sdp_rekap_dokumen.rekdok_step_id', 'left']
        ];
        $where = [
            'rekdok_step_id IS NOT NULL' => NULL,
            'rekdok_is_public'  => '1'
        ];

        $select = 'rekdok_file,
                rekdok_ringkasan,
                rekdok_deskripsi,
                step_nama,
                step_deskripsi,
                step_order';
        $records    = $this->m_global->get('sdp_rekap_dokumen', $join, $where, $select, null, ['step_order', 'asc']);
        $data['records']        = $records;
        $data['slider_utama']   = array_rand($records, 3);
        foreach ($records as $value) {
            $result[$value->step_order][]  = $value;
        }

        // isi image harus 6 slider
        $config_jml_image = 6;
        foreach ($result as $key => $value) {
            $count = count($value);
            if ($count < $config_jml_image) {
                $selisih = $config_jml_image - $count;
                for ($i = 0; $i < $selisih; $i++) {
                    $result[$key][] = $result[$key][$i];
                }
            } else {
                $result[$key] = array_slice($value, 0, $config_jml_image);
            }
        }

        $data['result'] = array_values($result);

        $this->templates->frontend('home/home_index', $data);
    }

    public function load_grafik()
    {
        $post = $this->input->post();
        $data['tahun_from']  = $post['tahun_from'] ?? date('Y');
        $data['tahun_to']  = $post['tahun_to'] ?? date('Y');
        $data['provinsi']  = $post['provinsi'] ?? '';
        $data['kabupaten']  = $post['kabupaten'] ?? '';
        $data['kecamatan']  = $post['kecamatan'] ?? '';
        $select = 'rekap_tahun,
        SUM(CASE WHEN rekap_tipe = 1 THEN 1 ELSE 0 END) AS jml_prasarana,
        SUM(CASE WHEN rekap_tipe = 2 THEN 1 ELSE 0 END) AS jml_sarana ';
        $where['(rekap_tahun BETWEEN "' . $data['tahun_from'] . '" AND "' . $data['tahun_to'] . '")'] = NULL;

        if ($data['provinsi'] != '') {
            $where['provinsi_kode'] = $data['provinsi'];
        }

        if ($data['kabupaten'] != '') {
            $where['kabkot_kode'] = $data['kabupaten'];
        }

        if ($data['kecamatan'] != '') {
            $where['kecamatan_kode'] = $data['kecamatan'];
        }
        $groupby = 'rekap_tahun';
        $records    = $this->m_global->get('grafik_sarpras', null, $where, $select, null, null, 0, null, $groupby);

        $result = [];
        foreach ($records as $value) {
            $result['sarana'][] = [$value->rekap_tahun, $value->jml_sarana];
            $result['prasarana'][] = [$value->rekap_tahun, $value->jml_prasarana];
        }

        $data['result'] = json_encode($result);

        if (empty($result)) {
            $this->load->view('home/grafik_null', $data);
        } else {
            $this->load->view('home/grafik', $data);
        }
    }
}

/* End of file Controllername.php */
