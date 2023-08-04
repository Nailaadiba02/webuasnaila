<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $menu = [
            'beranda' => [
                'title' => 'Beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif' => 'active',
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
                'aktif' => '',
            ],
        ];

        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Beranda</li>
                            </ol>
                        </div>';    
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Welcome to my PROVINSI";
        $data['selamat_datang'] = "Selamat datang di aplikasi sedeharna";
        return view('template/content', $data);
    }
}