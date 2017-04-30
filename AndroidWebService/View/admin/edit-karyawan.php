 <?php

$id = isset($_GET['id']);
$statusModel = new StatusModel();
$status = new StatusController($koneksi,$statusModel);
$allStatus = $status->getStatus();
$oneData = $user->oneData($id);

if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $edit = $user->editData($username,$nama,$email,$status,$id);
    if($edit){
      echo '<script>window.alert("Data Karyawan Berhasil di Edit!");window.location=("data-karyawan");</script>';
    }else{
      echo '<script>window.alert("Gagal di Edit");window.location=("data-karyawan");</script>';
    }

  }

 ?>
<div class="row">
  <div class="col-md-5">

  <div class="box box-danger">

    <div class="box-header with-border">
      <h3 class="box-title">Edit Data Karyawan</h3>

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
              <input type="text" value="<?= $oneData['username']; ?>" name="username" id="username" class="form-control" placeholder="username..." required>
            </div>
          </div>

          <!-- <div class="form-group">
            <label>Password Baru</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-lock"></i>
              </div>
              <input type="password" name="password" id="password" class="form-control" placeholder="password..." required>
            </div>
          </div> -->

          <!-- /.form-group -->
          <div class="form-group">
            <label>Nama</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user"></i>
              </div>
              <input type="text" name="nama" value="<?= $oneData['nama']; ?>" id="nama" class="form-control" placeholder="nama..." required>
            </div>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label>Email</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </div>
              <input type="email" name="email" value="<?= $oneData['email']; ?>" id="email" class="form-control" placeholder="email..." required>
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
          <!-- <div class="form-group">
            <label>Foto</label>
            <div class="input-group">
              <div class="input-group-addon">
                <small class="fa fa-image"></small>
              </div>
              <input class="btn btn-default" id="foto" type="file" name="foto" accept="image/*">
            </div>
          </div> -->
          <div class="form-group">
            <!-- /.form-group -->
            <div class="form-group">
              <div class="input-group">
                <div class="col-xs-6">
                  <button type="submit" class="btn btn-primary box submit" name="submit"><i class="fa fa-gear"></i> Edit</button>
                </div>
                <div class="col-xs-6">
                  <a href="data-karyawan" type="submit" class="btn btn-warning box submit" name="submit"><i class="fa fa-close"></i> Cancel</a>
                </div>
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