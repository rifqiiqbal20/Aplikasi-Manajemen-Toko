<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
    <!-- jQuery -->
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>

    <link rel="stylesheet" href="<?= base_url() ?>/plugins/sweatalert2/sweetalert2.min.css">
    <script src="<?= base_url() ?>/plugins/sweatalert2/sweetalert2.all.min.js"></script>

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-blue navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- <li class="nav-item">
                    <a href=class="nav-link ">
                        <i class="nav-icon fa fa-sign-out-alt text-danger"></i>
                        <p class="text">logout</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="<?= site_url('login/keluar'); ?>" role="button">
                        <div class="row">
                            <i class="nav-icon fa fa-sign-out-alt text-warning">
                            </i>
                            <p class="text-white">logout</p>
                        </div>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-navy">
            <!-- Brand Logo -->
            <a href="/Dashboard" class="brand-link" style="background-color:#ff851b;">
                <img src="<?= base_url() ?>/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Toko Rifqi Putra</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url() ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            <?= session()->get('namauser'); ?>
                        </a>
                    </div>
                </div>



                <!-- Sidebar Menu -->
                <nav class="mt-2 ">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?= site_url('dashboard/index'); ?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '' ?>">
                                <i class="nav-icon fa-solid fa-house fa-fade" style="color: brown;"></i>
                                <p class="text">Dashboard</p>
                            </a>
                        </li>

                        <?php if (session()->idlevel == 1) : ?>


                            <li class="nav-header">Data Master</li>

                            <li class="nav-item">
                                <a href="<?= site_url('barang/index'); ?>" class="nav-link <?= $menu == 'barang' ? 'active' : '' ?>">
                                    <i class="nav-icon fa-solid fa-book" style="color: #1676c0;"></i>
                                    <p class="text">Data Barang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('kategori/index'); ?>" class="nav-link <?= $menu == 'kategori' ? 'active' : '' ?>">
                                    <i class="nav-icon fa fa-tasks " style="color: red;"></i>
                                    <p class="text">Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('satuan/index'); ?>" class="nav-link <?= $menu == 'satuan' ? 'active' : '' ?>">
                                    <i class="nav-icon fa-solid fa-right-to-bracket" style="color: #FFD43B;"></i>
                                    <p class="text">Satuan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('supplier/index'); ?>" class="nav-link <?= $menu == 'Supplier' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-shopping-cart" style="color: chartreuse;"></i>
                                    <p class="text">Supplier</p>
                                </a>
                            </li>
                            <li class="nav-header">Transaksi</li>
                            <li class="nav-item">
                                <a href="<?= site_url('barangmasuk/data'); ?>" class="nav-link <?= $menu == 'barangmasuk' ? 'active' : '' ?>">
                                    <i class="nav-icon fa fa-arrow-alt-circle-down text-primary"></i>
                                    <p class="text">Barang Masuk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('barangkeluar/data'); ?>" class="nav-link <?= $menu == 'barangkeluar' ? 'active' : '' ?>">
                                    <i class="nav-icon fa fa-arrow-alt-circle-up text-warning"></i>
                                    <p class="text">Barang Keluar</p>
                                </a>
                            </li>
                            <li class="nav-header">Laporan</li>
                            <li class="nav-item">
                                <a href="<?= site_url('laporan/masuk'); ?>" class="nav-link <?= $menu == 'Laporanmasuk' ? 'active' : '' ?>">
                                    <i class="nav-icon fa fa-file text-success"></i>
                                    <p class="text">Laporan Barang Masuk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('laporan/keluar'); ?>" class="nav-link <?= $menu == 'Laporankeluar' ? 'active' : '' ?>">
                                    <i class="nav-icon fa fa-file text-danger"></i>
                                    <p class="text">Laporan Barang Keluar</p>
                                </a>
                            </li>
                        <?php endif; ?>


                        <?php if (session()->idlevel == 2) : ?>

                            <li class="nav-item">
                                <a href="<?= site_url('akun/index'); ?>" class="nav-link <?= $menu == 'akun' ? 'active' : '' ?>">
                                    <i class="nav-icon fa-solid fa-user" style="color: #63E6BE;"></i>
                                    <p class="text">Akun</p>
                                </a>
                            </li>
                            <li class="nav-header">Data Master</li>

                            <li class="nav-item">
                                <a href="<?= site_url('barang/index'); ?>" class="nav-link <?= $menu == 'barang' ? 'active' : '' ?>">
                                    <i class="nav-icon fa-solid fa-book" style="color: #1676c0;"></i>
                                    <p class="text">Data Barang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('kategori/index'); ?>" class="nav-link <?= $menu == 'kategori' ? 'active' : '' ?>">
                                    <i class="nav-icon fa fa-tasks " style="color: red;"></i>
                                    <p class="text">Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('satuan/index'); ?>" class="nav-link <?= $menu == 'satuan' ? 'active' : '' ?>">
                                    <i class="nav-icon fa-solid fa-right-to-bracket" style="color: #FFD43B;"></i>
                                    <p class="text">Satuan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('supplier/index'); ?>" class="nav-link <?= $menu == 'Supplier' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-shopping-cart" style="color: chartreuse;"></i>
                                    <p class="text">Supplier</p>
                                </a>
                            </li>

                            <li class="nav-header">Laporan</li>
                            <li class="nav-item">
                                <a href="<?= site_url('laporan/masuk'); ?>" class="nav-link <?= $menu == 'Laporanmasuk' ? 'active' : '' ?>">
                                    <i class="nav-icon fa fa-file text-success"></i>
                                    <p class="text">Laporan Barang Masuk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('laporan/keluar'); ?>" class="nav-link <?= $menu == 'Laporankeluar' ? 'active' : '' ?>">
                                    <i class="nav-icon fa fa-file text-danger"></i>
                                    <p class="text">Laporan Barang Keluar</p>
                                </a>
                            </li>
                        <?php endif; ?>


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>
                                <?= $this->renderSection('judul') ?>
                            </h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <?= $this->renderSection('subjudul') ?>
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?= $this->renderSection('isi') ?>
                    </div>
                    <!-- /.card-body -->

                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; Toko Rifqi Putra
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ./wrapper -->
    <script src="https://kit.fontawesome.com/52bd79fc65.js" crossorigin="anonymous"></script>

    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>/dist/js/demo.js"></script>

    <script src="
https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js
"></script>
</body>

</html>