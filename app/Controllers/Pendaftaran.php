<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrangtuaModel;
use App\Models\SantriModel;
use App\Models\KeuanganModel;
use App\Models\TagihanModel;
use CodeIgniter\Entity\Cast\TimestampCast;

class Pendaftaran extends BaseController
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
      'title' => 'Pendaftaran Santri Baru',
      'santri' => $this->santri->getSantriNew(),
    ];

    return view('pendaftaran/index', $data);
  }

  public function delete($id)
  {
    $this->db->table('santri')->delete(['id_santri' => $id]);
    $this->db->table('orangtua')->delete(['id_orangtua' => $id]);
    session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data santri berhasil dihapus!
                      </div>
                    </div>');
    return redirect()->to('/pendaftaran');
  }

  public function accept($id)
  {
    $this->santri->save([
      'id_santri' => $id,
      'status' => 'Aktif'
    ]);

    return redirect()->to('/pendaftaran');
  }

  public function detail($id)
  {
    $data = [
      'title' => 'Detail Santri Baru',
      'santri' => $this->santri->getSantriNew($id),
    ];

    return view('pendaftaran/detail', $data);
  }
  public function pendaftaran()
  {
    $data = [
      'title' => 'Pembayaran Pendaftaran',
      'hasil' =>  $this->model->keuangan_pendaftaran(),
      'santri' => $this->santri->findAll(),

    ];
    return view('pendaftaran/pendaftaran', $data);
  }

  public function pendaftaran_add()
  {
    $data = [
      'tagihan' => $this->tagihan->findAll(),
      'santri' => $this->santri->findAll(),
      'title' => 'Tambah Data Pendaftaran',
      'validation' => \Config\Services::validation(),
    ];
    return view('pendaftaran/pendaftaran_add', $data);
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
      return redirect()->to('/pendaftaran/pendaftaran_add')->withInput();
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
      return redirect()->to('/pendaftaran/pendaftaran_add')->withInput();
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
                              Data Pembayaran Pendaftaran berhasil ditambahkan!
                            </div>
                          </div>');
      return redirect()->to('/pendaftaran/pendaftaran');
    }
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
    return redirect()->to('/pendaftaran/pendaftaran');
  }

  public function filter_pendaftaran()
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
      $keuangan = $this->model->status_pendaftaran($tanggal);
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
          if ($jumlah_bayar >= $jumlah_tagihan) {
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
              'title' => 'Pembayaran Pendaftaran',
              'hasil' => $hasil,
            ];
          } else {
            $status = 'Belum Lunas';
            $data = [
              'title' => 'Pembayaran Pendaftaran',
              'hasil' => $this->model->salah(),
            ];
          }
        }
      } else {
        $data = [
          'title' => 'Pembayaran Pendaftaran',
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
      $keuangan = $this->model->status_pendaftaranBelum($tanggal);
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
              'title' => 'Pembayaran Pendaftaran',
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
          }
          $data = [
            'title' => 'Pembayaran Pendaftaran',
            'hasil' => $hasil
          ];
        }
      } else {
        $data = [
          'title' => 'Pembayaran Pendaftaran',
          'hasil' => $this->model->salah(),
        ];
      }
    } else {
      $data = [
        'title' => 'Pembayaran Pendaftaran',
        'hasil' => $this->model->keuangan_pendaftaran(),
      ];
    }

    return view('pendaftaran/pendaftaran', $data);
  }

  public function bayar_pendaftaran($id)
  {
    $data = [
      'title' => 'Pembayaran Pendaftaran',
      'BelumLunas' => $this->model->getKeuangan($id),
      'validation' => \Config\Services::validation(),
    ];
    return view('pendaftaran/bayar_pendaftaran', $data);
  }
  public function update_pendaftaran($id)
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
      return redirect()->to('/pendaftaran/bayar_pendaftaran/' . $id_keuangan)->withInput();
    }
    $keuangan = $this->model->bayar_pendaftaran($id_keuangan);
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
      return redirect()->to('/pendaftaran/bayar_pendaftaran/' . $id_keuangan)->withInput();
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
                      Pembayaran Pendaftaran Berhasil!!
                    </div>
                  </div>');

    return redirect()->to('/pendaftaran/pendaftaran');
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
