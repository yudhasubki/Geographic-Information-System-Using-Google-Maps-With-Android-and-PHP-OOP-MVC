<?php
   $con = mysqli_connect("localhost","root","","db_trackingpusri");

   if (mysqli_connect_errno($con)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

   $query = "SELECT * FROM data_pengecer WHERE status='1'";
   $result = mysqli_query($con,$query);
   $array = array();

   while($row = mysqli_fetch_object($result)){
			$json['success'] = 'success';
			$json['id_pengecer'] = $row->id_pengecer;
		   $json['kode_pengecer'] = $row->kode_pengecer;
			$json['nama_pengecer'] = $row->nama_pengecer;
			$json['nama_perusahaan'] = $row->nama_perusahaan;
			$json['alamat'] = $row->alamat;
			$json['lat'] = $row->lat;
			$json['lng'] = $row->lng;
			$json['provinsi'] = $row->provinsi;
			$arraypush = array_push($array,$json);
   }
   echo json_encode(array('result'=>$array));

   mysqli_close($con);
?>
