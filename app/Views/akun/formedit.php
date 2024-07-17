<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Form Edit akun
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fa fa-backward"></i> Kembali', [
    'class' => 'btn btn-warning',
    'onclick' => "location.href=('" . site_url('akun/index') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>
<?= form_open('akun/updatedata', '', [
    'idakun' => $id
]) ?>
<div class="form-group">
    <label for="namaakun">Nama akun</label>
    <?= form_input('namaakun', $nama, [
        'class' => 'form-control',
        'id' => 'namaakun',
        'autofocus' => true,
    ]) ?>

    <?= session()->getFlashdata('errorNamaakun'); ?>
</div>
<div class="form-group">
    <label for="namaakun">Password akun</label>
    <!-- Tampilkan placeholder atau teks sementara -->
    <input type="password" name="namapassword" class="form-control" id="namapassword" placeholder="Password Baru">
    <?= session()->getFlashdata('errorNamapassword'); ?>
</div>

<div class="form-group">
    <?= form_submit('', 'Update', [
        'class' => 'btn btn-success'
    ]) ?>
</div>
<?= form_close(); ?>
<?= $this->endSection('isi') ?>