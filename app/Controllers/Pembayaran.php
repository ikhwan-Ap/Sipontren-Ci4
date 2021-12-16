<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KeuanganModel;
use App\Models\TagihanModel;
use App\Models\SantriModel;
use App\Models\PengeluaranModel;

use CodeIgniter\Database\MySQLi\Result;
use DeepCopy\Filter\Filter;

use function PHPUnit\Framework\returnSelf;

class Pembayaran extends BaseController
{
    public function __construct()
    {
        $this->model = new KeuanganModel();
        $this->tagihan = new TagihanModel();
        $this->santri = new SantriModel();
        $this->pengeluaran = new PengeluaranModel();
    }

    public function index()
    {
        $data = [

            'title' => 'Pembayaran SPP',
            'Lunas' => $this->model->getSudahLunas(),
            'BelumLunas' => $this->model->getBelumLunas(),
        ];
        return view('pembayaran/index', $data);
    }

    public function filter()
    {
        $filter = $this->request->getVar('filter');
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_selesai = $this->request->getVar('tgl_selesai');
        $status_pembayaran = $this->request->getVar('status_pembayaran');
        if ($tgl_mulai != null || $tgl_selesai != null || $status_pembayaran == 'Lunas') {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'status_pembayaran' => $status_pembayaran
            ];
            $data = [
                'title' => 'Pembayaran SPP',
                'Lunas' => $this->model->getSudahLunasFilter($tanggal),
            ];
        } elseif ($tgl_mulai != null || $tgl_selesai != null || $status_pembayaran == 'Belum Lunas') {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'status_pembayaran' => $status_pembayaran
            ];
            $data = [
                'title' => 'Pembayaran SPP',
                'Lunas' => $this->model->getLunasFilter($tanggal),
            ];
        } else {
            $data = [
                'title' => 'Pembayaran SPP',
                'Lunas' => $this->model->getSudahLunas(),
                'BelumLunas' => $this->model->getBelumLunas(),
            ];
        }


        return view('pembayaran/index', $data);
    }

    public function daftar_ulang()
    {
        $data = [
            'title' => 'Pembayaran Daftar Ulang',
            'Lunas' => $this->model->getDaftarUlang(),
        ];
        return view('pembayaran/daftar', $data);
    }
    public function filter_daftar_ulang()
    {
        $filter = $this->request->getVar('filter');
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_selesai = $this->request->getVar('tgl_selesai');
        $status_pembayaran = $this->request->getVar('status_pembayaran');
        if ($tgl_mulai != null || $tgl_selesai != null || $status_pembayaran == 'Lunas') {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'status_pembayaran' => $status_pembayaran
            ];
            $data = [
                'title' => 'Pembayaran Daftar Ulang',
                'Lunas' => $this->model->getDaftarUlangLunas($tanggal),
            ];
        } elseif ($tgl_mulai != null || $tgl_selesai != null || $status_pembayaran == 'Belum Lunas') {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'status_pembayaran' => $status_pembayaran
            ];
            $data = [
                'title' => 'Pembayaran Daftar Ulang',
                'Lunas' => $this->model->getDaftarUlangBelumLunas($tanggal),
            ];
        } else {
            $data = [
                'title' => 'Pembayaran Daftar Ulang',
                'Lunas' => $this->model->getDaftarUlang(),
            ];
        }


        return view('pembayaran/daftar', $data);
    }

    public function pendaftaran()
    {
        $data = [
            'title' => 'Pembayaran Pendaftaran',
            'Lunas' => $this->model->getPendaftaran(),
        ];
        return view('pembayaran/pendaftaran', $data);
    }
    public function filter_pendaftaran()
    {
        $filter = $this->request->getVar('filter');
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_selesai = $this->request->getVar('tgl_selesai');
        $status_pembayaran = $this->request->getVar('status_pembayaran');
        if ($tgl_mulai != null || $tgl_selesai != null || $status_pembayaran == 'Lunas') {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'status_pembayaran' => $status_pembayaran
            ];
            $data = [
                'title' => 'Pembayaran Pendaftaran',
                'Lunas' => $this->model->getPendaftaranLunas($tanggal),
            ];
        } elseif ($tgl_mulai != null || $tgl_selesai != null || $status_pembayaran == 'Belum Lunas') {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'status_pembayaran' => $status_pembayaran
            ];
            $data = [
                'title' => 'Pembayaran Pendaftaran',
                'Lunas' => $this->model->getPendaftaranBelumLunas($tanggal),
            ];
        } else {
            $data = [
                'title' => 'Pembayaran Pendaftaran',
                'Lunas' => $this->model->getPendaftaran(),
            ];
        }


        return view('pembayaran/pendaftaran', $data);
    }

    public function lainnya()
    {
        $data = [
            'title' => 'Pembayaran Lainnya',
            'Lunas' => $this->model->getLainnya(),
        ];
        return view('pembayaran/lainnya', $data);
    }
    public function filter_lainnya()
    {
        $filter = $this->request->getVar('filter');
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_selesai = $this->request->getVar('tgl_selesai');
        $nama_pembayaran = $this->request->getVar('nama_pembayaran');
        $status_pembayaran = $this->request->getVar('status_pembayaran');
        if ($tgl_mulai != null || $tgl_selesai != null || $status_pembayaran == 'Lunas' || $nama_pembayaran != null) {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'status_pembayaran' => $status_pembayaran,
                'nama_pembayaran' => $nama_pembayaran
            ];
            $data = [
                'title' => 'Pembayaran Lainnya',
                'Lunas' => $this->model->getLainnyaLunas($tanggal),
            ];
        } elseif ($tgl_mulai != null || $tgl_selesai != null || $status_pembayaran == 'Belum Lunas' || $nama_pembayaran != null) {
            $tanggal = [
                'tgl_mulai' => $tgl_mulai,
                'tgl_selesai' => $tgl_selesai,
                'status_pembayaran' => $status_pembayaran,
                'nama_pembayaran' => $nama_pembayaran
            ];
            $data = [
                'title' => 'Pembayaran Lainnya',
                'Lunas' => $this->model->getLainnyaBelumLunas($tanggal),
            ];
        } else {
            $data = [
                'title' => 'Pembayaran Lainnya',
                'Lunas' => $this->model->getLainnya(),
            ];
        }


        return view('pembayaran/lainnya', $data);
    }
    public function tagihan()
    {
        $data = [
            'title' => 'Tagihan Baru',
            'Lunas' => $this->tagihan->findAll(),
        ];
        return view('pembayaran/tagihan', $data);
    }

    public function pemasukan()
    {


        $data = [
            'title' => 'Pemasukan',
            'tagihan' => $this->tagihan->getTagihan(),
            'pendapatan' => $this->model->pendapatan(),
            'pengeluaran' => $this->pengeluaran->pengeluaran(),
            'Total' => $this->model->total_pemasukan(),
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
                'Total' => $this->model->total_pemasukan(),
                'pengeluaran' => $this->pengeluaran->pengeluaran(),
                'Lunas' => $this->model->getPemasukan($tanggal),
                'tagihan' => $this->tagihan->getTagihan(),
                'pendapatan' => $this->model->getPemasukan($tanggal),
            ];
        } else {
            $data = [
                'title' => 'Pemasukan',
                'tagihan' => $this->tagihan->getTagihan(),
                'pendapatan' => $this->model->pendapatan(),
                'pengeluaran' => $this->pengeluaran->pengeluaran(),
                'Total' => $this->model->total_pemasukan(),
                'Lunas' => $this->model->total_pemasukan(),
            ];
        }


        return view('laporan/pemasukan', $data);
    }
    public function laporan_masuk()
    {


        $data = [
            'title' => 'Print Pemasukan',
            'tagihan' => $this->tagihan->getTagihan(),
            'pendapatan' => $this->model->pemasukan(),
            'pengeluaran' => $this->pengeluaran->pengeluaran(),
            'Lunas' => $this->model->total_pemasukan(),
        ];

        return view('laporan/laporanmasuk', $data);
    }

    public function filter_laporanmasuk()
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
                'title' => 'Print Pemasukan',
                'tagihan' => $this->tagihan->getTagihan(),
                'pendapatan' => $this->model->laporanmasuk($tanggal),
                'pengeluaran' => $this->pengeluaran->pengeluaran(),
                'Lunas' => $this->model->total_pemasukan(),
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


        return view('laporan/laporanmasuk', $data);
    }

    public function pengeluaran()
    {
        $data = [
            'title' => 'Pengeluaran',
            'data' => $this->pengeluaran->findAll(),
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
                'data' => $this->pengeluaran->getPengeluaran($tanggal),
                'pengeluaran' => $this->pengeluaran->getPengeluaran($tanggal),
            ];
        } else {
            $data = [
                'title' => 'Pengeluaran',
                'data' => $this->pengeluaran->findAll(),
                'pengeluaran' => $this->pengeluaran->total_pengeluaran(),
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
        $sql = $this->db->query("SELECT id_tagihan,YEAR('$waktu'),MONTH('$waktu') FROM keuangan WHERE id_santri='$id_santri' AND id_tagihan='$id_tagihan'
        AND YEAR(waktu) = YEAR('$waktu') AND MONTH(waktu) = MONTH('$waktu')")->getRowArray();

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
            $this->model->save([
                // 'id_tagihan' => $this->request->getVar('id_tagihan'),
                'id_tagihan' => $id_tagihan,
                'waktu' => $waktu,
                'id_santri' => $id_santri,
                'status_pembayaran' => 'Belum Lunas',

            ]);
            session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                              <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                  <span>×</span>
                                </button>
                                Data SPP berhasil ditambahkan!
                              </div>
                            </div>');
            return redirect()->to('/pembayaran');
        }
    }
    public function pendaftaran_add()
    {
        $data = [
            'tagihan' => $this->tagihan->findAll(),
            'santri' => $this->santri->findAll(),
            'title' => 'Tambah Data Pendaftaran',
            'validation' => \Config\Services::validation(),
        ];
        return view('pembayaran/pendaftaran_add', $data);
    }
    public function save_pendaftaran()
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
            return redirect()->to('/pembayaran/pendaftaran_add')->withInput();
        }
        $waktu = $this->request->getVar('waktu');
        $id_santri = $this->request->getVar('id_santri');
        $id_tagihan = $this->request->getVar('id_tagihan');
        $sql = $this->db->query("SELECT id_tagihan,id_santri,YEAR('$waktu'),MONTH('$waktu') FROM keuangan WHERE id_santri='$id_santri' AND id_tagihan='$id_tagihan'
        AND YEAR(waktu) = YEAR('$waktu') AND MONTH(waktu) = MONTH('$waktu')")->getRowArray();
        if ($sql > 0) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>×</span>
              </button>
              Data Telah tersedia
            </div>
          </div>');
            return redirect()->to('/pembayaran/pendaftaran_add')->withInput();
        } else {
            $this->model->save([
                // 'id_tagihan' => $this->request->getVar('id_tagihan'),
                'id_tagihan' => $id_tagihan,
                'waktu' => $waktu,
                'id_santri' => $id_santri,
                'status_pembayaran' => 'Belum Lunas',
            ]);
            session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                              <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                  <span>×</span>
                                </button>
                                Data Pembayaran Pendaftaran berhasil ditambahkan!
                              </div>
                            </div>');
            return redirect()->to('/pembayaran/pendaftaran');
        }
    }
    public function daftar_ulang_add()
    {
        $data = [
            'tagihan' => $this->tagihan->findAll(),

            'santri' => $this->santri->findAll(),
            'title' => 'Tambah Data Daftar Ulang',
            'validation' => \Config\Services::validation(),
        ];
        return view('pembayaran/daftar_ulang_add', $data);
    }
    public function save_daftar_ulang()
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
            return redirect()->to('/pembayaran/daftar_ulang_add')->withInput();
        }
        $waktu = $this->request->getVar('waktu');
        $id_santri = $this->request->getVar('id_santri');
        $id_tagihan = $this->request->getVar('id_tagihan');
        $sql = $this->db->query("SELECT id_tagihan,id_santri,YEAR('$waktu'),MONTH('$waktu') FROM keuangan WHERE id_santri='$id_santri' AND id_tagihan='$id_tagihan'
        AND YEAR(waktu) = YEAR('$waktu') AND MONTH(waktu) = MONTH('$waktu')")->getRowArray();
        if ($sql > 0) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>×</span>
              </button>
              Data Telah tersedia
            </div>
          </div>');
            return redirect()->to('/pembayaran/daftar_ulang_add')->withInput();
        } else {
            $this->model->save([
                // 'id_tagihan' => $this->request->getVar('id_tagihan'),
                'id_tagihan' => $id_tagihan,
                'waktu' => $waktu,
                'id_santri' => $id_santri,
                'status_pembayaran' => 'Belum Lunas',
            ]);
            session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                              <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                  <span>×</span>
                                </button>
                                Data Pembayaran Daftar Ulang berhasil ditambahkan!
                              </div>
                            </div>');
            return redirect()->to('/pembayaran/daftar_ulang');
        }
    }
    public function lainnya_add()
    {
        $data = [
            'tagihan' => $this->tagihan->getLainnya(),
            'santri' => $this->santri->findAll(),
            'title' => 'Tambah Data Pendaftaran',
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
        $sql = $this->db->query("SELECT id_tagihan,id_santri,YEAR('$waktu'),MONTH('$waktu') FROM keuangan WHERE id_santri='$id_santri' AND id_tagihan='$id_tagihan'
        AND YEAR(waktu) = YEAR('$waktu') AND MONTH(waktu) = MONTH('$waktu')")->getRowArray();
        if ($sql > 0) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>×</span>
              </button>
              Data Dengan Bulan Tersebut tersedia
            </div>
          </div>');
            return redirect()->to('/pembayaran/lainnya_add')->withInput();
        } else {
            $this->model->save([
                // 'id_tagihan' => $this->request->getVar('id_tagihan'),
                'id_tagihan' => $id_tagihan,
                'waktu' => $waktu,
                'id_santri' => $id_santri,
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
            return redirect()->to('/pembayaran/lainnya');
        }
    }

    public function tagihan_add()
    {
        $data = [
            'title' => 'Tambah Data Pembayaran Baru',
            'validation' => \Config\Services::validation(),
        ];
        return view('pembayaran/tagihan_add', $data);
    }

    public function save_tagihan()
    {
        // $getSantriBayar = $this->;
        if (!$this->validate([
            'nama_pembayaran' => [
                'rules' => 'required|is_unique[tagihan.nama_pembayaran]',
                'errors' => [
                    'required' => 'Nama Pembayaran Harus diisi!',
                    'is_unique' => 'Pembayaran tersebut telah terdaftar!',
                ]
            ],
            'jumlah_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah Pembayaran Harus di Isi',
                ]
            ]
        ])) {
            return redirect()->to('/pembayaran/tagihan_add')->withInput();
        }
        $this->tagihan->save([
            'nama_pembayaran' => $this->request->getVar('nama_pembayaran'),
            'jumlah_pembayaran' => $this->request->getVar('jumlah_pembayaran'),
        ]);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                              <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                  <span>×</span>
                                </button>
                                Data Tagihan berhasil ditambahkan!
                              </div>
                            </div>');
        return redirect()->to('/pembayaran/tagihan');
    }
    public function pengeluaran_add()
    {
        $data = [
            'Lunas' => $this->model->total_pemasukan(),
            'pengeluaran' => $this->pengeluaran->pengeluaran(),
            'title' => 'Tambah Data Pembayaran',
            'validation' => \Config\Services::validation(),
        ];
        return view('laporan/pengeluaran_add', $data);
    }

    public function save_pengeluaran()
    {
        // $getSantriBayar = $this->;
        if (!$this->validate([
            'nama_pengeluaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pembayaran Harus diisi!',
                ]
            ],
            'jumlah_pengeluaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah Pembayaran Harus di Isi',
                ]
            ],
            'waktu_pengeluaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Bayar  harus diisi!',
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
                'nama_pengeluaran' => $this->request->getVar('nama_pengeluaran'),
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

    public function bayar($id)
    {
        $data = [
            'title' => 'Pembayaran',
            'BelumLunas' => $this->model->getKeuangan($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('pembayaran/bayar', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'jumlah_bayar' => [
                'rules' => 'required|matches[jumlah_pembayaran]',
                'errors' => [
                    'required' => 'Pembayaran anda harus sesuai!',
                    'matches' => 'Jumlah bayar tidak sama dengan tagihan!',
                ]
            ],
            'jumlah_pembayaran' => [
                'rules' => 'required|matches[jumlah_bayar]',
                'errors' => [
                    'required' => 'Pembayaran anda harus sesuai!',
                    'matches' => 'Jumlah pembayaran  tidak sama dengan tagihan!',
                ]
            ]
        ])) {
            return redirect()->to('/pembayaran/bayar/' . $this->request->getVar('id_keuangan'))->withInput();
        }

        $this->model->save([
            'id_keuangan' => $id,
            'jumlah_bayar' => $this->request->getVar('jumlah_bayar'),
            'status_pembayaran' => 'Lunas',
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Pembayaran SPP Berhasil!!
                      </div>
                    </div>');

        return redirect()->to('/pembayaran');
    }
    public function bayar_daftar_ulang($id)
    {
        $data = [
            'title' => 'Pembayaran Daftar Ulang',
            'BelumLunas' => $this->model->getKeuangan($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('pembayaran/bayar_daftar_ulang', $data);
    }
    public function update_daftar_ulang($id)
    {
        if (!$this->validate([
            'jumlah_bayar' => [
                'rules' => 'required|matches[jumlah_pembayaran]',
                'errors' => [
                    'required' => 'Pembayaran anda harus sesuai!',
                    'matches' => 'Jumlah bayar tidak sama dengan tagihan!',
                ]
            ],
            'jumlah_pembayaran' => [
                'rules' => 'required|matches[jumlah_bayar]',
                'errors' => [
                    'required' => 'Pembayaran anda harus sesuai!',
                    'matches' => 'Jumlah pembayaran  tidak sama dengan tagihan!',
                ]
            ]
        ])) {
            return redirect()->to('/pembayaran/bayar_daftar_ulang/' . $this->request->getVar('id_keuangan'))->withInput();
        }

        $this->model->save([
            'id_keuangan' => $id,
            'jumlah_bayar' => $this->request->getVar('jumlah_bayar'),
            'status_pembayaran' => 'Lunas',
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Pembayaran Daftar Ulang Berhasil!!
                      </div>
                    </div>');

        return redirect()->to('/daftar_ulang');
    }

    public function bayar_pendaftaran($id)
    {
        $data = [
            'title' => 'Pembayaran Pendaftaran',
            'BelumLunas' => $this->model->getKeuangan($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('pembayaran/bayar_pendaftaran', $data);
    }
    public function update_pendaftaran($id)
    {
        if (!$this->validate([
            'jumlah_bayar' => [
                'rules' => 'required|matches[jumlah_pembayaran]',
                'errors' => [
                    'required' => 'Pembayaran anda harus sesuai!',
                    'matches' => 'Jumlah bayar tidak sama dengan tagihan!',
                ]
            ],
            'jumlah_pembayaran' => [
                'rules' => 'required|matches[jumlah_bayar]',
                'errors' => [
                    'required' => 'Pembayaran anda harus sesuai!',
                    'matches' => 'Jumlah pembayaran  tidak sama dengan tagihan!',
                ]
            ]
        ])) {
            return redirect()->to('/pembayaran/bayar_pendaftaran/' . $this->request->getVar('id_keuangan'))->withInput();
        }

        $this->model->save([
            'id_keuangan' => $id,
            'jumlah_bayar' => $this->request->getVar('jumlah_bayar'),
            'status_pembayaran' => 'Lunas',
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Pembayaran Pendaftaran Berhasil!!
                      </div>
                    </div>');

        return redirect()->to('/pembayaran/pendaftaran');
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
        if (!$this->validate([
            'jumlah_bayar' => [
                'rules' => 'required|matches[jumlah_pembayaran]',
                'errors' => [
                    'required' => 'Pembayaran anda harus sesuai!',
                    'matches' => 'Jumlah bayar tidak sama dengan tagihan!',
                ]
            ],
            'jumlah_pembayaran' => [
                'rules' => 'required|matches[jumlah_bayar]',
                'errors' => [
                    'required' => 'Pembayaran anda harus sesuai!',
                    'matches' => 'Jumlah pembayaran  tidak sama dengan tagihan!',
                ]
            ]
        ])) {
            return redirect()->to('/pembayaran/bayar_lainnya/' . $this->request->getVar('id_keuangan'))->withInput();
        }

        $this->model->save([
            'id_keuangan' => $id,
            'jumlah_bayar' => $this->request->getVar('jumlah_bayar'),
            'status_pembayaran' => 'Lunas',
        ]);

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
                        Data SPP berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/pembayaran');
    }
    public function delete_pendaftaran($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data Pendaftaran berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/pembayaran/pendaftaran');
    }
    public function delete_daftar($id)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data Daftar Ulang berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/pembayaran/daftar_ulang');
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
    public function delete_tagihan($id)
    {
        $this->tagihan->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data Tagihan berhasil dihapus!
                      </div>
                    </div>');
        return redirect()->to('/pembayaran/tagihan');
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
