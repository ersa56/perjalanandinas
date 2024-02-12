<?php
class JabatanModel
{
    private $table = 'tb_jabatan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllJabatan()
    {
        $this->db->query('SELECT * FROM ' . $this->table);

        return $this->db->resultSet();
    }

    public function getJabatanById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);

        return $this->db->single();
    }

    public function tambahJabatan($data)
    {
        $query = "INSERT INTO tb_jabatan(nama_jabatan, tanggung_jawab, deskripsi) VALUES (:nama_jabatan, :tanggung_jawab, :deskripsi)";
        $this->db->query($query);
        $this->db->bind('nama_jabatan', $data['nama_jabatan']);
        $this->db->bind('tanggung_jawab', $data['tanggung_jawab']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateDataJabatan($data)
    {
        $query = 'UPDATE tb_jabatan SET nama_jabatan=:nama_jabatan, tanggung_jawab=:tanggung_jawab, deskripsi=:deskripsi WHERE id=:id';
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama_jabatan', $data['nama_jabatan']);
        $this->db->bind('tanggung_jawab', $data['tanggung_jawab']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteJabatan($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariJabatan()
    {
        $key = $_POST['key'];
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nama_jabatan LIKE :key');
        $this->db->bind('key', "%$key%");

        return $this->db->resultSet();
    }
    
}
