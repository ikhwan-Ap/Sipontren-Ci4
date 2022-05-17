<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SantriModel;
use App\Models\KeuanganModel;
use App\Models\TagihanModel;

class Pendaftaran extends BaseController
{
  public function __construct()
  {
    helper('form');
    $this->santri = new SantriModel();
    $this->model = new KeuanganModel();
    $this->tagihan = new TagihanModel();
  }

  public function index()
  {
    $data = [
      'title' => 'Pendaftaran Santri Baru',
      'santri' => $this->santri->where('status', 'Baru')->where('updated_at', null)
        ->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->findAll(),
    ];
    $query = $this->db->query("SELECT santri.id_santri FROM santri
    LEFT JOIN keuangan  ON keuangan.id_santri = santri.id_santri
        WHERE santri.status ='BARU' AND keuangan.id_santri IS NULL AND deleted_at IS NULL")->getRowArray();

    if ($query != null) {
      foreach ($query as $hapus) {
        $id = $hapus;
        if ($id == null) {
          return view('pendaftaran/index', $data);
        } else {
          $this->santri->delete($hapus);
          return view('pendaftaran/index', $data);
        }
      }
    } else {
      return view('pendaftaran/index', $data);
    }
  }

  public function delete($id)
  {
    $sql = $this->db->query("SELECT id_keuangan,id_santri from keuangan where 
    id_santri = '$id'")->getRowArray();
    $id_keuangan = $this->db->query("SELECT id_keuangan from keuangan where 
    id_santri = '$id'")->getRowArray();
    if ($sql != null) {
      foreach ($sql as $data) {
        if ($data != null) {
          $this->db->table('keuangan')->delete($id_keuangan);
          $this->santri->delete($id);
        }
      }
    } else {
      session()->setFlashdata('messasge', 'error');
    }
    session()->setFlashdata('message', 'Data santri berhasil dihapus!');
    return redirect()->to('/pendaftaran');
  }

  public function accept($id)
  {
    $this->santri->update(['id_santri' => $id], ['status' => 'Non Aktif']);
    session()->setFlashdata('message', 'santri berhasil Diterima');
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
      'validation' => \Config\Services::validation(),
      'title' => 'Pembayaran Pendaftaran',
      'hasil' =>  $this->model->keuangan_pendaftaran(),
      'Belum_Lunas' => $this->model->Get_pendaftaran(),
      'santri' => $this->santri->findAll(),
      'daftar_ulang' => $this->tagihan->select('jumlah_pembayaran')->where('nama_pembayaran', 'uang daftar ulang')->findAll(),
    ];

    $waktu = date('Y-m-d H:i:s');
    $periode = $this->db->query("SELECT periode FROM keuangan where id_tagihan = '3' AND 
    jumlah_bayar ='0' AND periode > ('Y-m-d H:i:s')")->getRowArray();

    if ($periode != null) {
      foreach ($periode as $row) {
        if ($waktu > $row) {
          $query =  $this->db->query("SELECT id_keuangan FROM keuangan where id_tagihan = '3' AND 
            jumlah_bayar ='0' AND periode > ('Y-m-d H:i:s')")->getRowArray();
          $this->db->table('keuangan')->delete($query);
          return view('pendaftaran/pendaftaran', $data);
        } else {
          return view('pendaftaran/pendaftaran', $data);
        }
      }
    } else {
      return view('pendaftaran/pendaftaran', $data);
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
    return view('pendaftaran/pendaftaran_add', $data);
  }
  public function save_pendaftaran()
  {
    if (!$this->validate([
      'nama_lengkap' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Nama Lengkap  harus diisi!',
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
      session()->setFlashdata('message', 'Data Telah tersedia');
      return redirect()->to('/pendaftaran/pendaftaran_add')->withInput();
    } else {
      $this->model->save([
        'id_tagihan' => $id_tagihan,
        'waktu' => $waktu,
        'id_santri' => $id_santri,
        'jumlah_bayar' => $this->request->getVar('jumlah_bayar'),
        'jumlah_tagihan' => $this->request->getVar('jumlah_tagihan'),
        'periode' => date("Y-m-d h:i"),
        'ket_bayar' => 'langsung',
      ]);
      session()->setFlashdata('message', 'Data Pembayaran Pendaftaran berhasil ditambahkan!');
      return redirect()->to('/pendaftaran/pendaftaran');
    }
  }

  public function delete_pendaftaran($id)
  {
    $this->model->delete($id);
    session()->setFlashdata('message', 'Data Pendaftaran berhasil dihapus!');
    return redirect()->to('/pendaftaran/pendaftaran');
  }

  public function filter_pendaftaran()
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
          $ket_bayar = $uang['ket_bayar'];
          $bukti = $uang['bukti'];
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
              'status' => $status,
              'ket_bayar' => $ket_bayar,
              'bukti' => $bukti
            ];
            $data = [
              'title' => 'Pembayaran Pendaftaran',
              'hasil' => $hasil,
              'Belum_Lunas' => $this->model->salah(),
            ];
          } else {
            $status = 'Belum Lunas';
            $data = [
              'title' => 'Pembayaran Pendaftaran',
              'hasil' => $this->model->salah(),
              'Belum_Lunas' => $this->model->salah(),
            ];
          }
        }
      } else {
        $data = [
          'title' => 'Pembayaran Pendaftaran',
          'hasil' => $this->model->salah(),
          'Belum_Lunas' => $this->model->salah()
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
          $ket_bayar = $uang['ket_bayar'];
          $bukti = $uang['bukti'];
          if ($jumlah_tagihan >= $jumlah_bayar) {
            $status == 'Belum Lunas';
            $hasil[] = [
              'id_keuangan' => $id_keuangan,
              'nama_lengkap' => $nama_lengkap,
              'id_santri' => $id_santri,
              'nis' => $nis,
              'waktu' => $waktu,
              'jumlah_bayar' => $jumlah_bayar,
              'jumlah_tagihan' => $jumlah_tagihan,
              'status' => $status,
              'periode' => $periode,
              'ket_bayar' => $ket_bayar,
              'bukti' => $bukti
            ];
            $data = [
              'title' => 'Pembayaran Pendaftaran',
              'Belum_Lunas' => $hasil,
              'hasil' => $this->model->salah(),
            ];
          } else {
            $status = ' Lunas';
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
          'Belum_Lunas' => $this->model->salah(),
        ];
      }
    } else {
      $data = [
        'title' => 'Pembayaran Pendaftaran',
        'hasil' => $this->model->keuangan_pendaftaran(),
        'Belum_Lunas' => $this->model->Get_pendaftaran(),
      ];
    }
    return view('pendaftaran/pendaftaran', $data);
  }

  public function bayar_pendaftaran()
  {
    $validation = \Config\Services::validation();
    if ($this->request->isAJAX()) {
      $id_keuangan = $this->request->getVar('id_keuangan');
      $img = $this->request->getFile('bukti');
      $keterangan = $this->request->getVar('ket_bayar');
      $id_santri = $this->request->getVar('id_santri');
      $tagihan = $this->request->getVar('jumlah_tagihan');

      $valid = $this->validate([
        'ket_bayar' => [
          'rules' => 'required|',
          'errors' => [
            'required' => 'Keterangan Pembayaran harus sesuai!',
          ]
        ],
        'bukti' => [
          'rules' => 'uploaded[bukti]|max_size[bukti,1024]|is_image[bukti]
          |mime_in[bukti,image/jpg,image/jpeg,image/png]',
          'errors' => [
            'uploaded' => 'Bukti Pembayaran Harus Di Isi !!!',
            'max_size' => 'Gambar Melebihi 1 mb',
            'mime_in' => 'Gambar harus png / jpg / jpeg!!',
            'is_image' => 'File Bukan Merupakan Gambar',
          ]
        ],
      ]);

      if (!$valid) {
        $data = [
          'error' => [
            'errorKet' => $validation->getError('ket_bayar'),
            'errorBukti' => $validation->getError('bukti')
          ]
        ];
      } else {
        if ($keterangan == 'langsung') {
          $nama_image =  $img->getRandomName();
          $img->move('uploads/langsung', $nama_image);
          $save = $this->model->save([
            'id_keuangan' => $id_keuangan,
            'jumlah_bayar' => $tagihan,
            'ket_bayar' => $keterangan,
            'periode' => date("Y-m-d h:i"),
            'bukti' => $nama_image,
          ]);
          $jumlah_tagihan = $this->tagihan->get_tagihan();
          $id_santri = $this->request->getVar('id_santri');
          if ($save != '') {
            $this->model->save([
              'id_tagihan' => '4',
              'id_santri' => $id_santri,
              'jumlah_tagihan' => $jumlah_tagihan,
              'jumlah_bayar' => '0',
              'waktu' =>  date("Y-m-d h:i"),
              'periode' => Date("Y-m-d h:i", strtotime("+30 days")),
            ]);
            $data = [
              'sukses' => 'Pembayaran Berhasil'
            ];
          }
        } else {
          $nama_image = $img->getRandomName();
          $img->move('uploads/transfer', $nama_image);
          $data = [
            'jumlah_bayar' => $tagihan,
            'ket_bayar' => $keterangan,
            'periode' => date("Y-m-d h:i"),
            'bukti' => $nama_image,
          ];
          $save = $this->model->update(['id_keuangan' => $id_keuangan], $data);
          if ($save != '') {
            $jumlah_tagihan = $this->tagihan->get_tagihan();
            $id_santri = $this->request->getVar('id_santri');
            $this->model->save([
              'id_tagihan' => '4',
              'id_santri' => $id_santri,
              'jumlah_tagihan' => $jumlah_tagihan,
              'jumlah_bayar' => '0',
              'waktu' =>  date("Y-m-d h:i"),
              'periode' => Date("Y-m-d h:i", strtotime("+30 days")),
            ]);
            $data = [
              'sukses' => 'Pembayaran Berhasil'
            ];
          }
        }
      }
    }
    echo json_encode($data);
  }

  public function delSantri($id_santri)
  {
    if ($this->request->isAJAX()) {
      $data = $this->santri->get_id_santri($id_santri);
    }
    echo json_encode($data);
  }

  public function softDel()
  {
    $id_santri = $this->request->getVar('id_santri');
    if ($this->request->isAJAX()) {
      $this->santri->save([
        'id_santri' => $id_santri,
        'deleted_at' =>  date("Y-m-d h:i"),
      ]);
      session()->setFlashdata('message', 'Data Berhasil Di Hapus');
      $data = [
        'sukses' => 'Data berhasil Di Hapus'
      ];
    }
    echo json_encode($data);
  }

  public function accept_santri()
  {
    $id_santri = $this->request->getVar('id_santri');
    if ($this->request->isAJAX()) {
      $this->santri->update(['id_santri' => $id_santri], ['status' => 'Baru']);
      session()->setFlashdata('message', 'santri berhasil Diterima');
      $data = ['sukses' => 'Data Berhasil Di Terima'];
    }
    echo json_encode($data);
  }

  public function getSantri($id_santri)
  {
    $data = $this->santri->get_santri($id_santri);
    echo json_encode($data);
  }

  public function terima_santri($id_santri)
  {
    if ($this->request->isAJAX()) {
      $data = $this->santri->get_id_santri($id_santri);
      echo json_encode($data);
    }
  }

  public function getTagihan($id_keuangan)
  {
    $data =  $this->model->get_data($id_keuangan);
    echo json_encode($data);
  }

  public function get_autofill()
  {
    if (isset($_GET['term'])) {
      $result = $this->santri->search_nama($_GET['term']);

      if (count($result) > 0) {
        foreach ($result as $row) {
          $arr_result[] =  array(
            'label' => $row->nama_lengkap,
            'id_santri' => $row->id_santri,
          );
        }
        echo json_encode($arr_result);
      }
    }
  }
}
