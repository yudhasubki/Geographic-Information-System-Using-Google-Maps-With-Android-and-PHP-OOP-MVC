<?php
  include 'core/header.php';
  $pengecerModel = new DataPengecer();
  $pengecer = new Pengecer($koneksi,$pengecerModel);
  $getPengecer = $pengecer->getPengecer($getKoneksi);
  $userModel = new UserModel();
  $pengecerModel = new DataPengecer();
  $user = new UserController($koneksi,$userModel);
  $countUser = $user->countUser();
  $pengecer = new Pengecer($koneksi,$pengecerModel);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Resource</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $countActive = $pengecer->retailerActive(); ?></h3>
              <p>Data Aktif Retailer</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="#" class="small-box-footer">info</a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $countActive = $pengecer->retailerNonActive(); ?></h3>
              <p>Data Nonaktif Retailer</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-times"></i>
            </div>
            <a href="#" class="small-box-footer">info</a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $countUser ?></h3>

              <p>Data User</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">info</i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Chart Retailer</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script src="../assets/bootstrap/js/selectize.js"></script>
<?php
  include 'core/footer.php';
 ?>
