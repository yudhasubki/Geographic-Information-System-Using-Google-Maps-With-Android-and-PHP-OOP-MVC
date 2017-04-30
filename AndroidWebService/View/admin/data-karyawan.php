<?php include 'core/header.php'; ?>
<?php 
	$userModel = new UserModel();
	$user = new UserController($koneksi,$userModel);
	$allData = $user->allData();

	if(isset($_GET['hapus'])){
		$id = $_GET['hapus'];
		echo $id;
		$remove = $user->removeData($id);

		if($remove){
			echo '<script>window.alert("Berhasil di Hapus");window.location=("data-karyawan");</script>';
		}else{
			echo '<script>window.alert("Gagal di Hapus");window.location=("data-karyawan");</script>';
		}
	}
 ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Karyawan
        <small>PT PUPUK SRIWIDJAJA</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Data Karyawan</li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
	        <div class="box box-primary">
	            <div class="box-header">
	              <h3 class="box-title">Data Karyawan</h3>
	              <div class="box-tools pull-right">
		        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		      </div>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	              <table id="tablePosisi" class="table table-bordered table-hover">
	                <thead>
	                <tr>
	                  <th>Nama</th>
	                  <th>Username</th>
	                  <th>Email</th>
	                  <th>Status</th>
	                  <th>Edit</th>
	                  <th>Hapus</th>
	                </tr>
	                </thead>
	                <tbody>

	                <?php foreach($allData as $key){ ?>
	                <tr>
	                  <td><?= $key['nama']; ?></td>
	                  <td><?= $key['username']; ?></td>
	                  <td><?= $key['email']; ?></td>
	                  <td><?php 
	                  	if($key['status'] == 1){
	                  		echo 'Super Admin';
	              		}
	              		else if($key['status'] == 2)
	              		{
	              			echo 'Manager';
	              		}else
	              		{
	              			echo 'Staff';
	              		}
	                   ?></td>
	                  <td><a href="?id=<?php echo $key['id_user']; ?>" type="button" class="btn btn-warning" name="button">Edit</a></td>
	                  <td><a href="?hapus=<?php echo $key['id_user']; ?>" onclick="return confirmDelete()" type="button" class="btn btn-danger" name="button">Hapus</a></td>
	                </tr>
	                <?php } ?>
	                </tbody>
	                <tfoot border>
	                <tr>
	                  <th></th>
	                  <th></th>
	                  <th></th>
	                  <th></th>
	                  <th></th>
	                  <th></th>
	                </tr>
	                </tfoot>
	              </table>
	            </div>
	            <!-- /.box-body -->
	          </div>
        </div>
      </div>

      <?php


        if(empty($id)){
          include 'tambah-karyawan.php';
        }else if(isset($id)){
          include 'edit-karyawan.php';
        }

       ?>
    </section>
    <!-- /.content -->
  </div>
<script type="text/javascript">
	function confirmDelete(){

		return confirm("Yakin mau menghapus Data ? ");
	}

</script>
<?php include 'core/footer.php'; ?>