<?php
class Borrowing extends Controller
{
    public function index()
    {
        $data['judul'] = 'Log Data Pengembalian';
        $data['sirkulasi'] = $this->model('circulation_model')->getAllCirculation();
        $this->view('templates/header', $data);
        $this->view('borrowing/index', $data);
        $this->view('templates/footer');
    }

    public function report()
    {
        $data['judul'] = 'Laporan Anggota';
        $data['buku'] = $this->model('circulation_model')->reportB();
        $this->view('book/report', $data);
    }
}
