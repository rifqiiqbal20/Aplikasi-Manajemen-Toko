<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Dashboard
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>



<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>


<!-- Small boxes (Stat box) -->



<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class=" fa-solid fa-book"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Data Barang</span>
                <span class="info-box-number">
                    <?= countData('barang'); ?>
                    <small>Data</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-tasks"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Kategori </span>
                <span class="info-box-number"><?= countData('kategori'); ?> <small>Data</small></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fa-solid fa-right-to-bracket"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Satuan </span>
                <span class="info-box-number"><?= countData('satuan'); ?> <small>Data</small></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Supplier</span>
                <span class="info-box-number"><?= countData('supplier'); ?><small>Data</small></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
</div>
<div class="row">
    <div class="col-lg-6 mt-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Grafik Barang Masuk</div>
            <div class="card-body bg-white viewTampilGrafik">


            </div>
        </div>
    </div>
    <div class="col-lg-6 mt-4">
        <div class="card text-white bg-danger mb-3">
            <div class="card-header">Grafik Barang Keluar</div>
            <div class="card-body bg-white viewTampilGrafik2">


            </div>
        </div>
    </div>

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

    function tampilGrafik2() {
        $.ajax({
            type: "post",
            url: "/laporan/tampilGrafikBarangKeluar",
            data: {
                bulan: '2024-05'
            },
            dataType: "json",
            beforeSend: function() {
                $('.viewTampilGrafik2').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            success: function(response) {
                if (response.data) {
                    $('.viewTampilGrafik2').html(response.data);

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }

        });
    }

    $(document).ready(function() {
        tampilGrafik();
        tampilGrafik2();
    });
</script>



<?= $this->EndSection('isi') ?>