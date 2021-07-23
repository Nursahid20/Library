<?php

class Galery extends Controller
{
    public function index()
    {
        $data['judul'] = 'Galery';
        $data['buku'] = $this->model('setting_model')->getAllBook();
        $this->view('templates/header', $data);
        $this->view('galery/index', $data);
        $this->view('templates/footer');
    }

    public function find()
    {
        $data['judul'] = 'Galery Buku';
        $data['buku'] = $this->model('setting_model')->findBook();
        $this->view('templates/header', $data);
        $this->view('galery/index', $data);
        $this->view('templates/footer');
    }
}
