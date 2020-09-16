<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// =============================================== Start routing frontend ========================================
$route['default_controller']   = 'frontend/home';
$route['404_override']         = 'Page_error';
$route['translate_uri_dashes'] = FALSE;

// Start Frontend
$route['home'] = 'frontend/home';
$route['load_grafik'] = 'frontend/home/load_grafik';

$route['pusatdata']                            = 'frontend/pusatdata';
$route['pusatdata_cari/(:any)']                = 'frontend/pusatdata/cariData/$1';
$route['pusatdata_pdf/(:any)']                 = 'frontend/pusatdata/export_pdf/$1';
$route['pusatdata_pdf/(:any)/(:any)']          = 'frontend/pusatdata/export_pdf/$1/$2';
$route['pusatdata_pdf/(:any)/(:any)/(:any)']   = 'frontend/pusatdata/export_pdf/$1/$2/$3';
$route['pusatdata_table/(:any)']               = 'frontend/pusatdata/table/$1';
$route['pusatdata_table/(:any)/(:any)']        = 'frontend/pusatdata/table/$1/$2';
$route['pusatdata_table/(:any)/(:any)/(:any)'] = 'frontend/pusatdata/table/$1/$2/$3';
$route['pusatdata_table/(:any)/(:any)/(:any)/(:any)'] = 'frontend/pusatdata/table/$1/$2/$3/$4';
$route['pusatdata_dokumentasi']                = 'frontend/pusatdata/dokumentasi';


$route['galeri'] = 'frontend/galeri';
$route['faq']    = 'frontend/faq';
// =============================================== Start routing frontend ========================================



// =============================================== Start Routing Backend ========================================= 

// Start Backend
$route['landing']     = 'backend/landing';
$route['login']       = 'backend/login';
$route['login/masuk'] = 'backend/login/masuk';
$route['login/out']   = 'backend/login/keluar';

// start user
$route['user']               = 'backend/user';
$route['user_tambah']        = 'backend/user/tambah';
$route['user_simpan']        = 'backend/user/simpan';
$route['user_ubah/(:any)']   = 'backend/user/ubah/$1';
$route['user_update/(:any)'] = 'backend/user/update/$1';
$route['user_hapus/(:any)']  = 'backend/user/hapus/$1';
// end user

// start kategori
$route['kategori']               = 'backend/kategori';
$route['kategori_tambah']        = 'backend/kategori/tambah';
$route['kategori_simpan']        = 'backend/kategori/simpan';
$route['kategori_ubah/(:any)']   = 'backend/kategori/ubah/$1';
$route['kategori_update/(:any)'] = 'backend/kategori/update/$1';
$route['kategori_hapus/(:any)']  = 'backend/kategori/hapus/$1';
// end kategori

// start jenis bantuan
$route['jenis_bantuan']               = 'backend/jenis_bantuan';
$route['jenis_bantuan_tambah']        = 'backend/jenis_bantuan/tambah';
$route['jenis_bantuan_simpan']        = 'backend/jenis_bantuan/simpan';
$route['jenis_bantuan_ubah/(:any)']   = 'backend/jenis_bantuan/ubah/$1';
$route['jenis_bantuan_update/(:any)'] = 'backend/jenis_bantuan/update/$1';
$route['jenis_bantuan_hapus/(:any)']  = 'backend/jenis_bantuan/hapus/$1';
$route['jenis_bantuan_bantuan']       = 'backend/jenis_bantuan/getBantuan';
// end jenis bantuan

// start bantuan
$route['bantuan']               = 'backend/bantuan';
$route['bantuan_tambah']        = 'backend/bantuan/tambah';
$route['bantuan_simpan']        = 'backend/bantuan/simpan';
$route['bantuan_ubah/(:any)']   = 'backend/bantuan/ubah/$1';
$route['bantuan_update/(:any)'] = 'backend/bantuan/update/$1';
$route['bantuan_hapus/(:any)']  = 'backend/bantuan/hapus/$1';
// end bantuan

// start provinsi
$route['provinsi']               = 'backend/provinsi';
$route['provinsi_tambah']        = 'backend/provinsi/tambah';
$route['provinsi_simpan']        = 'backend/provinsi/simpan';
$route['provinsi_ubah/(:any)']   = 'backend/provinsi/ubah/$1';
$route['provinsi_update/(:any)'] = 'backend/provinsi/update/$1';
$route['provinsi_hapus/(:any)']  = 'backend/provinsi/hapus/$1';
// end provinsi

// start kabupaten / kota
$route['kabkot']               = 'backend/kabkot';
$route['kabkot_tambah']        = 'backend/kabkot/tambah';
$route['kabkot_simpan']        = 'backend/kabkot/simpan';
$route['kabkot_ubah/(:any)']   = 'backend/kabkot/ubah/$1';
$route['kabkot_update/(:any)'] = 'backend/kabkot/update/$1';
$route['kabkot_hapus/(:any)']  = 'backend/kabkot/hapus/$1';
// end kabupaten / kota

// start kecamatan
$route['kecamatan']               = 'backend/kecamatan';
$route['kecamatan_tambah']        = 'backend/kecamatan/tambah';
$route['kecamatan_simpan']        = 'backend/kecamatan/simpan';
$route['kecamatan_ubah/(:any)']   = 'backend/kecamatan/ubah/$1';
$route['kecamatan_update/(:any)'] = 'backend/kecamatan/update/$1';
$route['kecamatan_hapus/(:any)']  = 'backend/kecamatan/hapus/$1';
$route['kecamatan_get_kabkot']    = 'backend/kecamatan/getKabkot';
// end kecamatan

// start keldes
$route['keldes']               = 'backend/keldes';
$route['keldes_tambah']        = 'backend/keldes/tambah';
$route['keldes_simpan']        = 'backend/keldes/simpan';
$route['keldes_ubah/(:any)']   = 'backend/keldes/ubah/$1';
$route['keldes_update/(:any)'] = 'backend/keldes/update/$1';
$route['keldes_hapus/(:any)']  = 'backend/keldes/hapus/$1';
$route['keldes_get_kecamatan'] = 'backend/keldes/getKecamatan';
// end keldes

// start rekap
$route['rekap']                             = 'backend/rekap';
$route['rekap_tambah']                      = 'backend/rekap/tambah';
$route['rekap_simpan']                      = 'backend/rekap/simpan';
$route['rekap_ubah/(:any)']                 = 'backend/rekap/ubah/$1';
$route['rekap_update/(:any)']               = 'backend/rekap/update/$1';
$route['rekap_hapus/(:any)']                = 'backend/rekap/hapus/$1';
$route['rekap_detail/(:any)']               = 'backend/rekap/detail/$1';
$route['rekap_detail_tambah/(:any)/(:any)'] = 'backend/rekap/detail_tambah/$1/$2';
$route['rekap_detail_ubah/(:any)']          = 'backend/rekap/detail_ubah/$1';
$route['rekap_get_kelurahan']               = 'backend/rekap/getKelurahan';
$route['rekap_detail_simpan/(:any)/(:any)'] = 'backend/rekap/simpan_detail/$1/$2';
$route['rekap_detail_update/(:any)']        = 'backend/rekap/update_detail/$1';
$route['rekap_detail_hapus/(:any)/(:any)']  = 'backend/rekap/hapus_detail/$1/$2';
$route['rekap_import']                      = 'backend/rekap/importData';
$route['rekap_template']                    = 'backend/rekap/template';
$route['A']                                 = 'backend/rekap/apus_galeri';
// end rekap

// start sarana
$route['sarana']                             = 'backend/sarana';
$route['sarana_tambah']                      = 'backend/sarana/tambah';
$route['sarana_simpan']                      = 'backend/sarana/simpan';
$route['sarana_ubah/(:any)']                 = 'backend/sarana/ubah/$1';
$route['sarana_update/(:any)']               = 'backend/sarana/update/$1';
$route['sarana_hapus/(:any)']                = 'backend/sarana/hapus/$1';
$route['sarana_detail/(:any)']               = 'backend/sarana/detail/$1';
$route['sarana_detail_tambah/(:any)/(:any)'] = 'backend/sarana/detail_tambah/$1/$2';
$route['sarana_detail_ubah/(:any)']          = 'backend/sarana/detail_ubah/$1';
$route['sarana_get_kelurahan']               = 'backend/sarana/getKelurahan';
$route['sarana_detail_simpan/(:any)/(:any)'] = 'backend/sarana/simpan_detail/$1/$2';
$route['sarana_detail_update/(:any)']        = 'backend/sarana/update_detail/$1';
$route['sarana_detail_hapus/(:any)/(:any)']  = 'backend/sarana/hapus_detail/$1/$2';
$route['sarana_import']                      = 'backend/sarana/importData';
$route['sarana_template']                    = 'backend/sarana/template';
$route['A']                                  = 'backend/sarana/apus_galeri';
// end rekap

// start step
$route['step']               = 'backend/step';
$route['step_tambah']        = 'backend/step/tambah';
$route['step_simpan']        = 'backend/step/simpan';
$route['step_ubah/(:any)']   = 'backend/step/ubah/$1';
$route['step_update/(:any)'] = 'backend/step/update/$1';
$route['step_hapus/(:any)']  = 'backend/step/hapus/$1';
$route['step_get_kecamatan'] = 'backend/step/getKecamatan';
// end step

// =============================================== End Routing Backend ======================================= 
