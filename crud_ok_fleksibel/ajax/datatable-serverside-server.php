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


    public function viewRecordsDataTable($table, $columns, $links = [], $fetchMode = PDO::FETCH_ASSOC)
    {
        $requestData = $_REQUEST;

        $columns = array_values($columns);

        // Define the SQL query
        $sql = "SELECT * FROM $table";
        
        // Get total records count
        $totalRecords = $this->db->getConnection()->query("SELECT COUNT(*) FROM $table")->fetchColumn();

        // Apply search
        $searchValue = $requestData['search']['value'];
        if (!empty($searchValue)) {
            $sql .= " WHERE ";
            for ($i = 0; $i < count($columns); $i++) {
                $sql .= "$columns[$i] LIKE :searchValue";
                if ($i < count($columns) - 1) {
                    $sql .= " OR ";
                }
            }
        }

        // Get filtered records count
        $stmtCount = $this->db->getConnection()->prepare($sql);
        if (!empty($searchValue)) {
            for ($i = 0; $i < count($columns); $i++) {
                $stmtCount->bindValue(':searchValue', "%$searchValue%", PDO::PARAM_STR);
            }
        }
        $stmtCount->execute();
        $filteredRecords = $stmtCount->rowCount();

        // Apply ordering
        $orderColumn = $columns[$requestData['order'][0]['column']];
        $orderDirection = $requestData['order'][0]['dir'];
        $sql .= " ORDER BY $orderColumn $orderDirection";

        // Apply limit and offset
        $sql .= " LIMIT {$requestData['start']}, {$requestData['length']}";

        // Execute the final query
        $stmt = $this->db->getConnection()->prepare($sql);
        if (!empty($searchValue)) {
            for ($i = 0; $i < count($columns); $i++) {
                $stmt->bindValue(':searchValue', "%$searchValue%", PDO::PARAM_STR);
            }
        }
        $stmt->execute();

        // Fetch records with links for specified columns
        $result = $stmt->fetchAll($fetchMode);
        $resultWithLinks = [];

        foreach ($result as $row) {
            foreach ($links as $column => $linkType) {
                if (isset($row[$column])) {
                    $row[$column] = $this->applyLink($row[$column], $linkType, $row);
                }
            }
            // Add radio button for user status change
            $row['status'] = '<input type="radio" name="statusRadio" data-id="' . $row['id'] . '" value="active" class="statusRadio" ' . ($row['status'] === 'active' ? 'checked' : '') . '> Active
                             <input type="radio" name="statusRadio" data-id="' . $row['id'] . '" value="inactive" class="statusRadio" ' . ($row['status'] === 'inactive' ? 'checked' : '') . '>';

            $resultWithLinks[] = $row;
        }

        // Prepare the response for DataTables
        $response = [
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($filteredRecords),
            "data" => $resultWithLinks,
        ];

        return $response;
    }

    // Helper function to apply links based on link type
    private function applyLink($value, $linkType, $row)
    {
        switch ($linkType) {
            case 'profile':
                return '<a href="#" class="openModal" data-id="' . $row['id'] . '">' . $value . '</a>';
            case 'email':
                return '<a href="mailto:' . $value . '">' . $value . '</a>';
            // Add other link types as needed
            default:
                return $value;
        }
    }



}

// Example usage
$crud = new CRUD();

// // Define the columns for your DataTable
// $columns = ['id', 'nama', 'nik', 'kk', 'status'];

// // Define links for specific columns
// $links = [
//     'nama' => 'profile',
//     'nik' => 'email',
// ];


// Retrieve parameters from the Ajax request
$table = $_POST['table'] ?? ''; // Table name
$columns = $_POST['columns'] ?? []; // Required columns
$links = $_POST['links'] ?? []; // Columns containing links

// Call the viewRecordsDataTable function with links
$dataTableResponse = $crud->viewRecordsDataTable($table, $columns, $links);
// Return the JSON-encoded response to DataTables
echo json_encode($dataTableResponse);
?>
