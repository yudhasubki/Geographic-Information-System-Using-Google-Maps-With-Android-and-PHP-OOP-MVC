<?php 

	class StatusController{
		private $koneksi;
		private $status;

		public function __construct(Koneksi $koneksi , StatusModel $status){
			$this->koneksi = $koneksi;
			$this->status = $status;
		}

		public function getStatus(){
			$getKoneksi = $this->koneksi->getKoneksi();
			$getStatus = $this->status->getStatus($getKoneksi);

			$data = array();
			while($row = mysqli_fetch_array($getStatus,MYSQLI_ASSOC)){
				$data[] = $row;
			}
			return $data;
		}
	}

 ?>