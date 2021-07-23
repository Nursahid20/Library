<?php
class Reversion extends Controller
{
    public function index()
    {
        $data['judul'] = 'Log Data Pengembalian';
        $data['sirkulasi'] = $this->model('circulation_model')->getAllReversion();
        $this->view('templates/header', $data);
        $this->view('reversion/index', $data);
        $this->view('templates/footer');
    }

    public function report()
    {
        $data['judul'] = 'Laporan Anggota';
        $data['buku'] = $this->model('circulation_model')->reportR();
        $this->view('book/report', $data);
    }
}
