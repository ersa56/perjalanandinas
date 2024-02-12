<?php

class LoginModel
{
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function checkLogin($data)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username AND password = :password";
        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', md5($data['password']));
        $data = $this->db->single();

        return $data;
    }

    public function getUserRole($username)
    {
        $query = "SELECT role FROM " . $this->table . " WHERE username = :username";
        $this->db->query($query);
        $this->db->bind('username', $username);
        $role = $this->db->single();  // Menggunakan single() karena mengambil satu nilai kolom

        return $role['role'];  // Mengambil nilai dari kolom 'role'
    }
}
