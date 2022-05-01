<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SantriModel;
use App\Models\KeuanganModel;
use App\Models\TagihanModel;
use App\Models\AsatidzModel;

class Trash extends BaseController
{
  public function __construct()
  {
    $this->santri = new SantriModel();
    $this->keuangan = new KeuanganModel();
    $this->tagihan = new TagihanModel();
    $this->asatidz = new AsatidzModel();
  }
  public function index()
  {
    $data = [
      'title' => "Trash Santri Baru",
      'santri' => $this->santri->where('status', 'Baru')->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->onlyDeleted()->findAll(),
      'pendaftaran' => $this->tagihan->select('jumlah_pembayaran')->where('nama_pembayaran', 'uang pendaftaran')->findAll(),
    ];
    return view('/Trash/Trash_baru', $data);
  }

  public function aktif()
  {
    $data = [
      'title' => "Trash Santri Aktif",
      'santri' => $this->santri->where('status', 'Aktif')->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')->onlyDeleted()->findAll(),
      'pendaftaran' => $this->tagihan->select('jumlah_pembayaran')->where('nama_pembayaran', 'uang pendaftaran')->findAll(),
    ];
    return view('/Trash/Trash_aktif', $data);
  }
  public function nonAktif()
  {
    $data = [
      'title' => "Trash Santri Non Aktif",
      'santri' => $this->santri->where('status', 'Non Aktif')
        ->join('orangtua', 'orangtua.id_orangtua = santri.id_orangtua')
        ->onlyDeleted()->findAll(),
    ];
    return view('/Trash/Trash_nonAktif', $data);
  }

  public function asatidz()
  {
    $data = [
      'title' => "Trash Asatidz",
      'asatidz' => $this->asatidz->onlyDeleted()->findAll(),
    ];
    return view('/Trash/Trash_asatidz', $data);
  }
  public function alumni()
  {
    $data = [
      'title' => "Trash Alumni",
      'asatidz' => $this->santri->where('status', 'Alumni')->onlyDeleted()->findAll(),
    ];
    return view('/Trash/Trash_alumni', $data);
  }

  public function restore_baru()
  {
    $santri = $this->request->getVar('id_santri');
    if ($santri != null) {
      $this->keuangan->save([
        'id_tagihan' => '3',
        'id_santri' => $santri,
        'waktu' => date("Y-m-d h:i"),
        'periode' => Date("Y-m-d h:i", strtotime("+30 days")),
        'jumlah_bayar' => '0',
        'jumlah_tagihan' => $this->request->getVar('jumlah_pembayaran')
      ]);
      $this->santri->save([
        'id_santri' => $santri,
        'deleted_at' => null
      ]);
    }
    session()->setFlashdata('message', '
      Data Asatidz Kembali Di restore');
    return redirect()->to('/trash_baru');
  }

  public function restore_asatidz()
  {
    $asatidz = $this->request->getVar('id');
    $this->asatidz->save([
      'id' => $asatidz,
      'deleted_at' => null
    ]);
    session()->setFlashdata('message', 'Data Asatidz Kembali Di restore');
    return redirect()->to('/trash_asatidz');
  }

  public function restore_alumni()
  {
    $alumni = $this->request->getVar('id_santri');
    $this->santri->save([
      'id_santri' => $alumni,
      'deleted_at' => null
    ]);
    session()->setFlashdata('message', 'Data Alumni Kembali Di restore');
    return redirect()->to('/trash_alumni');
  }

  public function restore_nonAktif()
  {
    $id_santri = $this->request->getVar('id_santri');
    $this->santri->save([
      'id_santri' => $id_santri,
      'deleted_at' => null
    ]);
    session()->setFlashdata('message', 'Data Santri Non Aktif Kembali Di restore');
    return redirect()->to('/trash_nonAktif');
  }

  public function delete_baru()
  {
    $id_santri = $this->request->getVar('id_santri');
    $id_orangtua = $this->request->getVar('id_orangtua');
    $this->db->table('santri')->where('id_santri', $id_santri)->delete();
    $this->db->table('orangtua')->delete($id_orangtua);
    session()->setFlashdata('message', 'Data Telah Berhasil Di hapus');
    return redirect()->to('/trash_baru');
  }

  public function delete_aktif()
  {
    $id_santri = $this->request->getVar('id_santri');
    $id_orangtua = $this->request->getVar('id_orangtua');
    $this->db->table('santri')->where('id_santri', $id_santri)->delete();
    $this->db->table('orangtua')->delete($id_orangtua);
    session()->setFlashdata('message', 'Data Telah Berhasil Di hapus');
    return redirect()->to('/trash_aktif');
  }

  public function delete_nonAktif()
  {
    $id_santri = $this->request->getVar('id_santri');
    $id_orangtua = $this->request->getVar('id_orangtua');
    $this->db->table('santri')->where('id_santri', $id_santri)->delete();
    $this->db->table('orangtua')->delete($id_orangtua);
    session()->setFlashdata('message', '
          Data Santri Non Aktif Berhasil Di hapus');
    return redirect()->to('/trash_nonAktif');
  }

  public function delete_asatidz()
  {
    $id_asatidz = $this->request->getVar('id');
    $this->db->table('asatidz')->where('id_asatidz', $id_asatidz)->delete();
    session()->setFlashdata('message', '
          Data Asatidz Telah Berhasil Di hapus');
    return redirect()->to('/trash_asatidz');
  }

  public function delete_alumni()
  {
    $id_santri = $this->request->getVar('id_santri');
    $this->db->table('santri')->where('id_santri', $id_santri)->delete();
    session()->setFlashdata('message', ' Data Alumni Telah Berhasil Di hapus');
    return redirect()->to('/trash_alumni');
  }

  public function restore_aktif()
  {
    $santri = $this->request->getVar('id_santri');
    if ($santri != null) {
      $this->santri->save([
        'id_santri' => $santri,
        'deleted_at' => null
      ]);
    }
    session()->setFlashdata('message', 'Data Telah Kembali Di restore');
    return redirect()->to('/trash_aktif');
  }
}
