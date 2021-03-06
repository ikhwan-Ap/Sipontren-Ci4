<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);


/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->resource('provinsi');
$routes->get('/', 'Login::index');
$routes->get('/login/admin', 'Login::admin');
$routes->get('/login/asatidz', 'Login::asatidz');
$routes->get('/login/santri', 'Login::santri');
$routes->get('/kelas/coba', 'Kelas::coba');
$routes->get('/register/Get_kabupaten/:(any)', 'Register::Get_kabupaten/$1');
$routes->get('/register/Get_kecamatan/:(any)', 'Register::Get_kecamatan/$1');
$routes->get('/register/Get_desa/:(any)', 'Register::Get_desa/$1');


// register
$routes->get('/register', 'Register::index');
$routes->post('/register', 'Register::create');
$routes->get('/register/santri', 'Register::santri', ['filter' => 'isRegister']);

// pendaftaran santri baru
$routes->delete('/pendaftaran/(:num)', 'Pendaftaran::delete/$1');

// dashboard admin / super admin
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'isLoggedIn']);
$routes->get('/dashboard/asatidz', 'Dashboard::asatidz', ['filter' => 'isLoggedIn']);
$routes->get('/dashboard/santri', 'Dashboard::santri', ['filter' => 'isSantri']);
$routes->get('/dashboard/coba', 'Santri::coba');

// admin
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/add', 'Admin::create');
$routes->post('/admin', 'Admin::save');
$routes->delete('/admin/(:num)', 'Admin::delete/$1');
$routes->get('/admin/edit/(:any)', 'Admin::edit/$1');
$routes->put('/admin/(:any)', 'Admin::update/$1');
$routes->get('/admin/detail/(:num)', 'Admin::detail/$1');

//Keamanan
$routes->get('/keamanan', 'Keamanan::index');
$routes->get('/keamanan/add', 'Keamanan::create');
$routes->post('/keamanan', 'Keamanan::save');
$routes->delete('/keamanan/(:num)', 'Keamanan::delete/$1');
$routes->get('/keamanan/edit/(:any)', 'Keamanan::edit/$1');
$routes->put('/keamanan/(:any)', 'Keamanan::update/$1');
$routes->get('/keamanan/detail/(:num)', 'Keamanan::detail/$1');

// pendaftaran baru
$routes->get('/pendaftaran', 'Pendaftaran::index');


// asatidz

$routes->get('/asatidz', 'Asatidz::index');
$routes->get('/asatidz/profil/(:num)', 'Asatidz::profil/$1');
$routes->get('/asatidz/layout', 'Asatidz::template');
$routes->delete('/asatidz/(:num)', 'Asatidz::delete/$1');
$routes->get('/asatidz/add', 'Asatidz::create');
$routes->post('/asatidz', 'Asatidz::save');
$routes->get('/asatidz/detail/(:num)', 'Asatidz::detail/$1');
$routes->get('/asatidz/edit/(:any)', 'Asatidz::edit/$1');
$routes->put('/asatidz/(:num)', 'Asatidz::update/$1');

// santri
$routes->get('/santri', 'Santri::index');
$routes->get('/santri/add', 'Santri::create');
$routes->post('/santri', 'Santri::save');
$routes->get('/santri/edit/(:any)', 'Santri::edit/$1');
$routes->put('/santri/(:num)', 'Santri::update/$1');
$routes->get('/santri/editnonaktif/(:any)', 'Santri::editnonaktif/$1');
$routes->put('/santri_non/(:num)', 'Santri::updatenonaktif/$1');
$routes->get('/santri/profil/(:num)', 'Santri::profil/$1', ['filter' => 'isSantri']);
$routes->get('/santri/biodata', 'Santri::biodata', ['filter' => 'isSantri']);
$routes->get('/santri/detail/(:num)', 'Santri::detail/$1');
$routes->delete('/santri/(:num)', 'Santri::delete/$1');
$routes->get('/konfirmasi', 'Santri::konfirmasi');
$routes->post('/konfirmasi/(:num)', 'Santri::save_Aktif/$1');
$routes->get('/konfirmasi_Baru', 'Santri::konfirmasi_Baru');
$routes->post('/konfirmasi_Baru/(:num)', 'Santri::save_Baru/$1');

// alumni
$routes->get('/alumni', 'Alumni::index');


// diniyah
$routes->get('/diniyah', 'Diniyah::index');
$routes->get('/diniyah/add', 'Diniyah::create');
$routes->post('/diniyah', 'Diniyah::save');
$routes->delete('/diniyah/(:num)', 'Diniyah::delete/$1');
$routes->get('/diniyah/edit/(:any)', 'Diniyah::edit/$1');
$routes->put('/diniyah/(:any)', 'Diniyah::update/$1');

// program
$routes->get('/program', 'Program::index');
$routes->get('/program/add', 'Program::create');
$routes->post('/program', 'Program::save');
$routes->delete('/program/(:num)', 'Program::delete/$1');
$routes->get('/program/edit/(:any)', 'Program::edit/$1');
$routes->put('/program/(:any)', 'Program::update/$1');

// kamar
$routes->get('/kamar', 'Kamar::index');
$routes->get('/kamar/add', 'Kamar::create');
$routes->post('/kamar', 'Kamar::save');
$routes->delete('/kamar/(:num)', 'Kamar::delete/$1');
$routes->get('/kamar/edit/(:any)', 'Kamar::edit/$1');
$routes->put('/kamar/(:any)', 'Kamar::update/$1');

// kelas
$routes->get('/kelas', 'Kelas::index');
$routes->get('/kelas/add', 'Kelas::create');
$routes->post('/kelas', 'Kelas::save');
$routes->delete('/kelas/(:num)', 'Kelas::delete/$1');
$routes->get('/kelas/edit/(:any)', 'Kelas::edit/$1');
$routes->put('/kelas/(:any)', 'Kelas::update/$1');

// gedung
$routes->get('/gedung', 'Gedung::index');
$routes->get('/gedung/add', 'Gedung::create');
$routes->post('/gedung', 'gedung::save');
$routes->delete('/gedung/(:num)', 'Gedung::delete/$1');
$routes->get('/gedung/edit/(:any)', 'Gedung::edit/$1');
$routes->put('/gedung/(:any)', 'Gedung::update/$1');

//Pembayaran
$routes->get('/pembayaran', 'Pembayaran::index');
$routes->get('/rutin', 'Pembayaran::rutin');
$routes->get('/pemasukan', 'Pembayaran::pemasukan');

//
$routes->get('/pembayaran/bayar_rutin/(:any)', 'Pembayaran::bayar_rutin/$1');
$routes->put('/rutin/(:num)', 'Pembayaran::bayar_rutin/$1');
//Filter Data
$routes->post('/pembayaran/filter', 'Pembayaran::filter');
$routes->post('/pembayaran/rutin', 'Pembayaran::filter_rutin');
$routes->post('/rutin', 'Pembayaran::filter_rutin');
$routes->post('/pemasukan/filter', 'Pemabayaran::filter_pemasukan');

$routes->post('/laporanmasuk/filter', 'Pembayaran::filter_laporanmasuk');
//laporan/print masuk dan keluar
$routes->get('/laporan/masuk', 'Pembayaran::laporan_masuk');
$routes->get('/laporan/keluar', 'Pembayaran::laporan_keluar');

//
$routes->get('/pemabayaran/edit/(:any)', 'Pembayaran::edit/$1');
$routes->put('/pembayaran/(:num)', 'Pembayaran::editdata/$1');
//

//

//

//
//
$routes->get('/pembayaran/rutin_add', 'Pembayaran::rutin_add');
$routes->post('/pembayaran/rutin_add', 'Pembayaran::save_lainnya');
$routes->get('/lain', 'Pembayaran::index');
$routes->get('/pembayaran/lain', 'Pembayaran::lain_add');
$routes->post('/pembayaran/lain', 'Pembayaran::save_lain');
$routes->get('/pembayaran/add', 'Pembayaran::add');
$routes->post('/pembayaran', 'Pembayaran::save');
$routes->get('/bayar/lain/(:any)', 'Pembayaran::bayar_lain/$1');
$routes->put('/lain/(:num)', 'Pembayaran::update_lain/$1');

//

$routes->delete('/pembayaran/(:num)', 'Pembayaran::delete/$1');
$routes->delete('/pembayaran/lainnya(:num)', 'Pembayaran::delete_lainnya/$1');

// perizinan
$routes->get('/perizinan', 'Perizinan::index');
$routes->get('/perizinan/keamanan', 'Perizinan::keamanan');
$routes->get('/pulang/(:num)', 'Perizinan::pulang/$1');
$routes->get('/perizinan/terlambat', 'Perizinan::index/$1');
$routes->put('/perizinan', 'Perizinan::keamanan/$1');
$routes->post('/perizinan', 'Perizinan::save');
$routes->post('/perizinan/terima/(:any)', 'Perizinan::terima/$1');
$routes->get('/perizinan/kembali/(:any)', 'Perizinan::kembali/$1');
$routes->get('/perizinan/ditolak/(:any)', 'Perizinan::ditolak/$1');
$routes->delete('/perizinan/(:num)', 'Perizinan::delete/$1');
$routes->put('/terlambat/(:num)', 'Perizinan::terlambat/$1');


// kurikulum
$routes->get('/kurikulum', 'Kurikulum::index');
$routes->get('/kurikulum/add', 'Kurikulum::create');
$routes->post('/kurikulum', 'Kurikulum::save');

//Laporan
$routes->get('/laporan/print', 'Pembayaran::print');
$routes->get('/laporan/print/(:any)', 'Pembayaran::print_filter');
$routes->get('/laporan/print_pengeluaran', 'Pembayaran::print_pengeluaran');
$routes->get('/laporan/print_pengeluaran/(:any)', 'Pembayaran::print_filterpengeluaran');

// Data Pengeluaran
$routes->get('/data_pengeluaran', 'Pengeluaran::pengeluaran_baru');
$routes->get('/data_pengeluaran/edit/(:any)', 'Pengeluaran::edit_pengeluaran/$1');
$routes->put('/data_pengeluaran/(:any)', 'Pengeluaran::update_pengeluaran/$1');
$routes->get('/pengeluaranbaru_add', 'Pengeluaran::pengeluaranbaru_add');
$routes->post('/data_pengeluaran', 'Pengeluaran::save_pengeluaranbaru');
$routes->delete('/data_pengeluaran(:num)', 'Pengeluaran::delete_pengeluaranbaru/$1');
// Pengeluaran
$routes->get('/pengeluaran', 'Pengeluaran::pengeluaran');
$routes->post('/pengeluaran/filter', 'Pengeluaran::filter_pengeluaran');
$routes->get('/pengeluaran_add', 'Pengeluaran::pengeluaran_add');
$routes->post('/pengeluaran', 'Pengeluaran::save_pengeluaran');
$routes->delete('pengeluaran/(:num)', 'Pengeluaran::delete_pengeluaran/$1');

//COBA_KELAS_TAGIHAN BEDA
$routes->get('/status_pembayaran', 'Status_pembayaran::index');
$routes->get('/status_pembayaran/filter', 'Status_pembayaran::filter');
$routes->post('/status_pembayaran', 'Status_pembayaran::hasil');
$routes->get('/spp/bayar/(:any)', 'Status_pembayaran::spp/$1');
$routes->put('/spp(:any)', 'Status_pembayaran::bayar_spp/$1');
$routes->get('/bayar/rutin/(:any)', 'Pembayaran::rutin/$1');
$routes->put('/rutin(:any)', 'Pembayaran::bayar_rutin/$1');
$routes->get('/bayar/laptop/(:any)', 'Pembayaran::laptop/$1');
$routes->put('/laptop(:any)', 'Pembayaran::bayar_laptop/$1');
$routes->post('/status_pembayaran/filter', 'Status_pembayaran::filter_spp');
$routes->post('/status_pembayaran/filter_tanggalspp', 'Status_pembayaran::filter_tanggalspp');
$routes->get('/spp/bayar_kekurangan/(:any)', 'Status_pembayaran::bayar_kekurangan/$1');
$routes->put('/status_pembayaran/(:num)', 'Status_pembayaran::update_kekurangan/$1');
$routes->get('/status_add', 'Status_pembayaran::khusus');
$routes->post('/status_add', 'Status_pembayaran::save_khusus');

//Pembayaran Pendaftaran
$routes->get('/pendaftaran/pendaftaran', 'Pendaftaran::pendaftaran');
$routes->get('/pendaftaran/pendaftaran_add', 'Pendaftaran::pendaftaran_add');
$routes->post('/pendaftaran', 'Pendaftaran::save_pendaftaran');
$routes->delete('/pendaftaran/pendaftaran(:num)', 'Pendaftaran::delete_pendaftaran/$1');
$routes->post('/pendaftaran/pendaftaran', 'Pendaftaran::filter_pendaftaran');

//TAGIHAN
$routes->get('/tagihan_kelas', 'Tagihan::index');
$routes->get('/tagihan/tagihan_spp', 'Tagihan::tagihan_spp');
$routes->post('/tagihan_kelas', 'Tagihan::save_spp');
$routes->get('/tagihan/tagihan_rutin', 'Tagihan::tagihan_rutin');
$routes->post('/tagihan_rutin', 'Tagihan::save_rutin');
$routes->get('/tagihan', 'Tagihan::tagihan');
$routes->get('/pembayaran/tagihan_add', 'Tagihan::tagihan_add');
$routes->post('/tagihan', 'Tagihan::save_tagihan');
$routes->delete('/pembayaran/tagihan(:num)', 'Tagihan::delete_tagihan/$1');
$routes->get('/tagihan/edit/(:any)', 'Tagihan::edit/$1');
$routes->put('/tagihan/(:any)', 'Tagihan::update/$1');
$routes->get('/tagihan_rutin/edit/(:any)', 'Tagihan::edit_rutin/$1');
$routes->put('/tagihan_rutin/(:any)', 'Tagihan::update_rutin/$1');
$routes->get('/tagihan_regsis/edit/(:any)', 'Tagihan::edit_regis/$1');
$routes->put('/tagihan_regis/(:any)', 'Tagihan::update_regis/$1');

//DAFTAR ULANG
$routes->get('/daftar_ulang', 'Daftar_ulang::index');
$routes->post('/daftar_ulang', 'Daftar_ulang::filter_daftar_ulang');
$routes->get('/daftar_ulang_add', 'Daftar_ulang::daftar_ulang_add');
$routes->post('/daftar_ulang_add', 'Daftar_ulang::save_daftar_ulang');
$routes->delete('/daftar_ulang(:num)', 'Daftar_ulang::delete_daftar/$1');

//Jadwal
$routes->get('/coba/kurikulum', 'Kurikulum::coba');
$routes->get('/download', 'Santri::download');
$routes->get('/download_xls', 'Santri::download_xls');
//Wilayah
$routes->resource('Wilayah');


// TRASH
$routes->get('/trash_baru', 'Trash::index');
$routes->post('/trash_baru/(:num)', 'Trash::restore_baru/$1');
$routes->get('/trash_asatidz', 'Trash::asatidz');
$routes->post('/trash_asatidz/(:num)', 'Trash::restore_asatidz/$1');
$routes->get('/trash_aktif', 'Trash::aktif');
$routes->post('/trash_aktif/(:num)', 'Trash::restore_aktif/$1');
$routes->post('/trash_asatidz/(:num)', 'Trash::restore_asatidz/$1');
$routes->get('/trash_nonAktif', 'Trash::nonAktif');
$routes->post('/trash_nonAktif/(:num)', 'Trash::restore_nonAktif/$1');
$routes->post('/trash_asatidz/(:num)', 'Trash::restore_asatidz/$1');
$routes->get('/trash_alumni', 'Trash::alumni');
$routes->post('/trash_alumni/(:num)', 'Trash::restore_alumni/$1');
$routes->delete('/trash_baru/(:num)', 'Trash::delete_baru/$1');
$routes->delete('/trash_aktif/(:num)', 'Trash::delete_aktif/$1');
$routes->delete('/trash_asatidz/(:num)', 'Trash::delete_asatidz/$1');
$routes->delete('/trash_nonAktif/(:num)', 'Trash::delete_nonAktif/$1');
$routes->delete('/trash_alumni/(:num)', 'Trash::delete_alumni/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
