<?php
   //$con = mysqli_connect("mysql.idhostinger.com","u909634324_track","yudha0878","u909634324_track");
    $con = mysqli_connect("localhost","root","","db_trackingpusri");
   if (mysqli_connect_errno($con)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

   $username = $_POST['username'];
   $password = $_POST['password'];

   $result = mysqli_query($con,"SELECT * FROM user WHERE username='$username'");
   $count = $result->num_rows;
   $fetch = $result->fetch_assoc();
   $passHash = $fetch['password'];
   if(password_verify($password,$passHash)){
     if($count > 0){
  	   //while($row = mysqli_fetch_object($result)){
  		  $json['success'] = 'success';
  			$json['username'] = $fetch['username'];
  			$json['nama'] = $fetch['nama'];
        $json['email'] = $fetch['email'];
  			echo json_encode($json);
  	   //}
     }else{
  	   $json['gagal'] = 'Gagal';
  	   echo json_encode($json);
     }
   }else{
     $json['gagal'] = 'Gagal';
     echo json_encode($json);
   }
   mysqli_close($con);
?>
