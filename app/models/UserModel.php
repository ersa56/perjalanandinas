<?php

class UserModel
{
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllUser()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahUser($data)
    {
        $query = "INSERT INTO " . $this->table . "(nama, username, password, role) VALUES(:nama, :username, :password, :role)";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', md5($data['password']));
        $this->db->bind('role', $data['role']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cekUsername($username)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE username = :username");
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function updateDataUser($data)
    {
        if (empty($data['password'])) {
            $query = "UPDATE " . $this->table . " SET nama=:nama, role=:role WHERE id=:id";
            $this->db->query($query);
            $this->db->bind('id', $data['id']);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('role', $data['role']);
        } else {
            $query = "UPDATE " . $this->table . " SET nama=:nama, password=:password, role=:role WHERE id=:id";
            $this->db->query($query);
            $this->db->bind('id', $data['id']);
            $this->db->bind('nama', $data['nama']);
            $this->db->bind('password', md5($data['password']));
            $this->db->bind('role', $data['role']);
        }
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteUser($id)
    {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cariUser($key)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE nama LIKE :key");
        $this->db->bind('key', "%$key%");
        return $this->db->resultSet();
    }
}
