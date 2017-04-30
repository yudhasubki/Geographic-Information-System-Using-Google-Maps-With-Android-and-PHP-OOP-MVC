<?php
    $con = mysqli_connect("localhost","root","","db_trackingpusri");

   $query = "SELECT * FROM data_pengecer";
   $result = mysqli_query($con,$query);
   $array = array();

   while($row = mysqli_fetch_object($result)){
		  $json['kode_pengecer'] = $row->kode_pengecer;
			$json['lat'] = $row->lat;
			$json['long'] = $row->lng;
			$json['nama_pengecer'] = $row->nama_pengecer;
			$json['alamat'] = $row->alamat;
			$json['provinsi'] = $row->provinsi;
			$json['perusahaan'] = $row->nama_perusahaan;
			$arraypush = array_push($array,$json);
   }
   echo json_encode(array('result'=>$array));

   mysqli_close($con);
?>
