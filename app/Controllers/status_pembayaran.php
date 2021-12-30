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
use PhpParser\Node\Expr\List_;

use function PHPUnit\Framework\returnSelf;
use TCPDF;

class status_pembayaran extends BaseController
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
            'title' => 'Pembayaran SPP',
            'hasil' => $this->model->keuangan_coba(),
            'santri' => $this->santri->findAll(),
            'filter' =>  $this->kelas->findAll()

        ];
        return view('status/index', $data);
    }
    public function filter()
    {
        $data = [
            'title' => 'Pembayaran SPP',
            'hasil' => $this->model->keuangan_coba(),
            'santri' => $this->santri->findAll(),
            'filter' =>  $this->kelas->findAll()

        ];
        return view('status/index', $data);
    }

    public function spp($id_santri)
    {
        $data = [
            'title' => 'Pembayaran SPP',
            'validation' => \Config\Services::validation(),
            'santri' => $this->santri->where('id_santri', $id_santri)->first(),
            'tagihan' => $this->santri->where('id_santri', $id_santri)->where('tagihan.nama_pembayaran', 'uang syahriyah')->join('kelas', 'kelas.id_kelas = santri.id_kelas')->join('tagihan', 'tagihan.id_kelas = santri.id_kelas')->first(),
            'tagih' => $this->santri->select('tagihan.id_tagihan')->where('id_santri', $id_santri)->join('tagihan', 'tagihan.id_kelas = santri.id_kelas')->first(),
        ];

        return view('status/bayar_spp', $data);
    }

    public function hasil()
    {
        $bulan = [
            [
                'no' => '0',
                'kode' => 'Jan',
                'nama' => 'Januari',
            ],
            [
                'no' => '1',
                'kode' => 'Feb',
                'nama' => 'Februari',
            ],
            [
                'no' => '2',
                'kode' => 'Mar',
                'nama' => 'Maret',
            ],
            [
                'no' => '3',
                'kode' => 'Apr',
                'nama' => 'April',
            ],
            [
                'no' => '4',
                'kode' => 'May',
                'nama' => 'Mei',
            ],
            [
                'no' => '5',
                'kode' => 'Jun',
                'nama' => 'Juni',
            ],
            [
                'no' => '6',
                'kode' => 'Jul',
                'nama' => 'Juli',
            ],
            [
                'no' => '7',
                'kode' => 'Aug',
                'nama' => 'Agustus',
            ],
            [
                'no' => '8',
                'kode' => 'Sep',
                'nama' => 'September',
            ],
            [
                'no' => '9',
                'kode' => 'Oct',
                'nama' => 'Oktober',
            ],
            [
                'no' => '10',
                'kode' => 'Nov',
                'nama' => 'November',
            ],
            [
                'no' => '11',
                'kode' => 'Dec',
                'nama' => 'Desember',
            ]
        ];

        $tahun = $this->request->getVar('tahun');
        $tahun = date('Y', strtotime($tahun));
        $id_santri = $this->request->getVar('id_santri');
        $tagihan = $this->santri->tagihan($id_santri);
        $pembayaran = $this->model->coba_spp($id_santri, $tahun);
        if ($id_santri != null && $tahun != null) {
            $bulan_bayar = array();
            if ($pembayaran != null) {
                foreach ($pembayaran as $bayar) {
                    $bulan_bayar[$bayar['bulan']] = $bayar['total_bayar'];
                    $id_keuangan = $bayar['id_keuangan'];
                    $periode = $bayar['periode'];
                }
                $hasil = array();
                for ($i = 1; $i <= 12; $i++) {
                    $bulan = sprintf("%'02d", $i);
                    if ((isset($bulan_bayar[$tahun . "-" . $bulan])) && ($bulan_bayar[$tahun . "-" . $bulan] >= $tagihan['tagihan'])) {
                        $status = 'Lunas';
                        $jumlah_bayar = $bulan_bayar[$tahun . "-" . $bulan];
                        $periode = $bayar['periode'];
                    } else   if ((isset($bulan_bayar[$tahun . "-" . $bulan])) && ($bulan_bayar[$tahun . "-" . $bulan] <= $tagihan['tagihan'])) {
                        $status = 'Belum Lunas';
                        $jumlah_bayar = $bulan_bayar[$tahun . "-" . $bulan];
                        $periode = 0;
                    } else {
                        $status = 'Belum Lunas';
                        $jumlah_bayar = 0;
                        $periode = 0;
                    }
                    $hasil[] = [
                        'status' => $status,
                        'nama_lengkap' => $tagihan['nama_lengkap'],
                        'tahun' => $tahun,
                        'bulan' => $bulan . "-" . $tahun,
                        'id_keuangan' => $id_keuangan,
                        'periode' => $periode,
                        'tagihan' => $tagihan['tagihan'],
                        'pembayaran' => $jumlah_bayar,
                        'id_santri' => $id_santri,
                    ];
                }
                $data = [
                    'title' => 'Pembayaran SPP',
                    'hasil' => $hasil,
                    'santri' => $this->santri->findAll(),
                    'filter' =>  $this->kelas->findAll()
                ];
            } else {
                foreach ($pembayaran as $bayar) {
                    $bulan_bayar[$bayar['bulan']] = $bayar['total_bayar'];
                }
                $hasil = array();
                for ($i = 1; $i <= 12; $i++) {
                    $bulan = sprintf("%'02d", $i);
                    if ((isset($bulan_bayar[$tahun . "-" . $bulan])) && ($bulan_bayar[$tahun . "-" . $bulan] >= $tagihan['tagihan'])) {
                        $status = 'Lunas';
                        $jumlah_bayar = $bulan_bayar[$tahun . "-" . $bulan];
                    } else   if ((isset($bulan_bayar[$tahun . "-" . $bulan])) && ($bulan_bayar[$tahun . "-" . $bulan] <= $tagihan['tagihan'])) {
                        $status = 'Belum Lunas';
                        $jumlah_bayar = $bulan_bayar[$tahun . "-" . $bulan];
                        $periode = 0;
                    } else {
                        $status = 'Belum Lunas';
                        $jumlah_bayar = 0;
                        $periode = 0;
                    }
                    $hasil[] = [
                        'status' => $status,
                        'nama_lengkap' => $tagihan['nama_lengkap'],
                        'tahun' => $tahun,
                        'periode' => $periode,
                        'bulan' => $bulan . "-" . $tahun,
                        'tagihan' => $tagihan['tagihan'],
                        'pembayaran' => $jumlah_bayar,
                        'id_santri' => $id_santri,
                    ];
                }
                $data = [
                    'title' => 'Pembayaran SPP',
                    'hasil' => $hasil,
                    'santri' => $this->santri->findAll(),
                    'filter' =>  $this->kelas->findAll()
                ];
            }
        } else {
            $data = [
                'title' => 'Pembayaran SPP',
                'hasil' => $this->model->keuangan_coba(),
                'santri' => $this->santri->findAll(),
                'filter' =>  $this->kelas->findAll()
            ];
        }


        return view('status/index', $data);
    }



    public function filter_spp()
    {
        $id_kelas = $this->request->getVar('id_kelas');
        $bln = $this->request->getVar('bulan');
        $tagihan = $this->santri->filter_tagihanspp($id_kelas);
        $hasil = array();
        if ($id_kelas != null && $bln != null) {
            foreach ($tagihan as $t) {
                $id_santri = $t['id_santri'];
                $nama = $t['nama_lengkap'];
                $nis = $t['nis'];
                $id_kelas = $t['id_kelas'];
                $tagihan = $this->santri->tagihanspp($id_santri);
                $pembayaran = $this->model->filter_tanggalspp($id_santri, $bln);

                if ($tagihan[0]['tagihan'] == $pembayaran[0]['jumlah_bayar']) {
                    $status = 'Lunas';
                    $pembayaran[0]['jumlah_bayar'];
                } else {
                    $status = 'Belum Lunas';
                }
                $hasil[] = [
                    'id_santri' => $id_santri,
                    'nama_lengkap' => $nama,
                    'nis' => $nis,
                    'id_kelas' => $id_kelas,
                    'id_keuangan' => $pembayaran[0]['id_keuangan'],
                    'periode' => $pembayaran[0]['periode'],
                    'tagihan' => $tagihan[0]['tagihan'],
                    'pembayaran' => $pembayaran[0]['jumlah_bayar'],
                    'status' => $status,
                    'bulan' => $bln,
                ];
            }

            $data = [
                'title' => 'Pembayaran SPP',
                'hasil' => $hasil,
                'santri' => $this->santri->findAll(),
                'filter' =>  $this->kelas->findAll()
            ];
        } elseif ($id_kelas == null) {
            $data = [
                'title' => 'Pembayaran SPP',
                'hasil' => $this->model->keuangan_coba(),
                'santri' => $this->santri->findAll(),
                'filter' =>  $this->kelas->findAll()
            ];
        } else {
            $data = [
                'title' => 'Pembayaran SPP',
                'hasil' => $this->model->keuangan_coba(),
                'santri' => $this->santri->findAll(),
                'filter' =>  $this->kelas->findAll()
            ];
        }
        return view('status/index', $data);
    }

    public function bayar_spp($id_santri)
    {

        $waktu = $this->request->getVar('waktu');
        $id_tagihan = $this->request->getVar('id_tagihan');
        if (!$this->validate([
            'jumlah_bayar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah Pembayaran harus diisi!',
                ]
            ],
            'waktu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Bayar harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/spp/bayar/' . $this->request->getVar('id_santri'))->withInput();
        }
        $sql =    $sql = $this->db->query("SELECT id_tagihan,id_santri,YEAR('$waktu'),MONTH('$waktu') FROM keuangan WHERE id_santri='$id_santri' AND id_tagihan='$id_tagihan'
        AND YEAR(waktu) = YEAR('$waktu') AND MONTH(waktu) = MONTH('$waktu')")->getRowArray();

        if ($sql  > 0) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span>×</span>
                  </button>
                  Data Dengan Bulan Tersebut tersedia
                </div>
              </div>');
            return redirect()->to('/spp/bayar/' . $this->request->getVar('id_santri'))->withInput();
        } else {
            $this->model->save([
                'jumlah_bayar' => $this->request->getVar('jumlah_bayar'),
                'id_santri' => $id_santri,
                'waktu' => $waktu,
                'id_tagihan' => $id_tagihan,
                'periode' => date("Y-m-d h:i"),

            ]);
        }
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                          <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                              <span>×</span>
                            </button>
                            Pembayaran SPP Berhasil!!
                          </div>
                        </div>');

        return redirect()->to('/status_pembayaran');
    }

    public function bayar_kekurangan($id)
    {
        $data = [
            'title' => 'Pembayaran SPP',
            'BelumLunas' => $this->model->getKeuangan($id),
            'tagih' => $this->model->select('tagihan.jumlah_pembayaran')->where('id_keuangan', $id)->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan')->first(),
            'validation' => \Config\Services::validation(),
        ];
        return view('status/bayar_kekurangan', $data);
    }

    public function update_kekurangan($id)
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
            return redirect()->to('/spp/bayar_kekurangan/' . $id_keuangan)->withInput();
        }
        $keuangan = $this->model->bayar_kekurangan($id_keuangan);
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
            return redirect()->to('/spp/bayar_kekurangan/' . $id_keuangan)->withInput();
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
                          Pembayaran SPP Berhasil!!
                        </div>
                      </div>');

        return redirect()->to('/status_pembayaran');
    }
    public function filter_tanggalspp()
    {
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_selesai = $this->request->getVar('tgl_selesai');
        $tagihan = $this->santri->tanggal_spp();

        $pembayaran = $this->model->spp();


        for ($i = 0; $i < 12; $i++) {
            if ($tagihan[0]['tagihan'] != null || $pembayaran[0] != null || $tgl_mulai != null || $tgl_selesai != null) {
                $status = 'Lunas';
                $tanggal[] = [
                    'status' => $status,
                    'tagihan' => $tagihan[0]['tagihan'],
                    'nama_lengkap' => $tagihan[0]['nama_lengkap'],
                    'id_santri' => $tagihan[0]['id_santri'],
                    'pembayaran' => $pembayaran[0]['pembayaran'],
                    'tgl_mulai' => $tgl_mulai,
                    'tgl_selesai' => $tgl_selesai,
                ];

                $pembayaran = $this->model->filter_tanggalspp($tanggal);
            } else {
                $status = 'Belum Lunas';
            }
            $data = [
                'title' => 'Pembayaran SPP',
                'hasil' => $this->model->getSudahLunas(),
                'santri' => $this->santri->findAll(),
                'filter' =>  $this->kelas->findAll()
            ];

            return view('/status_pembayaran', $data);
        }
    }
}
