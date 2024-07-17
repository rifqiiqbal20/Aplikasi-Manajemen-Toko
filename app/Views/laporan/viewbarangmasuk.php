<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Laporan Barang Masuk
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>



<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<div class="row">
    <div class="col-lg-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Pilih Periode</div>
            <div class="card-body bg-white">
                <p class="card-text">
                    <?= form_open('laporan/cetak_barang_masuk_periode', ['target' => '_blank']) ?>
                <div class="form-group">
                    <label for="">Tanggal Awal</label>
                    <input type="date" name="tglawal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Akhir</label>
                    <input type="date" name="tglakhir" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-success">
                        <i class="fa fa-print"></i> Cetak Laporan
                    </button>
                </div>
                <?= form_close() ?>
                </p>
            </div>
        </div>
    </div>
    <!-- <div class="col-lg-8">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Grafik Barang Masuk</div>
            <div class="card-body bg-white viewTampilGrafik">


            </div>
        </div>
    </div> -->
</div>

<script>
    function tampilGrafik() {
        $.ajax({
            type: "post",
            url: "/laporan/tampilGrafikBarangMasuk",
            data: {
                bulan: '2024-05'
            },
            dataType: "json",
            beforeSend: function() {
                $('.viewTampilGrafik').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            success: function(response) {
                if (response.data) {
                    $('.viewTampilGrafik').html(response.data);

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }

        });
    }

    $(document).ready(function() {
        tampilGrafik();
    });
</script>
<?= $this->endSection('isi') ?>