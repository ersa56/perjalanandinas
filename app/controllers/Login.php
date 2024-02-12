<?php

class Login extends Controller
{
    public function index()
    {
        $data['title'] = 'Halaman Login';
        $this->view('login/login', $data);
    }

    public function prosesLogin()
    {
        $loginModel = $this->model('LoginModel');
        $data = $loginModel->checkLogin($_POST);

        if ($data) {
            $_SESSION['username'] = $data['username'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['session_login'] = 'sudah_login';

            // Mengambil role user
            $role = $loginModel->getUserRole($data['username']);

            // Redirect sesuai dengan role
            if ($role == 'admin') {
                header('location: ' . base_url . '/admin');
            } elseif ($role == 'user') {
                header('location: ' . base_url . '/home');
            } else {
                // Handle jika terdapat role lainnya
                Flasher::setMessage('Role tidak valid', '', 'danger');
                header('location: ' . base_url . '/login');
                exit;
            }
        } else {
            Flasher::setMessage('Username / Password', 'salah.', 'danger');
            header('location: ' . base_url . '/login');
            exit;
        }
    }
}
