<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrangtuaModel;
use App\Models\SantriModel;
use App\Models\WilayahModel;
use App\Models\RegenciesModel;
use App\Models\DistrictsModel;
use App\Models\VillagesModel;
use App\Models\TagihanModel;
use App\Models\KeuanganModel;

class Register extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->santri = new SantriModel();
        $this->ortu = new OrangtuaModel();
        $this->wilayah = new WilayahModel();
        $this->kabupaten = new RegenciesModel();
        $this->kecamatan = new DistrictsModel();
        $this->desa = new VillagesModel();
        $this->keuangan = new KeuanganModel();
        $this->tagihan = new TagihanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pendaftaran',
            'validation' => \Config\Services::validation(),
            'wilayah' => $this->wilayah->get_provinsi(),
            'pendaftaran' => $this->tagihan->select('jumlah_pembayaran')->where('nama_pembayaran', 'uang pendaftaran')->findAll(),
        ];
        return view('register/index', $data);
    }


    public function simpanData()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $nik_ktp = $this->request->getVar('nik_ktp');
            $no_kk = $this->request->getVar('no_kk');
            $nama_lengkap = $this->request->getVar('nama_lengkap');
            $email = $this->request->getVar('email');
            $jenis_kelamin = $this->request->getVar('jenis_kelamin');
            $tempat_lahir = $this->request->getVar('tempat_lahir');
            $tanggal_lahir = $this->request->getVar('tanggal_lahir');
            $alamat = $this->request->getVar('alamat');
            $desa_kelurahan = $this->request->getVar('desa_kelurahan');
            $kecamatan = $this->request->getVar('kecamatan');
            $kabupaten = $this->request->getVar('kabupaten');
            $provinsi = $this->request->getVar('provinsi');
            $no_hp_santri = $this->request->getVar('no_hp_santri');
            $catatan_medis = $this->request->getVar('catatan_medis');
            $pendidikan_terakhir = $this->request->getVar('pendidikan_terakhir');
            $pengalaman_mondok = $this->request->getVar('pengalaman_mondok');
            $pendidikan_sekarang = $this->request->getVar('pendidikan_sekarang');
            $gol_darah = $this->request->getVar('gol_darah');
            $nisn_nim = $this->request->getVar('nisn_nim');
            $nama_almet = $this->request->getVar('nama_almet');
            $kelas_semester = $this->request->getVar('kelas_semester');
            $jurusan = $this->request->getVar('jurusan');
            $jenis_kendaraan = $this->request->getVar('jenis_kendaraan');
            $plat_nomor = $this->request->getVar('plat_nomor');
            $nama_ayah = $this->request->getVar('nama_ayah');
            $nama_ibu = $this->request->getVar('nama_ibu');
            $no_hp_wali = $this->request->getVar('no_hp_wali');
            $pekerjaan_ortu = $this->request->getVar('pekerjaan_ortu');
            $valid = $this->validate('saveRegister');
            $valid_nik = $this->validate([
                'nik_ktp' => [
                    'rules' => 'required|numeric|min_length[16]|max_length[16]|is_unique[santri.nik_ktp]',
                    'errors' => [
                        'required' => 'NIK KTP harus diisi!',
                        'numeric' => 'NIK KTP harus angka!',
                        'is_unique' => 'NIK KTP TELAH TERDAFTAR !!!',
                        'min_length' => 'Nik KTP kurang dari 16'
                    ]
                ]
            ]);

            if (!$valid || !$valid_nik) {
                $data = [
                    'error' => [
                        'errorNik' => $validation->getError('nik_ktp'),
                        'errorNokk' => $validation->getError('no_kk'),
                        'errorNama' => $validation->getError('nama_lengkap'),
                        'errorEmail' => $validation->getError('email'),
                        'errorTempatlahir' => $validation->getError('tempat_lahir'),
                        'errorTanggal' => $validation->getError('tanggal_lahir'),
                        'errorProvinsi' => $validation->getError('provinsi'),
                        'errorKabupaten' => $validation->getError('kabupaten'),
                        'errorKecamatan' => $validation->getError('kecamatan'),
                        'errorDesa' => $validation->getError('desa_kelurahan'),
                        'errorAlamat' => $validation->getError('alamat'),
                        'errornohpSantri' => $validation->getError('no_hp_santri'),
                        'errorgolDarah' => $validation->getError('gol_darah'),
                        'errorjenisKelamin' => $validation->getError('jenis_kelamin'),
                        'errorPengalaman' => $validation->getError('pengalaman_mondok'),
                        'errorMedis' => $validation->getError('catatan_medis'),
                        'errorPendidikan_sekarang' => $validation->getError('pendidikan_sekarang'),
                        'errorPendidikan_terakhir' => $validation->getError('pendidikan_terakhir'),
                        'errorNis' => $validation->getError('nisn_nim'),
                        'errorAlmet' => $validation->getError('nama_almet'),
                        'errorJurusan' => $validation->getError('jurusan'),
                        'errorKelas' => $validation->getError('kelas_semester'),
                        'errornamaAyah' => $validation->getError('nama_ayah'),
                        'errornamaIbu' => $validation->getError('nama_ibu'),
                        'errornohpWali' => $validation->getError('no_hp_wali'),
                        'errorPekerjaan' => $validation->getError('pekerjaan_ortu'),
                        'errorKendaraan' => $validation->getError('jenis_kendaraan'),
                        'errorPlat' => $validation->getError('plat_nomor'),
                    ]
                ];
                session()->setFlashdata('error', 'Data pendaftaran gagal ditambahkan');
            } else {
                $this->ortu->save([
                    'nama_ayah' => $nama_ayah,
                    'nama_ibu' => $nama_ibu,
                    'no_hp_wali' => $no_hp_wali,
                    'pekerjaan_ortu' => $pekerjaan_ortu,
                ]);
                $idOrtu = $this->ortu->getID();
                $this->santri->save([
                    'nik_ktp' => $nik_ktp,
                    'no_kk' => $no_kk,
                    'nama_lengkap' => $nama_lengkap,
                    'email' => $email,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat' => $alamat,
                    'desa_kelurahan' => $desa_kelurahan,
                    'kecamatan' => $kecamatan,
                    'kabupaten' => $kabupaten,
                    'provinsi' => $provinsi,
                    'no_hp_santri' => $no_hp_santri,
                    'catatan_medis' => $catatan_medis,
                    'pendidikan_terakhir' => $pendidikan_terakhir,
                    'pengalaman_mondok' => $pengalaman_mondok,
                    'pendidikan_sekarang' => $pendidikan_sekarang,
                    'gol_darah' => $gol_darah,
                    'nisn_nim' => $nisn_nim,
                    'nama_almet' => $nama_almet,
                    'kelas_semester' => $kelas_semester,
                    'jurusan' => $jurusan,
                    'jenis_kendaraan' => $jenis_kendaraan,
                    'plat_nomor' => $plat_nomor,
                    'id_orangtua' => $idOrtu,
                    'status' => 'Baru',
                    'updated_at' => null
                ]);
                $id = $this->santri->getID();

                $jmlh = $this->request->getVar('jumlah_pembayaran');
                $this->keuangan->save([
                    'id_tagihan' => '3',
                    'id_santri' => $id,
                    'waktu' => date("Y-m-d h:i"),
                    'periode' => Date("Y-m-d h:i", strtotime("+30 days")),
                    'jumlah_bayar' => '0',
                    'jumlah_tagihan' =>  $jmlh,
                ]);
                session()->setFlashdata('message', 'Data pendaftaran berhasil ditambahkan');
                $data = [
                    'sukses' => 'Pendaftaran berhasil'
                ];
            }
        }
        echo json_encode($data);
    }
    public  function Get_kabupaten($provinsi_id)
    {

        if ($provinsi_id != '') {
            echo $this->kabupaten->get_kabupaten($provinsi_id);
        }
    }
    //request data kecamatan berdasarkan id kabupaten yang dipilih
    public  function Get_kecamatan($kabupaten_id)
    {
        if ($this->request->isAJAX()) {

            if ($kabupaten_id != '') {
                echo $this->kecamatan->get_kecamatan($kabupaten_id);
            }
        }
    }

    //request data desa berdasarkan id kecamatan yang dipilih
    public function Get_desa($kecamatan_id)
    {
        if ($this->request->isAJAX()) {

            if ($kecamatan_id != '') {
                echo $this->desa->get_desa($kecamatan_id);
            }
        }
    }
}
