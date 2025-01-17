<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Input Transaksi Barang Keluar
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>
<button type="button" class="btn btn-sm btn-warning" onclick="location.href=('/barangkeluar/data')">
    <i class="fa fa-backward"></i> Kembali
</button>
<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">No.Faktur</label>
            <input type="text" name="nofaktur" id="nofaktur" value="<?= $nofaktur; ?>" class="form-control" readonly>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Tgl.Faktur</label>
            <input type="date" name="tglfaktur" id="tglfaktur" class="form-control" value="<?= date('Y-m-d') ?>">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Cari Pelanggan</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nama Pelanggan" name="namapelanggan" id="namapelanggan" readonly>
                <input type="hidden" name="idpelanggan" id="idpelanggan">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button" id="tombolCariPelanggan" title="Cari Pelanggan">
                        <i class="fa fa-search"></i>
                    </button>
                    <button class="btn btn-outline-success" type="button" id="tombolTambahPelanggan" title="Tambah Pelanggan">
                        <i class="fa fa-plus-square"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-2">
        <div class="form-group">
            <label for="">Kode Barang</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="kodebarang" id="kodebarang">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button" id="tombolCariBarang">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Nama Barang</label>
            <input type="text" name="namabarang" id="namabarang" class="form-control" readonly>

        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="">Harga Jual</label>
            <input type="text" name="hargajual" id="hargajual" class="form-control" readonly>

        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <label for="">Jumlah</label>
            <input type="number" name="jml" id="jml" class="form-control" value="1">

        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group mb-3">
            <label for="">#</label>
            <div class="input-group">
                <button type="button" class="btn btn-success" title="Simpan Item" id="tombolSimpanItem">
                    <i class="fa fa-save"></i>
                </button>
                &nbsp;
                <button type="button" class="btn btn-info" title="Selesai Transaksi" id="tombolSelesaiTransaksi">
                    Selesai Transaksi
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 tampilDataTemp">

    </div>
</div>
<div class="viewmodal" style="display: none;"></div>
<script>
    function kosong() {
        $('#kodebarang').val('');
        $('#hargajual').val('');
        $('#namabarang').val('');
        $('#jml').val('1');
        $('#kodebarang').focus();
    }

    function simpanItem() {
        let nofaktur = $('#nofaktur').val();
        let kodebarang = $('#kodebarang').val();
        let namabarang = $('#namabarang').val();
        let hargajual = $('#hargajual').val();
        let jml = $('#jml').val();

        if (kodebarang.length == 0) {
            Swal.fire('Error', 'Kode barang harus diinputkan', 'error');
            kosong();

        } else {
            $.ajax({
                type: "post",
                url: "/barangkeluar/simpanItem",
                data: {
                    nofaktur: nofaktur,
                    kodebarang: kodebarang,
                    namabarang: namabarang,
                    jml: jml,
                    hargajual: hargajual
                },
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        Swal.fire('Error', response.error, 'error');
                        tampilDataTemp();
                        kosong();
                    }
                    if (response.sukses) {
                        Swal.fire('Berhasil', response.sukses, 'success');
                        tampilDataTemp();
                        kosong();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        }
    }

    function ambilDataBarang() {
        let kodebarang = $('#kodebarang').val();
        if (kodebarang.lenght == 0) {
            Swal.fire('error', 'Kode barang harus diinputkan', 'error');
            kosong();
        } else {
            $.ajax({
                type: "post",
                url: "/barangkeluar/ambilDataBarang",
                data: {
                    kodebarang: kodebarang
                },
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        Swal.fire('error', response.error, 'error');
                        kosong();
                    }
                    if (response.sukses) {
                        let data = response.sukses;

                        $('#namabarang').val(data.namabarang);
                        $('#hargajual').val(data.hargajual);
                        $('#jml').focus();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        }
    }

    function tampilDataTemp() {
        let faktur = $('#nofaktur').val();
        $.ajax({
            type: "post",
            url: "/barangkeluar/tampilDataTemp",
            data: {
                nofaktur: faktur
            },
            dataType: "json",
            beforeSend: function() {
                $('.tampilDataTemp').html("<i class='fa fa-spin fa-spinner'></i>");
            },
            success: function(response) {
                if (response.data) {
                    $('.tampilDataTemp').html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }

    function buatNofaktur() {
        let tanggal = $('#tglfaktur').val();

        $.ajax({
            type: "post",
            url: "/barangkeluar/buatNofaktur",
            data: {
                tanggal: tanggal
            },
            dataType: "json",
            success: function(response) {
                $('#nofaktur').val(response.nofaktur);
                tampilDataTemp();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }
    $(document).ready(function() {
        tampilDataTemp();
        $('#tglfaktur').change(function(e) {
            buatNofaktur();

        });
        $('#tombolTambahPelanggan').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "/pelanggan/formtambah",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahpelanggan').modal('show');

                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        });
        $('#tombolCariPelanggan').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "/pelanggan/modalData",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaldatapelanggan').modal('show');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        });
        $('#kodebarang').keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                ambilDataBarang();

            }
        });

        $('#tombolSimpanItem').click(function(e) {
            e.preventDefault();
            simpanItem();

        });

        $('#tombolCariBarang').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "/barangkeluar/modalCariBarang",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modalcaribarang').modal('show');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });

        });
        $('#tombolSelesaiTransaksi').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "/barangkeluar/modalPembayaran",
                data: {
                    nofaktur: $('#nofaktur').val(),
                    tglfaktur: $('#tglfaktur').val(),
                    idpelanggan: $('#idpelanggan').val(),
                    totalharga: $('#totalharga').val(),

                },
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        Swal.fire('Error', response.error, 'error')
                    }
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modalpembayaran').modal('show');

                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        });
    });
</script>


<?= $this->endSection('isi') ?>