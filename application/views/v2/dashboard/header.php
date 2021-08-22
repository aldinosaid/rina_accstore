<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>AdminLTE 3 | Dashboard 3</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome Icons -->
      <link rel="stylesheet" href="<?php echo base_url('assets/v2/plugins/fontawesome-free/css/all.min.css'); ?>">
      <!-- required stylesheet -->
      <?php
         if (isset($required_style)) {
            foreach ($required_style as $path) {
               echo '<link rel="stylesheet" href="' . base_url('assets/v2/'. $path) . '">';
            }
         }
      ?>
      <!-- IonIcons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?php echo base_url('assets/v2/dist/css/adminlte.min.css'); ?>">
   </head>
   <body class="hold-transition sidebar-mini">
      <div class="wrapper">
         <!-- Navbar -->
         <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
               </li>
            </ul>
         </nav>
         <!-- /.navbar -->
         <?php
            include 'sidebar.php';
         ?>