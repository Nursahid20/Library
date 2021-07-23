<?php  

class Contact_model {
	private $table = 'pesan';
	private $db;

	public function __construct() {
        $this->db = new Database; 
    }

	public function sendM($data) {
	    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $no_telepon = filter_input(INPUT_POST, 'no_telepon', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $pesan = filter_input(INPUT_POST, 'pesan', FILTER_SANITIZE_STRING);
	   
	    $query = "INSERT INTO pesan
                    VALUE 
                    (:nama, :nomor, :email, :pesan)";
        $this->db->query($query);
        $this->db->bind('nama',  $data['nama']);
        $this->db->bind('nomor',  $data['no_telepon']);
        $this->db->bind('email',  $data['email']);
        $this->db->bind('pesan',  $data['pesan']);

        $this->db->execute();

        return $this->db->rowCount();
    }

}
?>