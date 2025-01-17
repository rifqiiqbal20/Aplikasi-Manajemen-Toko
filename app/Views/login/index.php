<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">

</head>


<body class="hold-transition login-page bg-navy">

    <div class="container-card" width:70%; height:60%;>
        <div class="card-header text-center">
            <a href="#" class="h1"><b>Toko Rifqi</b>Putra</a>
        </div>
        <div class="login-box container">

            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <div class="login-logo">
                        <a href="<?= base_url() ?>/index2.html">Silahkan Login</a>
                    </div>
                    <?= form_open('login/cekUser'); ?>
                    <?= csrf_field(); ?>
                    <div class="input-group mb-3">
                        <?php

                        $isInvalidUser = (session()->getFlashdata('errIdUser')) ? 'is-invalid' : '';
                        ?>
                        <input type="text" name="iduser" class="form-control <?= $isInvalidUser ?>" placeholder="Inputkan ID user" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <?php
                        if (session()->getFlashdata('errIdUser')) {
                            echo ' <div id="validationServer03Feedback" class="invalid-feedback">
                        ' . session()->getFlashdata('errIdUser') . '
                        </div>';
                        }
                        ?>
                    </div>
                    <div class="input-group mb-3">
                        <?php
                        $isInvalidPassword = (session()->getFlashdata('errPassword')) ? 'is-invalid' : '';

                        ?>
                        <input type="password" name="pass" class="form-control <?= $isInvalidPassword ?>" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <?php
                        if (session()->getFlashdata('errPassword')) {
                            echo ' <div id="validationServer03Feedback" class="invalid-feedback">
                        ' . session()->getFlashdata('errPassword') . '
                        </div>';
                        }
                        ?>
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-block btn-success">
                            Login
                        </button>
                    </div>

                    <?= form_close(); ?>


                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
</body>

</html>