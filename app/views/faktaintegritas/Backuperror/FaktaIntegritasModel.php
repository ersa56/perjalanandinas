<?php
class FaktaIntegritasModel
{
    private $table = 'tb_fakta_integritas';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllFaktaIntegritas()
    {
        $this->db->query('SELECT * FROM ' . $this->table);

        return $this->db->resultSet();
    }

    public function getFaktaIntegritasById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);

        return $this->db->single();
    }

    public function tambahFaktaIntegritas($data)
    {
        // Upload file PDF
        $uploadResult = $this->uploadFile('fileupload');

        if ($uploadResult['status'] === 'error') {
            return $uploadResult; // Kembalikan hasil upload jika terjadi error
        }

        $query = "INSERT INTO {$this->table} (alamat, hari, nomor_telepon, tanggal_berangkat, tanggal_pulang, tempat_tujuan, fileupload) 
        VALUES (:alamat, :hari, :nomor_telepon, :tanggal_berangkat, :tanggal_pulang, :tempat_tujuan, :fileupload)";
        $this->db->query($query);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('hari', $data['hari']);
        $this->db->bind('nomor_telepon', $data['nomor_telepon']);
        $this->db->bind('tanggal_berangkat', $data['tanggal_berangkat']);
        $this->db->bind('tanggal_pulang', $data['tanggal_pulang']);
        $this->db->bind('tempat_tujuan', $data['tempat_tujuan']);
        $this->db->bind('fileupload', $uploadResult['filename']); // Gunakan hasil upload file

        if ($this->db->execute()) {
            return [
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan.'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Gagal menambahkan data.'
            ];
        }
    }


    public function updateDataFaktaIntegritas($data)
    {
        $query = 'UPDATE tb_fakta_integritas SET alamat=:alamat, hari=:hari, nomor_telepon=:nomor_telepon, tanggal_berangkat=:tanggal_berangkat, tanggal_pulang=:tanggal_pulang, tempat_tujuan=:tempat_tujuan, fileupload=:fileupload WHERE id=:id';
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('hari', $data['hari']);
        $this->db->bind('nomor_telepon', $data['nomor_telepon']);
        $this->db->bind('tanggal_berangkat', $data['tanggal_berangkat']);
        $this->db->bind('tanggal_pulang', $data['tanggal_pulang']);
        $this->db->bind('tempat_tujuan', $data['tempat_tujuan']);
        $this->db->bind('fileupload', $data['fileupload']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteFaktaIntegritas($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariFaktaIntegritas()
    {
        $key = $_POST['key'];
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE alamat LIKE :key');
        $this->db->bind('key', "%$key%");

        return $this->db->resultSet();
    }


    private function uploadFile($inputName)
    {
        $uploadDir = 'C:\laragon\www\perjalanandinas\uploads\\'; // Direktori upload, pastikan ada dengan izin tulis
        $allowedExtensions = ['pdf']; // Ekstensi yang diizinkan

        if (!isset($_FILES[$inputName])) {
            return [
                'status' => 'error',
                'message' => 'File tidak ditemukan.'
            ];
        }

        $uploadedFile = $_FILES[$inputName];
        $filename = $uploadedFile['name'];
        $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);

        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            return [
                'status' => 'error',
                'message' => 'Hanya file PDF yang diizinkan.'
            ];
        }

        $destination = $uploadDir . uniqid() . '_' . $filename;

        if (move_uploaded_file($uploadedFile['tmp_name'], $destination)) {
            return [
                'status' => 'success',
                'filename' => $destination
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Gagal mengunggah file. Error: ' . error_get_last()['message']
            ];
        }
    }


}
