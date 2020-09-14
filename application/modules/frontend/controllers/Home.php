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
        /*BEGIN GET DATA PETA MAP*/
        $selectjoinmap = '(
            SELECT
                rekdet_provinsi_kode,
                COUNT(rekdet_provinsi_kode) jumlah
            FROM sdp_rekap_detail 
            LEFT JOIN sdp_rekap ON rekap_id = rekdet_rekap_id AND rekap_tipe = "' . $data['type'] . '"
            WHERE rekdet_provinsi_kode IS NOT NULL AND rekap_tahun = "' . $data['tahun'] . '"
            GROUP BY rekdet_provinsi_kode
        ) temp';
        $joinmap    = [
            [$selectjoinmap, 'temp.rekdet_provinsi_kode = provinsi_kode', 'left'],
            ['sdp_master_kabkot', 'sdp_master_kabkot.kabkot_provinsi_kode = sdp_master_provinsi.provinsi_kode', 'left']
        ];
        $selectmap  = 'provinsi_kode, provinsi_nama, provinsi_latitude, provinsi_longtitude, temp.jumlah, sdp_master_kabkot.kabkot_kode, sdp_master_kabkot.kabkot_nama';
        $whereMap   = ['temp.jumlah IS NOT NULL' => NULL];

        if ($data['provinsi'] != '') {
            $whereMap['provinsi_kode'] = $data['provinsi'];
        }

        if ($data['kabupaten'] != '') {
            $whereMap['kabkot_kode'] = $data['kabupaten'];
        }

        $data['getmap']  = $this->m_global->get('sdp_master_provinsi', $joinmap, $whereMap, $selectmap, null, ['provinsi_nama', 'asc']);
        $data['getwil']  = $this->m_global->get('sdp_master_provinsi', $joinmap, NULL, $selectmap, null, ['provinsi_nama', 'asc']);

        // start get data map
        $result = array();
        foreach ($data['getmap'] as $element) {
            $result[$element->provinsi_kode]['provinsi_kode'] = $element->provinsi_kode;
            $result[$element->provinsi_kode]['provinsi_nama'] = $element->provinsi_nama;
            $result[$element->provinsi_kode]['provinsi_latitude'] = $element->provinsi_latitude;
            $result[$element->provinsi_kode]['provinsi_longtitude'] = $element->provinsi_longtitude;
            $result[$element->provinsi_kode]['jumlah'] = $element->jumlah;
            $result[$element->provinsi_kode]['kabupaten'][] = $element;
        }
        $data['records'] = array_values($result);
        $data['datamap'] = json_encode($data['records']);
        // end get data map

        // start get data wilayah
        foreach ($data['getwil'] as $element) {
            $result_wil[$element->provinsi_kode]['provinsi_kode'] = $element->provinsi_kode;
            $result_wil[$element->provinsi_kode]['provinsi_nama'] = $element->provinsi_nama;
            $result_wil[$element->provinsi_kode]['provinsi_latitude'] = $element->provinsi_latitude;
            $result_wil[$element->provinsi_kode]['provinsi_longtitude'] = $element->provinsi_longtitude;
            $result_wil[$element->provinsi_kode]['jumlah'] = $element->jumlah;
            $result_wil[$element->provinsi_kode]['kabupaten'][] = $element;
        }
        $data['provinsis'] = array_values($result_wil);
        $kabupaten_array = [];
        foreach ($data['provinsis'] as $provinsi) {
            foreach ($provinsi['kabupaten'] as $kabupaten) {
                if ($kabupaten->kabkot_kode != '' && $kabupaten->kabkot_nama != '') {
                    $kabupaten_array[] = (array)$kabupaten;
                }
            }
        }
        $data['kabupatens'] = $kabupaten_array;
        // end get data wilayah
        /*END GET DATA PETA MAP*/
        $this->templates->frontend('home/home_index', $data);
    }
}

/* End of file Controllername.php */
