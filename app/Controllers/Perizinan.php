<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PerizinanModel;
use App\Models\SantriModel;

class Perizinan extends BaseController
{
    public function __construct()
    {
        $this->santri = new SantriModel();
        $this->perizinan = new PerizinanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Perizinan',
            'izin' => $this->perizinan->getKeamanan(),
            'validation' => \Config\Services::validation(),
        ];

        return view('perizinan/index', $data);
    }

    public function keamanan()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'title' => 'Perizinan',
            'izin' => $this->perizinan->getKeamanan(),
        ];

        return view('perizinan/keamanan', $data);
    }

    public function save()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_santri = $this->request->getVar('id_santri');
            $tanggal_izin = $this->request->getVar('tanggal_izin');
            $tanggal_estimasi = $this->request->getVar('tanggal_estimasi');
            $keterangan = $this->request->getVar('keterangan');
            $user_penginput = $this->request->getVar('user_penginput');
            if (!$this->validate('savePerizinan')) {
                $data = [
                    'error' => [
                        'errorNis' => $validation->getError('nis'),
                        'errorNama' => $validation->getError('nama_lengkap'),
                        'errorKeterangan' => $validation->getError('keterangan'),
                        'errorIzin' => $validation->getError('tanggal_izin'),
                        'errorEstimasi' => $validation->getError('tanggal_estimasi'),
                    ]
                ];
            } else {
                if ($tanggal_estimasi < $tanggal_izin) {
                    $data = ['fail' => 'Tanggal Estimasi Dan Tanggal Izin Tidak Relevan'];
                } else {
                    $this->perizinan->save([
                        'id_santri' => $id_santri,
                        'keterangan' => $keterangan,
                        'tanggal_izin' => $tanggal_izin,
                        'tanggal_estimasi' => $tanggal_estimasi,
                        'user_penginput' => $user_penginput
                    ]);
                    $data = ['sukses' => 'Data Perizinan Berhasil Di Tambahkan'];
                    session()->setFlashdata('message', 'Data perizinan berhasil ditambahkan!');
                }
            }
        }
        echo json_encode($data);
    }

    public function terima($id_izin)
    {
        $this->perizinan->update(['id_izin' => $id_izin], ['tanggal_diterima' => date("Y-m-d h:i:s", time()),]);
        session()->setFlashdata('message', 'Data Perizinan Berhasil Di Terima');
        $data = ['sukses' => 'Perizinan Berhasil Di Terima'];
        echo json_encode($data);
    }

    public function pulang($id_izin)
    {
        $this->perizinan->update(['id_izin' => $id_izin], [
            'tanggal_pulang' => date("Y-m-d h:i:s", time()),
            'user_update' => session()->get('name'),
        ]);
        session()->setFlashdata('message', 'Data Santri Pulang Berhasil Di Inputkan');
        $data = ['sukses' => 'Data Berhasil Di Inputkan'];
        echo json_encode($data);
    }
    public function pulang_keamanan($id_izin)
    {
        $this->perizinan->update(['id_izin' => $id_izin], [
            'tanggal_pulang' => date("Y-m-d h:i:s", time()),
            'user_update' => session()->get('name')
        ]);

        return redirect()->to('/perizinan/keamanan');
    }

    public function tolak($id_izin)
    {
        $this->perizinan->update(['id_izin' => $id_izin], ['tanggal_ditolak' => date("Y-m-d h:i:s", time()),]);
        session()->setFlashdata('message', 'Perizinan  Berhasil Di Tolak');
        $data = ['sukses' => 'Data Berhasil Di Inputkan'];
        echo json_encode($data);
    }

    public function delete($id_izin)
    {
        $this->perizinan->delete($id_izin);
        session()->setFlashdata('message', 'Data Perizinan Berhasil Di Hapus');
        $data = ['sukses' => 'Data Berhasil Di Hapus'];
        echo json_encode($data);
    }

    public function terlambat()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_izin = $this->request->getVar('id_terlambat');
            $ket_terlambat = $this->request->getVar('ket_terlambat');
            $user_update = $this->request->getVar('user_update');
            $valid = $this->validate([
                'ket_terlambat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keterangan Terlambat harus diisi!',
                    ]
                ],
            ]);
            if (!$valid) {
                $data = ['error' => ['errorTerlambat' => $validation->getError('ket_terlambat')]];
            } else {
                $this->perizinan->update(['id_izin' => $id_izin], [
                    'tanggal_pulang' => date("Y-m-d h:i:s", time()),
                    'ket_terlambat' => $ket_terlambat,
                    'user_update' => $user_update,
                ]);
                session()->setFlashdata('message', 'Keterangan Berhasil Di Tambah');
                $data = ['sukses' => 'Data berhasil Di Inputkan'];
            }
        }
        echo json_encode($data);
    }

    public function riwayat()
    {
        $data = [
            'title' => 'Riwayat Perizinan',
            'izin' => $this->perizinan->getIzin(),
        ];

        return view('perizinan/riwayat', $data);
    }

    public function detailRiwayatIzin($id_izin)
    {
        $data = [
            'title' => 'Detail Riwayat Perizinan',
            'izin' => $this->perizinan->getIzin($id_izin),
        ];

        return view('perizinan/detail_riwayat', $data);
    }

    public function get_id($id_izin)
    {
        $data = $this->perizinan->get_id($id_izin);
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
