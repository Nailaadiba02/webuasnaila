<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StatusModel;
class Status extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->pm = new StatusModel();

        $this->menu =[
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
                'aktif' => '',
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
                'aktif' => 'active',
            ],
        ];
        
        $this->rules = [
            'Id_status' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'Id_status tidak boleh kosong',
                ]
            ],
            'Status' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'Status tidak boleh kosong',
                ]
            ],
            'MBS' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'MBS tidak boleh kosong',
                ]
            ],
            
        ];
    }
    public function index()
    {
        
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Status</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="' . base_url() .'">Beranda</a></li>
                                <li class="breadcrumb-item active">Status</li>
                            </ol>
                        </div>';    
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Status";

        $query = $this->pm->find();
        $data['data_Status'] = $query;
        return view('Status/content', $data);
    }
    
    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                        <h1 class="m-0">Status</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="' . base_url() .'">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="'.base_url().'">Status</a></li>
                            <li class="breadcrumb-item active">Tambah Status</li>
                        </ol>
                    </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Status';
        $data['action'] = base_url().'/Status/simpan';
        return view('Status/input', $data);
    }
    
    public function simpan()
    {
        
        if (strtolower($this->request->getMethod()) !=='post') {
            
            return redirect()->back()->withInput();
        }
        
        if (!$this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }

        
        $dt = $this->request->getPost();
        try {
            $simpan = $this->pm->insert($dt);
            return redirect()->to('Status')->with('success','Data berhasil disimpan');         
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            
            session()->setFlashdata('error',$e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    
}