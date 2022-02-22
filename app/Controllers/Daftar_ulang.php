<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SantriModel;
use App\Models\KeuanganModel;
use App\Models\TagihanModel;


class Daftar_ulang extends BaseController
{
    public function __construct()
    {
        $this->santri = new SantriModel();
        $this->model = new KeuanganModel();
        $this->tagihan = new TagihanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pembayaran Daftar Ulang',
            'hasil' => $this->model->getDaftarUlang(),
            'santri' => $this->santri->findAll(),
        ];
        return view('daftar_ulang/index', $data);
    }

    public function daftar_ulang_add()
    {
        $data = [
            'title' => 'Pembayaran Daftar Ulang',
            'tagihan' => $this->tagihan->findAll(),
            'santri' => $this->santri->findAll(),
            'validation' => \Config\Services::validation(),
        ];
        return view('daftar_ulang/daftar_ulang_add', $data);
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
            return redirect()->to('/daftar_ulang/daftar_ulang_add')->withInput();
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
            return redirect()->to('/daftar_ulang/daftar_ulang_add')->withInput();
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
                              Data Pembayaran Daftar Ulang berhasil ditambahkan!
                            </div>
                          </div>');
            return redirect()->to('/daftar_ulang');
        }
    }
    public function bayar_daftar_ulang($id)
    {
        $data = [
            'title' => 'Pembayaran Daftar Ulang',
            'BelumLunas' => $this->model->getKeuangan($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('daftar_ulang/bayar_daftar_ulang', $data);
    }

    public function update_daftar_ulang($id)
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
            return redirect()->to('/daftar_ulang/bayar_daftar_ulang/' . $id_keuangan)->withInput();
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
            return redirect()->to('/daftar_ulang/bayar_daftar_ulang/' . $id_keuangan)->withInput();
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
                          Pembayaran Daftar Ulang Berhasil!!
                        </div>
                      </div>');

        return redirect()->to('/daftar_ulang');
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
        return redirect()->to('/daftar_ulang');
    }
    public function filter_daftar_ulang()
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
            $keuangan = $this->model->status_daftar_ulang($tanggal);
            if ($keuangan != null) {
                foreach ($keuangan as $uang) {
                    $id_keuangan = $uang['id_keuangan'];
                    $nama_lengkap = $uang['nama_lengkap'];
                    $id_santri = $uang['id_santri'];
                    $nis = $uang['nis'];
                    $waktu = $uang['waktu'];
                    $jumlah_bayar = $uang['jumlah_bayar'];
                    $periode = $uang['periode'];
                    $jumlah_tagihan = $uang['jumlah_tagihan'];
                    if ($jumlah_bayar == $jumlah_tagihan) {
                        $status = 'Lunas';
                        $hasil[] = [
                            'periode' => $periode,
                            'id_keuangan' => $id_keuangan,
                            'nama_lengkap' => $nama_lengkap,
                            'id_santri' => $id_santri,
                            'nis' => $nis,
                            'waktu' => $waktu,
                            'jumlah_bayar' => $jumlah_bayar,
                            'jumlah_tagihan' => $jumlah_tagihan,
                            'status' => $status
                        ];
                        $data = [
                            'title' => 'Pembayaran Daftar Ulang',
                            'hasil' => $hasil,
                        ];
                    } else {
                        $status = 'Belum Lunas';
                        $data = [
                            'title' => 'Pembayaran Daftar Ulang',
                            'hasil' => $this->model->salah(),
                        ];
                    }
                }
            } else {
                $data = [
                    'title' => 'Pembayaran Daftar Ulang',
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
            $keuangan = $this->model->status_daftar_ulangBelum($tanggal);
            if ($keuangan != null) {
                foreach ($keuangan as $uang) {
                    $id_keuangan = $uang['id_keuangan'];
                    $nama_lengkap = $uang['nama_lengkap'];
                    $periode = $uang['periode'];
                    $id_santri = $uang['id_santri'];
                    $nis = $uang['nis'];
                    $waktu = $uang['waktu'];
                    $jumlah_bayar = $uang['jumlah_bayar'];
                    $jumlah_tagihan = $uang['jumlah_tagihan'];
                    if ($jumlah_tagihan == $jumlah_bayar) {
                        $status = 'Lunas';
                        $data = [
                            'title' => 'Pembayaran Daftar Ulang',
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
                            'jumlah_bayar' => $jumlah_bayar,
                            'jumlah_tagihan' => $jumlah_tagihan,
                            'status' => $status,
                            'periode' => $periode
                        ];
                        $data = [
                            'title' => 'Pembayaran Daftar Ulang',
                            'hasil' => $hasil
                        ];
                    }
                }
            } else {
                $data = [
                    'title' => 'Pembayaran Daftar Ulang',
                    'hasil' => $this->model->salah(),
                ];
            }
        } else {
            $data = [
                'title' => 'Pembayaran Daftar Ulang',
                'hasil' => $this->model->getDaftarUlang(),
            ];
        }
        return view('daftar_ulang/index', $data);
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
