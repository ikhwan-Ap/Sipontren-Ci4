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

class Tagihan extends BaseController
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
            'title' => 'Tagihan Kelas',
            'tagihan' => $this->tagihan->Tagihan(),
        ];
        return view('tagihan/index', $data);
    }
    public function tagihan_spp()
    {
        $data = [
            'title' => 'Tambah Data Tagihan Kelas',
            'validation' => \Config\Services::validation(),
            'kelas' => $this->kelas->findAll(),
            'tagihan' => $this->tagihan->findAll(),
            'kelas' => $this->kelas->findAll(),
        ];
        return view('tagihan/tagihankelas_add', $data);
    }
    public function save_spp()
    {
        // $getSantriBayar = $this->;
        if (!$this->validate([
            'jumlah_pembayaran' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'Jumlah Pembayaran Harus diisi!',
                ]
            ],
            'id_kelas' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'Nama Kelas Harus diisi!',
                ]
            ],
            'nama_pembayaran' => [
                'rules' => 'required|',
                'errors' => [
                    'required' => 'Nama Pembayaran Harus diisi!',
                ]
            ],

        ])) {
            return redirect()->to('/tagihan/tagihan_spp')->withInput();
        }
        $nama_pembayaran = $this->request->getVar('nama_pembayaran');
        $id_kelas = $this->request->getVar('id_kelas');
        $sql = $this->db->query("SELECT id_kelas,nama_pembayaran FROM tagihan WHERE id_kelas='$id_kelas' AND nama_pembayaran='$nama_pembayaran'
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
            return redirect()->to('/tagihan/tagihan_spp')->withInput();
        } else {
            $this->tagihan->save([
                'id_kelas' => $id_kelas,
                'nama_pembayaran' => $nama_pembayaran,
                'jumlah_pembayaran' => $this->request->getVar('jumlah_pembayaran')
            ]);
            session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                              <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                  <span>×</span>
                                </button>
                                Data Tagihan berhasil ditambahkan!
                              </div>
                            </div>');
            return redirect()->to('/tagihan_kelas');
        }
    }
    public function tagihan()
    {
        $data = [
            'title' => 'Tagihan Baru',
            'tagihan' => $this->tagihan->getTagihan(),
        ];
        return view('tagihan/tagihan', $data);
    }

    public function tagihan_add()
    {
        $data = [
            'title' => 'Tagihan Baru',
            'validation' => \Config\Services::validation(),
        ];
        return view('tagihan/tagihan_add', $data);
    }

    public function save_tagihan()
    {
        // $getSantriBayar = $this->;
        if (!$this->validate([
            'nama_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pembayaran Harus diisi!',
                ]
            ],

        ])) {
            return redirect()->to('/pembayaran/tagihan_add')->withInput();
        }

        $this->tagihan->save([
            'nama_pembayaran' => $this->request->getVar('nama_pembayaran'),
        ]);
        session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                              <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                  <span>×</span>
                                </button>
                                Data Tagihan berhasil ditambahkan!
                              </div>
                            </div>');
        return redirect()->to('/tagihan/tagihan');
    }
    public function tagihan_rutin()
    {
        $data = [
            'title' => 'Tagihan Baru',
            'validation' => \Config\Services::validation(),
        ];
        return view('tagihan/tagihanrutin_add', $data);
    }

    public function save_rutin()
    {
        // $getSantriBayar = $this->;
        if (!$this->validate([
            'jumlah_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jumlah Pembayaran Harus diisi!',
                ]
            ],
            'nama_pembayaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pembayaran Harus diisi!',
                ]
            ],

        ])) {
            return redirect()->to('/tagihan/tagihan_rutin')->withInput();
        }
        $nama_pembayaran = $this->request->getVar('nama_pembayaran');
        $sql = $this->db->query("SELECT nama_pembayaran FROM tagihan WHERE nama_pembayaran='$nama_pembayaran'
       ")->getRowArray();
        if ($sql > 0) {
            session()->setFlashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
          <div class="alert-body">
            <button class="close" data-dismiss="alert">
              <span>×</span>
            </button>
            Nama Pembayaran Tersebut Telah tersedia
          </div>
        </div>');
            return redirect()->to('/tagihan/tagihan_rutin')->withInput();
        } else {
            $this->tagihan->save([
                'nama_pembayaran' => $nama_pembayaran,
                'jumlah_pembayaran' => $this->request->getVar('jumlah_pembayaran')
            ]);
            session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                              <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                  <span>×</span>
                                </button>
                                Data Tagihan berhasil ditambahkan!
                              </div>
                            </div>');
            return redirect()->to('/tagihan');
        }
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
        return redirect()->to('/tagihan/tagihan');
    }
}
