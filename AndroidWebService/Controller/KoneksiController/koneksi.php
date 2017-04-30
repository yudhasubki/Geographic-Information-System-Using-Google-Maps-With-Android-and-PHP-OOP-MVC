<?php

  class Koneksi{


      public function getKoneksi(){
        $koneksi = mysqli_connect("localhost","root","","db_trackingpusri");
        return $koneksi;
      }
  }
 ?>
