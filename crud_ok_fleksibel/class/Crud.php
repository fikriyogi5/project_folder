<?php
class CRUD
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function executeSQL($query, $params = [], $fetchMode = PDO::FETCH_ASSOC)
    {
        try {
            $stmt = $this->db->prepare($query);

            foreach ($params as $param => $value) {
                $stmt->bindValue($param, $value);
            }

            $stmt->execute();

            if ($fetchMode !== null) {
                return $stmt->fetchAll($fetchMode);
            }

            return true; // Return true for successful execution without fetching data
        } catch (PDOException $e) {
            throw new Exception("Query execution failed: " . $e->getMessage());
        }

        ##############################################
        // // Example for SELECT query
        // $selectQuery = "SELECT * FROM your_table WHERE id = :id";
        // $selectParams = [':id' => 1];
        // $result = $db->executeSQL($selectQuery, $selectParams, PDO::FETCH_ASSOC);

        // // Example for INSERT query
        // $insertQuery = "INSERT INTO your_table (column1, column2) VALUES (:value1, :value2)";
        // $insertParams = [':value1' => 'example', ':value2' => '123'];
        // $db->executeSQL($insertQuery, $insertParams);
    }
    public function getRecordById($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchRecords($table, $name = null, $category = null, $type = null, $date = null, $fetchMode = PDO::FETCH_ASSOC)
    {
        // Build the SQL query based on the provided criteria
        $sql = "SELECT * FROM $table WHERE 1";

        if ($name !== null) {
            $sql .= " AND name LIKE :name";
        }

        if ($category !== null) {
            $sql .= " AND category = :category";
        }

        if ($type !== null) {
            $sql .= " AND type = :type";
        }

        if ($date !== null) {
            $sql .= " AND date = :date";
        }

        // Prepare and execute the SQL query
        $stmt = $this->db->prepare($sql);

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

    public function getDataByDateRange($table, $date_column, $startDate, $endDate)
    {
        try {
            $query = "SELECT * FROM $table WHERE $date_column BETWEEN :start_date AND :end_date";
            $params = [':start_date' => $startDate, ':end_date' => $endDate];

            return $this->executeSQL($query, $params, PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Error fetching data by date range: " . $e->getMessage());
        }
        ##############################################
        // // Example usage: Fetch data within a date range
        // $startDate = '2023-01-01';
        // $endDate = '2023-12-31';

        // $result = $db->getDataByDateRange($startDate, $endDate);

        // // Process the $result array as needed
        // print_r($result);
    }

    public function createRecord($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        ##############################################
        // Example data for the create operation
        // $createData = [
        //     'name' => 'Example Name',
        //     'description' => 'Example Description',
        //     'image' => $_FILES['image'], // Assuming you have a file input named 'image' in your HTML form
        // ];

        // // Specify the directory where you want to upload images
        // $uploadDir = 'uploads/';

        // // Upload image and get the file path
        // $imagePath = $crud->uploadImage($createData['image'], $uploadDir);

        // if ($imagePath) {
        //     $createData['image'] = $imagePath;
        //     $crud->createRecord('table1', $createData);
        // }
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
            $checkStmt = $this->db->prepare($checkSql);

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
        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        ##############################################
        // // Example data for the create operation
        // $createData = [
        //     'name' => 'Example Name',
        //     'description' => 'Example Description',
        //     'image' => $_FILES['image'], // Assuming you have a file input named 'image' in your HTML form
        // ];

        // // Specify the directory where you want to upload images
        // $uploadDir = 'uploads/';
        // $condition = ['email'];

        // // Upload image and get the file path
        // $imagePath = $crud->uploadImage($createData['image'], $uploadDir);

        // if ($imagePath) {
        //     $createData['image'] = $imagePath;
        //     $result = $crud->createRecordWithCheck('users', $createData, $condition);

        // }
        // // Display result message
        // echo $result;
    }

    public function updateRecord($table, $data, $id)
    {
        $updateValues = "";
        foreach ($data as $key => $value) {
            $updateValues .= "$key=:$key, ";
        }
        $updateValues = rtrim($updateValues, ', ');

        $sql = "UPDATE $table SET $updateValues WHERE id=:id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id', $id);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        ##############################################
        // // Example data for the update operation
        // $updateData = [
        //     'name' => 'Updated Name',
        //     'description' => 'Updated Description',
        //     'image' => $_FILES['updatedImage'], // Assuming you have a file input named 'updatedImage' in your HTML form
        // ];

        // // Specify the ID of the record you want to update
        // $recordId = 3;

        // // Upload updated image and get the file path
        // $updatedImagePath = $crud->uploadImage($updateData['image'], $uploadDir);

        // if ($updatedImagePath) {
        //     $updateData['image'] = $updatedImagePath;
        //     $crud->updateRecord('table1', $updateData, $recordId);
        // }

    }

    public function viewRecords($table, $fetchMode = PDO::FETCH_ASSOC, $conditions = [])
    {
        $sql = "SELECT * FROM $table";

        if (!empty($conditions) && is_array($conditions)) {
            $sql .= " WHERE ";
            $conditionsArray = [];

            foreach ($conditions as $column => $value) {
                $conditionsArray[] = "$column = :$column";
            }

            $sql .= implode(" AND ", $conditionsArray);
        }

        $stmt = $this->db->prepare($sql);

        if (!empty($conditions) && is_array($conditions)) {
            foreach ($conditions as $column => $value) {
                $stmt->bindValue(":$column", $value);
            }
        }

        $stmt->execute();

        if ($fetchMode === PDO::FETCH_ASSOC) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } elseif ($fetchMode === PDO::FETCH_OBJ) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } else {
            // Handle other fetch modes if needed
            return $stmt->fetchAll();
        }

        ##############################################
        // // View records example
        // // Fetch all user records
        // $allUsers = $crud->viewRecords('users', PDO::FETCH_ASSOC);

        // // Fetch a specific user record by ID (replace '1' with the actual ID)
        // $specificUser = $crud->viewRecords('users', PDO::FETCH_ASSOC, $recordId);

        // <h2>All Users</h2>
        // <table>
        //     <tr>
        //         <th>ID</th>
        //         <th>Name</th>
        //         <th>Email</th>
        //         <th>Password</th>
        //     </tr>

        //     <?php
        //     // Display all user records in the table
        //     foreach ($allUsers as $user) {
        //         echo "<tr>";
        //         echo "<td>{$user['id']}</td>";
        //         echo "<td>{$user['username']}</td>";
        //         echo "<td>{$user['email']}</td>";
        //         echo "<td>{$user['password']}</td>";
        //         echo "</tr>";
        //     }
        //
        // </table>

        // <h2>Specific User by ID</h2>
        // <table>
        //     <tr>
        //         <th>ID</th>
        //         <th>Name</th>
        //         <th>Email</th>
        //         <th>Password</th>
        //     </tr>

        //     <?php
        //     // Display the specific user record in the table
        //     if (!empty($specificUser)) {
        //         echo "<tr>";
        //         echo "<td>{$specificUser['id']}</td>";
        //         echo "<td>{$specificUser['username']}</td>";
        //         echo "<td>{$specificUser['email']}</td>";
        //         echo "<td>{$specificUser['password']}</td>";
        //         echo "</tr>";
        //     }
        //
        // </table>

    }

    public function viewRecordsDataTable($table, $columns, $fetchMode = PDO::FETCH_ASSOC)
    {
        $requestData = $_REQUEST;

        $columns = array_values($columns);

        // Define the SQL query
        $sql = "SELECT * FROM $table";

        // Get total records count
        $totalRecords = $this->db->query("SELECT COUNT(*) FROM $table")->fetchColumn();

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
        $stmtCount = $this->db->prepare($sql);
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
        $stmt = $this->db->prepare($sql);
        if (!empty($searchValue)) {
            for ($i = 0; $i < count($columns); $i++) {
                $stmt->bindValue(':searchValue', "%$searchValue%", PDO::PARAM_STR);
            }
        }
        $stmt->execute();

        if ($fetchMode === PDO::FETCH_ASSOC) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } elseif ($fetchMode === PDO::FETCH_OBJ) {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        } else {
            $result = $stmt->fetchAll();
        }

        // Prepare the response for DataTables
        $response = [
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($filteredRecords),
            "data" => $result,
        ];

        return $response;
    }

    public function deleteRecord($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        ##############################################
        // // Delete record example
        // $recordIdToDelete = 1;
        // $crud->deleteRecord('table1', $recordIdToDelete);
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
        ##############################################

        // // Example data for the create operation
        // $createData = [
        //     'name' => 'Example Name',
        //     'description' => 'Example Description',
        //     'image' => $_FILES['image'], // Assuming you have a file input named 'image' in your HTML form
        // ];

        // // Specify the directory where you want to upload images
        // $uploadDir = 'uploads/';

        // // Upload image and get the file path
        // $imagePath = $crud->uploadImage($createData['image'], $uploadDir);

        // if ($imagePath) {
        //     $createData['image'] = $imagePath;
        //     $crud->createRecord('table1', $createData);
        // }

    }
    public function updateUserStatus($userId, $newStatus)
    {
        try {
            $sql = "UPDATE users SET status = :status WHERE id = :id";
            $stmt = $this->db->prepare($sql);
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
