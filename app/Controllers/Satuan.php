<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelsatuan;

class Satuan extends BaseController
{
    public function __construct()
    {
        $this->satuan = new Modelsatuan();
    }
    public function index()
    {
        $tombolcari = $this->request->getPost('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getPost('cari');

            session()->set('cari_satuan', $cari);
            redirect()->to('/satuan/index');
        } else {
            $cari = session()->get('cari_satuan');
        }

        $datasatuan = $cari ? $this->satuan->cariData($cari)->paginate(5, 'satuan') : $this->satuan->paginate(5, 'satuan');

        $nohalaman = $this->request->getVar('page_satuan') ? $this->request->getVar('page_satuan') : 1;
        $data = [
            'title' => 'Satuan | Toko Rifqi Putra',
            'menu' => 'satuan',
            "tampildata" => $datasatuan,
            "pager" => $this->satuan->pager,
            "nohalaman" => $nohalaman,
            "cari" => $cari
        ];
        return view('satuan/viewsatuan', $data);
    }
    public function formtambah()
    {
        $data = [
            'title' => 'Satuan | Toko Rifqi Putra',
            'menu' => 'satuan',

        ];
        return view('satuan/formtambah', $data);
    }
    public function simpandata()
    {
        $namasatuan = $this->request->getVar('namasatuan');
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'namasatuan' => [
                'rules' => 'required',
                'label' => 'Nama satuan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);
        if (!$valid) {
            $pesan = [
                'errorNamasatuan' => '<br><div class="alert alert-danger">' . $validation->getError() . '</div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/satuan/formtambah');
        } else {
            $this->satuan->insert([
                'satnama' => $namasatuan
            ]);
            $pesan = [
                'sukses' => '<br><div class="alert alert-success">Data satuan berhasil ditambahkan</div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/satuan/index');
        }
    }


    public function formedit($id)
    {
        $rowData = $this->satuan->find($id);

        if ($rowData) {

            $data = [
                'title' => 'Satuan | Toko Rifqi Putra',
                'menu' => 'satuan',
                'id' => $id,
                'nama' => $rowData['satnama']
            ];

            return view('satuan/formedit', $data);
        } else {
            exit('Data tidak ditemukan');
        }
    }
    public function updatedata()
    {
        $idsatuan = $this->request->getVar('idsatuan');
        $namasatuan = $this->request->getVar('namasatuan');
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'namasatuan' => [
                'rules' => 'required',
                'label' => 'Nama satuan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);
        if (!$valid) {
            $pesan = [
                'errorNamasatuan' => '<br><div class="alert alert-danger">' . $validation->getError() . '</div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/satuan/formedit/.$idsatuan');
        } else {
            $this->satuan->update($idsatuan, [
                'satnama' => $namasatuan
            ]);
            $pesan = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil !</h5>
                Data satuan berhasil diupdate
              </div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/satuan/index');
        }
    }
    public function hapus($id)
    {
        $rowData = $this->satuan->find($id);

        if ($rowData) {
            $this->satuan->delete($id);

            $pesan = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil !</h5>
                Data satuan berhasil dihapus
              </div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/satuan/index');
        } else {
            exit('Data tidak ditemukan');
        }
    }
}
