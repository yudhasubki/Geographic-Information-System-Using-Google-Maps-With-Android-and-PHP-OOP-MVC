<?php


  class DataPengecer{

    public function getData($koneksi){
      $query = "SELECT * FROM data_pengecer ORDER BY nama_pengecer";
      $result = mysqli_query($koneksi,$query);
      return $result;
    }

    public function saveData($koneksi,$kode_pengecer,$nama_pengecer,$nama_perusahaan,$alamat,$late,$long){
      $query = "INSERT INTO data_pengecer (`kode_pengecer`,`nama_pengecer`,`nama_perusahaan`,`alamat`,`lat`,`lng`) VALUES ('$kode_pengecer','$nama_pengecer','$nama_perusahaan','$alamat','$late','$long')";
      $result = mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
      return $result;
    }

    public function oneData($koneksi,$id){
      $query = "SELECT * FROM data_pengecer WHERE id_pengecer='$id'";
      $result = mysqli_query($koneksi,$query);
      return $result;
    }

    public function editData($koneksi,$kode_pengecer,$nama_pengecer,$nama_perusahaan,$alamat,$lat,$lng,$id_pengecer){
      $query = "UPDATE data_pengecer SET kode_pengecer='$kode_pengecer', nama_pengecer='$nama_pengecer' , nama_perusahaan='$nama_perusahaan' , alamat='$alamat' , lat='$lat' , lng='$lng' WHERE id_pengecer='$id_pengecer'";
      $result = mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
      return $result;
    }

    public function removeData($koneksi,$id){
      $query = "DELETE FROM data_pengecer WHERE id_pengecer='$id'";
      $result = mysqli_query($koneksi,$query);
      return $result;
    }

    public function activeUser($koneksi,$id){
      $query = "UPDATE data_pengecer SET status=1 WHERE id_pengecer='$id'";
      $result = mysqli_query($koneksi,$query);
      return $result;
    }

    public function nonActive($koneksi,$id){
      $query = "UPDATE data_pengecer SET status=0 WHERE id_pengecer='$id'";
      $result = mysqli_query($koneksi,$query);
      return $result;
    }

    public function retailerActive($koneksi){
      $query = "SELECT * FROM data_pengecer WHERE status='1'";
      $result = mysqli_query($koneksi,$query);
      return $result;
    }

    public function retailerNonActive($koneksi){
      $query = "SELECT * FROM data_pengecer WHERE status='0'";
      $result = mysqli_query($koneksi,$query);
      return $result;
    }

  }



 ?>
