<?php
class Login extends Controller
{
    public function index()
    {
        $this->view('login/index');
    }

    public function LoginIn()
    {

        if ($this->model('login_model')->loginUser($_POST) > 0) {
            header('location: ' . BASEURL . '/home');
            exit;
        } else {
            Flasher::setFlash('', 'username atau password salah', 'danger');
            header('location: ' . BASEURL . '/login');
            exit;
        }
    }
}
