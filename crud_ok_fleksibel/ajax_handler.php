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

    public function createRecord($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->db->getConnection()->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function createRecordWithCheck($table, $data, $condition = [])
    {
        // Check if the record already exists based on unique columns
        $conditions = [];

        foreach ($condition as $column) {
            if (isset($data[$column])) {
                $conditions[] = "$column = :$column";
            }
        }

        if (!empty($conditions)) {
            $checkSql = "SELECT COUNT(*) as count FROM $table WHERE " . implode(' AND ', $conditions);
            $checkStmt = $this->db->getConnection()->prepare($checkSql);

            foreach ($condition as $column) {
                if (isset($data[$column])) {
                    $checkStmt->bindValue(":$column", $data[$column]);
                }
            }

            $checkStmt->execute();
            $count = $checkStmt->fetchColumn();

            if ($count > 0) {
                return "Record already exists!";
            }
        }

        // If the record doesn't exist, proceed with the insert
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->db->getConnection()->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }



    public function updateRecord($table, $data, $id)
    {
        $updateValues = "";
        foreach ($data as $key => $value) {
            $updateValues .= "$key=:$key, ";
        }
        $updateValues = rtrim($updateValues, ', ');

        $sql = "UPDATE $table SET $updateValues WHERE id=:id";
        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->bindValue(':id', $id);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function viewRecords($table, $fetchMode = PDO::FETCH_ASSOC, $id = null)
    {
        if ($id !== null) {
            // Fetch a specific record by ID
            $sql = "SELECT * FROM $table WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($fetchMode === PDO::FETCH_ASSOC) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } elseif ($fetchMode === PDO::FETCH_OBJ) {
                return $stmt->fetch(PDO::FETCH_OBJ);
            } else {
                // Handle other fetch modes if needed
                return $stmt->fetch();
            }
        } else {
            // Fetch all records
            $sql = "SELECT * FROM $table";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute();

            if ($fetchMode === PDO::FETCH_ASSOC) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } elseif ($fetchMode === PDO::FETCH_OBJ) {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            } else {
                // Handle other fetch modes if needed
                return $stmt->fetchAll();
            }
        }
    }


    public function deleteRecord($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindValue(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function uploadImage($file, $uploadDir)
    {
        $targetFile = $uploadDir . basename($file['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($file['tmp_name']);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($file['size'] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            return false;
        } else {
            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                return $targetFile;
            } else {
                echo "Sorry, there was an error uploading your file.";
                return false;
            }
        }
    }

}

$crud = new CRUD();

// Handle different actions
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'getUsers':
        getUsers();
        break;

    case 'openUserModal':
        openUserModal();
        break;

    case 'saveUser':
        saveUser();
        break;

    case 'deleteUser':
        deleteUser();
        break;

    default:
        // Handle other actions if needed
        break;
}

function getUsers()
{
    global $crud;

    $users = $crud->viewRecords('users', PDO::FETCH_ASSOC);

    // Include the user table template (you can create a separate template file)
    include 'user_table_template.php';
}

function openUserModal()
{
    global $crud;

    $userId = isset($_POST['userId']) ? $_POST['userId'] : null;
    $userData = ($userId) ? $crud->viewRecords('users', PDO::FETCH_ASSOC, $userId) : null;

    // Include the user modal template (you can create a separate template file)
    include 'user_modal_template.php';
}

function saveUser()
{
    global $crud;

    $userId = isset($_POST['userId']) ? $_POST['userId'] : null;
    $data = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ];

    $result = ($userId) ? $crud->updateRecord('users', $data, $userId) : $crud->createRecord('users', $data);

    echo ($result) ? 'success' : 'error';
}

function deleteUser()
{
    global $crud;

    $userId = isset($_POST['userId']) ? $_POST['userId'] : null;

    $result = $crud->deleteRecord('users', $userId);

    echo ($result) ? 'success' : 'error';
}
?>
