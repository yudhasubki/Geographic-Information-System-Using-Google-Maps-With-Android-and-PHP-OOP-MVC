<?php

  class User{

    public function getLogin($koneksi,$username,$password){
      $query = "SELECT * FROM user WHERE username='$username' AND status='1' OR status='2'";
      $result = mysqli_query($koneksi,$query);
      return $result;
    }

    public function getDetail($koneksi,$id_user){
      $query = "SELECT * FROM user WHERE id_user='$id_user'";
      $result = mysqli_query($koneksi,$query);
      return $result;
    }

    public function getStatus($koneksi,$id_user){
      $query = "SELECT nama_posisi FROM posisi WHERE id_posisi='$id_user'";
      $result = mysqli_query($koneksi,$query);
      return $result;
    }


  }

?>
