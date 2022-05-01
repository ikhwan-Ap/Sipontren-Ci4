<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;


class SantriModel extends Model
{
    protected $table            = 'santri';
    protected $primaryKey       = 'id_santri';
    protected $useSoftDeletes = true;
    protected $allowedFields    = [
        'nis', 'nik_ktp', 'no_kk', 'password', 'email', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
        'alamat', 'desa_kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'jurusan', 'jenis_kendaraan', 'plat_nomor',
        'no_hp_santri', 'id_kamar', 'id_diniyah', 'id_program', 'id_kelas', 'id_tagihan', 'catatan_medis',
        'pendidikan_terakhir', 'pengalaman_mondok', 'pendidikan_sekarang', 'gol_darah',
        'nama_almet', 'kelas_semester', 'nisn_nim', 'id_orangtua', 'status', 'created_at', 'updated_at', 'deleted_at'
    ];
    protected $column_search = [
        'nis', 'nama_lengkap', 'alamat', 'jenis_kelamin',
        'no_hp_santri', 'status'
    ];
    protected $column_order = [
        'nis', 'nik_ktp', 'no_kk', 'password', 'email', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
        'alamat', 'desa_kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'jurusan', 'jenis_kendaraan', 'plat_nomor',
        'no_hp_santri', 'id_kamar', 'id_diniyah', 'id_program', 'id_kelas', 'id_tagihan', 'catatan_medis',
        'pendidikan_terakhir', 'pengalaman_mondok', 'pendidikan_sekarang', 'gol_darah',
        'nama_almet', 'kelas_semester', 'nisn_nim', 'id_orangtua', 'status', 'created_at', 'updated_at', 'deleted_at'
    ];

    protected $order = ['id_santri' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;
    protected $deletedField  = 'deleted_at';
    protected $session;
    protected $useTimestamps = true;


    public function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
        $this->dt = $this->db->table($this->table);
    }


    private function getDataTables()
    {

        $request = Services::request();
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $request->getPost('search')['value']);
                }
                if (count($this->column_search)  - 1 == $i) {
                    $this->dt->groupEnd();
                }
                $i++;
            }
            if ($request->getPost('order')) {
                $this->dt->orderBy(
                    $this->column_order[$request->getPost('order')['0']['column']],
                    $request->getPost('order')['0']['dir']
                );
            } else {
                $order = $this->order;
                $this->dt->orderBy(key($order), $order[key($order)]);
            }
        }
    }

    public function datatablesAlumni()
    {
        $request = Services::request();
        $this->getDataTables();
        if ($request->getPost('length') != -1)
            $this->dt
                ->where('status', 'Alumni')
                ->where('deleted_at', null)
                ->limit($request->getPost('length'), $request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFiltered()
    {
        $this->getDataTables();
        return $this->dt->countAllResults();
    }

    public function countAll()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }

    public function get_by_id($id_santri)
    {
        $this->dt
            ->where('id_santri', $id_santri);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
    public function get_santri($id_santri)
    {
        $this->dt
            ->select('*')
            ->select('provinces.name as nama_provinsi')
            ->select('regencies.name as nama_kabupaten')
            ->select('districts.name as nama_kecamatan')
            ->select('villages.name as nama_desa')
            ->where('santri.id_santri', $id_santri)
            ->join('provinces', 'provinces.id = santri.provinsi', 'left')
            ->join('regencies', 'regencies.id = santri.kabupaten', 'left')
            ->join('districts', 'districts.id = santri.kecamatan', 'left')
            ->join('villages', 'villages.id = santri.desa_kelurahan', 'left')
            ->join('kelas', 'kelas.id_kelas = santri.id_kelas', 'left')
            ->join('diniyah', 'diniyah.id_diniyah = santri.id_diniyah', 'left')
            ->join('kamar', 'kamar.id_kamar = santri.id_kamar', 'left')
            ->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua', 'left')
            ->join('program', 'program.id_program = santri.id_program', 'left');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_spp($array)
    {
        $this->dt
            ->where($array);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_tagihan($id_santri)
    {
        $this->dt
            ->selectSum('keuangan.jumlah_tagihan', 'jumlah_tagihan')
            ->where('santri.id_santri', $id_santri)
            ->where('keuangan.id_tagihan', '27')
            ->groupBy('keuangan.id_keuangan')
            ->join('keuangan', 'keuangan.id_santri = santri.id_santri');
        $query = $this->dt->get();
        return $query->getRowArray();
    }
    public function get_tagihan_kelas($id_santri)
    {
        $this->dt
            ->select('keuangan.id_tagihan')
            ->where('santri.id_santri', $id_santri)
            ->where('keuangan.id_tagihan', '27')
            ->join('keuangan', 'keuangan.id_kelas = santri.id_kelas');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function updateAlumni($id_santri, $data)
    {
        $this->dt->where('id_santri', $id_santri);
        return $this->dt->update($data);
    }
    public function softDelete($id_santri, $data)
    {
        $this->dt->where('id_santri', $id_santri);
        return $this->dt->update($data);
    }

    public function delAlumni($id_santri)
    {
        $this->dt->where('id_santri', $id_santri);
        return $this->dt->delete();
    }
    public function get_id_santri($id_santri)
    {
        $this->dt->select('id_santri')
            ->where('id_santri', $id_santri);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_id($id_santri)
    {
        $this->dt->select('*')
            ->where('id_santri', $id_santri);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function getSantriNew($id = false)
    {
        if ($id == false) {
            return $this->db->table('santri')->select('*')->where('status', 'Baru')->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->get()->getResultArray();
        }

        return $this->db->table('santri')->select('*')->where(['id_santri' => $id, 'status' => 'Baru'])->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->get()->getRowArray();
    }

    public function getSantriNonActive()
    {
        return $this->db->table('santri')->select('*')->where('status', 'Non Aktif')

            ->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')
            ->get()->getResultArray();
    }

    public function getSantriActive()
    {
        $builder = $this->db->table('santri');
        $builder->select('*');
        $builder->where('status', 'Aktif');
        $builder->where('id_diniyah IS NOT NULL', null, false);
        $builder->where('id_kamar IS NOT NULL', null, false);
        $builder->where('id_kelas IS NOT NULL', null, false);
        $builder->where('id_program IS NOT NULL', null, false);
        $builder->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function konfirmasiAktif()
    {
        $builder = $this->db->table('santri');
        $builder->select('*');
        $builder->where('status', 'Aktif');
        $builder->where('id_diniyah', null);
        $builder->where('id_kamar', null);
        $builder->where('id_kelas', null);
        $builder->where('id_program', null);
        $builder->where('provinsi', '0');
        $builder->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function konfirmasiBaru()
    {
        $provinsi = ['0'];
        $builder = $this->db->table('santri');
        $builder->select('*');
        $builder->where('status', 'Baru');
        $builder->where('id_diniyah', null);
        $builder->where('id_kamar', null);
        $builder->where('id_kelas', null);
        $builder->where('id_program', null);
        $builder->where('updated_at IS NOT NULL', null, false);
        $builder->whereNotIn('provinsi', $provinsi);
        $builder->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getLogin($nis)
    {
        return $this->db->table($this->table)->getWhere(['nis' => $nis])->getRowArray();
    }

    public function getSantriAlumni()
    {
        return $this->db->table('santri')->select('*')
            ->where('status', 'Alumni')
            ->get()->getResultArray();
    }
    public function getAlumni($id)
    {
        return $this->db->table('santri')->select('*')
            ->where('status', 'Alumni')
            ->where('santri.id_santri', $id)
            ->get()->getRowArray();
    }

    public function getSantri($id = false)
    {
        if ($id == false) {
            return $this->db->table('santri')->select('*')->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->get()->getResultArray();
        }
        return $this->db->table('santri')->select('*')->where('id_santri', $id)
            ->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')
            ->join('kamar', 'kamar.id_kamar=santri.id_kamar')
            ->join('diniyah', 'diniyah.id_diniyah=santri.id_diniyah')
            ->join('program', 'program.id_program=santri.id_program')
            ->join('kelas', 'kelas.id_kelas=santri.id_kelas')
            ->get()->getRowArray();
    }
    public function getSantri_non($id)
    {
        return $this->db->table('santri')
            ->select('*')
            ->where('id_santri', $id)
            ->where('status', 'Non Aktif')
            ->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')
            ->join('kamar', 'kamar.id_kamar=santri.id_kamar')
            ->join('diniyah', 'diniyah.id_diniyah=santri.id_diniyah')
            ->join('program', 'program.id_program=santri.id_program')
            ->join('kelas', 'kelas.id_kelas=santri.id_kelas')
            ->get()->getRowArray();
    }

    public function search_santri($title)
    {

        $builder = $this->db->table('santri');
        $builder->select('*');
        $builder->join('keuangan', 'keuangan.id_santri = santri.id_santri');
        $builder->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua');
        $builder->like('nis', $title);
        $builder->orderBy('nis', 'ASC');
        $builder->groupBy('nis');
        $builder->limit(10);
        $query = $builder->get();
        return $query->getResult();
    }



    public function search_spp($title)
    {
        $builder = $this->db->table('santri');
        $builder->select('santri.nis', 'nis');
        $builder->select('santri.nama_lengkap', 'nama_lengkap');
        $builder->select('santri.id_santri', 'id_santri');
        $builder->select('santri.id_kelas', 'id_kelas');
        $builder->join('keuangan', 'keuangan.id_santri = santri.id_santri', 'LEFT OUTER');
        $builder->like('nis', $title);
        $builder->where('keuangan.id_tagihan', '27');
        $builder->where('keuangan.id_kelas != santri.id_kelas');
        $builder->orWhere('keuangan.id_tagihan', null);
        $builder->where('santri.password IS NOT NULL', null, false);
        $builder->where('santri.deleted_at', null);
        $builder->where('santri.status', 'Aktif');
        $builder->orderBy('nis', 'ASC');
        $builder->groupBy('nis');
        $builder->limit(10);
        $query = $builder->get();
        return $query->getResult();
    }



    public function search($title)
    {
        $builder = $this->db->table('santri');
        $builder->select('*');
        $builder->like('santri.nama_lengkap', $title);
        $builder->where('tagihan.nama_pembayaran', 'uang syahriyah');
        $builder->join('keuangan', 'keuangan.id_keuangan = santri.id_keuangan');
        $builder->join('tagihan', 'tagihan.id_tagihan = keuangan.id_tagihan');
        $builder->orderBy('nama_lengkap', 'ASC');
        $builder->limit(10);
        $query = $builder->get();
        return $query->getResult();
    }

    public function search_status($title)
    {
        $builder = $this->db->table('santri');
        $builder->select('*');
        $builder->like('santri.nis', $title);
        $builder->where('status', 'Aktif');
        $builder->where('password IS NOT NULL', null, false);
        $builder->orderBy('nis', 'ASC');
        $builder->limit(10);
        $query = $builder->get();
        return $query->getResult();
    }

    public function search_khusus($title)
    {
        $builder = $this->db->table('santri');
        $builder->select('*');
        $builder->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua');
        $builder->like('nis', $title);
        $builder->where('id_kelas IS NOT NULL', null, false);
        $builder->where('khusus', 'SPP');
        $builder->orderBy('nama_lengkap', 'ASC');
        $builder->limit(10);
        $query = $builder->get();
        return $query->getResult();
    }
    public function search_nama($title)
    {
        $builder = $this->db->table('santri');
        $builder->select('*');
        $builder->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua');
        $builder->like('nama_lengkap', $title);
        $builder->where('nis', null);
        $builder->orderBy('nama_lengkap', 'ASC');
        $builder->limit(10);
        $query = $builder->get();
        return $query->getResult();
    }

    public function tagihan($id_santri)
    {

        $builder = $this->db->table('santri');
        $builder->select('santri.nama_lengkap', 'nama_lengkap');
        $builder->select('santri.nis', 'nis');
        $builder->select('keuangan.periode', 'periode');
        $builder->select('kelas.nama_kelas', 'nama_kelas');
        $builder->selectSum('keuangan.jumlah_tagihan', 'tagihan');
        $builder->where('santri.id_santri', $id_santri);
        $builder->where('keuangan.id_tagihan', '27');
        $builder->where('santri.id_kelas = keuangan.id_kelas');
        $builder->join('kelas', 'kelas.id_kelas = santri.id_kelas');
        $builder->join('keuangan', 'keuangan.id_santri = santri.id_santri');
        $builder->groupBy('keuangan.id_keuangan');
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function data_tagihan($id_santri)
    {
        $data = [''];
        $builder = $this->db->table('santri');
        $builder->select('keuangan.jumlah_tagihan', 'tagihan');
        $builder->where('santri.id_santri', $id_santri);
        $builder->where('keuangan.id_tagihan', '27');
        $builder->whereNotIn('keuangan.jumlah_tagihan', $data);
        $builder->join('kelas', 'kelas.id_kelas = santri.id_kelas');
        $builder->join('keuangan', 'keuangan.id_santri = santri.id_santri');
        $builder->groupBy('keuangan.id_keuangan');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function tagihanspp($id_santri)
    {
        $builder = $this->db->table('santri');
        $builder->select('santri.nama_lengkap', 'nama_lengkap');
        $builder->select('santri.nis', 'nis');
        $builder->select('kelas.nama_kelas', 'nama_kelas');
        $builder->selectSum('tagihan.jumlah_pembayaran', 'tagihan');
        $builder->where('santri.id_santri', $id_santri);
        $builder->where('tagihan.nama_pembayaran', 'uang syahriyah');
        $builder->join('kelas', 'kelas.id_kelas = santri.id_kelas');
        $builder->join('tagihan', 'tagihan.id_kelas = santri.id_kelas');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function filter_tagihanspp($id_kelas)
    {
        return  $this->db->table('santri')
            ->select('santri.nama_lengkap', 'nama_lengkap')
            ->select('santri.nis', 'nis')
            ->select('santri.id_santri', 'id_santri')
            ->select('santri.id_kelas', 'id_kelas')
            ->select('tagihan.jumlah_pembayaran', 'tagihan')
            ->where('santri.id_kelas', $id_kelas)
            ->where('tagihan.nama_pembayaran', 'uang syahriyah')
            ->join('tagihan', 'tagihan.id_kelas = santri.id_kelas')
            ->get()->getResultArray();
    }

    public function tagihan_santri($id_santri)
    {
        $builder = $this->db->table('santri');
        $builder->select('santri.nama_lengkap', 'nama_lengkap');
        $builder->select('santri.nis', 'nis');
        $builder->selectSum('tagihan.jumlah_pembayaran', 'tagihan');
        $builder->where('santri.id_santri', $id_santri);
        $builder->where('tagihan.nama_pembayaran', 'uang syahriyah');
        $builder->join('tagihan', 'tagihan.id_tagihan = santri.id_tagihan');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function rutin($id_santri, $id_tagihan)
    {
        $builder = $this->db->table('santri');
        $builder->select('santri.nama_lengkap', 'nama_lengkap');
        $builder->select('santri.nis', 'nis');
        $builder->selectSum('tagihan.jumlah_pembayaran', 'tagihan');
        $builder->where('santri.id_santri', $id_santri);
        $builder->where('tagihan.nama_pembayaran', $id_tagihan);
        $builder->join('tagihan', 'tagihan.id_tagihan = santri.id_tagihan');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function tagihan_spp($id_kelas)
    {
        $builder = $this->db->table('santri');
        $builder->select('santri.id_santri', 'id_santri');
        $builder->select('santri.nama_lengkap', 'nama_lengkap');
        $builder->select('santri.nis', 'nis');
        $builder->select('kelas.nama_kelas', ' nama_kelas');
        $builder->select('kelas.id_kelas', ' id_kelas');
        $builder->selectSum('tagihan.jumlah_pembayaran', 'tagihan');
        $builder->where('santri.id_kelas', $id_kelas);
        $builder->join('tagihan', 'tagihan.id_kelas = santri.id_kelas');
        $builder->join('kelas', 'kelas.id_kelas = tagihan.id_kelas');
        $builder->groupBy('santri.id_kelas');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function tagihan_pendaftaran()
    {
        $builder = $this->db->table('santri');
        $builder->select('santri.id_santri', 'id_santri');
        $builder->select('santri.nama_lengkap', 'nama_lengkap');
        $builder->select('santri.nis', 'nis');
        $builder->select('kelas.nama_kelas', ' nama_kelas');
        $builder->select('(SELECT SUM(tagihan.jumlah_pembayaran)) AS tagihan', false);
        $builder->where('tagihan.nama_pembayaran', 'uang pendaftaran');
        $builder->join('tagihan', 'tagihan.id_kelas = santri.id_kelas');
        $builder->join('kelas', 'kelas.id_kelas = tagihan.id_kelas');
        $builder->groupBy('santri.id_santri');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function tagihan_rutin($id_tagihan)
    {
        $tagihan = ['uang pendaftaran', 'uang syahriyah', 'uang daftar ulang'];
        $builder = $this->db->table('santri');
        $builder->select('santri.nama_lengkap', 'nama_lengkap');
        $builder->select('santri.nis', 'nis');
        $builder->select('santri.id_tagihan', 'id_tagihan');
        $builder->selectSum('tagihan.jumlah_pembayaran', 'tagihan');
        $builder->where('tagihan.id_tagihan', $id_tagihan);
        $builder->join('tagihan', 'tagihan.id_tagihan = santri.id_tagihan');
        $builder->join('keuangan', 'keuangan.id_tagihan = santri.id_tagihan');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function Get_provinsi($id)
    {
        $builder = $this->table('santri');
        $builder->select('*');
        $builder->select('provinces.id as id_provinsi');
        $builder->select('provinces.name as nama_provinsi');
        $builder->where('santri.id_santri', $id);
        $builder->orderBy('name', 'ASC');
        $builder->join('provinces', 'provinces.id = santri.provinsi', 'left');
        $query =  $builder->get();
        return $query->getRowArray();
    }

    public function Get_kabupaten($id)
    {
        $builder = $this->table('santri');
        $builder->select('*');
        $builder->select('regencies.id as id_kabupaten');
        $builder->select('regencies.name as nama_kabupaten');
        $builder->where('santri.id_santri', $id);
        $builder->orderBy('name', 'ASC');
        $builder->join('regencies', 'regencies.id = santri.kabupaten', 'left');
        $query =  $builder->get();
        return $query->getRowArray();
    }

    public function Get_kecamatan($id)
    {
        $builder = $this->table('santri');
        $builder->select('districts.id as id_kecamatan');
        $builder->select('districts.name as nama_kecamatan');
        $builder->where('santri.id_santri', $id);
        $builder->orderBy('name', 'ASC');
        $builder->join('districts', 'districts.id = santri.kecamatan', 'left');
        $query =  $builder->get();
        return $query->getRowArray();
    }

    public function Get_desa($id)
    {
        $builder = $this->table('santri');
        $builder->select('villages.id as id_desa');
        $builder->select('villages.name as nama_desa');
        $builder->where('santri.id_santri', $id);
        $builder->orderBy('name', 'ASC');
        $builder->join('villages', 'villages.id = santri.desa_kelurahan', 'left');
        $query =  $builder->get();
        return $query->getRowArray();
    }

    public function Get_program($id)
    {
        $builder = $this->table('santri');
        $builder->where('id_santri', $id);
        $builder->join('program', 'program.id_program = santri.id_program');
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function Get_diniyah($id)
    {
        $builder = $this->table('santri');
        $builder->where('id_santri', $id);
        $builder->join('diniyah', 'diniyah.id_diniyah = santri.id_diniyah');
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function Get_kelas($id)
    {
        $builder = $this->table('santri');
        $builder->where('id_santri', $id);
        $builder->join('kelas', 'kelas.id_kelas = santri.id_kelas');
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function Get_kamar($id)
    {
        $builder = $this->table('santri');
        $builder->where('id_santri', $id);
        $builder->join('kamar', 'kamar.id_kamar = santri.id_kamar');
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function editNon($id)
    {
        $builder = $this->table('santri');
        $builder->select('*');
        $builder->where('id_santri', $id);
        $builder->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua');
        $query = $builder->get();
        return $query->getRowArray();
    }
    public function edit($id)
    {
        $builder = $this->table('santri');
        $builder->select('*');
        $builder->where('id_santri', $id);
        $builder->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua');
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function add_excel($santri)
    {
        $this->db->table('santri')->insert($santri);
    }

    public function no_kk($data)
    {
        return $this->db->table('santri')
            ->select('santri.no_kk')
            ->where('no_kk', $data)
            ->get()->getRowArray();
    }

    public function nik_ktp($data)
    {
        return $this->table('santri')
            ->where('nik_ktp', $data)
            ->get()->getRowArray();
    }

    public function data_ktp()
    {
        return $this->table('santri')
            ->select('santri.nik_ktp')
            ->get()->getResultArray();
    }

    public function get_orangtua($data)
    {
        return $this->table('santri')
            ->where('id_orangtua', $data)
            ->get()->getRowArray();
    }

    public function data($data)
    {
        return $this->table('santri')
            ->where('nik_ktp', $data)
            ->get()->getRowArray();
    }

    public function getID()
    {
        return $this->db->insertID();
    }

    public function get_regis()
    {
        $builder = $this->table('santri');
        $builder->select('id_santri');
        $builder->where('status', 'baru');
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function data_count()
    {
        $status = ['Aktif', 'Non Aktif'];
        $builder = $this->table('santri');
        $builder->whereIn('status', $status);
        $builder->countAllResults();
        $query = $builder->get();
        return $query->getResultArray();
    }
}
