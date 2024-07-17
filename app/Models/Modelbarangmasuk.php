<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelbarangmasuk extends Model
{
    protected $table            = 'barangmasuk';
    protected $primaryKey       = 'faktur';
    protected $allowedFields    = [
        'faktur', 'tglfaktur', 'totalharga'
    ];

    public function tampildata_cari($cari)
    {
        return $this->table('barangmasuk')->like('faktur', $cari);
    }
    public function cekFaktur($faktur)
    {
        return $this->table('barangmasuk')->getwhere([
            'sha1(faktur)' => $faktur
        ]);
    }

    public function laporanPeriode($tglawal, $tglakhir)
    {
        return $this->table('barangmasuk')->join('detail_barangmasuk', 'detail_barangmasuk.detfaktur = barangmasuk.faktur')
            ->join('barang', 'barang.brgkode = detail_barangmasuk.detbrgkode')
            ->join('satuan', 'satuan.satid = barang.brgsatid')
            ->join('supplier', 'supplier.supid = barang.brgsupid')
            ->where('tglfaktur >=', $tglawal)->where('tglfaktur <=', $tglakhir)->get();
    }
}
