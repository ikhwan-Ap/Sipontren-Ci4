<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\KeuanganModel;
use App\Models\TagihanModel;
use App\Models\SantriModel;
use App\Models\PengeluaranModel;
use App\Models\Data_pengeluaran;
use App\Models\KelasModel;


class Status_pembayaran extends BaseController
{
    protected $session;
    public function __construct()
    {
        helper('array');
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
            'hasil' => $this->model->SALAH(),
            'santri' => $this->santri->findAll(),
            'filter' =>  $this->kelas->findAll()

        ];
        return view('status/index', $data);
    }

    public function filter()
    {
        $data = [
            'title' => 'Pembayaran SPP',
            'hasil' => $this->model->SALAH(),
            'santri' => $this->santri->findAll(),
            'filter' =>  $this->kelas->findAll()

        ];
        return view('status/index', $data);
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
            $periode = array();
            $id_keuangan = array();
            $ket_bayar = array();
            if ($pembayaran != null) {
                foreach ($pembayaran as $bayar) {
                    $bulan_bayar[$bayar['bulan']] = $bayar['total_bayar'];
                    $id_keuangan[] = $bayar['id_keuangan'];
                    $periode[] = $bayar['periode'];
                    $ket_bayar[] = $bayar['ket_bayar'];
                }
                $hasil = array();
                for ($i = 1; $i <= 12; $i++) {
                    $bulan = sprintf("%'02d", $i);
                    if ((isset($bulan_bayar[$tahun . "-" . $bulan])) && ($bulan_bayar[$tahun . "-" . $bulan] >= $tagihan['tagihan'])) {
                        $status = 'Lunas';
                        $jumlah_bayar = $bulan_bayar[$tahun . "-" . $bulan];
                        $periode[] = $bayar['periode'];
                        $id_keuangan[] = $bayar['id_keuangan'];
                        $ket_bayar[] = $bayar['ket_bayar'];
                    } else   if ((isset($bulan_bayar[$tahun . "-" . $bulan])) && ($bulan_bayar[$tahun . "-" . $bulan] <= $tagihan['tagihan'])) {
                        $status = 'Belum Lunas';
                        $jumlah_bayar = $bulan_bayar[$tahun . "-" . $bulan];
                        $periode[] = '-';
                        $ket_bayar[] = null;
                        $id_keuangan[] = null;
                    } else {
                        $status = 'Belum Lunas';
                        $jumlah_bayar = 0;
                        $periode[] = '-';
                        $id_keuangan[] = null;
                        $ket_bayar[] = null;
                    }
                    $hasil[] = [
                        'status' => $status,
                        'nama_lengkap' => $tagihan['nama_lengkap'],
                        'tahun' => $tahun,
                        'ket_bayar' => $ket_bayar[$i],
                        'bulan' => $bulan . "-" . $tahun,
                        'id_keuangan' => $id_keuangan[$i],
                        'periode' => $periode[$i],
                        'tagihan' => $tagihan['tagihan'],
                        'nama_kelas' => $tagihan['nama_kelas'],
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
                        'periode' => $periode,
                        'bulan' => $bulan . "-" . $tahun,
                        'tagihan' => $tagihan['tagihan'],
                        'nama_kelas' => $tagihan['nama_kelas'],
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
                'hasil' => $this->model->SALAH(),
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
        $tagihan = $this->model->tagihanSpp($id_kelas);
        $hasil = array();
        if ($id_kelas != null && $bln != null) {
            foreach ($tagihan as $t) {
                $id_santri = $t['id_santri'];
                $nama = $t['nama_lengkap'];
                $nis = $t['nis'];
                $id_kelas = $t['id_kelas'];
                $jumlah_tagihan = $t['jumlah_tagihan'];
                $tagihan = $this->santri->tagihanspp($id_santri);
                $pembayaran = $this->model->filter_tanggalspp($id_santri, $bln);
                if ($pembayaran != null) {
                    if ($tagihan[0]['tagihan'] <= $pembayaran[0]['jumlah_bayar']) {
                        $status = 'Lunas';
                        $periode = $pembayaran[0]['periode'];
                        $keterangan = $pembayaran[0]['ket_bayar'];
                        $id_keuangan = $pembayaran[0]['id_keuangan'];
                    } else {
                        $status = 'Belum Lunas';
                        $id_keuangan = '';
                        $periode = '';
                        $keterangan = '';
                    }
                    $hasil[] = [
                        'id_santri' => $id_santri,
                        'nama_lengkap' => $nama,
                        'nis' => $nis,
                        'ket_bayar' => $keterangan,
                        'id_kelas' => $id_kelas,
                        'id_keuangan' => $id_keuangan,
                        'periode' => $periode,
                        'tagihan' => $jumlah_tagihan,
                        'nama_kelas' => $tagihan[0]['nama_kelas'],
                        'pembayaran' => $pembayaran[0]['jumlah_bayar'],
                        'status' => $status,
                        'bulan' => $bln,
                    ];
                } else {
                    $hasil[] =
                        [
                            'id_santri' => $id_santri,
                            'nama_lengkap' => $nama,
                            'nis' => $nis,
                            'id_kelas' => $id_kelas,
                            'id_keuangan' => '',
                            'periode' => '',
                            'tagihan' => $jumlah_tagihan,
                            'nama_kelas' => $tagihan[0]['nama_kelas'],
                            'pembayaran' => '0',
                            'status' => 'Belum Lunas',
                            'ket_bayar' => '-',
                            'bulan' => $bln,

                        ];
                }
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
                'hasil' => $this->model->SALAH(),
                'santri' => $this->santri->findAll(),
                'filter' =>  $this->kelas->findAll()
            ];
        } else {
            $data = [
                'title' => 'Pembayaran SPP',
                'hasil' => $this->model->SALAH(),
                'santri' => $this->santri->findAll(),
                'filter' =>  $this->kelas->findAll()
            ];
        }
        return view('status/index', $data);
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

    public function bayar()
    {
        if ($this->request->isAJAX()) {
            $validation =  \Config\Services::validation();
            $id_santri = $this->request->getVar('id_santri');
            $id_kelas = $this->request->getVar('id_kelas');
            $waktu = $this->request->getVar('waktu');
            $id_tagihan = $this->request->getVar('id_tagihan');
            $jumlah_bayar = $this->request->getVar('jumlah_bayar');
            $ket_bayar = $this->request->getVar('ket_bayar');

            $valid = $this->validate([
                'waktu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'data waktu harus diisi!',
                    ]
                ],
                'ket_bayar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'keterangan harus diisi!',
                    ]
                ],

            ]);

            $sql = array();
            $hasil_santri = array();
            $hasil_tagihan = array();
            $hasil_waktu = array();
            $array = array();
            $jumlah_data = count($waktu);
            foreach ($id_santri as $santri) {
                $hasil_santri['id_santri'] = $santri;
            }
            foreach ($id_tagihan as $tagih) {
                $hasil_tagihan['id_tagihan'] = $tagih;
            }
            foreach ($ket_bayar as $data_bayar) {
                $keterangan['ket_bayar'] = $data_bayar;
            }
            foreach ($waktu as $tgl) {
                $hasil_waktu['waktu'] = $tgl;

                if ($hasil_waktu['waktu'] == null || $keterangan['ket_bayar'] == null) {
                    if (!$valid) {
                        $data = [
                            'erorr' => [
                                'errorWaktu' => $validation->getError('waktu'),
                                'errorKet' => $validation->getError('ket_bayar'),
                            ]
                        ];
                    }
                } else {
                    for ($i = 0; $i < $jumlah_data; $i++) {
                        $hasil = [
                            'jumlah_bayar' => $jumlah_bayar[$i],
                            'jumlah_tagihan' => $jumlah_bayar[$i],
                            'id_santri' => $id_santri[$i],
                            'id_kelas' => $id_kelas[$i],
                            'waktu' => $waktu[$i],
                            'ket_bayar' => $ket_bayar[$i],
                            'id_tagihan' => $id_tagihan[$i],
                            'periode' => date("Y-m-d h:i"),
                        ];

                        $hari = date('d', strtotime($hasil_waktu['waktu']));
                        $bulan = date('m', strtotime($hasil_waktu['waktu']));
                        $tahun = date('Y', strtotime($hasil_waktu['waktu']));

                        $array = [
                            'id_santri' => $hasil_santri['id_santri'], 'id_tagihan' => $hasil_tagihan['id_tagihan'],
                            "DATE_FORMAT(waktu, '%Y')" => $tahun, "DATE_FORMAT(waktu, '%m')" => $bulan
                        ];
                        $hapus_id = [
                            'id_santri' => $hasil_santri['id_santri']
                        ];
                        $array_tgl = [
                            'id_santri' => $hasil_santri['id_santri'], 'id_tagihan' => $hasil_tagihan['id_tagihan'],
                            "DATE_FORMAT(waktu, '%Y')" => $tahun, "DATE_FORMAT(waktu, '%d')" => $hari
                        ];

                        $sql = $this->model->santri($array);
                        $time = $this->model->getBulan($waktu[$i]);
                        $hari_tgl = $this->model->hari_tgl($array_tgl);

                        if ($sql > 0) {
                            $data = [
                                'session' => [
                                    'session' => 'Data dengan bulan tersebut telah tersedia',
                                ]
                            ];
                        } elseif ($hari_tgl > 0) {
                            if ($time != null) {
                                if ($waktu[$i] == $time['waktu']) {
                                    continue;
                                } else {
                                    $save = $this->model->add_spp($hasil);
                                    if ($save != null) {
                                        $this->model->hapus_spp($hapus_id);
                                        session()->setFlashdata('message', 'Data Berhasil Di inputkan');
                                        $data = [
                                            'sukses' => [
                                                'sukses' => 'Data Pembayaran Berhasil Di inputkan',
                                            ]
                                        ];
                                    }
                                }
                            } else {
                                $save = $this->model->add_spp($hasil);
                                if ($save != null) {
                                    $this->model->hapus_spp($hapus_id);
                                    session()->setFlashdata('message', 'Data Berhasil Di inputkan');
                                    $data = [
                                        'sukses' => [
                                            'sukses' => 'Data Pembayaran Berhasil Di inputkan',
                                        ]
                                    ];
                                }
                            }
                        } else {
                            $save = $this->model->add_spp($hasil);
                            if ($save != null) {
                                $this->model->hapus_spp($hapus_id);
                                session()->setFlashdata('message', 'Data Berhasil Di inputkan');
                                $data = [
                                    'sukses' => [
                                        'sukses' => 'Data Pembayaran Berhasil Di inputkan',
                                    ]
                                ];
                            }
                        }
                    }
                }
            }
            echo json_encode($data);
        }
    }

    public function getSpp($id_santri)
    {
        $data =
            [
                'santri' =>  $this->santri->get_by_id($id_santri),
                'tagihan' => $this->santri->get_tagihan($id_santri),
                'kelas' => $this->santri->get_tagihan_kelas($id_santri)
            ];
        echo json_encode($data);
    }

    public function addSpp()
    {
        $validation = \Config\Services::validation();

        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_santri_spp');
            $id_kelas = $this->request->getVar('id_kelas_spp');
            $jumlah_tagihan = $this->request->getVar('jumlah_tagihan_spp');
            $id_tagihan = $this->request->getVar('id_tagihan_spp');

            $valid = $this->validate([
                'nis' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'nis harus diisi!',
                    ]
                ],
                'jumlah_tagihan_spp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jumlah Tagihan harus diisi!',
                    ]
                ],
            ]);

            $sql = $this->model->get_spp($id, $id_tagihan, $id_kelas);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNis_spp' => $validation->getError('nis'),
                        'errorTagihan_spp' => $validation->getError('jumlah_tagihan_spp'),
                    ]
                ];
            } elseif ($sql > 0) {
                $data = [
                    'session' => [
                        'session' => 'Data Telah tersedia'
                    ]
                ];
            } else {
                session()->setFlashdata('message', 'Data berhasil di input');
                $save =   $this->model->save([
                    'id_tagihan' => $id_tagihan,
                    'id_santri' => $id,
                    'id_kelas' => $id_kelas,
                    'jumlah_bayar' => '0',
                    'jumlah_tagihan' => $jumlah_tagihan,
                ]);


                $data = [
                    'sukses' => [
                        'sukses' => 'Data berhasil di inputkan'
                    ]
                ];
            }
        }
        echo json_encode($data);
    }
    public function getKeterangan($id_keuangan)
    {
        $data = $this->model->getKet($id_keuangan);
        echo json_encode($data);
    }
    public function get_autofill()
    {
        if (isset($_GET['term'])) {
            $result = $this->model->searchSpp($_GET['term']);

            if (count($result) > 0) {
                foreach ($result as $row) {
                    $arr_result[] =  array(
                        'label' => $row->nama_lengkap,
                        'nis' => $row->nis,
                        'id_santri' => $row->id_santri,
                    );
                }
                echo json_encode($arr_result);
            }
        }
    }

    public function get_spp()
    {
        if (isset($_GET['term'])) {

            $result = $this->santri->search_spp($_GET['term']);

            if (count($result) > 0) {
                foreach ($result as $row) {
                    $arr_result[] =  array(
                        'label' => $row->nis,
                        'nama_lengkap' => $row->nama_lengkap,
                        'id_santri' => $row->id_santri,
                        'id_kelas' => $row->id_kelas,
                    );
                }
                echo json_encode($arr_result);
            }
        }
    }
}
