<?php

class Contact extends Controller {
    public function index()
    {
        $data['judul'] = 'Kontak kami';
        $this->view('templates/header', $data);
        $this->view('contact/index', $data);
        $this->view('templates/footer');
    }

    public function send()
    {
        if($this->model('contact_model')->sendM($_POST) > 0)
        {
            Flasher::setFlash('berhasil', 'dikirim', 'success');
            header('location: ' . BASEURL . '/contact');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dikirim', 'danger');
            header('location: ' . BASEURL . '/contact');
            exit;
        }
    }
}