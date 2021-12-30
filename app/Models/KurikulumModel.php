<?php

namespace App\Models;

use CodeIgniter\Model;

class KurikulumModel extends Model
{
    protected $table = 'kurikulum';
    protected $primaryKey = 'id_kurikulum';
    protected $allowedFields = ['id_program', 'id_kelas', 'id_asatidz', 'jadwal_harian', 'waktu_mulai', 'waktu_selesai'];
}
