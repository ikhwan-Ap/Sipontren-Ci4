<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrangtuaModel;
use App\Models\SantriModel;
use App\Models\KeuanganModel;
use App\Models\TagihanModel;

class Pendaftaran extends BaseController
{
  public function __construct()
  {
    $this->santri = new SantriModel();
    $this->orangtua = new OrangtuaModel();
    $this->keuangan = new KeuanganModel();
    $this->tagihan = new TagihanModel();
  }

  public function index()
  {
    $data = [
      'title' => 'Pendaftaran Santri Baru',
      'santri' => $this->santri->getSantriNew(),
    ];

    return view('pendaftaran/index', $data);
  }

  public function delete($id)
  {
    $this->db->table('santri')->delete(['id_santri' => $id]);
    $this->db->table('orangtua')->delete(['id_orangtua' => $id]);
    session()->setFlashdata('message', '<div class="alert alert-success alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        Data santri berhasil dihapus!
                      </div>
                    </div>');
    return redirect()->to('/pendaftaran');
  }

  public function accept($id)
  {
    $this->santri->save([
      'id_santri' => $id,
      'status' => 'Aktif'
    ]);

    return redirect()->to('/pendaftaran');
  }

  public function detail($id)
  {
    $data = [
      'title' => 'Detail Santri Baru',
      'santri' => $this->santri->getSantriNew($id),
    ];

    return view('pendaftaran/detail', $data);
  }
  public function pendaftaran()
  {

    $tagihan = $this->santri->tagihan_pendaftaran();

    $keuangan = $this->keuangan->keuangan_pendaftaran();

    for ($i = 0; $i < 12; $i++) {
      if ($tagihan[0]['tagihan'] != null || $keuangan[0] != null) {
        $status = 'Belum Lunas';

        $hasil[] = [
          'status' => $status,
          'nama_lengkap' => $tagihan[0]['nama_lengkap'],
          'nis' => $tagihan[0]['nis'],
          'nama_kelas' => $tagihan[0]['nama_kelas'],
          'id_santri' => $tagihan[0]['id_santri'],
          'tagihan' => $tagihan[0]['tagihan'],
          'pembayaran' => $keuangan[0],
        ];
      } else {
        $status = 'Lunas';
      };
      $data = [
        'title' => 'Status Pembayaran',
        'hasil' => $hasil,
        'santri' => $this->santri->findAll(),

      ];
      return view('pendaftaran/pendaftaran', $data);
    }
  }

  public function filter_pendaftaran()
  {
    $filter = $this->request->getVar('filter');
    $tgl_mulai = $this->request->getVar('tgl_mulai');
    $tgl_selesai = $this->request->getVar('tgl_selesai');
    $status_pembayaran = $this->request->getVar('status_pembayaran');
    if ($tgl_mulai != null || $tgl_selesai != null || $status_pembayaran == 'Lunas') {
      $tanggal = [
        'tgl_mulai' => $tgl_mulai,
        'tgl_selesai' => $tgl_selesai,
        'status_pembayaran' => $status_pembayaran
      ];
      $data = [
        'title' => 'Pembayaran Pendaftaran',
        'Lunas' => $this->model->getPendaftaranLunas($tanggal),
      ];
    } elseif ($tgl_mulai != null || $tgl_selesai != null || $status_pembayaran == 'Belum Lunas') {
      $tanggal = [
        'tgl_mulai' => $tgl_mulai,
        'tgl_selesai' => $tgl_selesai,
        'status_pembayaran' => $status_pembayaran
      ];
      $data = [
        'title' => 'Pembayaran Pendaftaran',
        'Lunas' => $this->model->getPendaftaranBelumLunas($tanggal),
      ];
    } else {
      $data = [
        'title' => 'Pembayaran Pendaftaran',
        'Lunas' => $this->model->getPendaftaran(),
      ];
    }


    return view('pembayaran/pendaftaran', $data);
  }
}
