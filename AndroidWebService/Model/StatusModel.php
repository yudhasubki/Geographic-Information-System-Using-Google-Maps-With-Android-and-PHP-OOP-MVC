<?php 

	class StatusModel{

		public function getStatus($koneksi){
			$query = "SELECT * FROM posisi";
			$result = mysqli_query($koneksi,$query);
			return $result;
		}
	}


 ?>