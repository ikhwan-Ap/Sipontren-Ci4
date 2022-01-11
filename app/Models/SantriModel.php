<?php

namespace App\Models;

use CodeIgniter\Model;

class SantriModel extends Model
{
    protected $table            = 'santri';
    protected $primaryKey       = 'id_santri';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nis', 'nik_ktp', 'no_kk', 'password', 'email', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
        'alamat', 'desa_kelurahan', 'kecamatan', 'kabupaten', 'provinsi',
        'no_hp_santri', 'id_kamar', 'id_diniyah', 'id_program', 'id_kelas', 'id_tagihan', 'catatan_medis',
        'pendidikan_terakhir', 'pengalaman_mondok', 'pendidikan_sekarang', 'gol_darah',
        'nama_almet', 'kelas_semester', 'nisn_nim', 'id_orangtua', 'status', 'created_at', 'updated_at', 'deleted_at'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    public function getSantriNew($id = false)
    {
        if ($id == false) {
            return $this->db->table('santri')->select('*')->where('status', 'Baru')->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->get()->getResultArray();
        }

        return $this->db->table('santri')->select('*')->where(['id_santri' => $id, 'status' => 'Baru'])->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->get()->getRowArray();
    }

    public function getSantriNonActive()
    {
        return $this->db->table('santri')->select('*')->where('status', 'Non Aktif')->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->get()->getResultArray();
    }

    public function getSantriActive()
    {
        $builder = $this->db->table('santri');
        $builder->select('*');
        $builder->where('status', 'Aktif');
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

    public function search_santri($title)
    {
        $builder = $this->db->table('santri');
        $builder->select('*');
        $builder->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua');
        $builder->like('nis', $title);
        $builder->orderBy('nis', 'ASC');
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
        $builder->selectSum('tagihan.jumlah_pembayaran', 'tagihan');
        $builder->where('santri.id_santri', $id_santri);
        $builder->where('tagihan.nama_pembayaran', 'uang syahriyah');
        $builder->join('kelas', 'kelas.id_kelas = santri.id_kelas');
        $builder->join('tagihan', 'tagihan.id_kelas = santri.id_kelas');
        $query = $builder->get();
        return $query->getRowArray();
    }

    public function tagihanspp($id_santri)
    {
        $builder = $this->db->table('santri');
        $builder->select('santri.nama_lengkap', 'nama_lengkap');
        $builder->select('santri.nis', 'nis');
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

    // Lokasi
    public function getProvinsi()
    {
        return $this->db->table('provinces')->select('*')->get()->getResultArray();
    }

    public function getKabupaten()
    {
        return $this->db->table('cities')->select('*')
            ->join('provinces', 'provinces.prov_id = cities.prov_id')
            ->get()->getResultArray();
    }

    public function getKecamatan()
    {
        return $this->db->table('districts')->select('*')
            ->join('cities', 'cities.city_id = districts.city_id')
            ->get()->getResultArray();
    }

    public function getDesa()
    {
        return $this->db->table('subdistricts')->select('*')
            ->join('districts', 'districts.dis_id = subdistricts.dis_id')
            ->get()->getResultArray();
    }
}
