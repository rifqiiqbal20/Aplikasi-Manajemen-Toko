<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelbarang extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'brgkode';
    protected $allowedFields    = [
        'brgkode', 'brgnama', 'brgkatid', 'brgsatid', 'brgsupid', 'brgharga', 'brggambar', 'brgstok'
    ];

    public function tampildata()
    {
        return $this->table('barang')->join('kategori', 'brgkatid=katid')->join('satuan', 'brgsatid=satid')->join('supplier', 'brgsupid=supid');;
    }

    public function tampildata_cari($cari)
    {
        return $this->table('barang')->join('kategori', 'brgkatid=katid')->join('satuan', 'brgsatid=satid')->join('supplier', 'brgsupid=supid')->orlike('brgkode', $cari)->orlike('brgnama', $cari)->orlike('katnama', $cari);

        //select * from barang join ..where brgkode Like .....
    }
}
