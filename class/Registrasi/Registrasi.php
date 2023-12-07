<?php
// classes/Registrasi/Registrasi.php
namespace Registrasi;

class Registrasi {
    private $db;

    public function __construct(\Database\Database $db) {
        $this->db = $db;
    }

    private function isUsernameTaken($username) {
        $stmt = $this->db->getConnection()->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC) !== false;
    }

    private function isEmailTaken($email) {
        $stmt = $this->db->getConnection()->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC) !== false;
    }

    public function registerUser($username, $email) {
        // Periksa apakah username atau email sudah ada
        if ($this->isUsernameTaken($username) || $this->isEmailTaken($email)) {
            return false;
        }

        // Buat hash kata sandi yang aman
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->getConnection()->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        return $stmt->execute();

    }
    public function login($username, $password) {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Set session atau token login di sini
            // Contoh: $_SESSION['user_id'] = $user['id'];
            return true;
        }

        return false;
    }

    public function isUserLoggedIn() {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }

    public function logout() {
        // Hapus session login
        session_unset();
        session_destroy();
    }

    public function forgotPassword($email) {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user) {
            // Generate token reset password (contoh: UUID atau string acak)
            $token = bin2hex(random_bytes(16));

            // Simpan token di database atau tempat penyimpanan lain
            $stmt = $this->db->getConnection()->prepare("UPDATE users SET reset_token = :token WHERE id = :id");
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':id', $user['id']);
            $stmt->execute();

            // Kirim email dengan tautan reset password yang berisi token
            $resetLink = 'https://example.com/reset_password.php?token=' . $token;
            // Implementasi pengiriman email
            // Contoh: mail($user['email'], 'Reset Password', 'Klik tautan berikut untuk mereset kata sandi: ' . $resetLink);

            return true;
        }

        return false;
    }

    public function resetPassword($token, $newPassword) {
        // Cari pengguna berdasarkan token reset password
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM users WHERE reset_token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user) {
            // Reset token dan atur kata sandi baru
            $stmt = $this->db->getConnection()->prepare("UPDATE users SET reset_token = NULL, password = :password WHERE id = :id");
            $stmt->bindParam(':password', password_hash($newPassword, PASSWORD_DEFAULT));
            $stmt->bindParam(':id', $user['id']);
            $stmt->execute();

            return true;
        }

        return false;
    }
}
