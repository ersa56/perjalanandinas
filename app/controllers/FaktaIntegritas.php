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

        if (!$data['tb_fakta_integritas']) {
            Flasher::setMessage('Error', 'Data tidak ditemukan', 'danger');
            header('location:' . base_url . '/faktaintegritas');
            exit;
        }

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
        $data = $_POST;

        // Handle file upload
        $uploadResult = $this->model('FaktaIntegritasModel')->tambahFaktaIntegritas($data);

        if ($uploadResult['error']) {
            Flasher::setMessage('Gagal', $uploadResult['message'], 'danger');
            header('location: ' . base_url . '/faktaintegritas');
            exit;
        }

        if ($uploadResult > 0) {
            Flasher::setMessage('Berhasil', 'ditambahkan', 'success');
            header('location: ' . base_url . '/faktaintegritas');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'ditambahkan', 'danger');
            header('location: ' . base_url . '/faktaintegritas');
            exit;
        }
    }

    public function updateFaktaIntegritas()
    {
        $data = $_POST;

        // Cek apakah ada file baru yang dipilih
        if (!empty($_FILES['new_fileupload']['name'])) {
            // Jika ada file baru yang dipilih, lakukan upload dan perbarui nama file pada database
            $fileupload = $this->model('FaktaIntegritasModel')->uploadFile('new_fileupload');

            if ($fileupload['error']) {
                // Handle error jika upload gagal
                Flasher::setMessage('Gagal', $fileupload['message'], 'danger');
                header('location:' . base_url . '/faktaintegritas/edit/' . $data['id']);
                exit;
            }

            // Perbarui nama file pada data yang akan diupdate
            $data['fileupload'] = $fileupload['filename'];
        }

        // Selanjutnya, lanjutkan dengan pembaruan data seperti biasa

        if ($this->model('FaktaIntegritasModel')->updateDataFaktaIntegritas($data) > 0) {
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
        $pdf->Cell(190, 7, 'Laporan Daftar Surat Kegiatan', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat 
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 6, 'Alamat', 1);
        $pdf->Cell(30, 6, 'Tanggal Masuk', 1);
        $pdf->Cell(28, 6, 'Nomor Telepon', 1);
        $pdf->Cell(30, 6, 'Tempat Tujuan', 1);
        $pdf->Cell(70, 6, 'Nama File Yang Terupload', 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['tb_fakta_integritas'] as $row) {
            $pdf->Cell(40, 6, $row['alamat'], 1);
            $pdf->Cell(30, 6, $row['hari'], 1);
            $pdf->Cell(28, 6, $row['nomor_telepon'], 1);
            $pdf->Cell(30, 6, $row['tempat_tujuan'], 1);
            $pdf->Cell(70, 6, $row['fileupload'], 1);
            $pdf->Ln();
        }

        $pdf->Output('I', 'Laporan Data Kegiatan.pdf', true);
    }
}
