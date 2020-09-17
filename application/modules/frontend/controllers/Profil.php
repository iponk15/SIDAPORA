<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['slider']     = 1;
        $data['breadcrumb'] = null;
        $data['pagetitle']  = 'Profil <br> Struktur Kemenpora';

        $this->templates->frontend('profil/profil_index', $data);
    }
}

/* End of file Controllername.php */
