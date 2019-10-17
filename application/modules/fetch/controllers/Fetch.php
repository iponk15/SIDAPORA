<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fetch extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    public function globalFetch($table, $fId, $fNama, $id = NULL ){
        if(is_null($id)){
            $key     = $_GET['key'];
            $getData = $this->m_global->get($table, NULL, [$fNama.' LIKE' => '%'.$key.'%']);

            $data = [];
            for ($i=0; $i < count($getData); $i++) {
                $data[$i] = ['id' => $getData[$i]->$fId, 'name' => $getData[$i]->$fNama];
            }

            echo json_encode(['item' => $data]);
        }else{

            $getData = $this->m_global->get($table, NULL, [$fId => $id]);
            $tmp      = [ ['id' => $id, 'name' => $getData[0]->$fNama] ];

            echo json_encode($tmp);
        }
    }
    
    public function getKabkotFromProvinsi($table,$provId, $id = NULL){
        if(is_null($id)){
            $key     = $_GET['key'];
            $getData = $this->m_global->get($table, NULL, ['kabkot_provinsi_id' => $provId, 'kabkot_nama LIKE' => '%'.$key.'%']);

            $data = [];
            for ($i=0; $i < count($getData); $i++) {
                $data[$i] = ['id' => $getData[$i]->kabkot_id, 'name' => $getData[$i]->kabkot_nama];
            }

            echo json_encode(['item' => $data]);
        }else{

            $getData = $this->m_global->get($table, NULL, ['kabkot_id' => $id]);
            $tmp      = [ ['id' => $id, 'name' => $getData[0]->kabkot_nama] ];

            echo json_encode($tmp);
        }
    }
}