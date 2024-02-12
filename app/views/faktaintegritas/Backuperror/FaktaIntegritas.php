<?php
class FaktaIntegritas extends Controller
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
        $data['title'] = 'Data Laporan Kegiatan';
        $data['tb_fakta_integritas'] = $this->model('FaktaIntegritasModel')->getAllFaktaIntegritas();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('faktaintegritas/index', $data);
        $this->view('templates/footer');
    }

    public function cari()
    {
        $data['title'] = 'Data Kegiatan';
        $data['tb_fakta_integritas'] = $this->model('FaktaIntegritasModel')->cariFaktaIntegritas();
        $data['key'] = $_POST['key'];
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('faktaintegritas/index', $data);
        $this->view('templates/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Detail Laporan Kegiatan';
        $data['tb_fakta_integritas'] = $this->model('FaktaIntegritasModel')->getFaktaIntegritasById($id);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('faktaintegritas/edit', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Laporan';
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('faktaintegritas/create', $data);
        $this->view('templates/footer');
    }

    public function simpanFaktaIntegritas()
    {
        $uploadResult = $this->uploadFile('fileupload');

        if ($uploadResult['error']) {
            Flasher::setMessage('Gagal', $uploadResult['message'], 'danger');
            header('location: ' . base_url . '/faktaintegritas');
            exit;
        }

        $_POST['fileupload'] = $uploadResult['filename'];

        $result = $this->model('FaktaIntegritasModel')->tambahFaktaIntegritas($_POST);

        if ($result['status'] === 'success') {
            Flasher::setMessage('Berhasil', 'ditambahkan', 'success');
            header('location: ' . base_url . '/faktaintegritas');
            exit;
        } else {
            Flasher::setMessage('Gagal', $result['message'], 'danger');
            header('location: ' . base_url . '/faktaintegritas');
            exit;
        }
    }


    public function updateFaktaIntegritas()
    {
        if ($this->model('FaktaIntegritasModel')->updateDataFaktaIntegritas($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'diupdate', 'success');
            header('location:' . base_url . '/faktaintegritas');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'diupdate', 'danger');
            header('location:' . base_url . '/faktaintegritas');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('FaktaIntegritasModel')->deleteFaktaIntegritas($id) > 0) {
            Flasher::setMessage('Berhasil', 'dihapus', 'success');
            header('location:' . base_url . '/faktaintegritas');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'dihapus', 'danger');
            header('location: ' . base_url . '/faktaintegritas');
            exit;
        }
    }

    public function lihatlaporan()
    {
        $data['title'] = 'Data Laporan Kegiatan';
        $data['tb_fakta_integritas'] = $this->model('FaktaIntegritasModel')->getAllFaktaIntegritas();
        $this->view('faktaintegritas/lihatlaporan', $data);
    }

    public function laporan()
    {
        $data['tb_fakta_integritas'] = $this->model('FaktaIntegritasModel')->getAllFaktaIntegritas();
        $pdf = new FPDF('p', 'mm', 'A4');

        // membuat halaman baru 
        $pdf->AddPage();
        // setting jenis font yang akan digunakan 
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string  
        $pdf->Cell(190, 7, 'LAPORAN DATA KWITANSI', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat 
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 6, 'JUMLAH KWITANSI', 1);
        $pdf->Cell(30, 6, 'KODE KWITANSI', 1);
        $pdf->Cell(35, 6, 'NOMOR KWITANSI', 1);
        $pdf->Cell(40, 6, 'TANGGAL KWITANSI', 1);
        $pdf->Cell(35, 6, 'TOTAL KWITANSI', 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['tb_kwitansi'] as $row) {
            $pdf->Cell(35, 6, $row['jumlah_kwitansi'], 1);
            $pdf->Cell(30, 6, $row['kode_kwitansi'], 1);
            $pdf->Cell(35, 6, $row['nomor_kwitansi'], 1);
            $pdf->Cell(40, 6, $row['tanggal_kwitansi'], 1);
            $pdf->Cell(35, 6, $row['total_kwitansi'], 1);
            $pdf->Ln();
        }

        $pdf->Output('I', 'Laporan Kwitansi.pdf', true);
    }

    private function uploadFile($inputName)
    {
        $uploadDir = 'C:\laragon\www\perjalanandinas\uploads\\'; // Pastikan adanya garis miring di akhir
        $allowedExtensions = ['pdf']; // Ekstensi yang diizinkan

        if (!isset($_FILES[$inputName])) {
            return [
                'error' => true,
                'message' => 'File tidak ditemukan.'
            ];
        }

        $uploadedFile = $_FILES[$inputName];
        $filename = $uploadedFile['name'];
        $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);

        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            return [
                'error' => true,
                'message' => 'Hanya file PDF yang diizinkan.'
            ];
        }

        $destination = $uploadDir . uniqid() . '_' . $filename;

        if (move_uploaded_file($uploadedFile['tmp_name'], $destination)) {
            return [
                'error' => false,
                'filename' => $destination
            ];
        } else {
            // Tambahkan informasi debug
            return [
                'error' => true,
                'message' => 'Gagal mengunggah file. Error: ' . error_get_last()['message']
            ];
        }
    }
}
