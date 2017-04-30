<?php

  include 'core/header.php';
  $getPengecer = $pengecer->getPengecer($getKoneksi);

  if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];

    $remove = $pengecer->removeData($id);
    if($remove){
      echo '<script>window.alert("Data Berhasil di Hapus!");window.location=("data-pengecer");</script>';
    }else{
      echo '<script>window.alert("Data Gagal di Hapus!");window.location=("data-pengecer");</script>';
    }
  }

  if(isset($_GET['aktif'])){
    $id = $_GET['aktif'];

    $remove = $pengecer->activeRetailer($id);
    if($remove){
      echo '<script>window.alert("Retailer telah Aktif !");window.location=("data-pengecer");</script>';
    }else{
      echo '<script>window.alert("Gagal!");window.location=("data-pengecer");</script>';
    }
  }

  if(isset($_GET['nonaktif'])){
    $id = $_GET['nonaktif'];

    $remove = $pengecer->nonactiveRetailer($id);
    if($remove){
      echo '<script>window.alert("Retailer telah di Nonaktifkan !");window.location=("data-pengecer");</script>';
    }else{
      echo '<script>window.alert("Gagal!");window.location=("data-pengecer");</script>';
    }
  }
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pengecer
        <small>Resource</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Data Pengecer</li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Pengecer</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tablePosisi" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Kode Pengecer</th>
                  <th>Nama</th>
                  <th>Perusahaan</th>
                  <th>Alamat</th>
                  <th>Status</th>
                  <th></th>
                  <th>Edit</th>
                  <th>Hapus</th>
                </tr>
                </thead>
                <tbody>

                <?php while($row = mysqli_fetch_object($getPengecer)){ ?>
                <tr>
                  <td><?= $row->kode_pengecer; ?></td>
                  <td><?= $row->nama_pengecer; ?></td>
                  <td><?= $row->nama_perusahaan; ?></td>
                  <td><?= $row->alamat; ?></td>
                  <td>
                    <?php if($row->status == 1){ ?>
                      <span class="text-success">Aktif</span>
                    <?php }elseif($row->status == 0) { ?>
                      <span class="text-danger">Non Aktif</span>
                    <?php } ?>
                  </td> 
                  <td><center><a href="?aktif=<?php echo $row->id_pengecer?>"><i class="fa fa-check"></i></a> | <a href="?nonaktif=<?php echo $row->id_pengecer ?>"><i class="fa fa-close"></i></a></center></td>
                  <td><a href="?id=<?php echo $row->id_pengecer ?>" type="button" class="btn btn-warning" name="button">Edit</a></td>
                  <td><a href="?hapus=<?php echo $row->id_pengecer ?>" onclick="return confirmDelete()" type="button" class="btn btn-danger" name="button">Hapus</a></td>
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
          include 'tambah-pengecer.php';
        }else if(isset($id)){
          include 'edit-pengecer.php';
        }

       ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
  function confirmDelete(){
    return confirm("Yakin ingin menghapus Data ? ");
  }

  function nonActive(){
    return confirm("Yakin Non Aktif Retailer ?");
  }

  function Active()
  {
    return confirm("Yakin Mengaktifkan Retailer ? ");
  }
</script>

<?php
  include 'core/footer.php';
 ?>
