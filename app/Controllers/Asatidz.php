<?php

namespace App\Controllers;

use App\Models\AsatidzModel;
use App\Models\ProgramModel;
use App\Models\KelasModel;
use App\Models\WilayahModel;

class Asatidz extends BaseController
{
    public function __construct()
    {
        $this->program = new ProgramModel();
        $this->asatidzModel = new AsatidzModel();
        $this->kelasModel = new KelasModel();
        $this->provinsi = new WilayahModel();
        if (session()->get('username')) {
            return redirect()->to('dashboard/asatidz');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Data Asatidz',
            'asatidz' => $this->asatidzModel->findAll(),
        ];

        return view('asatidz/index', $data);
    }

    public function profil()
    {
        $data = [
            'title' => 'Profil',
            'validate' => \Config\Services::validation(),
            'asatidz' => $this->asatidzModel->where('username', session()->get('username'))->first(),
        ];
        return view('asatidz/profil', $data);
    }
    public function editprofil()
    {
        if (!$this->validate(
            [
                'nama_lengkap' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'nama harus di isi!!',
                    ]
                ],
                'no_hp' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'Nomor Hp harus di isi!!',
                    ]
                ],
                'email' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'email harus di isi!!',
                    ]
                ],
                'tempat_lahir' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'Tempat Tanggal Lahir harus di isi!!',
                    ]
                ],
                'alamat' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'alamat harus di isi!!',
                    ]
                ],
                'pendidikan' => [
                    'rules' => 'trim|required',
                    'errors' => [
                        'Riwayat Pendidikan harus di isi!!',
                    ]
                ],
            ]
        )) {

            return redirect()->to('/asatidz/profil/' . $this->request->getVar('username'))->withInput();
        }

        $this->asatidzModel->save(

            [
                'id' => $this->request->getVar('id'),
                'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                'no_hp' => $this->request->getVar('no_hp'),
                'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                'alamat' => $this->request->getVar('alamat'),
                'pendidikan' => $this->request->getVar('pendidikan'),
            ]
        );

        session()->setFlashdata('message', 'Data Berhasil Di Ubah');

        return redirect()->to('/asatidz/profil');
    }
    public function delete($id)
    {
        $this->asatidzModel->delete($id);
        session()->setFlashdata('message', 'Data asatidz berhasil dihapus!');
        return redirect()->to('/asatidz');
    }

    public function create()
    {
        $data = [
            'title' => 'Data Asatidz',
            'validation' => \Config\Services::validation(),
            'provinsi' => $this->provinsi->get_provinsi(),
            'program' => $this->program->findAll(),
        ];

        return view('asatidz/add', $data);
    }

    public function save()
    {
        if (!$this->validate('havePasswordAsatidz')) {
            return redirect()->to('/asatidz/add')->withInput();
        }
        $this->asatidzModel->save([
            'username' => $this->request->getVar('username'),
            'nik_ktp' => $this->request->getVar('nik_ktp'),
            'no_kk' => $this->request->getVar('no_kk'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'email' => $this->request->getVar('email'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'alamat' => $this->request->getVar('alamat'),
            'no_hp' => $this->request->getVar('no_hp'),
            'pendidikan' => $this->request->getVar('pendidikan'),
            'id_program' => $this->request->getVar('id_program'),
            'provinsi' => $this->request->getVar('provinsi'),
            'kabupaten' => $this->request->getVar('kabupaten'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'desa_kelurahan' => $this->request->getVar('desa_kelurahan'),
        ]);
        session()->setFlashdata('message', 'Data Asatidz berhasil ditambahkan!');

        return redirect()->to('/asatidz');
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Data Asatidz',
            'asatidz' => $this->asatidzModel->where('id', $id)->first(),
        ];

        return view('asatidz/detail', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Asatidz',
            'validation' => \Config\Services::validation(),
            'asatidz' => $this->asatidzModel->edit($id),
            'program' => $this->program->findAll(),
            'provinsi' => $this->asatidzModel->Get_provinsi($id),
            'kabupaten' => $this->asatidzModel->Get_kabupaten($id),
            'kecamatan' => $this->asatidzModel->Get_kecamatan($id),
            'desa' => $this->asatidzModel->Get_desa($id),
            'wilayah' => $this->provinsi->get_provinsi(),
        ];

        return view('asatidz/edit', $data);
    }

    public function update($id)
    {
        if ($this->request->getVar('password') == '') {
            if (!$this->validate('noPasswordAsatidz') || !$this->validate([
                'nik_ktp' => ['rules' => "required|numeric|min_length[16]|max_length[16]|is_unique[asatidz.nik_ktp,id,$id]"]
            ])) {
                return redirect()->to('/asatidz/edit/' .  $id)->withInput();
            }
            $data = [
                'nik_ktp' => $this->request->getVar('nik_ktp'),
                'no_kk' => $this->request->getVar('no_kk'),
                'username' => $this->request->getVar('username'),
                'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                'email' => $this->request->getVar('email'),
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                'alamat' => $this->request->getVar('alamat'),
                'id_program' => $this->request->getVar('id_program'),
                'no_hp' => $this->request->getVar('no_hp'),
                'pendidikan' => $this->request->getVar('pendidikan'),
                'provinsi' => $this->request->getVar('provinsi'),
                'kabupaten' => $this->request->getVar('kabupaten'),
                'kecamatan' => $this->request->getVar('kecamatan'),
                'desa_kelurahan' => $this->request->getVar('desa_kelurahan'),
            ];
            $this->asatidzModel->update(['id' => $id], $data);
            session()->setFlashdata('message', 'Data asatidz berhasil diubah!');

            return redirect()->to('/asatidz');
        } else {
            if (!$this->validate('havePasswordAsatidz') || !$this->validate([
                'nik_ktp' => ['rules' => "required|numeric|min_length[16]|max_length[16]|is_unique[asatidz.nik_ktp,id,$id]"]
            ])) {
                return redirect()->to('/asatidz/edit/' .  $id)->withInput();
            }
            $data = [
                'nik_ktp' => $this->request->getVar('nik_ktp'),
                'no_kk' => $this->request->getVar('no_kk'),
                'username' => $this->request->getVar('username'),
                'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                'email' => $this->request->getVar('email'),
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                'alamat' => $this->request->getVar('alamat'),
                'id_program' => $this->request->getVar('id_program'),
                'no_hp' => $this->request->getVar('no_hp'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'pendidikan' => $this->request->getVar('pendidikan'),
                'provinsi' => $this->request->getVar('provinsi'),
                'kabupaten' => $this->request->getVar('kabupaten'),
                'kecamatan' => $this->request->getVar('kecamatan'),
                'desa_kelurahan' => $this->request->getVar('desa_kelurahan'),
            ];
            $this->asatidzModel->update(['id' => $id], $data);
            session()->setFlashdata('message', 'Data asatidz berhasil diubah!');
            return redirect()->to('/asatidz');
        }
    }

    public function detailAsatidz($id)
    {
        $data = $this->asatidzModel->get_detail($id);
        echo json_encode($data);
    }
    public function softDel($id)
    {
        $data = $this->asatidzModel->get_softDel($id);
        echo json_encode($data);
    }
    public function btn_softDel()
    {
        $id = $this->request->getVar('id');
        if ($this->request->isAJAX()) {
            $this->asatidzModel->save([
                'id' => $id,
                'deleted_at' => date("Y-m-d h:i"),
            ]);
            session()->setFlashdata('message', 'Data berhasil di hapus');
            $data = ['sukses' => 'Data berhasil di hapus',];
        }
        echo json_encode($data);
    }
}
