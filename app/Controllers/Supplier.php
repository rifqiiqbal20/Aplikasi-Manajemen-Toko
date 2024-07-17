<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelsupplier;

class Supplier extends BaseController
{
    public function __construct()
    {
        $this->supplier = new Modelsupplier();
    }
    public function index()
    {
        $tombolcari = $this->request->getPost('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getPost('cari');

            session()->set('cari_supplier', $cari);
            redirect()->to('/supplier/index');
        } else {
            $cari = session()->get('cari_supplier');
        }

        $datasupplier = $cari ? $this->supplier->cariData($cari)->paginate(5, 'supplier') : $this->supplier->paginate(5, 'supplier');

        $nohalaman = $this->request->getVar('page_supplier') ? $this->request->getVar('page_supplier') : 1;
        $data = [
            'title' => 'Supplier | Toko Rifqi Putra',
            'menu' => 'Supplier',
            "tampildata" => $datasupplier,
            "pager" => $this->supplier->pager,
            "nohalaman" => $nohalaman,
            "cari" => $cari
        ];
        return view('supplier/viewsupplier', $data);
    }
    public function formtambah()
    {
        $data = [
            'title' => 'Supplier | Toko Rifqi Putra',
            'menu' => 'Supplier',

        ];
        return view('supplier/formtambah', $data);
    }
    public function simpandata()
    {
        $namasupplier = $this->request->getVar('namasupplier');
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'namasupplier' => [
                'rules' => 'required',
                'label' => 'Nama supplier',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);
        if (!$valid) {
            $pesan = [
                'errorNamasupplier' => '<br><div class="alert alert-danger">' . $validation->getError() . '</div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/supplier/formtambah');
        } else {
            $this->supplier->insert([
                'supnama' => $namasupplier
            ]);
            $pesan = [
                'sukses' => '<br><div class="alert alert-success">Data supplier berhasil ditambahkan</div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/supplier/index');
        }
    }


    public function formedit($id)
    {
        $rowData = $this->supplier->find($id);

        if ($rowData) {

            $data = [
                'title' => 'Supplier | Toko Rifqi Putra',
                'menu' => 'Supplier',
                'id' => $id,
                'nama' => $rowData['supnama']
            ];

            return view('supplier/formedit', $data);
        } else {
            exit('Data tidak ditemukan');
        }
    }
    public function updatedata()
    {
        $idsupplier = $this->request->getVar('idsupplier');
        $namasupplier = $this->request->getVar('namasupplier');
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'namasupplier' => [
                'rules' => 'required',
                'label' => 'Nama supplier',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);
        if (!$valid) {
            $pesan = [
                'errorNamasupplier' => '<br><div class="alert alert-danger">' . $validation->getError() . '</div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/supplier/formedit/.$idsupplier');
        } else {
            $this->supplier->update($idsupplier, [
                'supnama' => $namasupplier
            ]);
            $pesan = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil !</h5>
                Data supplier berhasil diupdate
              </div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/supplier/index');
        }
    }
    public function hapus($id)
    {
        $rowData = $this->supplier->find($id);

        if ($rowData) {
            $this->supplier->delete($id);

            $pesan = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil !</h5>
                Data supplier berhasil dihapus
              </div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/supplier/index');
        } else {
            exit('Data tidak ditemukan');
        }
    }
}
