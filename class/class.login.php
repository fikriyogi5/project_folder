<?php
include '../config/db.php';



class Login {
    protected $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->connection;
    }

    public function login($table, $username, $password)
    {
        $database = new Database();

        // Mengecek apakah username ada di database
        $query = "SELECT * FROM $table WHERE username = :username";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // Username tidak ditemukan
            return false;
        }

        // Memeriksa apakah password cocok
        if (password_verify($password, $user['password'])) {
            // Password cocok, login berhasil
            return $user;
        } else {
            // Password tidak cocok
            return false;
        }
    }
} 