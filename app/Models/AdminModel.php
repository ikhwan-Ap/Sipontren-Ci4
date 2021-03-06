<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admin';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'username', 'email', 'password', 'role'];

    public function getLogin($username)
    {
        return $this->db->table($this->table)->getWhere(['username' => $username])->getRowArray();
    }

    public function get_id($id)
    {
        $builder = $this->db->table('admin');
        $builder->where('id', $id);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
