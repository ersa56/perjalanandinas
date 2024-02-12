<?php
class Home extends Controller
{
    public function __construct()
    {
        if ($_SESSION['session_login'] != 'sudah_login') {
            Flasher::setMessage('Login', 'Tidak ditemukan.', 'danger');
            header('location: ' . base_url . '/login');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Halaman Utama';
        $data['nama'] = 'Akhmad Ersa Nugraha';
        $data['tb_anggota_dewan'] = $this->model('AnggotaDewanModel')->getAllAnggota(); // Mendapatkan data pegawai
        $data['tb_kwitansi'] = $this->model('KwitansiModel')->getAllKwitansi();
        $data['tb_sppd'] = $this->model('SppdModel')->getAllSppd();
        $data['tb_fakta_integritas'] = $this->model('FaktaIntegritasModel')->getAllFaktaIntegritas();
        $data['tb_jabatan'] = $this->model('JabatanModel')->getAllJabatan();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}
