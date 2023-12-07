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

// Instantiate the Database class
try {
    $db = new Database();

    // Function to get resident data based on the selected dusun
    function getResidentData($dusunID)
    {
        global $db;

        $sql = "SELECT * FROM warga WHERE dusun_id = :dusunID";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->bindValue(':dusunID', $dusunID, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get the selected dusun ID from the AJAX request
    $dusunID = isset($_POST['dusunID']) ? $_POST['dusunID'] : null;

    // Get resident data based on the selected dusun
    $residentData = getResidentData($dusunID);

    // Return resident data as JSON
    echo json_encode($residentData);
} catch (Exception $e) {
    // Handle exceptions, log errors, or return an error response
    echo json_encode(['error' => $e->getMessage()]);
}
?>
