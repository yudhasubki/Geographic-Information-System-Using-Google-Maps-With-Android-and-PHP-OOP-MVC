<?php 

	class UserModel {

		public function getData($koneksi){
			$query = "SELECT * FROM user";
			$result = mysqli_query($koneksi,$query);
			return $result;
		}

		public function saveData($koneksi,$username,$password,$nama,$email,$status,$foto){
			$query = "INSERT INTO user (username,password,nama,email,status,foto) VALUES ('$username','$password','$nama','$email','$status','$foto');";
			$result = mysqli_query($koneksi,$query) or die(mysqli_error($koneksi));
			return $result;
		}

		public function oneData($koneksi,$id){
			$query = "SELECT * FROM user WHERE id_user='$id'";
			$result = mysqli_query($koneksi,$query);
			return $result;
		}

		public function editData($koneksi,$username,$nama,$email,$status,$id){
			$query = "UPDATE user SET username='$username',nama='$nama',email='$email',status='$status' WHERE id_user='$id'";
			$result = mysqli_query($koneksi,$query);
			return $result;
		}

		public function removeData($koneksi , $id){
			$query = "DELETE FROM user WHERE id_user='$id'";
			$result = mysqli_query($koneksi,$query);
			return $result;
		}

		

	}




 ?>