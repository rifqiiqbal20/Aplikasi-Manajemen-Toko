<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
From Tambah Satuan
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fa fa-backward"></i> Kembali', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('satuan/index') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>
<?= form_open('satuan/simpandata') ?>
<div class="form-group">
    <label for="namasatuan">Nama satuan</label>
    <?= form_input('namasatuan', '', [
        'class' => 'form-control',
        'id' => 'namasatuan',
        'autofocus' => true,
        'placeholder' => 'Isikan Nama satuan'
    ]) ?>

    <?= session()->getFlashdata('errorNamasatuan'); ?>
</div>

<div class="form-group">
    <?= form_submit('', 'Simpan', [
        'class' => 'btn btn-success'
    ]) ?>
</div>
<?= form_close(); ?>
<?= $this->endSection('isi') ?>