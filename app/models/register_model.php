<?php  

class Register_model {
    private $table = 'user';
	private $db;

	public function __construct() {
        $this->db = new Database; 
    }

	public function registerUser($data) {
	    $nis1 = filter_input(INPUT_POST, 'nis', FILTER_SANITIZE_STRING);        
        $nis2 = filter_input(INPUT_POST, 'nis', FILTER_SANITIZE_STRING);        
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $jk = filter_input(INPUT_POST, 'jenis_kelamin', FILTER_SANITIZE_STRING);
        $kelas = filter_input(INPUT_POST, 'kelas', FILTER_SANITIZE_STRING);
        $no_telepon = filter_input(INPUT_POST, 'no_telepon', FILTER_SANITIZE_STRING);
        $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
        $status = 'siswa';
        

        $query = "SELECT username FROM user WHERE username=:nis1";

        $this->db->query($query);
        $this->db->bind('nis1', $nis1);
        $this->db->execute();
        
        if($this->db->single()){
            echo "<script>  
                    alert('username sudah terdaftar');
                  </script>";
            return false;    
        }

        $nis2 = password_hash($nis2, PASSWORD_DEFAULT);

        $query1 = "INSERT INTO user (username, password, status) 
                VALUES (:nis1, :nis2, :status)";
            $this->db->query($query1);
            $this->db->bind('nis1', $nis1);
            $this->db->bind('nis2', $nis2);
            $this->db->bind('status', $status);
            $this->db->execute();
        if($query1){  
            $query2 = "INSERT INTO anggota (nis, nama_anggota, jenis_kelamin, kelas, no_telepon, alamat) 
                VALUES (:nis1, :name , :jk, :kelas, :no_telepon, :alamat)";
            $this->db->query($query2);
            $this->db->bind('nis1', $nis1);
            $this->db->bind('name', $name);
            $this->db->bind('jk', $jk);
            $this->db->bind('kelas', $kelas);
            $this->db->bind('no_telepon', $no_telepon);
            $this->db->bind('alamat', $alamat);
            if($this->db->execute()) {
                header('location: ' . BASEURL . '/login');
            }
        }

        return $this->db->rowCount();
    }

    public function registerAdmin() {      
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $status = 'admin';
        
        $query = "SELECT username FROM user WHERE username=:username";

        $this->db->query($query);
        $this->db->bind('username', $username);
        $this->db->execute();
        
        if($this->db->single()){
            echo "<script>  
                    alert('username sudah terdaftar');
                  </script>";
            return false;    
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query1 = "INSERT INTO user (username, password, status) 
                VALUES (:username, :password, :status)";
            $this->db->query($query1);
            $this->db->bind('username', $username);
            $this->db->bind('password', $password);
            $this->db->bind('status', $status);
            $this->db->execute();
        
            if($this->db->execute()) {
                header('location: ' . BASEURL . '/login');
            }
        

        return $this->db->rowCount();
    }

    public function getAllUser()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

}
?>