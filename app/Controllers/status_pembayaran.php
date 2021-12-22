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

    public function index($id_santri = false)
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
        $tagihan = $this->santri->tagihan_spp($id_santri);
        $pembayaran = $this->model->keuangan_spp($id_santri);
        for ($i = 0; $i < 12; $i++) {
            $kode = $bulan[$i]['kode'];
            if ($tagihan[0]['tagihan'] != null && $pembayaran[0][$kode] != null) {
                $status = '';

                $hasil[] = [
                    'bulan' => $bulan[$i]['nama'],
                    'status' => $status,
                    'tagihan' => $tagihan[0]['tagihan'],
                    'pembayaran' => $pembayaran[0][$bulan[$i]['kode']],
                    'id_santri' => $id_santri,
                ];
            }
            $data = [
                'title' => 'Status Pembayaran',
                'hasil' => $hasil,
                'santri' => $this->santri->findAll(),

            ];
            return view('status/index', $data);
        }
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
        $month = date('m');
        $month = ($month) - 1;
        $kode = $bulan[$month]['kode'];
        $id_santri = $this->request->getVar('id_santri');
        $tagihan = $this->santri->tagihan($id_santri);
        $pembayaran = $this->model->keuangan($id_santri);
        for ($i = 0; $i < 12; $i++) {
            $kode = $bulan[$i]['kode'];
            if ($tagihan[0]['tagihan'] == $pembayaran[0][$kode]) {
                $status = 'Lunas';
                $hasil[] = [
                    'bulan' => $bulan[$i]['nama'],
                    'status' => $status,
                    'tagihan' => $tagihan[0]['tagihan'],
                    'pembayaran' => $pembayaran[0][$bulan[$i]['kode']],
                    'id_santri' => $id_santri,
                ];
            } elseif ($tagihan[0]['tagihan'] != $pembayaran[0][$kode]) {
                $status = 'Belum Lunas';
                $hasil[] = [
                    'bulan' => $bulan[$i]['nama'],
                    'status' => $status,
                    'tagihan' => $tagihan[0]['tagihan'],
                    'pembayaran' => $pembayaran[0][$bulan[$i]['kode']],
                    'id_santri' => $id_santri,
                ];
            } else {
                $data = [
                    'title' => 'Status Pembayaran',
                    'hasil' => $this->model->getSudahLunas(),
                    'santri' => $this->santri->findAll(),

                ];
            }


            $data = [
                'title' => 'Status Pembayaran',
                'hasil' => $hasil,
                'santri' => $this->santri->findAll(),

            ];
        }

        return view('status/index', $data);
    }
    public function spp($id_santri)
    {
        $data = [
            'title' => 'Status Pembayaran',
            'validation' => \Config\Services::validation(),
            'santri' => $this->santri->where('id_santri', $id_santri)->first(),
            'tagihan' => $this->santri->where('id_santri', $id_santri)->where('tagihan.nama_pembayaran', 'uang syahriyah')->join('kelas', 'kelas.id_kelas = santri.id_kelas')->join('tagihan', 'tagihan.id_kelas = santri.id_kelas')->first(),
        ];

        return view('status/bayar_spp', $data);
    }
    public function bayar_spp($id_santri)
    {

        $waktu = $this->request->getVar('waktu');
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
        $sql = $this->db->query("SELECT id_santri,id_tagihan,YEAR('$waktu'),MONTH('$waktu') FROM keuangan WHERE id_santri='$id_santri'  AND YEAR(waktu) = YEAR('$waktu') AND MONTH(waktu) = MONTH('$waktu')")->getRowArray();
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
                'waktu' => $waktu

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
}
