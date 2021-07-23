<?php

class Member extends Controller
{
    public function index($page = 1)
    {
        $data['judul'] = 'Kelola Anggota';
        $data['siswa'] = $this->model('setting_model')->getAllMember();
        $data['page'] = $page;
        $this->view('templates/header', $data);
        $this->view('member/index', $data);
        $this->view('templates/footer');
    }

    public function addMember()
    {
        if ($this->model('setting_model')->addMember($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('location: ' . BASEURL . '/member');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('location: ' . BASEURL . '/member');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('setting_model')->deleteDataMember($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('location: ' . BASEURL . '/member');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('location: ' . BASEURL . '/member');
            exit;
        }
    }

    public function getMember()
    {
        echo json_encode($this->model('setting_model')->getMemberById($_POST['id']));
    }

    public function updateMember()
    {
        if ($this->model('setting_model')->updateMember($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('location: ' . BASEURL . '/member');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('location: ' . BASEURL . '/member');
            exit;
        }
    }

    public function report()
    {
        $data['judul'] = 'Laporan Anggota';
        $data['buku'] = $this->model('setting_model')->reportM();
        $this->view('book/report', $data);
    }
}
