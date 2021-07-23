<?php
include '../public/fpdf/fpdf.php';

class Circulation_model
{
    private $table = 'sirkulasi';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addCirculation()
    {
        $idSkl = filter_input(INPUT_POST, 'idSkl', FILTER_SANITIZE_STRING);
        $peminjam = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $buku = filter_input(INPUT_POST, 'buku', FILTER_SANITIZE_STRING);
        $tgl_pinj = filter_input(INPUT_POST, 'tgl_pinjam', FILTER_SANITIZE_STRING);
        $pinjam = explode("-", $tgl_pinj);
        $tgl_pinja = mktime(0, 0, 0, date($pinjam[1]), date($pinjam[2]), date($pinjam[0]));
        $tgl_pinjam = date("d-m-Y", $tgl_pinja);
        $tgl_kembal = mktime(0, 0, 0, date($pinjam[1]), date($pinjam[2]) + 7, date($pinjam[0]));
        $tgl_kembali = date("d-m-Y", $tgl_kembal);
        $status = 'pinjam';

        $query = "INSERT INTO sirkulasi (idSkl, buku, peminjam, tgl_pinjam,tgl_kembali,statuss) 
                VALUES (:id, :buku, :peminjam, :tgl_pinjam, :tgl_kembali, :statuss)";
        $this->db->query($query);
        $this->db->bind('id', $idSkl);
        $this->db->bind('buku', $buku);
        $this->db->bind('peminjam', $peminjam);
        $this->db->bind('tgl_pinjam', $tgl_pinjam);
        $this->db->bind('tgl_kembali', $tgl_kembali);
        $this->db->bind('statuss', $status);

        if ($this->db->execute()) {
            header('location: ' . BASEURL . '/circulation');
        }

        return $this->db->rowCount();
    }

    public function getAllCirculation()
    {
        $this->db->query('SELECT * FROM ' . $this->table . " WHERE statuss = 'pinjam'");
        return $this->db->resultSet();
    }

    public function getAllReversion()
    {
        $this->db->query('SELECT * FROM ' . $this->table . " WHERE statuss = 'kembali'");
        return $this->db->resultSet();
    }

    public function delete($id)
    {
        $query = "DELETE FROM sirkulasi WHERE idSkl = :id";
        $this->db->query($query);
        $this->db->bind('id',  $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function clear($id)
    {
        $query = "UPDATE sirkulasi set statuss = 'kembali' WHERE idSkl = $id";
        $this->db->query($query);
        $this->db->bind('id',  $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getCirculation($id)
    {
        $this->db->query('SELECT * FROM ' .  $this->table . ' WHERE idSkl=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function addExtend($id)
    {
        $this->db->query('SELECT * FROM ' .  $this->table . ' WHERE idSkl=:id');
        $this->db->bind('id', $id);
        $tgl = $this->db->single();
        $tgl =  explode('-', $tgl['tgl_kembali']);
        $tgl_ = mktime(0, 0, 0, date($tgl[1]), date($tgl[0]) + 7, date($tgl[2]));
        $tgl_kembali = date("d-m-Y", $tgl_);

        $this->db->query('UPDATE ' .  $this->table . ' SET tgl_kembali = :tgl WHERE idSkl=:id');
        $this->db->bind('tgl', $tgl_kembali);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function reportB()
    {
        $pdf = new FPDF('P', 'cm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle('Laporan Data Siswa yang meminjam buku');
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
        $pdf->Cell(19, 0.5, 'Laporan Data Siswa yang meminjam buku', 3, 3, 'C');
        $pdf->ln();
        $pdf->SetLineWidth(0.05);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetFillColor(213, 203, 203);
        $pdf->Cell(2, 1, 'No', 1, 0, 'C', true);
        $pdf->Cell(6, 1, 'Buku', 1, 0, 'C', true);
        $pdf->Cell(6, 1, 'Peminjam', 1, 0, 'C', true);
        $pdf->Cell(5, 1, 'Tanggal Pinjam', 1, 1, 'C', true);
        $pdf->SetFont('Arial', '', 11);
        $pdf->SetFillColor(255, 255, 255);
        $this->db->query("SELECT * FROM sirkulasi WHERE statuss = 'pinjam'");
        $q = $this->db->resultSet();
        $i = 1;
        foreach ($q as $row) {
            $pdf->Cell(2, 1, $i, 1, 0, 'C');
            $pdf->Cell(6, 1, $row['buku'], 1, 0, 'C');
            $pdf->Cell(6, 1, $row['peminjam'], 1, 0, 'C');
            $pdf->Cell(5, 1, $row['tgl_pinjam'], 1, 1, 'C');
            $i++;
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

    public function reportR()
    {
        $pdf = new FPDF('P', 'cm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle('Laporan Data Siswa yang sudah mengembalikan buku');
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
        $pdf->Cell(19, 0.5, 'Laporan Data Siswa yang sudah mengembalikan buku', 3, 3, 'C');
        $pdf->ln();
        $pdf->SetLineWidth(0.05);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetFillColor(213, 203, 203);
        $pdf->Cell(2, 1, 'No', 1, 0, 'C', true);
        $pdf->Cell(6, 1, 'Buku', 1, 0, 'C', true);
        $pdf->Cell(6, 1, 'Peminjam', 1, 0, 'C', true);
        $pdf->Cell(5, 1, 'Tanggal kembali', 1, 1, 'C', true);
        $pdf->SetFont('Arial', '', 11);
        $pdf->SetFillColor(255, 255, 255);
        $this->db->query("SELECT * FROM sirkulasi WHERE statuss = 'kembali'");
        $q = $this->db->resultSet();
        $i = 1;
        foreach ($q as $row) {
            $pdf->Cell(2, 1, $i, 1, 0, 'C');
            $pdf->Cell(6, 1, $row['buku'], 1, 0, 'C');
            $pdf->Cell(6, 1, $row['peminjam'], 1, 0, 'C');
            $pdf->Cell(5, 1, $row['tgl_kembali'], 1, 1, 'C');
            $i++;
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


    // public function clearData($id)
    // {
    //     $id1 = explode(',', $id);
    //     $query = "SELECT stok FROM buku WHERE kodeBuku= :kode";
    //     $this->db->query($query);
    //     $this->db->bind('kode',  $id1[1]);

    //     $value = $this->db->single();
    //     $val1 = (int)$value['stok'];
    //     $val2 = $val1 + 1;

    //     $query = "UPDATE buku SET stok= :val2 WHERE kodeBuku = :kode";
    //     $this->db->query($query);
    //     $this->db->bind('val2',  $val2);
    //     $this->db->bind('kode',  $id1[1]);

    //     $this->db->execute();

    //     $status = 'clear';
    //     $query = "UPDATE pinjam SET status= :status WHERE id = :id";
    //     $this->db->query($query);
    //     $this->db->bind('status',  $status);
    //     $this->db->bind('id',  $id1[0]);

    //     $this->db->execute();


    //     return $this->db->rowCount();
    // }
}
