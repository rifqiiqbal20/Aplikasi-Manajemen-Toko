<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBarangKeluar extends Model
{
    protected $table            = 'barangkeluar';
    protected $primaryKey       = 'faktur';

    protected $allowedFields    = [
        'faktur', 'tglfaktur', 'idpel', 'totalharga'
    ];
    public function noFaktur($tanggalSekarang)
    {
        return $this->table('barangkeluar')->select('max(faktur) as nofaktur')->where(
            'tglfaktur',
            $tanggalSekarang
        )->get();
    }
    public function laporanPeriode($tglawal, $tglakhir)
    {
        return $this->table('barangkeluar')->join('detail_barangkeluar', 'detail_barangkeluar.detfaktur = barangkeluar.faktur')
            ->join('barang', 'barang.brgkode = detail_barangkeluar.detbrgkode')
            ->join('satuan', 'satuan.satid = barang.brgsatid')
            ->join('supplier', 'supplier.supid = barang.brgsupid')
            ->join('pelanggan', 'pelanggan.pelid = barangkeluar.idpel')
            ->where('tglfaktur >=', $tglawal)->where('tglfaktur <=', $tglakhir)->get();
    }
}
