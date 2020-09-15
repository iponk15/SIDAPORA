<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pusatdata extends MX_Controller
{
    private $prefix            = 'pusatdata/pusatdata_';
    private $url               = 'pusatdata';
    private $tableKategori     = 'sdp_master_kategori';
    private $tableRekdet       = 'sdp_rekap_detail';
    private $tableBantuan      = 'sdp_master_bantuan';
    private $tableJnsbtn       = 'sdp_master_jenis_bantuan';
    private $tableProvinsi     = 'sdp_master_provinsi';
    private $tableKabkot       = 'sdp_master_kabkot';
    private $tableKecamatan    = 'sdp_master_kecamatan';
    private $tableKeldes       = 'sdp_master_keldes';
    private $tableRekap        = 'sdp_rekap';
    private $tableRekapDetail  = 'sdp_rekap_detail';
    private $tableRekapDokumen = 'sdp_rekap_dokumen';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['slider']     = 0;
        $data['breadcrumb'] = ['Home' => base_url('home'), 'Pusat Data' => base_url($this->url)];

        $get  = $this->input->get();

        $data['tahun'] = $get['tahun'] ?? date('Y');
        $data['type']   = $get['type'] ?? 1;
        $data['provinsi']   = $get['provinsi'] ?? '';
        $data['kabupaten']  = $get['kabupaten'] ?? '';

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

        $this->templates->frontend($this->prefix . 'index', $data);
        // $this->templates->frontend($this->prefix.'map', $data);
    }

    function cariData($flag = null, $tahun = null, $provinsi = null, $kabupaten = null)
    {
        $post  = $this->input->post();
        /*BEGIN GET DATA PETA MAP*/
        $selectjoinmap = '(
            SELECT
                rekdet_provinsi_kode,
                COUNT(rekdet_provinsi_kode) jumlah
            FROM sdp_rekap_detail 
            LEFT JOIN sdp_rekap ON rekap_id = rekdet_rekap_id AND rekap_tipe = "' . $post['type'] . '"
            WHERE rekdet_provinsi_kode IS NOT NULL AND rekap_tahun = "' . (empty($tahun) ? $post['tahun'] : $tahun) . '"
            GROUP BY rekdet_provinsi_kode
        ) temp';
        $joinmap    = [[$selectjoinmap, 'temp.rekdet_provinsi_kode = provinsi_kode', 'left']];
        $selectmap  = 'provinsi_kode, provinsi_nama, provinsi_latitude, provinsi_longtitude, temp.jumlah';
        $whereMap   = ['temp.jumlah IS NOT NULL' => NULL];

        if (!empty($post['provinsi'])) {
            $whereMap['provinsi_kode'] = $post['provinsi'];
        }

        $data['getmap']  = $this->m_global->get('sdp_master_provinsi', $joinmap, $whereMap, $selectmap, null, ['provinsi_nama', 'asc']);
        $data['datamap'] = json_encode($data['getmap']);
        /*END GET DATA PETA MAP*/

        // get data rekap
        $selectJoin = '(
            SELECT
                kategori_id,
                kategori_nama,
                rekap_id,
                rekap_judul,
                rekap_tahun
            FROM sdp_master_kategori 
            LEFT JOIN sdp_rekap ON kategori_id = rekap_kategori_id AND rekap_tipe = "' . $post['type'] . '"
            WHERE kategori_status = "1" AND rekap_tahun = "' . (empty($tahun) ? $post['tahun'] : $tahun) . '"
            GROUP BY kategori_id
        ) temp';
        $join   = [[$selectJoin, 'smk.kategori_id = temp.kategori_id', 'left']];
        $select = 'smk.kategori_id,smk.kategori_nama,temp.rekap_id,temp.rekap_judul,temp.rekap_tahun';
        $rekap  = $this->m_global->get($this->tableKategori . ' smk', $join, null, $select);

        foreach ($rekap as $rows) {
            if (!empty($rows->rekap_id)) {

                $join           = [
                    [$this->tableBantuan, 'rekdet_bantuan_kode = bantuan_kode', 'left'],
                    [$this->tableJnsbtn, 'rekdet_jnsbtn_kode = jnsbtn_kode', 'left'],
                    [$this->tableProvinsi, 'rekdet_provinsi_kode = provinsi_kode', 'left'],
                    [$this->tableKabkot, '(rekdet_kabkot_kode = kabkot_kode AND kabkot_provinsi_kode = provinsi_kode)', 'left'],
                    [$this->tableKecamatan, '(rekdet_kecamatan_kode = kecamatan_kode AND kecamatan_provinsi_kode = provinsi_kode AND kecamatan_kabkot_kode = kabkot_kode)', 'left'],
                    [$this->tableKeldes, '(rekdet_keldes_kode = keldes_kode AND keldes_provinsi_kode = provinsi_kode AND keldes_kabkot_kode = kabkot_kode AND keldes_kecamatan_kode = kecamatan_kode)', 'left'],
                ];

                $select                   = 'rekdet_lembaga,bantuan_nama,jnsbtn_nama,provinsi_nama,kabkot_nama,kecamatan_nama,keldes_nama,rekdet_nominal';
                $where['rekdet_rekap_id'] = $rows->rekap_id;

                if (!empty($post['provinsi'])) {
                    $where['provinsi_kode'] = $post['provinsi'];
                }

                if (!empty($post['kabupaten'])) {
                    $where['kabkot_kode']   = $post['kabupaten'];
                }

                $getRekapDetail = $this->m_global->get($this->tableRekdet, $join, $where, $select);
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
                    'rekap_id'       => $rows->rekap_id,
                    'rekap_judul'    => $rows->rekap_judul,
                    'rekap_kategori' => $rows->kategori_nama,
                    'rekap_tahun'    => $rows->rekap_tahun,
                    'rekap_detail'   => $tempRekDet
                ];
            }
        }
        // pre($tempRekap, 1);
        if ($flag == '1') {
            $data['tahun']     = $post['tahun'];
            $data['type']      = $post['type'];
            $data['galeri']    = getGaleriPusdat($data['tahun']);
            $data['provinsi']  = $post['provinsi'];
            $data['kabupaten'] = $post['kabupaten'];

            // get data rekap dan rekap detail
            $data['records'] = (empty($tempRekap) ? null : $tempRekap);
            $this->load->view($this->prefix . 'detail', $data);
        } else if ($flag == '2') {
            $data['provinsi']  = $post['provinsi'];
            $data['type']      = $post['type'];
            $data['kabupaten'] = (empty($post['kabupaten']) ? null : $post['kabupaten']);
            $data['records']   = (empty($tempRekap) ? '' : $tempRekap);
            if ($data['type'] == 1) {
                //PRASARANA
                $this->load->view($this->prefix . 'list_data_rekap', $data);
            } else {
                //SARANA
                $this->load->view($this->prefix . 'list_data_rekap_sarana', $data);
            }
        } else {
            return $tempRekap;
        }
    }

    function export_pdf($tahun, $provinsi = null, $kabupaten = null)
    {
        $mpdf            = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A3-L']);
        $data['tahun']   = $tahun;
        $data['records'] = $this->cariData(0, $tahun, $provinsi, $kabupaten);
        $html            = $this->load->view($this->prefix . 'pdf', $data, true);
        $mpdf->WriteHTML($html);
        // $mpdf->Output(); // opens in browser
        $mpdf->Output('Laporan Rekapitulasi Tahun ' . $tahun . '.pdf', 'D');
    }

    function table($rekap_id = '', $type = '', $provinsi = '', $kabupaten = '')
    {
        if (@$_REQUEST['customActionType'] == 'group_action') {
            $aChk = [0, 1, 99];
            if (in_array(@$_REQUEST['customActionName'], $aChk)) {
                $this->change_status($_REQUEST['customActionName'], [strEncrypt('rekdet_id', true) . ' IN ' => "('" . implode("','", $_REQUEST['id']) . "')"]);
            }
        }

        $aCari = [
            'rekdet_lembaga' => 'rekdet_lembaga',
            'bantuan_nama'   => 'bantuan_nama',
            'jnsbtn_nama'    => 'jnsbtn_nama',
            'provinsi_nama'  => 'provinsi_nama',
            'kabkot_nama'    => 'kabkot_nama',
            'kecamatan_nama' => 'kecamatan_nama',
            'keldes_nama'    => 'keldes_nama',
            'rekdet_nominal' => 'rekdet_nominal'
        ];

        $join    = NULL;
        $where   = NULL;
        $where_e = NULL;

        if (@$_REQUEST['action'] == 'filter') {
            $where = [];
            foreach ($aCari as $key => $value) {
                if ($_REQUEST[$key] != '') {
                    if ($key == 'lastupdate') {
                        $tmp = explode(' - ', $_REQUEST[$key]);
                        $where_e['DATE(' . $this->db->escape_str(@$value) . ') BETWEEN '] = "'" . $this->db->escape_str(@$tmp[0]) . "' AND '" . $this->db->escape_str(@$tmp[1]) . "'";
                    } else {
                        $where[$value . ' LIKE '] = '%' . $_REQUEST[$key] . '%';
                    }
                }
            }
        }

        $keys   = array_keys($aCari);
        $order = ['rekdet_lastupdate', 'DESC'];
        // $order = [$aCari[$keys[($_REQUEST['order'][0]['column']-2)]], $_REQUEST['order'][0]['dir']];

        $join           = [
            [$this->tableBantuan, 'rekdet_bantuan_kode = bantuan_kode', 'left'],
            [$this->tableJnsbtn, 'rekdet_jnsbtn_kode = jnsbtn_kode', 'left'],
            [$this->tableProvinsi, 'rekdet_provinsi_kode = provinsi_kode', 'left'],
            [$this->tableKabkot, '(rekdet_kabkot_kode = kabkot_kode AND kabkot_provinsi_kode = provinsi_kode)', 'left'],
            [$this->tableKecamatan, '(rekdet_kecamatan_kode = kecamatan_kode AND kecamatan_provinsi_kode = provinsi_kode AND kecamatan_kabkot_kode = kabkot_kode)', 'left'],
            [$this->tableKeldes, '(rekdet_keldes_kode = keldes_kode AND keldes_provinsi_kode = provinsi_kode AND keldes_kabkot_kode = kabkot_kode AND keldes_kecamatan_kode = kecamatan_kode)', 'left'],
            [$this->tableRekap, 'rekdet_rekap_id = rekap_id', 'left'],
        ];

        $where[md56('rekdet_rekap_id', 1)] = $rekap_id;
        $where['rekap_tipe']    = $type;

        if ($provinsi != '') {
            $where['provinsi_kode'] = $provinsi;
        }

        if ($kabupaten != '') {
            $where['kabkot_kode']   = $kabupaten;
        }

        $iTotalRecords   = $this->m_global->count($this->tableRekdet, $join, $where);
        $iDisplayLength  = intval($_REQUEST['length']);
        $iDisplayLength  = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart   = intval($_REQUEST['start']);
        $sEcho           = intval($_REQUEST['draw']);
        $records         = array();
        $records["data"] = array();
        $end             = $iDisplayStart + $iDisplayLength;
        $end             = $end > $iTotalRecords ? $iTotalRecords : $end;

        $select = 'rekdet_id,rekdet_lembaga,bantuan_nama,jnsbtn_nama,provinsi_nama,kabkot_nama,kecamatan_nama,keldes_nama,rekdet_nominal';
        $result = $this->m_global->get($this->tableRekdet, $join, $where, $select, $where_e, $order, $iDisplayStart, $iDisplayLength);
        $i      = 1 + $iDisplayStart;
        // pre($this->db->last_query(), 1);
        foreach ($result as $rows) {
            if ($type == 1) {
                $records["data"][] = array(
                    $i++,
                    $rows->rekdet_lembaga,
                    $rows->bantuan_nama,
                    $rows->jnsbtn_nama,
                    $rows->keldes_nama,
                    $rows->kecamatan_nama,
                    $rows->kabkot_nama,
                    $rows->provinsi_nama,
                    uang($rows->rekdet_nominal),
                    '<a data-toggle="modal" href="#dokumentasi" data-id="' . md56($rows->rekdet_id) . '" class="btn btn-sm green listDokumentasi" title="Lihat Dokumentasi">
                        <i class="fa fa-file-image-o"> </i>
                    </a>'
                );
            } else {
                $records["data"][] = array(
                    $i++,
                    $rows->rekdet_lembaga,
                    $rows->keldes_nama,
                    $rows->kecamatan_nama,
                    $rows->kabkot_nama,
                    $rows->provinsi_nama,
                    uang($rows->rekdet_nominal),
                    '<a data-toggle="modal" href="#dokumentasi" data-id="' . md56($rows->rekdet_id) . '" class="btn btn-sm green listDokumentasi" title="Lihat Dokumentasi">
                        <i class="fa fa-file-image-o"> </i>
                    </a>'
                );
            }
        }

        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"]            = $sEcho;
        $records["recordsTotal"]    = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        echo json_encode($records);
    }

    function dokumentasi()
    {
        $post        = $this->input->post();
        $data['dok'] = $this->m_global->get($this->tableRekapDokumen, null, [md56('rekdok_rekdet_id', 1) => $post['rekdet_id']], 'rekdok_ringkasan,rekdok_file,rekdok_deskripsi');
        $this->load->view($this->prefix . 'dokumentasi', $data);
    }
}

/* End of file Controllername.php */
