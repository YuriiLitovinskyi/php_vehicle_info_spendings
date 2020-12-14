<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
        //echo 'users constructor';
    }

    public function __destruct()
    {
        $this->db = null;
        //echo 'users destructor';
    }

    // Register new User
    public function register($data)
    {
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute insert query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Login User
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;

        // Check if passwords match
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    // Find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        // Bind values
        $row = $this->db->single();

        // Check row, if user already exists in DB
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Get user by id
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        // Bind values
        $row = $this->db->single();

        return $row;
    }

    public function editProfile($data)
    {
        $this->db->query('UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id');

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute insert query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUserProfile($id)
    {
        $this->db->query('DELETE from users WHERE id = :id');

        $this->db->bind(':id', $id);

        // Execute delete query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
