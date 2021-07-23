<?php
include '../public/fpdf/fpdf.php';

class Setting_model
{
    private $table_book = 'buku';
    private $table_member = 'anggota';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // setting book

    public function getAllBook()
    {
        $this->db->query('SELECT * FROM ' . $this->table_book);
        return $this->db->resultSet();
    }

    public function getBookById($id)
    {
        $this->db->query('SELECT * FROM ' .  $this->table_book . ' WHERE idBuku=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function addBook($data)
    {

        function uploadImg()
        {
            $namaFile = $_FILES['gambar']['name'];
            $ukuranFile = $_FILES['gambar']['size'];
            $error = $_FILES['gambar']['error'];
            $tmpName = $_FILES['gambar']['tmp_name'];

            // cek apakah tidak ada gambar yang diupload
            if ($error === 4) {
                echo "<script>
                        alert('pilih gambar terlebih dahulu!');
                    </script>";
                return false;
            }

            // cek apakah yang diupload adalah gambar
            $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);   // explode = memecah string menggunakan delimiter
            $ekstensiGambar = strtolower(end($ekstensiGambar));
            if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
                echo "<script>
                        alert('yang anda upload bukan gambar!');
                    </script>";
                return false;
            }


            // cek jika ukurannya terlalu besar
            if ($ukuranFile > 1000000) {
                echo "<script>
                        alert('ukuran gambar terlalu besar');
                    </script>";
                return false;
            }

            // lulus pengecekan, gambar sia diupload
            // generate nama gambar baru
            $namaFileBaru = uniqid();
            $namaFileBaru .= '.';
            $namaFileBaru .= $ekstensiGambar;

            move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

            return $namaFileBaru;
        }

        $gambar = uploadImg();
        if (!$gambar) {
            return false;
        }

        $kode = filter_input(INPUT_POST, 'kodeBuku', FILTER_SANITIZE_STRING);
        $judul = filter_input(INPUT_POST, 'judul', FILTER_SANITIZE_STRING);
        $pengarang = filter_input(INPUT_POST, 'pengarang', FILTER_SANITIZE_STRING);
        $penerbit = filter_input(INPUT_POST, 'penerbit', FILTER_SANITIZE_STRING);
        $tahun = filter_input(INPUT_POST, 'tahunTerbit', FILTER_SANITIZE_STRING);
        $stok = filter_input(INPUT_POST, 'stok', FILTER_SANITIZE_STRING);

        $query = "INSERT INTO buku (kodeBuku,judul,pengarang,penerbit,tahunTerbit,stok,gambar)
                    VALUE 
                    (:kodeBuku, :judul, :pengarang, :penerbit, :tahunTerbit, :stok, :gambar)";
        $this->db->query($query);
        $this->db->bind('kodeBuku',  $kode);
        $this->db->bind('judul',  $judul);
        $this->db->bind('pengarang',  $pengarang);
        $this->db->bind('penerbit',  $penerbit);
        $this->db->bind('tahunTerbit',  $tahun);
        $this->db->bind('stok',  $stok);
        $this->db->bind('gambar',  $gambar);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteDataBook($id)
    {
        $query = "DELETE FROM buku WHERE idBuku = :id";
        $this->db->query($query);
        $this->db->bind('id',  $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateDataBook($data)
    {
        function uploadImg1()
        {
            $namaFile = $_FILES['gambar']['name'];
            $ukuranFile = $_FILES['gambar']['size'];
            $error = $_FILES['gambar']['error'];
            $tmpName = $_FILES['gambar']['tmp_name'];

            // cek apakah tidak ada gambar yang diupload
            if ($error === 4) {
                echo "<script>
                        alert('pilih gambar terlebih dahulu!');
                    </script>";
                return false;
            }

            // cek apakah yang diupload adalah gambar
            $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);   // explode = memecah string menggunakan delimiter
            $ekstensiGambar = strtolower(end($ekstensiGambar));
            if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
                echo "<script>
                        alert('yang anda upload bukan gambar!');
                    </script>";
                return false;
            }


            // cek jika ukurannya terlalu besar
            if ($ukuranFile > 1000000) {
                echo "<script>
                        alert('ukuran gambar terlalu besar');
                    </script>";
                return false;
            }

            // lulus pengecekan, gambar sia diupload
            // generate nama gambar baru
            $namaFileBaru = uniqid();
            $namaFileBaru .= '.';
            $namaFileBaru .= $ekstensiGambar;

            move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

            return $namaFileBaru;
        }

        $gambarLama = $data['gambarLama'];

        if ($_FILES['gambar']['error'] === 4) {
            $gambar = $gambarLama;
        } else {
            $gambar = uploadImg1();
        }
        $kode = filter_input(INPUT_POST, 'kodeBuku', FILTER_SANITIZE_STRING);
        $judul = filter_input(INPUT_POST, 'judul', FILTER_SANITIZE_STRING);
        $pengarang = filter_input(INPUT_POST, 'pengarang', FILTER_SANITIZE_STRING);
        $penerbit = filter_input(INPUT_POST, 'penerbit', FILTER_SANITIZE_STRING);
        $tahun = filter_input(INPUT_POST, 'tahunTerbit', FILTER_SANITIZE_STRING);
        $stok = filter_input(INPUT_POST, 'stok', FILTER_SANITIZE_STRING);
        $query = "UPDATE buku
                    SET kodeBuku = :kode , judul= :judul, pengarang= :pengarang, penerbit= :penerbit, tahunTerbit= :terbit, stok= :stok, gambar= :gambar WHERE idBuku = :id";
        $this->db->query($query);
        $this->db->bind('id',  $data['id']);
        $this->db->bind('kode',  $kode);
        $this->db->bind('judul',  $judul);
        $this->db->bind('pengarang',  $pengarang);
        $this->db->bind('penerbit',  $penerbit);
        $this->db->bind('terbit',  $tahun);
        $this->db->bind('stok',  $stok);
        $this->db->bind('gambar',  $gambar);

        $this->db->execute();

        return $this->db->rowCount();
    }

    // report book

    public function report()
    {
        $pdf = new FPDF('P', 'cm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle('Laporan Data Buku ');
        $pdf->SetFont('Arial', 'B', '19');
        $pdf->Cell(19, 1, 'SMAN 1 BINUANG', 0, 1, 'C');
        $pdf->Image('../public/img/sma.png', 2, 1.2, 2.3, 2.3);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(19, 1, 'JL JEND. A. YANI NO. 27 BINUANG, KARANGAN PUTIH, ', 0, 1, 'C');
        $pdf->Cell(19, 1, 'Kec. Binuang, Kab. Tapin Prov. Kalimantan Selatan', 0, 1, 'C');

        $pdf->SetLineWidth(0.1);
        $pdf->Line(1, 4, 20, 4);
        $pdf->ln();
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(19, 0.5, 'Laporan Data Buku', 3, 3, 'C');
        $pdf->ln();
        $pdf->SetLineWidth(0.05);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetFillColor(213, 203, 203);
        $pdf->Cell(2, 1, 'Kode', 1, 0, 'C', true);
        $pdf->Cell(5, 1, 'Judul', 1, 0, 'C', true);
        $pdf->Cell(4, 1, 'Pengarang', 1, 0, 'C', true);
        $pdf->Cell(3, 1, 'Penerbit', 1, 0, 'C', true);
        $pdf->Cell(3, 1, 'Tahun Terbit', 1, 0, 'C', true);
        $pdf->Cell(2, 1, 'Stok', 1, 1, 'C', true);
        $pdf->SetFont('Arial', '', 11);
        $pdf->SetFillColor(255, 255, 255);
        $this->db->query("SELECT * FROM buku");
        $q = $this->db->resultSet();
        foreach ($q as $row) {
            $pdf->Cell(2, 1, $row['kodeBuku'], 1, 0, 'C');
            $pdf->Cell(5, 1, $row['judul'], 1, 0, 'C');
            $pdf->Cell(4, 1, $row['pengarang'], 1, 0, 'C');
            $pdf->Cell(3, 1, $row['penerbit'], 1, 0, 'C');
            $pdf->Cell(3, 1, $row['tahunTerbit'], 1, 0, 'C');
            $pdf->Cell(2, 1, $row['stok'], 1, 1, 'C');
        }
        $pdf->ln(11);
        $pdf->Cell(17.5, 0.5, 'Binuang, ' . date("d M Y"), 0, 1, 'R');
        $pdf->Cell(16.5, 0.5, 'Mengetahui', 0, 1, 'R');
        $pdf->Cell(17.6, 0.5, 'Kepala Sekolah SMAN 1', 0, 1, 'R');
        $pdf->Cell(16.3, 0.5, 'Binuang', 0, 1, 'R');
        $pdf->ln(2);
        $pdf->SetFont('Arial', 'BU', 11);
        $pdf->Cell(19, 0.5, 'Dr. Hj. Endang Budi Lestari, S.Pd.', 0, 1, 'R');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(18, 0.5, 'NIP. 19750515 121591 2005', 0, 1, 'R');
        $pdf->output();
    }




    // Setting Member
    public function getAllMember()
    {
        $this->db->query('SELECT * FROM ' . $this->table_member);
        return $this->db->resultSet();
    }

    public function addMember($data)
    {
        $nis = filter_input(INPUT_POST, 'nis', FILTER_SANITIZE_STRING);
        $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $jk = filter_input(INPUT_POST, 'jk', FILTER_SANITIZE_STRING);
        $kelas = filter_input(INPUT_POST, 'kelas', FILTER_SANITIZE_STRING);
        $nomor = filter_input(INPUT_POST, 'nomor', FILTER_SANITIZE_STRING);
        $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);

        $query = "INSERT INTO anggota (nis,nama_anggota,jenis_kelamin,kelas,no_telepon,alamat)
                    VALUE 
                    (:nis, :nama_anggota, :jenis_kelamin, :kelas, :no_telepon, :alamat)";
        $this->db->query($query);
        $this->db->bind('nis',  $nis);
        $this->db->bind('nama_anggota',  $nama);
        $this->db->bind('jenis_kelamin',  $jk);
        $this->db->bind('kelas',  $kelas);
        $this->db->bind('no_telepon',  $nomor);
        $this->db->bind('alamat',  $alamat);

        $this->db->execute();

        $password = password_hash($nis, PASSWORD_DEFAULT);

        $query1 = "INSERT INTO user (username, password, status) 
                VALUES (:username, :password, :status)";
        $this->db->query($query1);
        $this->db->bind('username', $nis);
        $this->db->bind('password', $password);
        $this->db->bind('status', 'siswa');
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getMemberById($id)
    {
        $this->db->query('SELECT * FROM ' .  $this->table_member . ' WHERE idAnggota=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function updateMember($data)
    {
        $nis = filter_input(INPUT_POST, 'nis', FILTER_SANITIZE_STRING);
        $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $jk = filter_input(INPUT_POST, 'jk', FILTER_SANITIZE_STRING);
        $kelas = filter_input(INPUT_POST, 'kelas', FILTER_SANITIZE_STRING);
        $nomor = filter_input(INPUT_POST, 'nomor', FILTER_SANITIZE_STRING);
        $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);

        $query = "UPDATE anggota
                    SET nis = :nis, nama_anggota = :nama, jenis_kelamin= :jk, 
                    kelas= :kelas, no_telepon= :nomor, alamat= :alamat WHERE idAnggota = :id";
        $this->db->query($query);
        $this->db->bind('id',  $data['id']);
        $this->db->bind('nis',  $nis);
        $this->db->bind('nama',  $nama);
        $this->db->bind('jk',  $jk);
        $this->db->bind('kelas',  $kelas);
        $this->db->bind('nomor',  $nomor);
        $this->db->bind('alamat',  $alamat);


        $this->db->execute();

        return $this->db->rowCount();
    }

    public function findBook()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM buku WHERE judul LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

    public function deleteDataMember($id)
    {
        $query = "DELETE FROM anggota WHERE idAnggota = :id";
        $this->db->query($query);
        $this->db->bind('id',  $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function reportM()
    {
        $pdf = new FPDF('P', 'cm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle('Laporan Data Anggota ');
        $pdf->SetFont('Arial', 'B', '19');
        $pdf->Cell(19, 1, 'SMAN 1 BINUANG', 0, 1, 'C');
        $pdf->Image('../public/img/sma.png', 2, 1.2, 2.3, 2.3);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(19, 1, 'JL JEND. A. YANI NO. 27 BINUANG, KARANGAN PUTIH, ', 0, 1, 'C');
        $pdf->Cell(19, 1, 'Kec. Binuang, Kab. Tapin Prov. Kalimantan Selatan', 0, 1, 'C');

        $pdf->SetLineWidth(0.1);
        $pdf->Line(1, 4, 20, 4);
        $pdf->ln();
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(19, 0.5, 'Laporan Data Anggota', 3, 3, 'C');
        $pdf->ln();
        $pdf->SetLineWidth(0.05);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetFillColor(213, 203, 203);
        $pdf->Cell(3, 1, 'nis', 1, 0, 'C', true);
        $pdf->Cell(5, 1, 'Nama', 1, 0, 'C', true);
        $pdf->Cell(3, 1, 'Jenis Kelamin', 1, 0, 'C', true);
        $pdf->Cell(2, 1, 'Kelas', 1, 0, 'C', true);
        $pdf->Cell(3, 1, 'No Telepon', 1, 0, 'C', true);
        $pdf->Cell(3, 1, 'alamat', 1, 1, 'C', true);
        $pdf->SetFont('Arial', '', 11);
        $pdf->SetFillColor(255, 255, 255);
        $this->db->query("SELECT * FROM anggota");
        $q = $this->db->resultSet();
        foreach ($q as $row) {
            $pdf->Cell(3, 1, $row['nis'], 1, 0, 'C');
            $pdf->Cell(5, 1, $row['nama_anggota'], 1, 0, 'C');
            $pdf->Cell(3, 1, $row['jenis_kelamin'], 1, 0, 'C');
            $pdf->Cell(2, 1, $row['kelas'], 1, 0, 'C');
            $pdf->Cell(3, 1, $row['no_telepon'], 1, 0, 'C');
            $pdf->Cell(3, 1, $row['alamat'], 1, 1, 'C');
        }
        $pdf->ln(11);
        $pdf->Cell(17.5, 0.5, 'Binuang, ' . date("d M Y"), 0, 1, 'R');
        $pdf->Cell(16.5, 0.5, 'Mengetahui', 0, 1, 'R');
        $pdf->Cell(17.6, 0.5, 'Kepala Sekolah SMAN 1', 0, 1, 'R');
        $pdf->Cell(16.3, 0.5, 'Binuang', 0, 1, 'R');
        $pdf->ln(2);
        $pdf->SetFont('Arial', 'BU', 11);
        $pdf->Cell(19, 0.5, 'Dr. Hj. Endang Budi Lestari, S.Pd.', 0, 1, 'R');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(18, 0.5, 'NIP. 19750515 121591 2005', 0, 1, 'R');
        $pdf->output();
    }
}
