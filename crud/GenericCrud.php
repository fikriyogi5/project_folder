<?php
// File: GenericCrud.php

require_once 'DbConnection.php';
class Crud
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    public function createRecord($table, $data, $imagePath = null)
    {
        // Cek apakah data sudah ada
        if (!$this->isDuplicate($table, $data)) {
            // Data belum ada, lanjutkan dengan penyisipan
            $columns = implode(", ", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));

            $query = "INSERT INTO $table ($columns) VALUES ($values)";
            $this->conn->executeQuery($query, $data);

            $lastInsertedId = $this->conn->getLastInsertedId();

            if ($imagePath) {
                $this->uploadImage($table, $lastInsertedId, $imagePath);
            }
        } else {
            // Data sudah ada, tampilkan pesan
            echo "Data already exists!";
        }
    }
    // Metode untuk memperbarui record dalam tabel
       public function updateRecord($table, $data, $condition)
       {
           $updateValues = [];

           foreach ($data as $key => $value) {
               $updateValues[] = "$key = :$key";
           }

           $updateClause = implode(', ', $updateValues);

           $conditionValues = [];

           foreach ($condition as $key => $value) {
               $conditionValues[] = "$key = :$key";
           }

           $conditionClause = implode(' AND ', $conditionValues);

           $query = "UPDATE $table SET $updateClause WHERE $conditionClause";

           $params = array_merge($data, $condition);

           $stmt = $this->conn->prepare($query);

           foreach ($params as $key => $value) {
               $stmt->bindValue(":$key", $value);
           }

           $stmt->execute();

           return $stmt->rowCount();
       }

    private function isDuplicate($table, $data)
    {
        $conditions = [];
        foreach ($data as $key => $value) {
            $conditions[] = "$key = :$key";
        }
        $conditionStr = implode(" AND ", $conditions);

        $query = "SELECT COUNT(*) as count FROM $table WHERE $conditionStr";
        $result = $this->conn->executeQuery($query, $data)->fetch(PDO::FETCH_ASSOC);

        return ($result['count'] > 0);
    }


    public function readAllRecords($table, $fetchMode = PDO::FETCH_ASSOC, $condition = null)
    {
        $conditionClause = $condition ? "WHERE $condition" : "";
        $query = "SELECT * FROM $table $conditionClause";

        $stmt = $this->conn->executeQuery($query);

        if ($fetchMode == PDO::FETCH_ASSOC) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }

        // Metode untuk membaca satu record dari tabel berdasarkan kondisi tertentu
        public function readRecord($table, $condition, $fetchMode = PDO::FETCH_ASSOC)
        {
            $conditionValues = [];

            foreach ($condition as $key => $value) {
                $conditionValues[] = "$key = :$key";
            }

            $conditionClause = implode(' AND ', $conditionValues);

            $query = "SELECT * FROM $table WHERE $conditionClause";

            $stmt = $this->conn->executeQuery($query);
            // $stmt->execute($condition);

            if ($fetchMode == PDO::FETCH_ASSOC) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
        }

    public function editRecord($table, $data, $recordId)
    {
        $setClause = implode("=?, ", array_keys($data)) . "=?";
        $query = "UPDATE $table SET $setClause WHERE id=?";
        $values = array_values($data);
        $values[] = $recordId;
        $this->conn->executeQuery($query, $values);
    }

    public function deleteRecord($table, $recordId)
    {
        $query = "DELETE FROM $table WHERE id=?";
        $this->conn->executeQuery($query, [$recordId]);
    }

    private function uploadImage($table, $recordId, $imagePath)
    {
        $imageTable = $table . "_images";
        $query = "INSERT INTO $imageTable ({$table}_id, image_path) VALUES (?, ?)";
        $this->conn->executeQuery($query, [$recordId, $imagePath]);
    }
}

// Usage example:

// $crud = new Crud();

// // Contoh create dengan gambar
// $data = [
//     "username" => "john_doe",
//     "email" => "john.doe@example.com"
// ];
// $crud->createRecord("users", $data, "uploads/john_doe_profile.jpg");

// // Contoh create tanpa gambar
// $data = [
//     "username" => "jane_doe",
//     "email" => "jane.doe@example.com"
// ];
// $crud->createRecord("users", $data);

// // Tampilkan semua record
// $users = $crud->readAllRecords("users", PDO::FETCH_ASSOC, "username='john_doe'");
// print_r($users);

// // Edit record
// $editData = [
//     "username" => "john_doe_updated",
//     "email" => "john.doe.updated@example.com"
// ];
// $crud->editRecord("users", $editData, 1);

// // Hapus record
// $crud->deleteRecord("users", 2);

?>
