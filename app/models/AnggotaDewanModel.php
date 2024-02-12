<?php
class AnggotaDewanModel
{
    private $table = 'tb_anggota_dewan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllAnggota()
    {
        $this->db->query('SELECT tb_anggota_dewan.*, tb_jabatan.nama_jabatan FROM ' . $this->table . ' JOIN tb_jabatan ON tb_jabatan.id = tb_anggota_dewan.nama_jabatan_id');


        return $this->db->resultSet();
    }

    public function getAnggotaById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);

        return $this->db->single();
    }
    public function tambahAnggota($data)
    {
        $query = "INSERT INTO tb_anggota_dewan(asal, id_anggota_dewan, jenis_kelamin_id, nama_anggota_dewan, nama_jabatan_id, nip, no_anggota_dewan, ttl, umur) VALUES (:asal, :id_anggota_dewan, :jenis_kelamin_id, :nama_anggota_dewan, :nama_jabatan_id, :nip, :no_anggota_dewan, :ttl, :umur)";
        $this->db->query($query);
        $this->db->bind('asal', $data['asal']);
        $this->db->bind('id_anggota_dewan', $data['id_anggota_dewan']);
        $this->db->bind('jenis_kelamin_id', $data['jenis_kelamin_id']);
        $this->db->bind('nama_anggota_dewan', $data['nama_anggota_dewan']);
        $this->db->bind('nama_jabatan_id', $data['nama_jabatan_id']);
        $this->db->bind('nip', $data['nip']);
        $this->db->bind('no_anggota_dewan', $data['no_anggota_dewan']);
        $this->db->bind('ttl', $data['ttl']);
        $this->db->bind('umur', $data['umur']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateDataAnggota($data)
    {
        $query = "UPDATE tb_anggota_dewan SET asal=:asal, id_anggota_dewan=:id_anggota_dewan, jenis_kelamin_id=:jenis_kelamin_id, nama_anggota_dewan=:nama_anggota_dewan, nama_jabatan_id=:nama_jabatan_id, nip=:nip, no_anggota_dewan=:no_anggota_dewan, ttl=:ttl, umur=:umur WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('asal', $data['asal']);
        $this->db->bind('id_anggota_dewan', $data['id_anggota_dewan']);
        $this->db->bind('jenis_kelamin_id', $data['jenis_kelamin_id']);
        $this->db->bind('nama_anggota_dewan', $data['nama_anggota_dewan']);
        $this->db->bind('nama_jabatan_id', $data['nama_jabatan_id']);
        $this->db->bind('nip', $data['nip']);
        $this->db->bind('no_anggota_dewan', $data['no_anggota_dewan']);
        $this->db->bind('ttl', $data['ttl']);
        $this->db->bind('umur', $data['umur']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteAnggota($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariAnggota()
    {
        $key = $_POST['key'];
        $this->db->query('SELECT * FROM ' . $this->table . ' JOIN tb_jabatan ON tb_jabatan.id = tb_anggota_dewan.nama_jabatan_id WHERE nama_anggota_dewan LIKE :key');
        $this->db->bind('key', "%$key%");

        return $this->db->resultSet();
    }
}