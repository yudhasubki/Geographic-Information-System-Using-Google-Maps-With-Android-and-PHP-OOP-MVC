<?php


  class Login{

    private $koneksi;
    private $user;
    private $count;

  	public function __construct ($koneksi,User $user){
      $this->koneksi = $koneksi;
      $this->user = $user;
  	}

    public function processLogin($koneksi,$username,$password){
      $query = $this->user->getLogin($koneksi,$username,$password);
      $count = $query->num_rows;


        if($count > 0){
          $fetch = $query->fetch_assoc();
          $passHash = $fetch['password'];
          if(password_verify($password,$passHash)){
            $data = array(
              $_SESSION['nama'] = $fetch['nama'],
              $_SESSION['username'] = $fetch['username'],
              $_SESSION['id'] = $fetch['id_user'],
            );
            return $data;
          }
        }
      return null;
    }

  public function getDetail($koneksi,$id){
    $query = $this->user->getDetail($koneksi,$id);
    $count = $query->num_rows;
    if($count > 0){
      while ($query = mysqli_fetch_object($query)) {
        $query = array(
          'nama'=>$query->nama,
          'username'=>$query->username,
          'foto'=>$query->foto,
          'status'=>$query->status
        );
        return $query;
      }
    }
  }

  public function getStatus($koneksi,$id){
    $query = $this->user->getStatus($koneksi,$id);
    $count = $query->num_rows;
    if($count > 0){
      while($query = mysqli_fetch_object($query)){
        $query = array(
          'status'=>$query->nama_posisi
        );
        return $query;
      }
    }
  }


  }

 ?>
