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
            // Instead of echoing the error, throw an exception
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

// Assuming your Database class constructor requires host, dbname, username, and password
try {
    $db = new Database();

    // Function to get regions based on the selected parent ID
    function getRegions($parentID, $table)
    {
        global $db;

        $sql = "SELECT id, name FROM $table WHERE parent_id = :parentID";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->bindValue(':parentID', $parentID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get the selected parent ID from the AJAX request
    $parentID = isset($_POST['parentID']) ? $_POST['parentID'] : null;
    $table = isset($_POST['table']) ? $_POST['table'] : null;

    // Get regions based on the selected parent ID
    $regions = getRegions($parentID, $table);

    // Return regions as JSON
    echo json_encode($regions);
} catch (Exception $e) {
    // Handle exceptions, log errors, or return an error response
    echo json_encode(['error' => $e->getMessage()]);
}
?>
