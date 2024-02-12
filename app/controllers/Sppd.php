<?php
class Sppd extends Controller
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
        $data['title'] = 'Data Surat Perintah Perjalanan Dinas (SPPD)';
        $data['tb_sppd'] = $this->model('SppdModel')->getAllSppd();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('sppd/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Surat Perintah Perjalanan Dinas (SPPD)';
        $data['tb_anggota_dewan'] = $this->model('AnggotaDewanModel')->getAllAnggota();
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('sppd/create', $data);
        $this->view('templates/footer');
    }

    public function simpanSppd()
    {
        if ($this->model('SppdModel')->tambahSppd($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'ditambahkan', 'success');
            header('location: ' . base_url . '/sppd');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'ditambahkan', 'danger');
            header('location: ' . base_url . '/sppd');
            exit;
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Detail Surat Perintah Perjalanan Dinas (SPPD)';
        $data['tb_anggota_dewan'] = $this->model('AnggotaDewanModel')->getAllAnggota();
        $data['tb_sppd'] = $this->model('SppdModel')->getSppdById($id);
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('sppd/edit', $data);
        $this->view('templates/footer');
    }

    public function updateSppd()
    {
        if ($this->model('SppdModel')->updateDataSppd($_POST) > 0) {
            Flasher::setMessage('Berhasil', 'diupdate', 'success');
            header('location: ' . base_url . '/sppd');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'diupdate', 'danger');
            header('location: ' . base_url . '/sppd');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('SppdModel')->deleteSppd($id) > 0) {
            Flasher::setMessage('Berhasil', 'dihapus', 'success');
            header('location: ' . base_url . '/sppd');
            exit;
        } else {
            Flasher::setMessage('Gagal', 'dihapus', 'danger');
            header('location: ' . base_url . '/sppd');
            exit;
        }
    }

    public function cari()
    {
        $data['title'] = 'Data Surat Perintah Perjalanan Dinas (SPPD)';
        $data['tb_sppd'] = $this->model('SppdModel')->cariSppd();
        $data['key'] = $_POST['key'];
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('sppd/index', $data);
        $this->view('templates/footer');
    }

    public function laporan()
    {
        $data['tb_sppd'] = $this->model('SppdModel')->getAllSppd();
        $pdf = new FPDF('p', 'mm', 'A4');

        // membuat halaman baru 
        $pdf->AddPage();
        // setting jenis font yang akan digunakan 
        $pdf->SetFont('Arial', 'B', 14);
        // mencetak string  
        $pdf->Cell(190, 7, 'Laporan Surat Perintah Perjalanan Dinas', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat 
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 6, 'Nama Anggota', 1);
        $pdf->Cell(30, 6, 'Kenderaan', 1);
        $pdf->Cell(40, 6, 'Tujuan', 1);
        $pdf->Cell(40, 6, 'Tanggal Berangkat', 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);

        foreach ($data['tb_sppd'] as $row) {
            $pdf->Cell(50, 6, $row['nama_anggota_dewan'], 1);
            $pdf->Cell(30, 6, $row['jenis_transportasi'], 1);
            $pdf->Cell(40, 6, $row['tempat_tujuan'], 1);
            $pdf->Cell(40, 6, $row['tanggal_berangkat'], 1);
            $pdf->Ln();
        }

        $pdf->Output('I', 'Laporan SPPD.pdf', true);
    }

    public function lihatlaporan()
    {
        $data['title'] = 'Data Laporan Surat Perintah Perjalanan Dinas (SPPD)';
        $data['tb_sppd'] = $this->model('SppdModel')->getAllSppd();
        $this->view('sppd/lihatlaporan', $data);
    }


    public function cetakpdf($id)
    {
        $data['title'] = 'Detail Surat Perintah Perjalanan Dinas (SPPD)';
        $data['tb_sppd'] = $this->model('SppdModel')->getSppdById($id);

        // Membuat instance FPDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'SURAT PERINTAH PERJALANAN DINAS (SPPD)', 0, 1, 'C');
        $pdf->Ln(10);

        // Menampilkan data dalam PDF
        $pdf->SetFont('Arial', '', 12);

        // Section 1: Informasi SPPD
        $pdf->Cell(0, 10, 'Nomor SPPD: ' . $data['tb_sppd']['id'], 0, 1);
        $pdf->Cell(0, 10, 'Tanggal: ' . date('d-m-Y', strtotime($data['tb_sppd']['tanggal_berangkat'])), 0, 1);

        // Section 2: Rincian Perjalanan
        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'Rincian Perjalanan:', 0, 1);
        $pdf->Cell(50, 10, 'Nama Anggota Dewan:', 0);
        $pdf->Cell(0, 10, $data['tb_sppd']['nama_anggota_dewan'], 0, 1);
        $pdf->Cell(50, 10, 'Jenis Transportasi:', 0);
        $pdf->Cell(0, 10, $data['tb_sppd']['jenis_transportasi'], 0, 1);
        $pdf->Cell(50, 10, 'Tujuan:', 0);
        $pdf->Cell(0, 10, $data['tb_sppd']['tempat_tujuan'], 0, 1);
        $pdf->Cell(50, 10, 'Tanggal Pulang:', 0);
        $pdf->Cell(0, 10, date('d-m-Y', strtotime($data['tb_sppd']['tanggal_pulang'])), 0, 1);
        $pdf->Cell(50, 10, 'Jangka Waktu:', 0);
        $pdf->Cell(0, 10, $data['tb_sppd']['jangka_waktu'], 0, 1);

        // Section 3: Detail Kegiatan dan Keuangan
        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'Detail Kegiatan dan Keuangan:', 0, 1);
        $pdf->Cell(50, 10, 'Jenis Kegiatan:', 0);
        $pdf->Cell(0, 10, $data['tb_sppd']['judul_kegiatan'], 0, 1);
        $pdf->Cell(50, 10, 'Nomor Lampiran:', 0);
        $pdf->Cell(0, 10, $data['tb_sppd']['nomor_lampiran'], 0, 1);
        $pdf->Cell(50, 10, 'Nomor Rekening:', 0);
        $pdf->Cell(0, 10, $data['tb_sppd']['nomor_rekening'], 0, 1);
        $pdf->Cell(50, 10, 'Total Realisasi Anggaran:', 0);
        $pdf->Cell(0, 10, $data['tb_sppd']['total_relisasi_anggaran'], 0, 1);

        // Output PDF
        $pdf->Output();
    }




}
