<?php


$statusModel = new StatusModel();
$status = new StatusController($koneksi,$statusModel);
$allStatus = $status->getStatus();


if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $foto = $_FILES['foto'];
    $fotoNama = $_FILES['foto']['name'];
    $simpanFoto = time().$fotoNama;
    $targetDir = '../assets/images/';
    $dir = '../assets/images/'.basename($simpanFoto);

    $save = $user->saveData($username,$password,$nama,$email,$status,$dir);
    
    if($save){
      $fotoSave = move_uploaded_file($_FILES['foto']['tmp_name'], $dir);
      echo '<script>window.alert("Data Karyawan Berhasil di Input!");window.location=("data-karyawan");</script>';
    }else{
      echo '<script>window.alert("Gagal di Input");window.location=("data-karyawan");</script>';
    }

  }

 ?>
<div class="row">
  <div class="col-md-5">

  <div class="box box-danger">

    <div class="box-header with-border">
      <h3 class="box-title">Tambah Data Karyawan</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
        <form action="" method="POST" id="tambahKaryawan" name="tambahKaryawan" enctype="multipart/form-data">
          <div class="form-group">
            <label>Username</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user-plus"></i>
              </div>
              <input type="text" name="username" id="username" class="form-control" placeholder="username..." required>
            </div>
          </div>

          <div class="form-group">
            <label>Password</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-lock"></i>
              </div>
              <input type="password" name="password" id="password" class="form-control" placeholder="password..." required>
            </div>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Nama</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user"></i>
              </div>
              <input type="text" name="nama" id="nama" class="form-control" placeholder="nama..." required>
            </div>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Email</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </div>
              <input type="email" name="email" id="email" class="form-control" placeholder="email..." required>
            </div>
          </div>
          <div class="form-group">
            <label>Status</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-level-up"></i>
              </div>
              <select class="btn btn-default" id="status" name="status">
              <?php 
                foreach ($allStatus as $key) {
                ?>
                <option class="btn btn-default col-xs-7" value="<?= $key['id_posisi']; ?>"><?= $key['nama_posisi'] ?></option>
               <?php   
                }

               ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Foto</label>
            <div class="input-group">
              <div class="input-group-addon">
                <small class="fa fa-image"></small>
              </div>
              <input class="btn btn-default" id="foto" type="file" name="foto" accept="image/*">
            </div>
          </div>
          <div class="form-group">
            <!-- /.form-group -->
            <div class="form-group">
              <div class="input-group">
                <button type="submit" class="btn btn-primary box submit" name="submit"><i class="fa fa-download"></i> Save</button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    </form>
  <!-- /.box-body -->
  <div class="box-footer">
    Visit <a href="https://pusri.co.id/">PT Pupuk Sriwidjaja</a>
  </div>
</div>
</div>
</div>
