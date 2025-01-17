<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelbarang;
use App\Models\Modelkategori;
use App\Models\Modelsatuan;
use App\Models\Modelsupplier;
use CodeIgniter\HTTP\ResponseInterface;

class Barang extends BaseController
{
    public function __construct()
    {
        $this->barang = new Modelbarang();
    }
    public function index()
    {
        $tombolcari = $this->request->getPost('tombolcari');
        if (isset($tombolcari)) {
            $cari = $this->request->getPost('cari');

            session()->set('cari_barang', $cari);
            redirect()->to('/barang/index');
        } else {
            $cari = session()->get('cari_barang');
        }
        //untuk  menghitung total data ditemukan
        $totaldata = $cari ? $this->barang->tampildata_cari($cari)->countAllResults() : $this->barang->tampildata()->countAllResults();

        $dataBarang = $cari ? $this->barang->tampildata_cari($cari)->paginate(10, 'barang') : $this->barang->tampildata()->paginate(10, 'barang');

        $nohalaman = $this->request->getVar('page_barang') ? $this->request->getVar('page_barang') : 1;

        $data = [
            'title' => 'Data Barang | Toko Rifqi Putra',
            'menu' => 'barang',
            "tampildata" => $dataBarang,
            "pager" => $this->barang->pager,
            "nohalaman" => $nohalaman,
            "totaldata" => $totaldata,
            "cari" => $cari

        ];
        return view('barang/viewbarang', $data);
    }
    public function tambah()
    {
        $modelkategori = new Modelkategori();
        $modelsatuan = new Modelsatuan();
        $modelsupplier = new Modelsupplier();

        $data = [
            'title' => 'Data Barang | Toko Rifqi Putra',
            'menu' => 'barang',
            'datakategori' => $modelkategori->findall(),
            'datasupplier' => $modelsupplier->findall(),
            'datasatuan' => $modelsatuan->findall()
        ];
        return view('barang/formtambah', $data);
    }
    public function simpandata()
    {
        $kodebarang = $this->request->getVar('kodebarang');
        $namabarang = $this->request->getVar('namabarang');
        $kategori = $this->request->getVar('kategori');
        $satuan = $this->request->getVar('satuan');
        $supplier = $this->request->getVar('supplier');
        $harga = $this->request->getVar('harga');
        $stok = $this->request->getVar('stok');

        $validation = \Config\Services::validation();
        $valid = $this->validate([
            'kodebarang' => [
                'rules' => 'required|is_unique[barang.brgkode]',
                'label' => 'Kode Barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada....'
                ]
            ],
            'namabarang' => [
                'rules' => 'required',
                'label' => 'Nama Barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'label' => 'kategori',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'label' => 'Satuan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'supplier' => [
                'rules' => 'required',
                'label' => 'Supplier',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]

            ],
            'harga' => [
                'rules' => 'required|numeric',
                'label' => 'Harga',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'label' => 'Stok',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'

                ]
            ],
            'gambar' => [
                'rules' => 'mime_in[gambar,image/png,image/jpeg]|ext_in[gambar,png,jpg,gif]',
                'label' => 'Gambar'


            ]
        ]);

        if (!$valid) {
            $sess_pesan = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                ' . $validation->listErrors() . '
                </div>'
            ];

            session()->setFlashdata($sess_pesan);
            return redirect()->to('/barang/tambah');
        } else {
            $gambar = $_FILES['gambar']['name'];

            if ($gambar != NULL) {
                $namaFileGambar = $kodebarang;
                $fileGambar = $this->request->getfile('gambar');
                $fileGambar->move('upload', $namaFileGambar . '.' . $fileGambar->getExtension());

                $pathGambar = 'upload/' . $fileGambar->getName();
            } else {
                $pathGambar = '';
            }
            $this->barang->insert([
                'brgkode' => $kodebarang,
                'brgnama' => $namabarang,
                'brgkatid' => $kategori,
                'brgsatid' => $satuan,
                'brgsupid' => $supplier,
                'brgharga' => $harga,
                'brgstok' => $stok,
                'brggambar' => $pathGambar
            ]);

            $pesan_sukses = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                Data barang dengan kode <strong>' . $kodebarang . '</strong> berhasil disimpan
              </div>'
            ];

            session()->setFlashdata($pesan_sukses);
            return redirect()->to('/barang/tambah');
        }
    }
    public function edit($kode)
    {
        $cekData = $this->barang->find($kode);

        if ($cekData) {

            $modelkategori = new Modelkategori();
            $modelsatuan = new Modelsatuan();
            $modelsupplier = new Modelsupplier();

            $data = [
                'title' => 'Data Barang | Toko Rifqi Putra',
                'menu' => 'barang',
                'kodebarang' => $cekData['brgkode'],
                'namabarang' => $cekData['brgnama'],
                'kategori' => $cekData['brgkatid'],
                'satuan' => $cekData['brgsatid'],
                'supplier' => $cekData['brgsupid'],
                'harga' => $cekData['brgharga'],
                'stok' => $cekData['brgstok'],
                'datakategori' => $modelkategori->findAll(),
                'datasupplier' => $modelsupplier->findAll(),
                'datasatuan' => $modelsatuan->findAll(),
                'gambar' => $cekData['brggambar']
            ];

            return view('barang/formedit', $data);
        } else {
            $pesan_error = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Error !</h5>
                Data barang tidak ditemukan...
                </div>'
            ];

            session()->setFlashdata($pesan_error);
            return redirect()->to('/barang/index');
        }
    }

    public function updatedata()
    {
        $kodebarang = $this->request->getVar('kodebarang');
        $namabarang = $this->request->getVar('namabarang');
        $kategori = $this->request->getVar('kategori');
        $satuan = $this->request->getVar('satuan');
        $supplier = $this->request->getVar('supplier');
        $harga = $this->request->getVar('harga');
        $stok = $this->request->getVar('stok');

        $validation = \Config\Services::validation();
        $valid = $this->validate([

            'namabarang' => [
                'rules' => 'required',
                'label' => 'Nama Barang',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'label' => 'kategori',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'label' => 'Satuan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ],
            'supplier' => [

                'rules' => 'required',
                'label' => 'Supplier',
                'errors' => [
                    'in' => '{field} harus sama dengan "supplier"',
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'label' => 'Harga',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'label' => 'Stok',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} hanya dalam bentuk angka'

                ]
            ],
            'gambar' => [
                'rules' => 'mime_in[gambar,image/png,image/jpeg]|ext_in[gambar,png,jpg,gif]',
                'label' => 'Gambar'


            ]
        ]);

        if (!$valid) {
            $sess_pesan = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                ' . $validation->listErrors() . '
                </div>'
            ];

            session()->setFlashdata($sess_pesan);
            return redirect()->to('/barang/tambah');
        } else {
            $cekData = $this->barang->find($kodebarang);
            $pathGambarLama =  $cekData['brggambar'];
            $gambar = $_FILES['gambar']['name'];

            if ($gambar != NULL) {
                ($pathGambarLama == '' || $pathGambarLama == null) ? '' : unlink($pathGambarLama);
                $namaFileGambar = $kodebarang;
                $fileGambar = $this->request->getfile('gambar');
                $fileGambar->move('upload', $namaFileGambar . '.' . $fileGambar->getExtension());

                $pathGambar = 'upload/' . $fileGambar->getName();
            } else {
                $pathGambar = $pathGambarLama;
            }
            $this->barang->update($kodebarang, [
                'brgnama' => $namabarang,
                'brgkatid' => $kategori,
                'brgsatid' => $satuan,
                'brgsupid' => $supplier,
                'brgharga' => $harga,
                'brgstok' => $stok,
                'brggambar' => $pathGambar
            ]);

            $pesan_sukses = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                Data barang dengan kode <strong>' . $kodebarang . '</strong> berhasil diupdate
              </div>'
            ];

            session()->setFlashdata($pesan_sukses);
            return redirect()->to('/barang/index');
        }
    }
    public function hapus($kode)
    {
        $cekData = $this->barang->find($kode);

        if ($cekData) {

            $pathGambarLama = $cekData['brggambar'];
            ($pathGambarLama == '' || $pathGambarLama == null) ? '' : unlink($pathGambarLama);
            $this->barang->delete($kode);
            $pesan_sukses = [
                'sukses' => '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                Data barang dengan kode <strong>' . $kode . '</strong> berhasil dihapus
              </div>'
            ];

            session()->setFlashdata($pesan_sukses);
            return redirect()->to('/barang/index');
        } else {
            $pesan_error = [
                'error' => '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Error !</h5>
                Data barang tidak ditemukan...
                </div>'
            ];

            session()->setFlashdata($pesan_error);
            return redirect()->to('/barang/index');
        }
    }
}
