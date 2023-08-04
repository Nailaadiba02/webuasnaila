<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Buku extends BaseController
{
    public function index()
    {
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
                'aktif' => '',
            ],
            'sekolah' => [
                'title' => 'sekolah',
                'link' => base_url() .'/sekolah',
                'icon' => 'fa-solid fa-address-card',
                'aktif' => 'active',
            ],
            'Status' => [
                'title' => 'Status',
                'link' => base_url() . '/Status',
                'icon' => 'fa-solid fa-list',
                'aktif' => '',
            ],
        ];

        $this->rules = [
            'Id_sekolah' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'Id_sekolah tidak boleh kosong',
                ]
            ],
            'nama_sekolah' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'nama_sekolah tidak boleh kosong',
                ]
            ],
            'alamat' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'alamat tidak boleh kosong',
                ]
            ],
            'kode pos' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'kode pos tidak boleh kosong',
                ]
            ],
            'jenis sekolah' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'jenis sekolah tidak boleh kosong',
                ]
            ],
        ];

        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">sekolah</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="' . base_url() .'">Beranda</a></li>
                                <li class="breadcrumb-item active">sekolah</li>
                            </ol>
                        </div>';    
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
            return view('sekolah/content', $data);
    
    }
}