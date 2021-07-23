<?php
class Register extends Controller {
    public function index()
    {
        $data['user'] = $this->model('register_model')->getAllUser();
        $this->view('register/index', $data);
    }

    public function registerAdd()
    {
        if( $this->model('register_model')->registerUser($_POST) > 0 )
        {
            Flasher::setFlash('register', 'berhasil', 'success');
            header('location: ' . BASEURL . '/login');
            exit;
        } else {
            Flasher::setFlash('register', 'gagal', 'danger');
            header('location: ' . BASEURL . '/register');
            exit;
        }
    }
}