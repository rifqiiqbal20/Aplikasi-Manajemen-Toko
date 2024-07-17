<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
From Tambah Supplier
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fa fa-backward"></i> Kembali', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('supplier/index') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>
<?= form_open('supplier/simpandata') ?>
<div class="form-group">
    <label for="namasupplier">Nama supplier</label>
    <?= form_input('namasupplier', '', [
        'class' => 'form-control',
        'id' => 'namasupplier',
        'autofocus' => true,
        'placeholder' => 'Isikan Nama supplier'
    ]) ?>

    <?= session()->getFlashdata('errorNamasupplier'); ?>
</div>

<div class="form-group">
    <?= form_submit('', 'Simpan', [
        'class' => 'btn btn-success'
    ]) ?>
</div>
<?= form_close(); ?>
<?= $this->endSection('isi') ?>