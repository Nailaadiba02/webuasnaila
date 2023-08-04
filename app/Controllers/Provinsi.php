<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProvinsiModel;

class Provinsi extends BaseController
{
    protected $am;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->am = new ProvinsiModel();
    
        $menu = [
            'beranda' => [
                'title' => 'Beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif' => '',
            ],
            'Provinsi' => [
                'title' => 'Provinsi',
                'link' => base_url() . '/Provinsi',
                'icon' => 'fa-solid fa-users',
                'aktif' => 'active',
            ],
            'sekolah' => [
                'title' => 'sekolah',
                'link' => base_url() .'/sekolah',
                'icon' => 'fa-solid fa-address-card',
                'aktif' => '',
            ],
            'Status' => [
                'title' => 'Status',
                'link' => base_url() . '/Status',
                'icon' => 'fa-solid fa-list',
                'aktif' => '',
            ],
        ];

        $this->rules = [
            'Id_provinsi' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'Id_provinsi tidak boleh kosong',
                ]
            ],
            'profinsi' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'profinsi tidak boleh kosong',
                ]
            ],
            'kota' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'kota tidak boleh kosong',
                ]
            ],
            'kecamatan' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'kecamatan tidak boleh kosong',
                ]
            ],
        ];
    }
    

    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Provinsi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="' . base_url() .'">Beranda</a></li>
                                <li class="breadcrumb-item active">Provinsi</li>
                            </ol>
                        </div>';    
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Provinsi";

        $query = $this->am->find();
        $data ['data_Provinsi'] = $query;
        return view('Provinsi/content', $data);
    
    }

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Provinsi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href ="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="' . base_url() . '/Provinsi">Provinsi</a></li>
                                <li class="breadcrumb-item active">Tambah Provinsi</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Provinsi';
        $data['action'] = base_url() . '/Provinsi/simpan';
        return view('Provinsi/input', $data);
    }
    
    public function simpan()
    {
        
        if (! $this->request->is('post')) {
            
            return redirect()->back()->withInput();
        }

        if (! $this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }
        $dt = $this->request->getPost();
        try {
            $simpan = $this->am->insert($dt);
            return redirect()->to('provinsi')->with('success', 'Data berhasil disimpan');

        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }    
    }

    public function hapus($id) 
    {
        if(empty($id)) {
            return redirect()->back()->with('error', 'Hapus data gagal dilakukan');
        }

        try {
            $this->am->delete($id);
            return redirect()->to('Provinsi')->with('success', 'Data Provinsi dengan kode '.$id.'berhasil dihapus');

        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {

            return redirect()->to('Provinsi')->with('error', $e->getMessage());
        }
    }

    public function edit($id) {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Provinsi</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href ="' . base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="' . base_url() . '/Provinsi">Provinsi</a></li>
                                <li class="breadcrumb-item active">Edit Provinsi</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Edit Provinsi';
        $data['action'] = base_url() . '/Provinsi/update';

        $data['edit_data'] =$this->am->find($id);
        return view('Provinsi/input', $data);
    }

    public function update() {
        $dtEdit = $this->request->getPost();
        $param = $dtEdit['param'];
        unset($dtEdit['param']);
        unset($this->rules['password']);

        if (!$this->validate($this->rules)) {

            return redirect()->back()->withinput();
        }

        if (empty($dtEdit['password'])) {
            unset($dtEdit['password']);
        }

        try {
            $this->am->update($param, $dtEdit);
            return redirect()->to('Provinsi')->with('success', 'Data berhasil di Update');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirec()->back()->withInput();
        }
    }
}

