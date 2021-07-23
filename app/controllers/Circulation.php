<?php

class Circulation extends Controller
{
    public function index($page = 1)
    {
        $data['judul'] = 'Sirkulasi';
        $data['sirkulasi'] = $this->model('circulation_model')->getAllCirculation();
        $data['page'] = $page;
        $this->view('templates/header', $data);
        $this->view('circulation/index', $data);
        $this->view('templates/footer');
    }

    public function addCirculation()
    {
        if ($this->model('circulation_model')->addCirculation($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('location: ' . BASEURL . '/circulation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('location: ' . BASEURL . '/circulation');
            exit;
        }
    }

    public function extend($id)
    {
        if ($this->model('circulation_model')->addExtend($id) > 0) {
            Flasher::setFlash('berhasil', 'diperpanjang', 'success');
            header('location: ' . BASEURL . '/circulation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diperpanjang', 'danger');
            header('location: ' . BASEURL . '/circulation');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('circulation_model')->delete($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('location: ' . BASEURL . '/circulation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('location: ' . BASEURL . '/circulation');
            exit;
        }
    }

    public function clear($id)
    {
        if ($this->model('circulation_model')->clear($id) > 0) {
            Flasher::setFlash('berhasil', 'dikembalikan', 'success');
            header('location: ' . BASEURL . '/circulation');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dikembalikan', 'danger');
            header('location: ' . BASEURL . '/circulation');
            exit;
        }
    }
}
