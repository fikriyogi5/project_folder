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


    public function searchRecords($table, $name = null, $category = null, $type = null, $date = null, $fetchMode = PDO::FETCH_ASSOC)
    {
        // Build the SQL query based on the provided criteria
        $sql = "SELECT * FROM $table WHERE 1";

        if ($name !== null) {
            $sql .= " AND nama LIKE :name";
        }

        if ($category !== null) {
            $sql .= " AND nik = :category";
        }

        if ($type !== null) {
            $sql .= " AND status = :type";
        }

        if ($date !== null) {
            $sql .= " AND tanggal_lahir = :date";
        }

        // Prepare and execute the SQL query
        $stmt = $this->db->getConnection()->prepare($sql);

        if ($name !== null) {
            $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
        }

        if ($category !== null) {
            $stmt->bindValue(':category', $category, PDO::PARAM_STR);
        }

        if ($type !== null) {
            $stmt->bindValue(':type', $type, PDO::PARAM_STR);
        }

        if ($date !== null) {
            $stmt->bindValue(':date', $date, PDO::PARAM_STR);
        }

        $stmt->execute();

        // Fetch and return the results
        if ($fetchMode === PDO::FETCH_ASSOC) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } elseif ($fetchMode === PDO::FETCH_OBJ) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } else {
            // Handle other fetch modes if needed
            return $stmt->fetchAll();
        }
    }

// Get search criteria from the AJAX request
$searchName = isset($_POST['nama']) ? $_POST['nama'] : null;
$searchCategory = isset($_POST['nik']) ? $_POST['nik'] : null;
$searchType = isset($_POST['status']) ? $_POST['status'] : null;
$searchDate = isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : null;

try {
    // Perform the search
    $searchResults = searchRecords('warga', $searchName, $searchCategory, $searchType, $searchDate);

    // Return search results as JSON
    echo json_encode($searchResults);
} catch (Exception $e) {
    // Handle exceptions, log errors, or return an error response
    echo json_encode(['error' => $e->getMessage()]);
}
?>
