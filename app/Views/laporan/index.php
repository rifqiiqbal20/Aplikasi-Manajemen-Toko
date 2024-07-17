<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Cetak Laporan
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

Silakan Pilih Laporan Yang ingin dicetak

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>


<div class="row">
    <div class="col-lg-4">
        <button type="button" class="btn btn-block btn-lg btn-lg btn-success" onclick="window.location=('/laporan/cetak_barang_masuk')">
            <i class="fa fa-file"></i> LAPORAN BARANG MASUK
        </button>
    </div>
    <div class="col-lg-4">
        <button type="button" class="btn btn-block btn-lg btn-lg btn-danger" onclick="window.location=('/laporan/cetak_barang_keluar')">
            <i class="fa fa-trash-alt"></i> LAPORAN BARANG KELUAR
        </button>
    </div>
    <div class="col-lg-4">

    </div>
</div>
<?php if (session()->has('alert')) : ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Maaf...',
                text: '<?= session('alert') ?>',
                showConfirmButton: false,
                timer: 3000 // Waktu dalam milidetik (3000ms = 3 detik)
            });
        });
    </script>
<?php endif; ?>



<?= $this->endSection('isi') ?>