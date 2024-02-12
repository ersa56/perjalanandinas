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
        $fileupload = $this->uploadFile('fileupload'); // Panggil metode uploadFile

        if ($fileupload['error']) {
            // Handle error jika upload gagal
            return $fileupload;
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
        $this->db->bind('fileupload', $fileupload['filename']); // Simpan nama file ke database

        $this->db->execute();

        return $this->db->rowCount();
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

    // Metode untuk melakukan upload file
    private function uploadFile($inputName)
    {
        $file = $_FILES[$inputName];

        $filename = uniqid() . '_' . $file['name'];
        $targetDir = "C:/laragon/www/perjalanandinas/uploads/"; // Sesuaikan dengan path direktori tempat menyimpan file
        $targetFile = $targetDir . $filename;

        $uploadOk = move_uploaded_file($file['tmp_name'], $targetFile);

        if ($uploadOk) {
            return [
                'error' => false,
                'filename' => $filename
            ];
        } else {
            return [
                'error' => true,
                'message' => 'Upload file gagal.'
            ];
        }
    }
    
}
