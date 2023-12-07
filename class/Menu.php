<?php



// use Registrasi\Database;
// use PDO;
// use PDOException;
// require_once '../libs/PHPMailer/vendor/autoload.php';
require_once 'Database.php'; // Include the Database class
require_once 'Setting.php'; // Assuming there is a Setting class

// menu.php
class Menu {
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function getMenuItems($roleId, $parentId = null) {
        
        if ($parentId === null) {
            $stmt = $this->pdo->prepare("SELECT * FROM menu_items WHERE role_id = :role_id AND parent_id IS NULL");
        } else {
            $stmt = $this->pdo->prepare("SELECT * FROM menu_items WHERE role_id = :role_id AND parent_id = :parent_id");
            $stmt->bindParam(':parent_id', $parentId);
        }

        $stmt->bindParam(':role_id', $roleId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function displayMenu($roleId, $parentId = null) {
        $menuItems = $this->getMenuItems($roleId, $parentId);

        if ($menuItems) {
            echo '<ul>';
            foreach ($menuItems as $menuItem) {
                echo '<li>';
                echo '<a href="' . $menuItem['url'] . '">' . $menuItem['label'] . '</a>';
                $this->displayMenu($roleId, $menuItem['id']); // Recursively display sub-menu
                echo '</li>';
            }
            echo '</ul>';
        }
    }
}