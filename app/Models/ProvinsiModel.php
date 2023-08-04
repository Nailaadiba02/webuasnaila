<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinsiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'Provinsi';
    protected $primaryKey       = 'Id_provinsi';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Id_Provinsi','Provinsi','kota','kecamatan'];
    
  
    protected function hash(array $data) 
    {
        if (!isset($data['data'][''])) {
            
        }
        $data['data'][''] = hash($data['data'][''], PASSWORD_DEFAULT);

        return $data;
    }
}