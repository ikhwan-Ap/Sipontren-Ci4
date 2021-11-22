<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrangtuaModel;
use App\Models\SantriModel;

class Pendaftaran extends BaseController
{
  public function __construct()
  {
    $this->santri = new SantriModel();
    $this->orangtua = new OrangtuaModel();
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
}
