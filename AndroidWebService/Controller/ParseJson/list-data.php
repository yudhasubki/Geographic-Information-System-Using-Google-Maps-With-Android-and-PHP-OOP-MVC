<?php
   //$con = mysqli_connect("mysql.idhostinger.com","u909634324_track","yudha0878","u909634324_track");
   $con = mysqli_connect("localhost","root","","db_trackingpusri");
   $kode_pengecer = $_POST['kode_pengecer'];
   $explode = explode('-',$kode_pengecer);

   $query = "SELECT * FROM data_pengecer WHERE kode_pengecer='$explode[0]'";
   $result = mysqli_query($con,$query);
   $count = $result->num_rows;

   if($count > 0){
	   while($row = mysqli_fetch_object($result)){
		    $json['success'] = 'success';
		   	$json['kode_pengecer'] = $row->kode_pengecer;
			$json['nama_pengecer'] = $row->nama_pengecer;
			$json['lat'] = $row->lat;
			$json['lng'] = $row->lng;
			echo json_encode($json);
	   }
   }else{
	   $json['gagal'] = 'gagal';
	   echo json_encode($json);
   }

   mysqli_close($con);
?>
