<?php
// classes/User/User.php
namespace User;

class User {
    private $db;

    public function __construct(\Database\Database $db) {
        $this->db = $db;
    }

    public function createUser($username, $email) {
        $stmt = $this->db->getConnection()->prepare("INSERT INTO users (username, email) VALUES (:username, :email)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function getUserInfo($userId) {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateUser($userId, $username, $email) {
        $stmt = $this->db->getConnection()->prepare("UPDATE users SET username = :username, email = :email WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function deleteUser($userId) {
        $stmt = $this->db->getConnection()->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
}
