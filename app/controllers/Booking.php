<?php

class Booking extends Controller
{
    public function index()
    {
        $data['judul'] = 'Pemesanan';
        $data['booking'] = $this->model('booking_model')->getBooking();
        $data['book'] = $this->model('setting_model')->getAllBook();
        $this->view('templates/header', $data);
        $this->view('booking/index', $data);
        $this->view('templates/footer');
    }

    public function add()
    {
        if ($this->model('booking_model')->add($_POST) > 0) {
            Flasher::setFlash('berhasil', 'dipesan', 'success');
            header('location: ' . BASEURL . '/booking');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dipesan', 'danger');
            header('location: ' . BASEURL . '/booking');
            exit;
        }
    }
}
