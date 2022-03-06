<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Provinsi extends ResourceController
{
    protected $modelName = 'App\Models\ProvinsiModel';
    protected $format = 'json';

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
    }
    public function index()
    {
        return $this->respond($this->model->findAll());
    }
    public function create()
    {
        $data = $this->request->getPost();
        $this->model->save($data);
        $validate = $this->validation->run($data, 'provinsi');
        $errors = $this->validation->getErrors();


        if ($errors) {
            return $this->fail($errors);
        }
        $this->model->save(
            [
                'nama_provinsi' => $this->request->getVar('nama_provinsi')
            ]
        );
    }
}
