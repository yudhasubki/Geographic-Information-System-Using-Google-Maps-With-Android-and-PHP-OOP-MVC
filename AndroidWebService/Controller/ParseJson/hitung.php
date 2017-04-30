<?php
    $con = mysqli_connect("localhost","root","","db_trackingpusri");

   if (mysqli_connect_errno($con)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

   $result = mysqli_query($con,"SELECT * FROM data_pengecer WHERE status='1'");
   $count = $result->num_rows;

	$json['hitung'] = $count;
	echo json_encode($json);
   mysqli_close($con);
?>
