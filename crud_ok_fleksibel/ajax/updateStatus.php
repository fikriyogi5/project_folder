<?php
class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'app';
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

class CRUD
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function updateUserStatus($userId, $newStatus)
    {
        try {
            $sql = "UPDATE warga SET status = :status WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':status', $newStatus, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            throw new Exception("Error updating user status: " . $e->getMessage());
        }
    }

}

// Assuming your Database class constructor requires host, dbname, username, and password
$crud = new CRUD();

// Handle the AJAX request to update user status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];
    $newStatus = $_POST['status'];

    try {
        // Update user status in the database
        $success = $crud->updateUserStatus($userId, $newStatus);

        // Return a response
        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Failed to update status']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
