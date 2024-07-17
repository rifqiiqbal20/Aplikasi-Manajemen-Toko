<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelakun;

class akun extends BaseController
{
    public function __construct()
    {
        $this->akun = new Modelakun();
    }
    public function index()
    {
        $tombolcari = $this->request->getPost('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getPost('cari');

            session()->set('cari_sakun', $cari);
            redirect()->to('/akun/index');
        } else {
            $cari = session()->get('cari_akun');
        }

        $dataakun = $cari ? $this->akun->cariData($cari)->paginate(5, 'akun') : $this->akun->paginate(5, 'akun');

        $nohalaman = $this->request->getVar('page_akun') ? $this->request->getVar('page_akun') : 1;
        $data = [
            'title' => 'akun | Toko Rifqi Putra',
            'menu' => 'akun',
            "tampildata" => $dataakun,
            "pager" => $this->akun->pager,
            "nohalaman" => $nohalaman,
            "cari" => $cari
        ];
        return view('akun/viewakun', $data);
    }
    public function formtambah()
    {
        $data = [
            'title' => 'akun | Toko Rifqi Putra',
            'menu' => 'akun',

        ];
        return view('akun/formtambah', $data);
    }
    public function simpandata()
    {
        $namaakun = $this->request->getVar('namaakun');
        $namapassword = $this->request->getVar('namapassword');
        $userlevelid = $this->request->getPost('userlevelid');
        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'namaakun' => [
                'rules' => 'required',
                'label' => 'Nama akun',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'namapassword' => [
                'rules' => 'required',
                'label' => 'Nama password',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'level id' => [
                'rules' => 'required',
                'label' => 'level id',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);
        if (!$valid) {
            $pesan = [
                'errorNamaakun' => '<br><div class="alert alert-danger">' . $validation->getError() . '</div>',
                'errorNamapassword' => '<br><div class="alert alert-danger">' . $validation->getError() . '</div>',
                'errorNamalevelid' => '<br><div class="alert alert-danger">' . $validation->getError() . '</div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/akun/formtambah');
        } else {
            $this->akun->insert([
                'usernama' => $namaakun,
                'userpassword' => $namapassword,
                'userlevelid' => $userlevelid
            ]);
            $pesan = [
                'sukses' => '<br><div class="alert alert-success">Data akun berhasil ditambahkan</div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/akun/index');
        }
    }


    public function formedit($id)
    {
        $rowData = $this->akun->find($id);

        if ($rowData) {

            $data = [
                'title' => 'akun | Toko Rifqi Putra',
                'menu' => 'akun',
                'id' => $id,
                'nama' => $rowData['usernama'],
                'password' => $rowData['userpassword']
            ];

            return view('akun/formedit', $data);
        } else {
            exit('Data tidak ditemukan');
        }
    }
    public function updatedata()
    {
        $idakun = $this->request->getVar('idakun');
        $namaakun = $this->request->getVar('namaakun');
        $namapassword = $this->request->getVar('namapassword'); // Ambil password yang diinput

        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'namaakun' => [
                'rules' => 'required',
                'label' => 'Nama akun',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'namapassword' => [
                'rules' => 'required',
                'label' => 'Nama password',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'errorNamaakun' => '<br><div class="alert alert-danger">' . $validation->getError() . '</div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/akun/formedit/' . $idakun);
        } else {
            // Simpan data akun tanpa mengubah password jika tidak diinput
            $this->akun->update($idakun, [
                'usernama' => $namaakun
            ]);
            $pesan = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil !</h5>
                Data akun berhasil diupdate
              </div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/akun/index');
        }
    }



    public function hapus($id)
    {
        $rowData = $this->akun->find($id);

        if ($rowData) {
            $this->akun->delete($id);

            $pesan = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil !</h5>
                Data akun berhasil dihapus
              </div>'
            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/akun/index');
        } else {
            exit('Data tidak ditemukan');
        }
    }
}
