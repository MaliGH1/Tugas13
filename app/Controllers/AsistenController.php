<?php

namespace App\Controllers;

use App\Models\AsistenModel;

class AsistenController extends BaseController
{

    protected $AsistenModel;
    public function __construct()
    {
        $this->AsistenModel = new AsistenModel();
    }

    public function login()
    {
        return view('asisten/login');
    }

    public function AsistenView()
    {
        $asisten = $this->AsistenModel->findAll();

        $data = [
            'list' => $asisten,
            'title' => 'Daftar Asisten',
        ];

        return view('/asisten/AsistenView', $data);
    }

    public function simpan()
    {
        helper('form');
        // Memeriksa apakah melakukan submit data atau tidak.
        if (!$this->request->is('post')) {
            return view('/asisten/simpan');
        }
        // Mengambil data yang disubmit dari form 
        $post = $this->request->getPost(['nim', 'nama', "praktikum", "ipk"]);
        // Mengakses Model untuk menyimpan data 
        $model = model(AsistenModel::class);
        $model->simpan($post);
        return view('/asisten/success');
    }

    public function update()
    {
        $db = \Config\Database::connect();
        $Builder = $db->table('asisten');

        helper('form');
        if (!$this->request->is('post')) {
            return view('/asisten/update');
        }
        $data = [
            'nama' => [$this->request->getPost('nama')],
            'praktikum' => [$this->request->getPost('praktikum')],
            'ipk' => [$this->request->getPost('ipk')],
        ];
        $Builder->where('nim', $this->request->getPost('nim'));
        $Builder->update($data);
        return view('/asisten/success');
    }

    public function delete()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('asisten');

        helper('form');
        if (!$this->request->is('post')) {
            return view('/asisten/delete');
        }
        $post = $this->request->getPost([
            'nim'
        ]);
        $builder->where('nim', $post);
        $builder->delete();
        return view('/asisten/success');
    }

    public function search()
    {
        if (!$this->request->is('post')) {
            return view('/asisten/search');
        }
        $nim = $this->request->getPost(['key']);

        $model = model(AsistenModel::class);
        $asisten = $model->ambil($nim['key']);

        $data = ['hasil' => $asisten];
        return view('/asisten/search', $data);
    }

    public function check()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('login');

        $post = $this->request->getPost(['usr', 'pwd']);
        $builder->select('Username, Password');
        $builder->where('username', $post['usr']);
        $builder->where('password', $post['pwd']);
        $query = $builder->get();
        $result = $query->getRow();

        if ($result && $result->Username && $result->Password) {
            $session = session();
            $session->set('pengguna', $post['usr']);
            return view('asisten/AsistenView');
        } else {
            return view('asisten/fail');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return view('/asisten/login');
    }
}
