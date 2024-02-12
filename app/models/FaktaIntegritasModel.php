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
        // Cek apakah ada file yang diunggah
        if (!empty($_FILES['fileupload']['name'])) {
            // Jika ada file yang diunggah, lakukan upload dan perbarui nama file pada database
            $fileupload = $this->uploadFile('fileupload');

            if ($fileupload['error']) {
                // Handle error jika upload gagal
                return $fileupload;
            }
            
            // Perbarui nama file pada data yang akan diupdate
            $data['fileupload'] = $fileupload['filename'];

            // Ambil nama file sebelum menghapus record
            $this->db->query('SELECT fileupload FROM ' . $this->table . ' WHERE id=:id');
            $this->db->bind('id', $data['id']);
            $oldFilename = $this->db->single()['fileupload'];

            // Hapus file lama dari sistem file
            $oldFilePath = "C:/laragon/www/perjalanandinas/public/uploads/" . $data['fileupload']; // Sesuaikan dengan path direktori tempat menyimpan file
            if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }
        }


        $query = 'UPDATE ' . $this->table . ' SET 
        alamat=:alamat, hari=:hari, nomor_telepon=:nomor_telepon, tanggal_berangkat=:tanggal_berangkat, tanggal_pulang=:tanggal_pulang, tempat_tujuan=:tempat_tujuan, fileupload=:fileupload 
        WHERE id=:id';

        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('hari', $data['hari']);
        $this->db->bind('nomor_telepon', $data['nomor_telepon']);
        $this->db->bind('tanggal_berangkat', $data['tanggal_berangkat']);
        $this->db->bind('tanggal_pulang', $data['tanggal_pulang']);
        $this->db->bind('tempat_tujuan', $data['tempat_tujuan']);
        $this->db->bind('fileupload', $data['fileupload']); // Gunakan data fileupload yang sudah diperbarui jika ada

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteFaktaIntegritas($id)
    {
        // Ambil nama file sebelum menghapus record
        $this->db->query('SELECT fileupload FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        $filename = $this->db->single()['fileupload'];
    
        // Hapus file dari sistem file
        $filePath = "C:/laragon/www/perjalanandinas/public/uploads/" . $filename; // Sesuaikan dengan path direktori tempat menyimpan file
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    
        // Hapus record dari database
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


    //public function uploadFile($inputName)
    //{
        //$file = $_FILES[$inputName];
    
        //$originalFilename = $file['name']; // Ambil nama asli file
        //$targetDir = "C:/laragon/www/perjalanandinas/uploads/"; // Sesuaikan dengan path direktori tempat menyimpan file
        //$targetFile = $targetDir . $originalFilename;
    
        //$uploadOk = move_uploaded_file($file['tmp_name'], $targetFile);
    
        //if ($uploadOk) {
          //  return [
            //    'error' => false,
            //   'filename' => $originalFilename
            //];
        //} else {
            //return [
            //    'error' => true,
            //    'message' => 'Upload file gagal.'
            //];
        //}
   //}
    

    // Metode untuk melakukan upload file
    public function uploadFile($inputName)
    {
        $file = $_FILES[$inputName];

        $filename = uniqid() . '_' . $file['name'];
        $targetDir = "C:/laragon/www/perjalanandinas/public/uploads/"; // Sesuaikan dengan path direktori tempat menyimpan file
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
