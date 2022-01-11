<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KeuanganModel;
use App\Models\TagihanModel;
use App\Models\SantriModel;
use App\Models\PengeluaranModel;
use App\Models\Data_pengeluaran;
use App\Models\KelasModel;
use CodeIgniter\Database\MySQLi\Result;
use DeepCopy\Filter\Filter;
use function PHPUnit\Framework\returnSelf;
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
        $filter = $this->request->getVar('filter');
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


    public function lainnya()
    {
        $data = [
            'title' => 'Pembayaran Rutin',
            'hasil' => $this->model->getLainnya(),
            'tagihan' => $this->tagihan->getLainnya(),
        ];
        return view('pembayaran/lainnya', $data);
    }

    public function filter_rutin()
    {
        $filter = $this->request->getVar('filter');
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
                    $nama_pembayaran = $tagih['nama_pembayaran'];
                    $pembayaran = $this->model->filter_rutin($id_santri, $bulan, $id_tagihan);
                    if ($tagihan[0]['tagihan'] == $pembayaran[0]['jumlah_bayar']) {
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
                        'jumlah_tagihan' => $tagihan[0]['tagihan'],
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
        return view('pembayaran/lainnya', $data);
    }
    public function pengeluaran_baru()
    {
        $data = [
            'title' => 'Pengeluaran Baru',
            'Pengeluaran' => $this->data->findAll(),
        ];
        return view('laporan/pengeluaran_baru', $data);
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
        $filter = $this->request->getVar('filter');
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

    public function filter_laporanmasuk()
    {
        $filter = $this->request->getVar('filter');
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

    public function pengeluaran()
    {
        $data = [
            'title' => 'Pengeluaran',
            'keluar' => $this->data->getData(),
            'data' => $this->pengeluaran->getPengeluaran_baru(),
            'pengeluaran' => $this->pengeluaran->total_pengeluaran(),
        ];
        return view('laporan/pengeluaran', $data);
    }
    public function filter_pengeluaran()
    {
        $filter = $this->request->getVar('filter');
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_selesai = $this->request->getVar('tgl_selesai');
        $nama_pengeluaran = $this->request->getVar('nama_pengeluaran');
        if ($tgl_mulai != null || $tgl_selesai != null || $nama_pengeluaran != null) {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'nama_pengeluaran' => $nama_pengeluaran
            ];
            $data = [
                'title' => 'Pengeluaran',
                'keluar' => $this->data->getData(),
                'data' => $this->pengeluaran->getPengeluaran($tanggal),
                'pengeluaran' => $this->pengeluaran->pengeluaran_total($tanggal),

            ];
        } else {
            $data = [
                'title' => 'Pengeluaran',
                'data' => $this->pengeluaran->getPengeluaran_baru(),
                'pengeluaran' => $this->pengeluaran->total_pengeluaran(),
                'keluar' => $this->data->getData(),
            ];
        }


        return view('laporan/pengeluaran', $data);
    }
    public function add()
    {
        $data = [
            'tagihan' => $this->tagihan->findAll(),
            'santri' => $this->santri->findAll(),
            'title' => 'Tambah Data Pembayaran',
            'validation' => \Config\Services::validation(),
        ];
        return view('pembayaran/add', $data);
    }
    public function save()
    {
        // $getSantriBayar = $this->;
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
            return redirect()->to('/pembayaran/add')->withInput();
        }
        /* $tanggal = date_format(date_create($waktu), "Y-m");  */


        $waktu = $this->request->getVar('waktu');

        $id_santri = $this->request->getVar('id_santri');
        $id_tagihan = $this->request->getVar('id_tagihan');
        $bulanindo = [
            '01' => 'januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];


        for ($i = 0; $i < 12; $i++) {
            $jatuhtempo = date("Y-m-d", strtotime("+$i month"));
            $bulan = $bulanindo[date('m', strtotime($jatuhtempo))] . "  " . date('Y', strtotime($jatuhtempo));
            $sql = $this->db->query("SELECT id_santri,id_tagihan,YEAR('$jatuhtempo'),MONTH('$jatuhtempo') FROM keuangan WHERE id_santri='$id_santri' AND id_tagihan='$id_tagihan' AND YEAR(waktu) = YEAR('$jatuhtempo') AND MONTH(waktu) = MONTH('$jatuhtempo')")->getRowArray();
        }

        //array MONTH(waktu)='$bln' AND YEAR(waktu)='$thn'
        if ($sql  > 0) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span>×</span>
                  </button>
                  Data Dengan Bulan Tersebut tersedia
                </div>
              </div>');
            return redirect()->to('/pembayaran/add')->withInput();
        } else {
            // $this->model->save([
            //     // 'id_tagihan' => $this->request->getVar('id_tagihan'),
            //     'id_tagihan' => $id_tagihan,
            //     'waktu' => $jatuhtempo,
            //     'id_santri' => $id_santri,
            //     'bulan' => $bulan,
            //     'status_pembayaran' => 'Belum Lunas',

            // ]);

            for ($i = 0; $i < 12; $i++) {
                $jatuhtempo = date("Y-m-d", strtotime("+$i month"));

                $bulan = $bulanindo[date('m', strtotime($jatuhtempo))] . "  " . date('Y', strtotime($jatuhtempo));

                $this->model->save(
                    [
                        'id_santri'        => $id_santri,
                        'id_tagihan'        => $id_tagihan,
                        'waktu'        =>    $jatuhtempo,
                        'bulan'        =>    $bulan,
                        'status_pembayaran' => 'Belum Lunas',
                    ]
                );
            }

            // $builder = $this->db->table('keuangan');
            // $builder->insertBatch();
            session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                              <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                  <span>×</span>
                                </button>
                                Data Lain berhasil ditambahkan!
                              </div>
                            </div>');
            return redirect()->to('/pembayaran');
        }
    }

    public function lainnya_add()
    {
        $data = [
            'tagihan' => $this->tagihan->getLainnya(),
            'santri' => $this->santri->findAll(),
            'title' => 'Tambah Data Rutin',
            'validation' => \Config\Services::validation(),
        ];
        return view('pembayaran/lainnya_add', $data);
    }
    public function save_lainnya()
    {
        // $getSantriBayar = $this->;
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
            return redirect()->to('/pembayaran/lainnya_add')->withInput();
        }
        $waktu = $this->request->getVar('waktu');
        $id_santri = $this->request->getVar('id_santri');
        $id_tagihan = $this->request->getVar('id_tagihan');
        $sql = $this->db->query("SELECT id_tagihan,id_santri,YEAR('$waktu'),MONTH('$waktu') FROM keuangan 
        WHERE id_santri='$id_santri' AND id_tagihan='$id_tagihan'")->getRowArray();
        if ($sql > 0) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>×</span>
              </button>
              Data Santri Telah Tersebut tersedia
            </div>
          </div>');
            return redirect()->to('/pembayaran/lainnya_add')->withInput();
        } else {
            $this->model->save([
                // 'id_tagihan' => $this->request->getVar('id_tagihan'),
                'id_tagihan' => $id_tagihan,
                'waktu' => $waktu,
                'id_santri' => $id_santri,
                'periode' => date("Y-m-d h:i"),
            ]);
            session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                              <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                  <span>×</span>
                                </button>
                                Data Pembayaran berhasil ditambahkan!
                              </div>
                            </div>');
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
        // $getSantriBayar = $this->;
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
        $sql = $this->db->query("SELECT id_tagihan,id_santri FROM keuangan WHERE id_santri='$id_santri' AND id_tagihan='$id_tagihan'
       ")->getRowArray();
        if ($sql > 0) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
          <div class="alert-body">
            <button class="close" data-dismiss="alert">
              <span>×</span>
            </button>
            Data Telah tersedia
          </div>
        </div>');
            return redirect()->to('/pembayaran/lain_add')->withInput();
        } else {
            $this->model->save([
                // 'id_tagihan' => $this->request->getVar('id_tagihan'),
                'id_tagihan' => $id_tagihan,
                'waktu' => $waktu,
                'id_santri' => $id_santri,
                'jumlah_bayar' => $this->request->getVar('jumlah_bayar'),
                'jumlah_tagihan' => $this->request->getVar('jumlah_tagihan'),
                'periode' => date("Y-m-d h:i"),

            ]);
            session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                              <button class="close" data-dismiss="alert">
                                <span>×</span>
                              </button>
                              Data Pembayaran berhasil ditambahkan!
                            </div>
                          </div>');
            return redirect()->to('/lain');
        }
    }
    public function pengeluaranbaru_add()
    {
        $data = [
            'title' => 'Tambah Data Pengeluaran Baru',
            'validation' => \Config\Services::validation(),
        ];
        return view('laporan/pengeluaranbaru_add', $data);
    }
    public function save_pengeluaranbaru()
    {
        // $getSantriBayar = $this->;
        if (!$this->validate([
            'nama_pengeluaran' => [
                'rules' => 'required|is_unique[data_pengeluaran.nama_pengeluaran]',
                'errors' => [
                    'required' => 'Nama pengeluaran Harus diisi!',
                    'is_unique' => 'pengeluaran tersebut telah terdaftar!',
                ]
            ],
        ])) {
            return redirect()->to('/pembayaran/pengeluaranbaru_add')->withInput();
        }
        $this->data->save([
            'nama_pengeluaran' => $this->request->getVar('nama_pengeluaran')
        ]);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                              <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                  <span>×</span>
                                </button>
                                Data Pengeluaran berhasil ditambahkan!
                              </div>
                            </div>');
        return redirect()->to('/pengeluaran_baru');
    }
    public function pengeluaran_add()
    {
        $data = [
            'Lunas' => $this->model->jumlah_pemasukan(),
            'pengeluaran' => $this->pengeluaran->pengeluaran(),
            'pengeluaran_baru' => $this->data->findAll(),
            'title' => 'Tambah Data Pembayaran',
            'validation' => \Config\Services::validation(),

        ];
        return view('laporan/pengeluaran_add', $data);
    }

    public function save_pengeluaran()
    {
        // $getSantriBayar = $this->;
        if (!$this->validate([
            'id_keluar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pengeluaran Harus diisi!',
                ]
            ],
            'jumlah_pengeluaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah Pengeluaran Harus di Isi',
                ]
            ],
            'waktu_pengeluaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal  harus diisi!',
                ]
            ],

        ])) {
            return redirect()->to('/pembayaran/pengeluaran_add')->withInput();
        }
        $jumlah_pengeluaran = $this->request->getVar('jumlah_pengeluaran');
        $sql = $this->db->query("SELECT sum(jumlah_bayar) as jumlah_bayar FROM keuangan");
        $cek = $sql->getRow()->jumlah_bayar;
        $pengeluaran = $this->db->query("SELECT sum(jumlah_pengeluaran) as jumlah_pengeluaran FROM pengeluaran WHERE jumlah_pengeluaran='$jumlah_pengeluaran'");
        $cek_pengeluaran = $pengeluaran->getRow()->jumlah_pengeluaran;
        $anggaran = $cek - $cek_pengeluaran;
        if ($jumlah_pengeluaran > $anggaran) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>×</span>
              </button>
              Pengeluaran Melebihi Anggaran Yang tersedia
            </div>
          </div>');
            return redirect()->to('/pembayaran/pengeluaran_add')->withInput();
        } else {
            $this->pengeluaran->save([
                'id_keluar' => $this->request->getVar('id_keluar'),
                'jumlah_pengeluaran' => $jumlah_pengeluaran,
                'waktu_pengeluaran' => $this->request->getVar('waktu_pengeluaran'),
            ]);
            session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                                      <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                          <span>×</span>
                                        </button>
                                        Data Pengeluaran Berhasil ditambahkan!
                                      </div>
                                    </div>');
            return redirect()->to('/pengeluaran');
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
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data Pembayaran berhasil ditambahkan!
                      </div>
                    </div>');

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
        $total = $tagihan + $jumlah_bayar;
        if ($total > $pembayaran) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>×</span>
        </button>
        Pembayaran Melebihi Jumlah Tagihan
      </div>
    </div>');
            return redirect()->to('/pembayaran/bayar_lain/' . $id_keuangan)->withInput();
        } else {
            $this->model->save([
                'id_keuangan' => $id_keuangan,
                'jumlah_bayar' => $total,
                'periode' => date("Y-m-d h:i"),
            ]);
        }
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                      <button class="close" data-dismiss="alert">
                        <span>×</span>
                      </button>
                      Pembayaran Berhasil!!
                    </div>
                  </div>');

        return redirect()->to('/lain');
    }
    public function bayar_lainnya($id)
    {
        $data = [
            'title' => 'Pembayaran Lain',
            'BelumLunas' => $this->model->getKeuangan($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('pembayaran/bayar_lainnya', $data);
    }
    public function update_lainnya($id)
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
        $total = $tagihan + $jumlah_bayar;
        if ($total > $pembayaran) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                    <span>×</span>
                    </button>
                    Pembayaran Melebihi Jumlah Tagihan
                </div>
                </div>');
            return redirect()->to('/pembayaran/bayar_lainnya/' . $id_keuangan)->withInput();
        } else {
            $this->model->save([
                'id_keuangan' => $id_keuangan,
                'jumlah_bayar' => $total,
                'periode' => date("Y-m-d h:i"),
            ]);
        }
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span>×</span>
                  </button>
                  Pembayaran Berhasil!!
                </div>
              </div>');

        return redirect()->to('/lainnya');
    }
    public function delete($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data Lain berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/pembayaran');
    }

    public function delete_lainnya($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data Pembayaran berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/pembayaran/lainnya');
    }
    public function delete_pengeluaranbaru($id)
    {
        $this->data->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data Pengeluaran berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/pengeluaran_baru');
    }
    public function delete_pengeluaran($id)
    {
        $this->pengeluaran->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data Pengeluaran berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/pengeluaran');
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
