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
        $data['provinsi']   = $get['provinsi'] ?? '';
        $data['kabupaten']  = $get['kabupaten'] ?? '';
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
}

/* End of file Controllername.php */
