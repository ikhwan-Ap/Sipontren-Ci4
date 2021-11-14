<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table = 'program';
    protected $primaryKey = 'id_program';
    protected $allowedFields = ['nama_program'];
}
