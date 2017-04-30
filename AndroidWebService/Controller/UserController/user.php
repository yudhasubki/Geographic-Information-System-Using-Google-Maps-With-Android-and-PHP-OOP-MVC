<?php 

	class UserController{
		private $koneksi;
		private $user;

		public function __construct(Koneksi $koneksi , UserModel $user){
			$this->koneksi = $koneksi;
			$this->user = $user;
		}

		public function allData(){
			$getKoneksi = $this->koneksi->getKoneksi();
			$alldata = $this->user->getData($getKoneksi);
			$data = array();
			while($row = mysqli_fetch_array($alldata,MYSQLI_ASSOC)){
				$data[] = $row;
			}
			return $data;
		}

		public function saveData($username,$password,$nama,$email,$status,$foto){
			$getKoneksi = $this->koneksi->getKoneksi();
			$save = $this->user->saveData($getKoneksi,$username,$password,$nama,$email,$status,$foto);
			if($save){
				return true;
			}
			return false;
		}

		public function oneData($id){
			$getKoneksi = $this->koneksi->getKoneksi();
			$oneData = $this->user->oneData($getKoneksi,$id);
			$fetch = $oneData->fetch_assoc();
			return $fetch;
		}

		public function editData($username,$nama,$email,$status,$id){
			$getKoneksi = $this->koneksi->getKoneksi();
			$editData = $this->user->editData($getKoneksi,$username,$nama,$email,$status,$id);
			if($editData){
				return true;
			}
			return false;
		}

		public function removeData($id){
			$getKoneksi = $this->koneksi->getKoneksi();
			$remove = $this->user->removeData($getKoneksi,$id);
			if($remove){
				return true;
			}
			return false;
		}

		public function countUser(){
			$getKoneksi = $this->koneksi->getKoneksi();
			$alldata = $this->user->getData($getKoneksi);
			$count = $alldata->num_rows;
			return $count;
		}

	}
	


 ?>