<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KeuanganModel;
use App\Models\TagihanModel;
use App\Models\SantriModel;
use App\Models\PengeluaranModel;
use App\Models\Data_pengeluaran;
use App\Models\KelasModel;
use TCPDF;


class Pembayaran extends BaseController
{
    public function __construct()
    {
        $this->model = new KeuanganModel();
        $this->tagihan = new TagihanModel();
        $this->santri = new SantriModel();
        $this->pengeluaran = new PengeluaranModel();
        $this->data = new Data_pengeluaran();
        $this->kelas = new KelasModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pembayaran Lain',
            'hasil' => $this->model->keuangan_lain(),
            'santri' => $this->santri->findAll(),
        ];
        return view('pembayaran/index', $data);
    }

    public function filter_lainnya()
    {
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_selesai = $this->request->getVar('tgl_selesai');
        $status = $this->request->getVar('status');
        $hasil = array();
        if ($tgl_mulai != null && $tgl_selesai != null && $status == 'Lunas') {

            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'status' => $status
            ];
            $keuangan = $this->model->status_lain($tanggal);
            if ($keuangan != null) {
                foreach ($keuangan as $uang) {
                    $id_keuangan = $uang['id_keuangan'];
                    $nama_lengkap = $uang['nama_lengkap'];
                    $id_santri = $uang['id_santri'];
                    $nis = $uang['nis'];
                    $waktu = $uang['waktu'];
                    $jumlah_bayar = $uang['jumlah_bayar'];
                    $nama_pembayaran = $uang['nama_pembayaran'];
                    $periode = $uang['periode'];
                    $jumlah_tagihan = $uang['jumlah_tagihan'];
                    if ($jumlah_bayar >= $jumlah_tagihan) {
                        $status = 'Lunas';
                        $hasil[] = [
                            'periode' => $periode,
                            'id_keuangan' => $id_keuangan,
                            'nama_lengkap' => $nama_lengkap,
                            'id_santri' => $id_santri,
                            'nis' => $nis,
                            'waktu' => $waktu,
                            'periode' => $periode,
                            'jumlah_bayar' => $jumlah_bayar,
                            'nama_pembayaran' => $nama_pembayaran,
                            'jumlah_tagihan' => $jumlah_tagihan,
                            'status' => $status
                        ];

                        $data = [
                            'title' => 'Pembayaran Lain',
                            'hasil' => $hasil,
                        ];
                    } else {
                        $status = 'Belum Lunas';
                        $data = [
                            'title' => 'Pembayaran Lain',
                            'hasil' => $this->model->salah(),
                        ];
                    }
                }
            } else {
                $data = [
                    'title' => 'Pembayaran Lain',
                    'hasil' => $this->model->salah(),
                ];
            }
            $hasil = array();
        } elseif ($tgl_mulai != null && $tgl_selesai != null && $status == 'Belum Lunas') {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'status' => $status
            ];
            $keuangan = $this->model->status_lainBelum($tanggal);
            if ($keuangan != null) {
                foreach ($keuangan as $uang) {
                    $id_keuangan = $uang['id_keuangan'];
                    $nama_lengkap = $uang['nama_lengkap'];
                    $periode = $uang['periode'];
                    $nama_pembayaran = $uang['nama_pembayaran'];
                    $id_santri = $uang['id_santri'];
                    $nis = $uang['nis'];
                    $waktu = $uang['waktu'];
                    $jumlah_bayar = $uang['jumlah_bayar'];
                    $jumlah_tagihan = $uang['jumlah_tagihan'];
                    if ($jumlah_tagihan == $jumlah_bayar) {
                        $status = 'Lunas';
                        $data = [
                            'title' => 'Pembayaran Lain',
                            'hasil' => $this->model->salah(),
                        ];
                    } else {
                        $status = 'Belum Lunas';
                        $hasil[] = [
                            'id_keuangan' => $id_keuangan,
                            'nama_lengkap' => $nama_lengkap,
                            'id_santri' => $id_santri,
                            'nis' => $nis,
                            'waktu' => $waktu,
                            'nama_pembayaran' => $nama_pembayaran,
                            'jumlah_bayar' => $jumlah_bayar,
                            'jumlah_tagihan' => $jumlah_tagihan,
                            'status' => $status,
                            'periode' => $periode
                        ];
                    }
                    $data = [
                        'title' => 'Pembayaran Lain',
                        'hasil' => $hasil
                    ];
                }
            } else {
                $data = [
                    'title' => 'Pembayaran Lain',
                    'hasil' => $this->model->salah(),
                ];
            }
        } else {
            $data = [
                'title' => 'Pembayaran Lain',
                'hasil' => $this->model->keuangan_lain(),
            ];
        }

        return view('pembayaran/index', $data);
    }


    public function rutin()
    {
        $data = [
            'title' => 'Pembayaran Rutin',
            'hasil' => $this->model->getLainnya(),
            'tagihan' => $this->tagihan->getLainnya(),
        ];
        return view('pembayaran/rutin', $data);
    }

    public function filter_rutin()
    {
        $bulan = $this->request->getVar('bulan');
        $id_tagihan = $this->request->getVar('id_tagihan');
        $tagihan = $this->tagihan->tagihan_rutin($id_tagihan);
        $hasil = array();
        if ($bulan != null && $id_tagihan != null) {
            if ($tagihan != null) {
                foreach ($tagihan as $tagih) {
                    $id_santri = $tagih['id_santri'];
                    $id_keuangan = $tagih['id_keuangan'];
                    $id_tagihan = $tagih['id_tagihan'];
                    $nis = $tagih['nis'];
                    $nama_lengkap = $tagih['nama_lengkap'];
                    $jumlah_tagihan = $tagih['jumlah_pembayaran'];
                    $nama_pembayaran = $tagih['nama_pembayaran'];
                    $pembayaran = $this->model->filter_rutin($id_santri, $bulan, $id_tagihan);
                    if ($jumlah_tagihan == $pembayaran[0]['jumlah_bayar']) {
                        $status = 'Lunas';
                        $pembayaran[0]['jumlah_bayar'];
                    } else {
                        $status = 'Belum Lunas';
                        $pembayaran[0]['jumlah_bayar'];
                    }
                    $hasil[] = [
                        'id_santri' => $id_santri,
                        'nama_lengkap' => $nama_lengkap,
                        'nis' => $nis,
                        'id_keuangan' => $id_keuangan,
                        'jumlah_tagihan' => $jumlah_tagihan,
                        'id_tagihan' => $id_tagihan,
                        'jumlah_bayar' => $pembayaran[0]['jumlah_bayar'],
                        'nama_pembayaran' => $nama_pembayaran,
                        'status' => $status,
                        'waktu' => $bulan,
                    ];
                }
                $data = [
                    'title' => 'Pembayaran Rutin',
                    'hasil' => $hasil,
                    'tagihan' => $this->tagihan->getLainnya(),
                ];
            } else {
                $data = [
                    'title' => 'Pembayaran Rutin',
                    'hasil' => $this->model->salah(),
                    'tagihan' => $this->tagihan->getLainnya(),
                ];
            }
            $hasil = array();
        } else {
            $data = [
                'title' => 'Pembayaran Rutin',
                'hasil' => $this->model->getLainnya(),
                'tagihan' => $this->tagihan->getLainnya(),
            ];
        }
        return view('pembayaran/rutin', $data);
    }


    public function pemasukan()
    {
        $data = [
            'title' => 'Pemasukan',
            'tagihan' => $this->tagihan->getTagihan(),
            'pendapatan' => $this->model->pendapatan(),
            'pengeluaran' => $this->pengeluaran->pengeluaran(),
            'Total' => $this->model->jumlah_pemasukan(),
            'Lunas' => $this->model->total_pemasukan(),
        ];
        return view('laporan/pemasukan', $data);
    }
    public function filter_pemasukan()
    {
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_selesai = $this->request->getVar('tgl_selesai');
        $nama_pembayaran = $this->request->getVar('nama_pembayaran');
        if ($tgl_mulai != null || $tgl_selesai != null || $nama_pembayaran != null) {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'nama_pembayaran' => $nama_pembayaran
            ];
            $data = [
                'title' => 'Pemasukan',
                'Total' => $this->model->jumlah_pemasukan(),
                'pengeluaran' => $this->pengeluaran->pengeluaran(),
                'Lunas' => $this->model->pemasukan_total($tanggal),
                'tagihan' => $this->tagihan->getTagihan(),
                'pendapatan' => $this->model->getPemasukan($tanggal),
            ];
        } else {
            $data = [
                'title' => 'Pemasukan',
                'tagihan' => $this->tagihan->getTagihan(),
                'pendapatan' => $this->model->pendapatan(),
                'pengeluaran' => $this->pengeluaran->pengeluaran(),
                'Total' => $this->model->jumlah_pemasukan(),
                'Lunas' => $this->model->total_pemasukan(),
            ];
        }


        return view('laporan/pemasukan', $data);
    }
    public function laporan_masuk()
    {
        $data = [
            'tanggal' => '',
            'title' => 'Print Pemasukan',
            'tagihan' => $this->tagihan->getTagihan(),
            'pendapatan' => $this->model->pemasukan(),
            'pengeluaran' => $this->pengeluaran->pengeluaran(),
            'Lunas' => $this->model->total_pemasukan(),
        ];

        return view('laporan/laporanmasuk', $data);
        $html =  view('laporan/print', $data);
        $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Pondok Pesantren Darussalam');
        $pdf->SetTitle('Sipontren');
        $pdf->SetSubject('Skripsi');
        $pdf->SetKeywords('Laporan, PDF, Skripsi');
        $pdf->setFooterData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // ---------------------------------------------------------

        // add a page
        $pdf->AddPage();
        // print a block of text using Write()
        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');

        // ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('Data-Pemasukan-' . date('Ymd') . '.pdf', 'I');
    }
    public function laporan_keluar()
    {

        $data = [
            'tanggal' => '',
            'title' => 'Print Pengeluaran',
            'keluar' => $this->data->getData(),
            'data' => $this->pengeluaran->getPengeluaran_baru(),
            'pengeluaran' => $this->pengeluaran->total_pengeluaran(),
        ];

        return view('laporan/laporankeluar', $data);
        $html =  view('laporan/print_pengeluaran', $data);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Data Pengeluaran');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');


        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/img/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->SetFont('times', 12);

        // add a page
        $pdf->AddPage();

        // set some text to print

        $pdf->writeHTML($html);

        // ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('Data-Pengeluaran.pdf', 'I');
    }

    public function filter_laporanmasuk()
    {
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_selesai = $this->request->getVar('tgl_selesai');
        $nama_pembayaran = $this->request->getVar('nama_pembayaran');
        $tanggal = [
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'nama_pembayaran' => $nama_pembayaran
        ];

        if ($tgl_mulai != null && $tgl_selesai != null && $nama_pembayaran != null) {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'nama_pembayaran' => $nama_pembayaran
            ];
            $data = [
                'title' => 'Print Pemasukan',
                'tagihan' => $this->tagihan->getTagihan(),
                'pendapatan' => $this->model->laporanmasuk($tanggal),
                'pengeluaran' => $this->pengeluaran->pengeluaran(),
                'Lunas' => $this->model->total_laporanmasuk($tanggal),
                'tanggal' => $tanggal,
            ];
        } else {
            $data = [
                'title' => 'Print Pemasukan',
                'tagihan' => $this->tagihan->getTagihan(),
                'pendapatan' => $this->model->pemasukan(),
                'pengeluaran' => $this->pengeluaran->pengeluaran(),
                'Lunas' => $this->model->total_pemasukan(),
                'tanggal' => $tanggal,
            ];
        }
        return view('laporan/laporanmasuk', $data);
        $html =  view('laporan/print', $data);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Data Pemasukan');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');


        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/img/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->SetFont('times', 12);

        // add a page
        $pdf->AddPage();

        // set some text to print

        $pdf->writeHTML($html);

        // ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('Data-Pemasukan.pdf', 'I');
    }
    public function filter_laporankeluar()
    {
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_selesai = $this->request->getVar('tgl_selesai');
        $nama_pengeluaran = $this->request->getVar('nama_pengeluaran');
        $tanggal = [
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'nama_pengeluaran' => $nama_pengeluaran
        ];
        if ($tgl_mulai != null || $tgl_selesai != null || $nama_pengeluaran != null) {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'nama_pengeluaran' => $nama_pengeluaran
            ];
            $data = [
                'title' => 'Print Pengeluaran',
                'keluar' => $this->data->getData(),
                'data' => $this->pengeluaran->getPengeluaran($tanggal),
                'pengeluaran' => $this->pengeluaran->pengeluaran_total($tanggal),
                'tanggal' => $tanggal,
            ];
        } else {
            $data = [
                'title' => 'Print Pengeluaran',
                'data' => $this->pengeluaran->getPengeluaran_baru(),
                'pengeluaran' => $this->pengeluaran->total_pengeluaran(),
                'keluar' => $this->data->getData(),
                'tanggal' => $tanggal
            ];
        }
        return view('laporan/laporankeluar', $data);
        $html =  view('laporan/print_pengeluaran', $data);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Data Pengeluaran');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');


        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/img/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->SetFont('times', 12);

        // add a page
        $pdf->AddPage();

        // set some text to print

        $pdf->writeHTML($html);

        // ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('Data-Pengeluaran.pdf', 'I');
    }
    public function print()
    {

        $data = [
            'title' => 'Print Pemasukan',
            'tagihan' => $this->tagihan->getTagihan(),
            'pendapatan' => $this->model->pemasukan(),
            'pengeluaran' => $this->pengeluaran->pengeluaran(),
            'Lunas' => $this->model->total_pemasukan(),
        ];

        $html =  view('laporan/print', $data);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Data Pemasukan');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');


        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/img/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->SetFont('times', 12);

        // add a page
        $pdf->AddPage();

        // set some text to print

        $pdf->writeHTML($html);

        // ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('Data-Pemasukan.pdf', 'I');
    }
    public function print_filter()
    {

        $uri = service('uri');
        $param = $uri->getSegments();
        $tgl_mulai = $param[2];
        $tgl_selesai = $param[3];
        $nama_pembayaran = urldecode($param[4]);

        if ($tgl_mulai != null && $tgl_selesai != null && $nama_pembayaran != null) {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'nama_pembayaran' => $nama_pembayaran
            ];
            $data = [
                'title' => 'Print Pemasukan',
                'tagihan' => $this->tagihan->getTagihan(),
                'pendapatan' => $this->model->laporanmasuk($tanggal),
                'pengeluaran' => $this->pengeluaran->pengeluaran(),
                'Lunas' => $this->model->total_laporanmasuk($tanggal),
            ];
        } else {
            $data = [
                'title' => 'Print Pemasukan',
                'tagihan' => $this->tagihan->getTagihan(),
                'pendapatan' => $this->model->pemasukan(),
                'pengeluaran' => $this->pengeluaran->pengeluaran(),
                'Lunas' => $this->model->total_pemasukan(),
            ];
        }
        $html =  view('laporan/print', $data);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Data Pemasukan');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');


        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/img/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->SetFont('times', 12);

        // add a page
        $pdf->AddPage();

        // set some text to print

        $pdf->writeHTML($html);

        // ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('Data-Pemasukan.pdf', 'I');
    }
    public function print_pengeluaran()
    {

        $data = [
            'title' => 'Print Pengeluaran',
            'keluar' => $this->data->getData(),
            'data' => $this->pengeluaran->getPengeluaran_baru(),
            'pengeluaran' => $this->pengeluaran->total_pengeluaran(),
        ];

        $html =  view('laporan/print_pengeluaran', $data);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Data Pengeluaran');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');


        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/img/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->SetFont('times', 12);

        // add a page
        $pdf->AddPage();

        // set some text to print

        $pdf->writeHTML($html);

        // ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('Data-Pengeluaran.pdf', 'I');
    }
    public function print_filterpengeluaran()
    {

        $uri = service('uri');
        $param = $uri->getSegments();
        $tgl_mulai = $param[2];
        $tgl_selesai = $param[3];
        $nama_pengeluaran = urldecode($param[4]);

        if ($tgl_mulai != null || $tgl_selesai != null || $nama_pengeluaran != null) {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'nama_pengeluaran' => $nama_pengeluaran
            ];
            $data = [
                'title' => 'Print Pengeluaran',
                'keluar' => $this->data->getData(),
                'data' => $this->pengeluaran->getPengeluaran($tanggal),
                'pengeluaran' => $this->pengeluaran->pengeluaran_total($tanggal),
            ];
        } else {
            $data = [
                'title' => 'Print Pengeluaran',
                'data' => $this->pengeluaran->getPengeluaran_baru(),
                'pengeluaran' => $this->pengeluaran->total_pengeluaran(),
                'keluar' => $this->data->getData(),
            ];
        }
        $html =  view('laporan/print_pengeluaran', $data);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Data Pengeluaran');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');


        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/img/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->SetFont('times', 12);

        // add a page
        $pdf->AddPage();

        // set some text to print

        $pdf->writeHTML($html);

        // ---------------------------------------------------------

        //Close and output PDF document
        $pdf->Output('Data-Pengeluaran.pdf', 'I');
    }

    public function rutin_add()
    {
        $data = [
            'tagihan' => $this->tagihan->getLainnya(),
            'santri' => $this->santri->findAll(),
            'title' => 'Tambah Data Rutin',
            'validation' => \Config\Services::validation(),
        ];
        return view('pembayaran/rutin_add', $data);
    }
    public function save_lainnya()
    {
        if (!$this->validate([
            'nis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nis  harus diisi!',
                ]
            ],
            'id_santri' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi!',
                ]
            ],
            'id_tagihan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pembayaran harus diisi!',
                ]
            ],
            'waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Bayar  harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/pembayaran/rutin_add')->withInput();
        }
        $waktu = $this->request->getVar('waktu');
        $id_santri = $this->request->getVar('id_santri');
        $id_tagihan = $this->request->getVar('id_tagihan');
        $sql = $this->db->query("SELECT id_tagihan,id_santri,YEAR('$waktu'),MONTH('$waktu') 
        FROM keuangan WHERE id_santri='$id_santri' AND id_tagihan='$id_tagihan'
        AND YEAR(waktu) = YEAR('$waktu') AND MONTH(waktu) = MONTH('$waktu')")->getRowArray();
        if ($sql > 0) {
            session()->setFlashdata('message', 'Data Santri Tersebut Telah Tersedia');
            return redirect()->to('/pembayaran/rutin_add')->withInput();
        } else {
            $this->model->save([
                'id_tagihan' => $id_tagihan,
                'waktu' => $waktu,
                'id_santri' => $id_santri,
                'periode' => date("Y-m-d h:i"),
            ]);
            session()->setFlashdata('message', 'Data Pembayaran Berhasil Di Tambahkan');
            return redirect()->to('/lainnya');
        }
    }
    public function lain_add()
    {
        $data = [
            'title' => 'Pembayaran Lain',
            'tagihan' => $this->tagihan->Lain(),
            'santri' => $this->santri->findAll(),
            'validation' => \Config\Services::validation(),
        ];
        return view('pembayaran/lain_add', $data);
    }

    public function save_lain()
    {
        if (!$this->validate([
            'nis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nis  harus diisi!',
                ]
            ],
            'id_santri' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi!',
                ]
            ],
            'id_tagihan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pembayaran harus diisi!',
                ]
            ],
            'jumlah_bayar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah yang di bayarkan harus diisi!',
                ]
            ],
            'jumlah_tagihan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah tagihan harus diisi!',
                ]
            ],
            'waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Bayar  harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/pembayaran/lain_add')->withInput();
        }
        $waktu = $this->request->getVar('waktu');
        $id_santri = $this->request->getVar('id_santri');
        $id_tagihan = $this->request->getVar('id_tagihan');
        $sql = $this->db->query("SELECT id_tagihan,id_santri,YEAR('$waktu'),MONTH('$waktu') FROM keuangan WHERE id_santri='$id_santri' AND id_tagihan='$id_tagihan'
        AND YEAR(waktu) = YEAR('$waktu') AND MONTH(waktu) = MONTH('$waktu')")->getRowArray();
        if ($sql > 0) {
            session()->setFlashdata('message', 'Data Telah Tersedia');
            return redirect()->to('/pembayaran/lain_add')->withInput();
        } else {
            $this->model->save([
                'id_tagihan' => $id_tagihan,
                'waktu' => $waktu,
                'id_santri' => $id_santri,
                'jumlah_bayar' => $this->request->getVar('jumlah_bayar'),
                'jumlah_tagihan' => $this->request->getVar('jumlah_tagihan'),
                'periode' => date("Y-m-d h:i"),

            ]);
            session()->setFlashdata('message', 'Data Berhasil Di Tambahkan!');
            return redirect()->to('/lain');
        }
    }


    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Pembayaran',
            'santri' => $this->santri->findAll(),
            'tagihan' => $this->tagihan->findAll(),
            'validation' => \Config\Services::validation(),
            'keuangan' => $this->model->where('id_keuangan', $id)->first(),
        ];

        return view('pembayaran/edit', $data);
    }

    public function editdata($id)
    {
        if (!$this->validate([
            'nis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nis  harus diisi!',
                ]
            ],
            'id_santri' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi!',
                ]
            ],
            'id_tagihan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi!',
                ]
            ],
            'waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/pembayaran/edit' . $this->request->getVar('id_keuangan'))->withInput();
        }
        $this->model->save([
            'id_keuangan' => $id,
            'waktu' => $this->request->getVar('waktu'),
            'id_santri' => $this->request->getVar('id_santri'),
            'id_tagihan' => $this->request->getVar('id_tagihan'),
            'status_pembayaran' => 'Belum Lunas',

        ]);
        session()->setFlashdata('message', 'Data Berhasil Di Tambahkan');

        return redirect()->to('/pembayaran');
    }

    public function bayar_lain($id)
    {
        $data = [
            'title' => 'Pembayaran Lain',
            'BelumLunas' => $this->model->getKeuangan($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('pembayaran/bayar_lain', $data);
    }
    public function update_lain($id)
    {
        $id_keuangan = $this->request->getVar('id_keuangan');
        if (!$this->validate([
            'jumlah_bayar' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'Pembayaran anda harus sesuai!',
                ]
            ],
        ])) {
            return redirect()->to('/pembayaran/bayar_lain/' . $id_keuangan)->withInput();
        }
        $keuangan = $this->model->bayar_daftar_ulang($id_keuangan);
        foreach ($keuangan as $bayar) {
            $tagihan = $bayar['jumlah_bayar'];
            $pembayaran = $bayar['jumlah_tagihan'];
        }
        $jumlah_bayar = $this->request->getVar('jumlah_bayar');
        if ($tagihan == null) {
            $total = 0 + $jumlah_bayar;
        } else {
            $total = $tagihan + $jumlah_bayar;
        }

        if ($total > $pembayaran) {
            session()->setFlashdata('message', 'Pembayaran Melebihi Jumlah Tagihan');
            return redirect()->to('/pembayaran/bayar_lain/' . $id_keuangan)->withInput();
        } else {
            $this->model->save([
                'id_keuangan' => $id_keuangan,
                'jumlah_bayar' => $total,
                'periode' => date("Y-m-d h:i"),
            ]);
        }
        session()->setFlashdata('message', 'Pembayaran Berhasil');

        return redirect()->to('/lain');
    }
    public function bayar_rutin($id)
    {
        $data = [
            'title' => 'Pembayaran Rutin',
            'BelumLunas' => $this->model->getKeuangan($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('pembayaran/bayar_lainnya', $data);
    }
    public function update_rutin()
    {
        $id_keuangan = $this->request->getVar('id_keuangan');
        if (!$this->validate([
            'jumlah_bayar' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'Pembayaran anda harus sesuai!',
                ]
            ],
        ])) {
            return redirect()->to('/pembayaran/bayar_lainnya/' . $id_keuangan)->withInput();
        }
        $keuangan = $this->model->bayar_lainnya($id_keuangan);
        foreach ($keuangan as $bayar) {
            $tagihan = $bayar['jumlah_bayar'];
            $pembayaran = $bayar['jumlah_pembayaran'];
        }
        $jumlah_bayar = $this->request->getVar('jumlah_bayar');
        if ($tagihan == null) {
            $total = 0 + $jumlah_bayar;
        } else {
            $total = $tagihan + $jumlah_bayar;
        }

        if ($total > $pembayaran) {
            session()->setFlashdata('message', 'Pembayaran Melebihi Jumlah Tagihan');
            return redirect()->to('/pembayaran/bayar_lainnya/' . $id_keuangan)->withInput();
        } else {
            $this->model->save([
                'id_keuangan' => $id_keuangan,
                'jumlah_bayar' => $total,
                'periode' => date("Y-m-d h:i"),
            ]);
        }
        session()->setFlashdata('message', 'Pembayaran Berhasil');

        return redirect()->to('/lainnya');
    }




    public function delete($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', 'Data Berhasil Di Hapus');
        return redirect()->to('/pembayaran');
    }

    public function delete_lainnya($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', 'Data Berhasil Di Hapus');
        return redirect()->to('/pembayaran/lainnya');
    }

    public function get_autofill()
    {
        if (isset($_GET['term'])) {
            $result = $this->santri->search_santri($_GET['term']);

            if (count($result) > 0) {
                foreach ($result as $row) {
                    $arr_result[] =  array(
                        'label' => $row->nis,
                        'nama_lengkap' => $row->nama_lengkap,
                        'id_santri' => $row->id_santri,
                    );
                }
                echo json_encode($arr_result);
            }
        }
    }
}
