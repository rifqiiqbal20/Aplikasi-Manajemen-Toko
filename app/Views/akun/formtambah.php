<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
From Tambah akun
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fa fa-backward"></i> Kembali', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('akun/index') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>
<?= form_open('akun/simpandata') ?>
<div class="form-group">
    <label for="namaakun">ID akun</label>
    <?= form_input('namaakun', 'admin', [
        'class' => 'form-control',
        'id' => 'namaakun',
        'autofocus' => true,
        'placeholder' => 'Isikan Nama akun'
    ]) ?>

    <?= session()->getFlashdata('errorNamaakun'); ?>
</div>
<div class="form-group">
    <label for="namaakun">Nama akun</label>
    <?= form_input('namaakun', '', [
        'class' => 'form-control',
        'id' => 'namaakun',
        'autofocus' => true,
        'placeholder' => 'Isikan Nama akun'
    ]) ?>

    <?= session()->getFlashdata('errorNamaakun'); ?>
</div>
<div class="form-group">
    <label for="namaakun">Password</label>
    <?= form_input('namapassword', '', [
        'class' => 'form-control',
        'id' => 'namapassword',
        'autofocus' => true,
        'placeholder' => 'Isikan Nama Password'
    ]) ?>

    <?= session()->getFlashdata('errorNamaakun'); ?>
</div>


<div class="form-group">
    <?= form_submit('', 'Simpan', [
        'class' => 'btn btn-success'
    ]) ?>
</div>
<?= form_close(); ?>
<?= $this->endSection('isi') ?>