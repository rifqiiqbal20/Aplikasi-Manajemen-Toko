<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Form Edit Supplier
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fa fa-backward"></i> Kembali', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('supplier/index') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>
<?= form_open('supplier/updatedata', '', [
    'idsupplier' => $id
]) ?>
<div class="form-group">
    <label for="namasupplier">Nama supplier</label>
    <?= form_input('namasupplier', $nama, [
        'class' => 'form-control',
        'id' => 'namasupplier',
        'autofocus' => true,
    ]) ?>

    <?= session()->getFlashdata('errorNamasupplier'); ?>
</div>

<div class="form-group">
    <?= form_submit('', 'Update', [
        'class' => 'btn btn-success'
    ]) ?>
</div>
<?= form_close(); ?>
<?= $this->endSection('isi') ?>