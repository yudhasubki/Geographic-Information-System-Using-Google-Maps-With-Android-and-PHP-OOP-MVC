<?php

  session_start();
  include '../../Controller/LoginController/login.php';
  include '../../Controller/KoneksiController/koneksi.php';
  include '../../Model/LoginModel.php';
  include '../../Model/PengecerModel.php';
  include '../../Model/UserModel.php';
  include '../../Model/StatusModel.php';
  include '../../Controller/AssetController/pengecer.php';
  include '../../Controller/UserController/user.php';
  include '../../Controller/StatusController/status.php';
  include 'directory.php';
  $id = isset($_GET['id']);
  $koneksi = new Koneksi();
  $loginModel = new User();
  $getKoneksi = $koneksi->getKoneksi();
  $login = new Login($getKoneksi,$loginModel);
  $pengecerModel = new DataPengecer();
  $pengecer = new Pengecer($koneksi,$pengecerModel);

  if(isset($_SESSION['nama']) == null){
      echo '<script>window.location=("../")</script>';
    }else{
      $getDetail = $login->getDetail($getKoneksi,$_SESSION['id']);
    }
  $status = $getDetail['status'];
  $getStatus = $login->getStatus($getKoneksi,$status);


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PT PUPUK SRIWIDJAJA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../assets/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../assets/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="../assets/helper/datatables.css">
  <link rel="stylesheet" href="../assets/plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="../assets/dist/css/jquery-ui.css">
  <link rel="stylesheet" href="../assets/dist/js/jtable/themes/lightcolor/blue/jtable.min.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/selectize.bootstrap3.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/selectize.css">
  <link rel="stylesheet" href="../assets/bootstrap/css/selectize.bootstrap3.css">
  <link rel="stylesheet" href="../assets/plugins/elfinder/css/elfinder.min.css">
  <link rel="stylesheet" href="../assets/plugins/elfinder/css/theme.css">
 
  <script src="../assets/dist/js/html5shiv.min.js"></script>
  <script src="../assets/dist/js/respond.min.js"></script>
  <script src="../assets/dist/js/jquery.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/dist/js/jquery-ui.js"></script>

</head>
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PUSRI</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $getDetail['foto'];?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['nama']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $getDetail['foto'];?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo $_SESSION['nama']; ?>
                  <small>
                    <?php
                      echo $getStatus['status'];
                     ?>

                  </small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $getDetail['foto'];?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nama']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview <?php if($first_part == "dashboard"){echo "active"; }?>">
          <a href="dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview <?php if($first_part == "maps"){echo "active"; }?>">
          <a href="maps">
            <i class="fa fa-map"></i> <span>Maps</span>
          </a>
        </li>
        <li class="treeview <?php if($first_part == "data-pengecer"){echo "active"; }?>">
          <a href="data-pengecer">
            <i class="fa fa-user"></i>
            <span>Data Pengecer</span>
          </a>
        </li>
        <li class="treeview <?php if($first_part == "data-karyawan"){echo "active"; }?>">
          <a href="data-karyawan">
            <i class="fa fa-briefcase"></i>
            <span>Data Karyawan</span>
          </a>
        </li>
		<li class="treeview <?php if($first_part == "data-manager"){echo "active"; }?>">
          <a href="data-manager">
            <i class="fa fa-database"></i>
            <span>Data Manager</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
