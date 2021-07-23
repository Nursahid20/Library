<?php

class Login_model
{
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function loginUser($data)
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $query = "SELECT * FROM user WHERE username=:username";

        $this->db->query($query);
        $this->db->bind('username', $username);
        $this->db->execute();

        $user = $this->db->single();
        if ($username == $user['username']) {
            if (password_verify($password, $user["password"])) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['status'] = $user['status'];
                $_SESSION['username'] = $user['username'];

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

        return $this->db->rowCount();
    }

    public function getAllUser()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
}
