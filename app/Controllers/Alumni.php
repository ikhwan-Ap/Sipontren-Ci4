<?php

namespace App\Controllers;

use App\Models\SantriModel;
use Config\Security;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class Alumni extends BaseController
{
    public function __construct()
    {
        helper('url');
        $this->santri = new SantriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Alumni',
            'alumni' => $this->santri->where('status', 'Alumni')->findAll(),
        ];

        return view('alumni/index', $data);
    }

    public function getAlumni()
    {

        $this->santri = new SantriModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->santri->datatablesAlumni();
            $row = array();
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="deleteAlumni(' . $hasil->id_santri . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="edit_alumni( ' . $hasil->id_santri . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                <button type="button" class="btn btn-light" onclick="btnDetail('  . $hasil->id_santri  . ')"title="EDIT">
                        <span class="ion ion-android-open" data-pack="android" data-tags=""></span>
                </button>
                ';
                $row[] =

                    [
                        $no++,
                        $hasil->nis,
                        $hasil->nama_lengkap,
                        $hasil->alamat,
                        $hasil->jenis_kelamin,
                        $hasil->no_hp_santri,
                        $hasil->status,
                        $action,

                    ];
            }
            $output = [
                'recordsTotal' => $this->santri->countAll(),
                'recordsFiltered' => $this->santri->countFiltered(),
                'data' => $row
            ];
            $output[$csrfName] = $csrfHash;
            echo json_encode($output);
        }
    }

    public function delAlumni()
    {
        $id = $this->request->getPost('id_santri');
        $data =  $this->santri->delete(['id_santri' => $id]);
        echo json_encode($data);
    }

    public function add_alumni()
    {
        $validation = \Config\Services::validation();



        if ($this->request->isAJAX()) {
            $nis = $this->request->getVar('nis');
            $no_kk = $this->request->getVar('no_kk');
            $nik_ktp = $this->request->getVar('nik_ktp');
            $nama_lengkap = $this->request->getVar('nama_lengkap');
            $email = $this->request->getVar('email');
            $tempat_lahir = $this->request->getVar('tempat_lahir');
            $tanggal_lahir = $this->request->getVar('tanggal_lahir');
            $alamat = $this->request->getVar('alamat');
            $no_hp_santri = $this->request->getVar('no_hp_santri');
            $jenis_kelamin = $this->request->getVar('jenis_kelamin');
            $pendidikan_terakhir = $this->request->getVar('pendidikan_terakhir');
            $pendidikan_sekarang = $this->request->getVar('pendidikan_sekarang');

            $valid = $this->validate([
                'nis' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'nis harus diisi!',
                    ]
                ],
                'nik_ktp' => [
                    'rules' => 'required|numeric|min_length[16]|max_length[16]|is_unique[santri.nik_ktp]',
                    'errors' => [
                        'required' => 'NIK KTP harus diisi!',
                        'numeric' => 'NIK KTP harus angka!',
                        'is_unique' => 'NIK KTP TELAH TERDAFTAR !!!',
                        'min_length' => 'Nik KTP kurang dari 16'
                    ]
                ],
                'no_kk' => [
                    'rules' => 'required|numeric|min_length[16]|max_length[16]',
                    'errors' => [
                        'required' => 'No KK harus diisi!',
                        'numeric' => 'No KK harus angka!',
                        'min_length' => 'Nomor KK kurang dari 16 !!!'
                    ]
                ],
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Lengkap harus diisi!',
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email harus diisi!',
                        'valid_email' => 'Email tidak valid!',
                    ]
                ],
                'jenis_kelamin' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Kelamin harus diisi!',
                    ]
                ],
                'tempat_lahir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tempat Lahir harus diisi!',
                    ]
                ],
                'tanggal_lahir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Lahir harus diisi!',
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat harus diisi!',
                    ]
                ],
                'no_hp_santri' => [
                    'rules' => 'required|numeric|min_length[11]|max_length[16]',
                    'errors' => [
                        'required' => 'No HP harus diisi!',
                        'numeric' => 'No HP harus angka!',
                    ]
                ],
                'pendidikan_terakhir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'pendidikan terakhir harus diisi!',
                    ]
                ],
                'pendidikan_sekarang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'pendidikan harus diisi!',
                    ]
                ],
            ]);


            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNik' => $validation->getError('nik_ktp'),
                        'errorNis' => $validation->getError('nis'),
                        'errorNokk' => $validation->getError('no_kk'),
                        'errorNama' => $validation->getError('nama_lengkap'),
                        'errorEmail' => $validation->getError('email'),
                        'errorTempatlahir' => $validation->getError('tempat_lahir'),
                        'errorTanggal' => $validation->getError('tanggal_lahir'),
                        'errorjenisKelamin' => $validation->getError('jenis_kelamin'),
                        'errorAlamat' => $validation->getError('alamat'),
                        'errornohpSantri' => $validation->getError('no_hp_santri'),
                        'errorPendidikan_sekarang' => $validation->getError('pendidikan_sekarang'),
                        'errorPendidikan_terakhir' => $validation->getError('pendidikan_terakhir'),
                    ],
                ];
            } else {
                $this->santri->save([
                    'nis' => $this->request->getVar('nis'),
                    'nik_ktp' => $this->request->getVar('nik_ktp'),
                    'no_kk' => $this->request->getVar('no_kk'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'email' => $this->request->getVar('email'),
                    'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                    'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                    'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_hp_santri' => $this->request->getVar('no_hp_santri'),
                    'status' => 'Alumni',
                    'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
                    'pendidikan_sekarang' => $this->request->getVar('pendidikan_sekarang'),
                ]);

                session()->setFlashdata('message', 'Data Alumni Berhasil Di Tambahkan');

                $data = [
                    'sukses' => 'Data berhasil di tambahkan',
                ];
            }

            echo json_encode($data);
        }
    }

    public function edit_alumni($id_santri)
    {
        $data = $this->santri->get_by_id($id_santri);
        echo json_encode($data);
    }

    public function getData($id_santri)
    {
        $data = $this->santri->get_by_id($id_santri);
        echo json_encode($data);
    }

    public function deleteAlumni()
    {
        $id_santri = $this->request->getVar('id_santri');
        $data =  $this->santri->delAlumni($id_santri);
        $data = [
            'sukses' => 'Data berhasil di hapus',
        ];
        echo json_encode($data);
    }

    public function softDelete()
    {
        $id_santri = $this->request->getVar('id_santri');
        $this->santri->save([
            'id_santri' => $id_santri,
            'deleted_at' => date("Y-m-d h:i"),
        ]);
        $data = [
            'sukses' => 'Data berhasil di hapus',
        ];
        echo json_encode($data);
    }

    public function update_alumni()
    {
        $validation = \Config\Services::validation();



        if ($this->request->isAJAX()) {

            $id_santri = $this->request->getVar('id_santri');


            $valid = $this->validate([
                'nis' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'nis harus diisi!',
                    ]
                ],
                'nik_ktp' => [
                    'rules' => "required|numeric|min_length[16]|max_length[16]|is_unique[santri.nik_ktp,id_santri,$id_santri]",
                    'errors' => [
                        'required' => 'NIK KTP harus diisi!',
                        'numeric' => 'NIK KTP harus angka!',
                        'min_length' => 'Nik KTP kurang dari 16',
                        'is_unique' => 'Nik KTP Telah tersedia'
                    ]
                ],
                'no_kk' => [
                    'rules' => 'required|numeric|min_length[16]|max_length[16]',
                    'errors' => [
                        'required' => 'No KK harus diisi!',
                        'numeric' => 'No KK harus angka!',
                        'min_length' => 'Nomor KK kurang dari 16 !!!'
                    ]
                ],
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Lengkap harus diisi!',
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Email harus diisi!',
                        'valid_email' => 'Email tidak valid!',
                    ]
                ],
                'jenis_kelamin' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Kelamin harus diisi!',
                    ]
                ],
                'tempat_lahir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tempat Lahir harus diisi!',
                    ]
                ],
                'tanggal_lahir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Lahir harus diisi!',
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat harus diisi!',
                    ]
                ],
                'no_hp_santri' => [
                    'rules' => 'required|numeric|min_length[11]|max_length[16]',
                    'errors' => [
                        'required' => 'No HP harus diisi!',
                        'numeric' => 'No HP harus angka!',
                    ]
                ],
                'pendidikan_terakhir' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'pendidikan terakhir harus diisi!',
                    ]
                ],
                'pendidikan_sekarang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'pendidikan harus diisi!',
                    ]
                ],
            ]);


            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNik' => $validation->getError('nik_ktp'),
                        'errorNis' => $validation->getError('nis'),
                        'errorNokk' => $validation->getError('no_kk'),
                        'errorNama' => $validation->getError('nama_lengkap'),
                        'errorEmail' => $validation->getError('email'),
                        'errorTempatlahir' => $validation->getError('tempat_lahir'),
                        'errorTanggal' => $validation->getError('tanggal_lahir'),
                        'errorjenisKelamin' => $validation->getError('jenis_kelamin'),
                        'errorAlamat' => $validation->getError('alamat'),
                        'errornohpSantri' => $validation->getError('no_hp_santri'),
                        'errorPendidikan_sekarang' => $validation->getError('pendidikan_sekarang'),
                        'errorPendidikan_terakhir' => $validation->getError('pendidikan_terakhir'),
                    ],
                ];
            } else {
                $data = [
                    'nis' => $this->request->getVar('nis'),
                    'nik_ktp' => $this->request->getVar('nik_ktp'),
                    'no_kk' => $this->request->getVar('no_kk'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'email' => $this->request->getVar('email'),
                    'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                    'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                    'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_hp_santri' => $this->request->getVar('no_hp_santri'),
                    'status' => 'Alumni',
                    'pendidikan_terakhir' => $this->request->getVar('pendidikan_terakhir'),
                    'pendidikan_sekarang' => $this->request->getVar('pendidikan_sekarang'),
                ];

                $this->santri->updateAlumni($id_santri, $data);



                $data = [
                    'sukses' => 'Data berhasil di Ubah',
                ];
            }

            echo json_encode($data);
        }
    }
    public function get_status()
    {
        if (isset($_GET['term'])) {
            $result = $this->santri->search_status($_GET['term']);

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
