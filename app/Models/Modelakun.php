<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelakun extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'userid';
    protected $allowedFields    = [
        'userid', 'usernama'
    ];
    public function cariData($cari)
    {
        return $this->table('users')->like('usernama', $cari);
    }
}
