<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Top Navigation</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- required stylesheet -->
        <?php
            if (isset($required_style)) {
                foreach ($required_style as $path) {
                    echo '<link rel="stylesheet" href="' . base_url('assets/v2/'. $path) . '">';
                }
            }
        ?>
        <style type="text/css">
            .amount {
                font-size: 40px;
                padding: 15px;
                font-weight: 800;
                margin-top: 2rem;
                margin-bottom: 2rem;
                text-align: center;
            }
        </style>
    </head>
    <body class="hold-transition layout-top-nav">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <div class="container">
                    <a href="<?php echo base_url('barang'); ?>" class="navbar-brand">
                        <img src="<?php echo base_url('assets/v2/dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                        <span class="brand-text font-weight-light">GROSIR LUSINAN</span>
                    </a>
                    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
            <!-- /.navbar -->