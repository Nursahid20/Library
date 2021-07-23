<?php

class Book extends Controller
{
    public function index($page = 1)
    {
        $data['judul'] = 'Kelola Buku';
        $data['buku'] = $this->model('setting_model')->getAllBook();
        $data['page'] = $page;
        $this->view('templates/header', $data);
        $this->view('book/index', $data);
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

    public function getBook()
    {
        echo json_encode($this->model('setting_model')->getBookById($_POST['id']));
    }

    public function updateBook()
    {
        if ($this->model('setting_model')->updateDataBook($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('location: ' . BASEURL . '/book');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('location: ' . BASEURL . '/book');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('setting_model')->deleteDataBook($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('location: ' . BASEURL . '/book');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('location: ' . BASEURL . '/book');
            exit;
        }
    }

    public function report()
    {
        $data['judul'] = 'Laporan Buku';
        $data['buku'] = $this->model('setting_model')->report();
        $this->view('book/report', $data);
    }
}
