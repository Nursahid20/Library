<?php
class Admin extends Controller
{
    public function index()
    {
        $data['user'] = $this->model('register_model')->getAllUser();
        $this->view('admin/index', $data);
    }

    public function registerAd()
    {
        if ($this->model('register_model')->registerAdmin($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('location: ' . BASEURL . '/login');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('location: ' . BASEURL . '/Admin');
            exit;
        }
    }
}
