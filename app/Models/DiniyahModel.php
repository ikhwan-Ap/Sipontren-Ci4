<?php

namespace App\Models;

use CodeIgniter\Model;

class DiniyahModel extends Model
{
    protected $table = 'diniyah';
    protected $primaryKey = 'id_diniyah';
    protected $allowedFields = ['nama_diniyah'];
}
