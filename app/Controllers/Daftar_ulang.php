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
        helper('form');
        helper('url');
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
            'Belum_Lunas' => $this->model->daftarUlang(),
            'validation' => \Config\Services::validation(),
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
            session()->setFlashdata('message', 'Data Telah tersedia');
            return redirect()->to('/daftar_ulang/daftar_ulang_add')->withInput();
        } else {
            $this->model->save([
                'id_tagihan' => $id_tagihan,
                'waktu' => $waktu,
                'id_santri' => $id_santri,
                'jumlah_bayar' => $this->request->getVar('jumlah_bayar'),
                'jumlah_tagihan' => $this->request->getVar('jumlah_tagihan'),
                'periode' => date("Y-m-d h:i"),

            ]);
            session()->setFlashdata('message', 'Data Pembayaran Daftar Ulang berhasil ditambahkan!');
            return redirect()->to('/daftar_ulang');
        }
    }

    public function bayar_daftarUlang()
    {
        $validation = \Config\Services::validation();

        if ($this->request->isAJAX()) {
            $img = $this->request->getFile('bukti');
            $id_keuangan = $this->request->getVar('id_keuangan');
            $jumlah_bayar = $this->request->getVar('jumlah_bayar');
            $ket_bayar = $this->request->getVar('ket_bayar');
            $nis = $this->request->getVar('nis');
            $id_santri = $this->request->getVar('id_santri');
            $valid = $this->validate([
                'ket_bayar' => [
                    'rules' => 'required|',
                    'errors' => [
                        'required' => 'Keterangan harus di isi!',
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
                'nis' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIS harus Di isi !!',
                    ]
                ],
            ]);

            if (!$valid) {
                $data  = [
                    'error' => [
                        'errorKet' => $validation->getError('ket_bayar'),
                        'errorNis' => $validation->getError('nis'),
                        'errorBukti' => $validation->getError('bukti'),
                    ],
                ];
            } else {
                if ($ket_bayar == 'langsung') {
                    $nama_img = $img->getRandomName();
                    $img->move('uploads/langsung', $nama_img);
                    $this->model->save([
                        'id_keuangan' => $id_keuangan,
                        'jumlafh_bayar' => $jumlah_bayar,
                        'ket_bayar' => $ket_bayar,
                        'periode' => date("Y-m-d h:i"),
                        'bukti' => $nama_img,
                    ]);
                    if ($id_santri != null) {
                        $this->santri->save([
                            'id_santri' => $id_santri,
                            'nis' => $nis,
                            'status' => 'Aktif',
                        ]);
                    }
                    $data = [
                        'sukses' => [
                            'sukses' => 'Pembayaran Berhasil Di Inputkan'
                        ]
                    ];
                } else {
                    $nama_img = $img->getRandomName();
                    $img->move('uploads/transfer', $nama_img);
                    $this->model->save([
                        'id_keuangan' => $id_keuangan,
                        'jumlah_bayar' => $jumlah_bayar,
                        'ket_bayar' => $ket_bayar,
                        'periode' => date("Y-m-d h:i"),
                        'bukti' => $nama_img,
                    ]);
                    if ($id_santri != null) {
                        $this->santri->save([
                            'id_santri' => $id_santri,
                            'nis' => $nis,
                            'status' => 'Aktif',
                        ]);
                    }
                    $data = [
                        'sukses' => [
                            'sukses' => 'Pembayaran Berhasil Di Inputkan'
                        ]
                    ];
                }
            }
        }
        echo json_encode($data);
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
                    $ket_bayar = $uang['ket_bayar'];
                    $bukti = $uang['bukti'];
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
                            'status' => $status,
                            'ket_bayar' => $ket_bayar,
                            'bukti' => $bukti
                        ];
                        $data = [
                            'title' => 'Pembayaran Daftar Ulang',
                            'hasil' => $hasil,
                            'Belum_Lunas' => $this->model->salah(),
                        ];
                    } else {
                        $status = 'Belum Lunas';
                        $data = [
                            'title' => 'Pembayaran Daftar Ulang',
                            'hasil' => $this->model->salah(),
                            'Belum_Lunas' => $this->model->salah(),
                        ];
                    }
                }
            } else {
                $data = [
                    'title' => 'Pembayaran Daftar Ulang',
                    'hasil' => $this->model->salah(),
                    'Belum_Lunas' => $this->model->salah(),
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
                            'Belum_Lunas' => $hasil,
                            'hasil' => $this->model->salah(),
                        ];
                    } else {
                        $status = 'Lunas';
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
        } else {
            $data = [
                'title' => 'Pembayaran Daftar Ulang',
                'hasil' => $this->model->getDaftarUlang(),
                'Belum_Lunas' => $this->model->daftarUlang(),
            ];
        }
        return view('daftar_ulang/index', $data);
    }

    public function get_daftarUlang($id_keuangan)
    {
        if ($this->request->isAJAX()) {
            $data =  $this->model->get_data($id_keuangan);
        }
        echo json_encode($data);
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
