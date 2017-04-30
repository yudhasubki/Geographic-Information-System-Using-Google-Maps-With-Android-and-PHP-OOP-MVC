<?php

include '../Controller/LoginController/login.php';
include '../Controller/KoneksiController/koneksi.php';
include '../Model/LoginModel.php';

session_start();
$koneksi = new Koneksi();
$getKoneksi = $koneksi->getKoneksi();
$loginModel = new User();
$login = new Login($getKoneksi,$loginModel);

if(isset($_SESSION['nama']) != null ){
  echo '<script>window.location=("admin/index")</script>';
}

try{
    if(isset($_POST['submit'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $LoginModel = new User();

      $success = $login->processLogin($getKoneksi,$username,$password);
      if($success){
        echo '<script>window.location=("admin/dashboard");</script>';
      }else if(empty($username) || empty($password)){
        echo '<script>window.alert("Username kosong!");</script>';
      }else if($username == null && $password == null){
        echo '<Script>window.alert("Username dan Password masih kosong");</script>';
      }else{
        echo '<script>window.alert("Username dan Password Salah")</script>';
      }
    }
  }catch(Exception $e){
    echo $e->getMessage();
  }



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PT PUPUK SRIWIDJAJA | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="icon" href="assets/images/pusri.png" >
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page" style="background-color:#42a5f5">
<div class="login-box">
  <div class="login-logo">
    <img src="assets/images/pusri.png " style="width:150px;height:200px;">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="background-color:#ffeb3b">
      <p class="login-box-msg" style="color:#0d47a1"><b>Menjadi Perusahaan Pupuk Terkemuka Tingkat Regional</b></p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username">
        <span style="color:#0d47a1;" class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span style="color:#0d47a1;" class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <span style="color:#0d47a1;"> Created By <a href="#">Yudha & Jery</a></span>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat"><span style="color:#ffff00;"><b>Sign In</b></span></button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
