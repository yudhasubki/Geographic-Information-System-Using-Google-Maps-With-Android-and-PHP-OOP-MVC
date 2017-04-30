<?php

	class Pengecer{
		private $koneksi;
		private $pengecer;

		public function __construct(Koneksi $koneksi,DataPengecer $pengecer){
			$this->koneksi = $koneksi;
			$this->pengecer = $pengecer;
		}
		
		public function getData($koneksi){
			$query = $this->pengecer->getData($koneksi);
			$count = $query->num_rows;
			$array = array();
			if($count > 0){
				while($data = mysqli_fetch_object($query)){
					$a['lat'] = $data->lat;
					$a['lng'] = $data->lng;
					$a['nama_pengecer'] = $data->nama_pengecer;
					$a['kode_pengecer'] = $data->kode_pengecer;
					$a['nama_perusahaan'] = $data->nama_perusahaan;
					$arrayPush = array_push($array,$a);
				}
				$json = json_encode(array('result'=>$array));
				return $json;

			}
		}

		public function getNama($koneksi){
			$query = $this->pengecer->getData($koneksi);
			$count = $query->num_rows;
			if($count > 0){
				while($query = mysqli_fetch_object($query)){
					$data = array(
						'lat' => $query->lat,
						'lng' => $query->lng,
						'nama_pengecer' => $query->nama_pengecer
					);
					return $data;
				}
			}
		}

		public function getPengecer($koneksi){
			$query = $this->pengecer->getData($koneksi);
			return $query;
		}

		public function saveData($koneksi,$kode_pengecer,$nama_pengecer,$nama_perusahaan,$alamat,$late,$long){
			$save = $this->pengecer->saveData($koneksi,$kode_pengecer,$nama_pengecer,$nama_perusahaan,$alamat,$late,$long);
			if($save){
				return true;
			}
			return false;
		}

		public function oneData($koneksi,$id){
			$oneData = $this->pengecer->oneData($koneksi,$id);
			$fetch = $oneData->fetch_assoc();
			return $fetch;
		}

		public function editData($koneksi,$kode_pengecer,$nama_pengecer,$nama_perusahaan,$alamat,$lat,$lng,$id){
			$edit = $this->pengecer->editData($koneksi,$kode_pengecer,$nama_pengecer,$nama_perusahaan,$alamat,$lat,$lng,$id);
			if($edit){
				return true;
			}
			return false;
		}

		public function removeData($id){
			$getKoneksi = $this->koneksi->getKoneksi();
			$remove  = $this->pengecer->removeData($getKoneksi,$id);
			if($remove){
				return true;
			}
			return false;
		}

		public function activeRetailer($id){
			$getKoneksi = $this->koneksi->getKoneksi();
			$active = $this->pengecer->activeUser($getKoneksi,$id);
			if($active){
				return true;
			}
			return false;
		}

		public function nonactiveRetailer($id){
			$getKoneksi = $this->koneksi->getKoneksi();
			$active = $this->pengecer->nonActive($getKoneksi,$id);
			if($active){
				return true;
			}
		}

		public function retailerActive()
		{
			$getKoneksi = $this->koneksi->getKoneksi();
			$statusActive = $this->pengecer->retailerActive($getKoneksi);
			$count = $statusActive->num_rows;
			return $count;
		}

		public function retailerNonActive()
		{
			$getKoneksi = $this->koneksi->getKoneksi();
			$statusNonActive = $this->pengecer->retailerNonActive($getKoneksi);
			$count = $statusNonActive->num_rows;
			return $count;
		}
	}

?>
