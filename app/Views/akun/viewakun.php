<?= $this->extend('main/layout') ?>

<?= $this->section('judul') ?>
Data akun
<?= $this->endSection('judul') ?>

<?= $this->section('subjudul') ?>

<?= form_button('', '<i class="fa fa-plus-circle"> </i> Tambah Data', [
    'class' => 'btn btn-success',
    'onclick' => "location.href=('" . site_url('akun/formtambah') . "')"
]) ?>

<?= $this->endSection('subjudul') ?>


<?= $this->section('isi') ?>

<?= session()->getFlashdata('sukses'); ?>
<?= form_open('akun/index') ?>
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Cari data akun" aria-label="Recipient's username" aria-describedby="button-addon2" name="cari" value="<?= $cari ?>">
    <div class="input-group-append">
        <button class="btn btn-outline-primary" name="tombolcari" type="submit" id="tombolcari" name="tombolcari">
            <i class="fa fa-search"></i>
        </button>
    </div>
</div>
<?= form_close(); ?>
<table class="table table-striped table-bordered" style="width: 100%;">
    <thead>
        <tr style="background-color: red; color:white;">
            <th style="width:5%">No</th>
            <th>User ID</th>
            <th>Nama akun</th>
            <th>Password</th>
            <th>Level pengguna</th>

            <th style="width:15%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 1 + (($nohalaman - 1) * 5);
        foreach ($tampildata as $row) :
        ?>

            <tr>
                <td><?= $nomor++; ?></td>
                <td><?= $row['userid']; ?></td>
                <td><?= $row['usernama']; ?></td>
                <td><?= $row['userpassword']; ?></td>
                <td><?= $row['userlevelid']; ?></td>
                <td>
                    <button type="button" class="btn btn-info" title="Edit Data" onclick="edit('<?= $row['userid'] ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <form method="POST" action="/akun/hapus/<?= $row['userid'] ?>" style="display:inline;" onsubmit="return hapus();">
                        <input type="hidden" value="DELETE" name="_method">
                        <button type="submit" class="btn btn-danger" title="Hapus Data">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="float-center">
    <?= $pager->links('akun', 'paging'); ?>
</div>

<script>
    function edit(id) {
        window.location = ('/akun/formedit/' + id);
    }

    function hapus() {
        pesan = confirm('yakin data akun dihapus ?');

        if (pesan) {
            return true;
        } else {
            return false;
        }

    }
</script>

<?= $this->endSection('isi') ?>