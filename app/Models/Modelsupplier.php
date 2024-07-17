<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelsupplier extends Model
{
    protected $table            = 'supplier';
    protected $primaryKey       = 'supid';
    protected $allowedFields    = [
        'supid', 'supnama'
    ];
    public function cariData($cari)
    {
        return $this->table('supplier')->like('supnama', $cari);
    }
}
