<?php

class Booking_book extends Controller
{
    public function index()
    {
        $data['judul'] = 'Kelola Pesanan';
        $data['booking'] = $this->model('booking_model')->getAllBooking();
        $this->view('templates/header', $data);
        $this->view('booking_book/index', $data);
        $this->view('templates/footer');
    }

    public function addBook()
    {
        if ($this->model('setting_model')->addBook($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('location: ' . BASEURL . '/book');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('location: ' . BASEURL . '/book');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('booking_model')->delete($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('location: ' . BASEURL . '/booking_book');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('location: ' . BASEURL . '/booking_book');
            exit;
        }
    }

    public function clear($id)
    {
        if ($this->model('booking_model')->clear($id) > 0) {
            Flasher::setFlash('pemesanan', 'berhasil', 'success');
            header('location: ' . BASEURL . '/booking_book');
            exit;
        } else {
            Flasher::setFlash('pemesanan', 'gagal', 'danger');
            header('location: ' . BASEURL . '/booking_book');
            exit;
        }
    }
}
