<?php

class Booking_model
{
    private $table = 'pemesanan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function add()
    {
        $buku = filter_input(INPUT_POST, 'buku', FILTER_SANITIZE_STRING);
        $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $tgl_pesan = date("d-m-Y");

        $query = "INSERT INTO pemesanan (buku, nama, tgl_pesan) 
                VALUES (:buku, :nama, :tgl_pesan)";
        $this->db->query($query);
        $this->db->bind('nama', $nama);
        $this->db->bind('buku', $buku);
        $this->db->bind('tgl_pesan', $tgl_pesan);

        if ($this->db->execute()) {
            header('location: ' . BASEURL . '/booking');
        }

        return $this->db->rowCount();
    }

    public function clear($id)
    {
        $this->db->query("SELECT * FROM pemesanan WHERE id = $id");
        $data = $this->db->resultSet();
        foreach ($data as $data) {
            $buku = $data['buku'];
            $peminjam = $data['nama'];
        }
        $buku = $data['buku'];
        $peminjam = $data['nama'];
        $tgl_pinjam = date('d-m-Y');
        $pinjam = explode("-", $tgl_pinjam);
        $tgl_kembal = mktime(0, 0, 0, date($pinjam[1]), date($pinjam[0]) + 7, date($pinjam[2]));
        $tgl_kembali = date("d-m-Y", $tgl_kembal);
        $status = 'pinjam';

        $query = "DELETE FROM pemesanan where id = $id ";
        $this->db->query($query);
        $this->db->execute();

        $query = "INSERT INTO sirkulasi (buku,peminjam,tgl_pinjam, tgl_kembali,statuss) VALUES 
        (:buku,:peminjam,:tgl_pinjam,:tgl_kembali,:statuss)";
        $this->db->query($query);
        $this->db->bind('buku',  $buku);
        $this->db->bind('peminjam',  $peminjam);
        $this->db->bind('tgl_pinjam',  $tgl_pinjam);
        $this->db->bind('tgl_kembali',  $tgl_kembali);
        $this->db->bind('statuss',  $status);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM pemesanan WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id',  $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getAllBooking()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }




    public function getBooking()
    {
        $username = $_SESSION['username'];
        $this->db->query("SELECT anggota.nis, anggota.nama_anggota, pemesanan.id, pemesanan.buku, pemesanan.nama, pemesanan.tgl_pesan FROM anggota INNER JOIN pemesanan 
        ON pemesanan.nama=anggota.nama_anggota WHERE nis = $username");
        return $this->db->resultSet();
    }

    public function getAllBook()
    {
        $this->db->query('SELECT * FROM buku');
        return $this->db->resultSet();
    }
}
