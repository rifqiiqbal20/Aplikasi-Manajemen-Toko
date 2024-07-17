<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBarangKeluar;
use App\Models\Modelbarangmasuk;
use App\Models\Modeldetailbarangmasuk;
use CodeIgniter\HTTP\ResponseInterface;

class Laporan extends BaseController
{
    public function masuk()
    {
        $data = [
            'title' => 'Laporan Barang Masuk | Toko Rifqi Putra',
            'menu' => 'Laporanmasuk',

        ];
        return view('laporan/viewbarangmasuk', $data);
    }
    public function keluar()
    {
        $data = [
            'title' => 'Laporan Barang Keluar | Toko Rifqi Putra',
            'menu' => 'Laporankeluar',

        ];
        return view('laporan/viewbarangkeluar', $data);
    }

    public function cetak_barang_masuk()
    {
        $data = [
            'title' => 'Laporan Barang Masuk | Toko Rifqi Putra',
            'menu' => 'Laporan',

        ];
        return view('laporan/viewbarangmasuk', $data);
    }
    public function cetak_barang_keluar()
    {
        $data = [
            'title' => 'Laporan Barang Keluar| Toko Rifqi Putra',
            'menu' => 'Laporan',

        ];
        return view('laporan/viewbarangkeluar', $data);
    }
    public function cetak_barang_masuk_periode()
    {
        $tglawal = $this->request->getPost('tglawal');
        $tglakhir = $this->request->getPost('tglakhir');

        $modelBarangMasuk = new Modelbarangmasuk();
        $cekData = $modelBarangMasuk->find();
        $dataLaporan = $modelBarangMasuk->laporanPeriode($tglawal, $tglakhir);
        if ($cekData != null) {
            $data = [
                'title' => 'Laporan | Toko Rifqi Putra',
                'menu' => 'Laporan',
                'datalaporan' => $dataLaporan,
                'tglawal' => $tglawal,
                'tglakhir' => $tglakhir,
            ];

            return view('laporan/cetakLaporanBarangMasuk', $data);
        } else {
            session()->setFlashdata('alert', 'Data barang Masuk tidak ada.');
            return redirect()->to(site_url('laporan/index'));
        }
    }
    public function cetak_barang_keluar_periode()
    {
        $tglawal = $this->request->getPost('tglawal');
        $tglakhir = $this->request->getPost('tglakhir');

        $modelBarangkeluar = new ModelBarangKeluar();
        $cekData = $modelBarangkeluar->find();
        $dataLaporan = $modelBarangkeluar->laporanPeriode($tglawal, $tglakhir);
        if ($cekData != null) {
            $data = [
                'title' => 'Laporan Barang Keluar | Toko Rifqi Putra',
                'menu' => 'Laporan',
                'datalaporan' => $dataLaporan,
                'tglawal' => $tglawal,
                'tglakhir' => $tglakhir,
            ];

            return view('laporan/cetakLaporanBarangKeluar', $data);
        } else {
            session()->setFlashdata('alert', 'Data Barang Keluar tidak ada.');
            return redirect()->to(site_url('laporan/index'));
        }
    }

    function tampilGrafikBarangMasuk()
    {

        $bulan = $this->request->getPost('bulan');

        $db = \Config\Database::connect();

        $query = $db->query("SELECT tglfaktur AS tgl,totalharga FROM barangmasuk WHERE DATE_FORMAT(tglfaktur,'%Y-%m') = '$bulan' ORDER BY tglfaktur ASC")->getResult();

        $data = [
            'grafik' => $query
        ];
        $json = [
            'data' => view('laporan/grafikbarangmasuk', $data)
        ];

        echo json_encode($json);
    }
    function tampilGrafikBarangKeluar()
    {

        $bulan = $this->request->getPost('bulan');

        $db = \Config\Database::connect();

        $query = $db->query("SELECT tglfaktur AS tgl,totalharga FROM barangkeluar WHERE DATE_FORMAT(tglfaktur,'%Y-%m') = '$bulan' ORDER BY tglfaktur ASC")->getResult();

        $data = [
            'grafik' => $query
        ];
        $json = [
            'data' => view('laporan/grafikbarangkeluar', $data)
        ];

        echo json_encode($json);
    }
}
