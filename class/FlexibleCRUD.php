<?php
require_once 'Database.php';

class FlexibleCRUD {
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }


    public function create($table, array $data, array $uniqueColumns)
{
    // Check if both table name and data are provided
    if (!$table || empty($data)) {
        return ['error' => 'Table name and data are required.'];
    }

    // Check if data with specific columns already exists
    if ($this->dataExists($table, $data, $uniqueColumns)) {
        return ['error' => 'Data with specified columns already exists.'];
    }

    // Insert the new item into the specified table
    $columns = implode(',', array_keys($data));
    $placeholders = implode(',', array_fill(0, count($data), '?'));

    $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    $stmt = $this->pdo->prepare($sql);

    // Bind values to placeholders
    $i = 1;
    foreach ($data as $value) {
        $stmt->bindValue($i++, $value);
    }

    $stmt->execute();
    // Execute the query
    if ($stmt->execute()) {
        return $this->read($table);
    } else {
        return ['error' => 'Failed to execute the SQL statement.'];
    }
}

    
    // use Intervention\Image\ImageManagerStatic as Image;

    public function creates($table, array $data, $fileInputName, array $uniqueColumns) {
        // Check if both table name and data are provided
        if (!$table || empty($data)) {
            return ['error' => 'Table name and data are required.'];
        }

        // Check if file upload is included in the data
        $fileUpload = isset($_FILES[$fileInputName]) ? $_FILES[$fileInputName] : null;

        // Check if data with specific columns already exists
        if ($this->dataExists($table, $data, $uniqueColumns)) {
            return ['error' => 'Data with specified columns already exists.'];
        }

        // Insert the new item into the specified table
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->pdo->prepare($sql);

        // Bind values for non-file input fields
        $index = 1;
        foreach ($data as $value) {
            $stmt->bindValue($index++, $value);
        }

        // Handle file upload if provided
        if ($fileUpload) {
            $uploadDir = 'uploads/';
            $thumbDir = 'thumbnails/';

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (!file_exists($thumbDir)) {
                mkdir($thumbDir, 0777, true);
            }

            $uploadedFile = $uploadDir . basename($fileUpload['name']);

            if (move_uploaded_file($fileUpload['tmp_name'], $uploadedFile)) {
                // Compress the image
                $this->compressImage($uploadedFile);

                // Create thumbnail
                $thumbnailPath = $thumbDir . 'thumb_' . basename($fileUpload['name']);
                $this->createThumbnail($uploadedFile, $thumbnailPath);

                // Bind file path to the prepared statement
                $stmt->bindValue($index, $uploadedFile);
            } else {
                return ['error' => 'File upload failed.'];
            }
        }

    }

    // use Intervention\Image\ImageManagerStatic as Image;

    // public function createWithUpload($table, array $data, $fileInputName, array $uniqueColumns, $editItemId = null) {
    //     // Check if both table name and data are provided
    //     if (!$table || empty($data)) {
    //         return ['error' => 'Table name and data are required.'];
    //     }

    //     // Check if file upload is included in the data
    //     $fileUpload = isset($_FILES[$fileInputName]) ? $_FILES[$fileInputName] : null;

    //     // Check if data with specific columns already exists (except for the current item being edited)
    //     if ($this->dataExists($table, $data, $uniqueColumns, $editItemId)) {
    //         return ['error' => 'Data with specified columns already exists.'];
    //     }

    //     // Determine if it's an edit or create operation
    //     if ($editItemId) {
    //         // Edit existing item
    //         $editResult = $this->editItem($table, $data, $fileUpload, $fileInputName, $editItemId);

    //         if ($editResult['error']) {
    //             return $editResult;
    //         }
    //     } else {
    //         // Insert new item
    //         $insertResult = $this->insertItem($table, $data, $fileUpload, $fileInputName);

    //         if ($insertResult['error']) {
    //             return $insertResult;
    //         }
    //     }

    //     return $this->read($table);
    // }

    // private function editItem($table, array $data, $fileUpload, $fileInputName, $editItemId) {
    //     // Update the existing item in the specified table
    //     $setColumns = [];
    //     foreach ($data as $key => $value) {
    //         $setColumns[] = "$key=?";
    //     }

    //     $setColumns = implode(',', $setColumns);

    //     $sql = "UPDATE $table SET $setColumns WHERE id=?";
    //     $stmt = $this->pdo->prepare($sql);

    //     // Bind values for non-file input fields
    //     $index = 1;
    //     foreach ($data as $value) {
    //         $stmt->bindValue($index++, $value);
    //     }

    //     // Handle file upload if provided
    //     if ($fileUpload) {
    //         $uploadDir = 'uploads/';

    //         if (!file_exists($uploadDir)) {
    //             mkdir($uploadDir, 0777, true);
    //         }

    //         $uploadedFile = $uploadDir . basename($fileUpload['name']);

    //         if (move_uploaded_file($fileUpload['tmp_name'], $uploadedFile)) {
    //             // Compress the image
    //             $this->compressImage($uploadedFile);

    //             // Create thumbnail
    //             $thumbnailPath = 'thumbnails/' . 'thumb_' . basename($fileUpload['name']);
    //             $this->createThumbnail($uploadedFile, $thumbnailPath);

    //             // Bind file path to the prepared statement
    //             $stmt->bindValue($index, $uploadedFile);
    //         } else {
    //             return ['error' => 'File upload failed.'];
    //         }
    //     }

    //     // Bind the item ID for the WHERE clause
    //     $stmt->bindValue($index++, $editItemId, PDO::PARAM_INT);

    //     if ($stmt->execute()) {
    //         return ['success' => 'Item updated successfully.'];
    //     } else {
    //         return ['error' => 'Failed to execute the SQL statement for updating.'];
    //     }
    // }

    // private function insertItem($table, array $data, $fileUpload, $fileInputName) {
    //     // Insert the new item into the specified table
    //     $columns = implode(',', array_keys($data));
    //     $values = implode(',', array_fill(0, count($data), '?'));

    //     $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    //     $stmt = $this->pdo->prepare($sql);

    //     // Bind values for non-file input fields
    //     $index = 1;
    //     foreach ($data as $value) {
    //         $stmt->bindValue($index++, $value);
    //     }

    //     // Handle file upload if provided
    //     if ($fileUpload) {
    //         $uploadDir = 'uploads/';

    //         if (!file_exists($uploadDir)) {
    //             mkdir($uploadDir, 0777, true);
    //         }

    //         $uploadedFile = $uploadDir . basename($fileUpload['name']);

    //         if (move_uploaded_file($fileUpload['tmp_name'], $uploadedFile)) {
    //             // Compress the image
    //             $this->compressImage($uploadedFile);

    //             // Create thumbnail
    //             $thumbnailPath = 'thumbnails/' . 'thumb_' . basename($fileUpload['name']);
    //             $this->createThumbnail($uploadedFile, $thumbnailPath);

    //             // Bind file path to the prepared statement
    //             $stmt->bindValue($index, $uploadedFile);
    //         } else {
    //             return ['error' => 'File upload failed.'];
    //         }
    //     }

    //     if ($stmt->execute()) {
    //         return ['success' => 'Item inserted successfully.'];
    //     } else {
    //         return ['error' => 'Failed to execute the SQL statement for inserting.'];
    //     }
    // }


    private function compressImage($filePath) {
        $image = Image::make($filePath);
        $image->save($filePath, 80); // Save with 80% compression quality (adjust as needed)
    }

    private function createThumbnail($sourcePath, $destinationPath) {
        $thumbnailWidth = 100; // Adjust the thumbnail width as needed
        $thumbnailHeight = null; // Automatically calculate height based on aspect ratio

        $thumbnail = Image::make($sourcePath)->fit($thumbnailWidth, $thumbnailHeight);
        $thumbnail->save($destinationPath);
    }


    public function read($table, $condition = '', $where = [], $fetchType = 'fetchAll') {
        // Check if the table name is provided
        if (!$table) {
            return ['error' => 'Table name is required.'];
        }

        $sql = "SELECT * FROM $table";

        // Add condition if provided
        if ($condition) {
            $sql .= " WHERE $condition";
        }

        // Add where clause if provided
        if (!empty($where)) {
            $sql .= " " . implode(' AND ', $where);
        }

        // Choose fetch type based on the parameter
        $stmt = $this->pdo->query($sql);
        if ($fetchType === 'fetch') {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public function getDataById($jenis, $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM warga WHERE $jenis = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function update($id, $table, array $newData) {

        $indexToUpdate = $this->findIndexById($id, $table);

        if ($indexToUpdate !== null) {
            // Update the item in the database
            $set = implode('=?, ', array_keys($newData)) . '=?';
            $sql = "UPDATE $this->tableName SET $set WHERE id=?";
            $stmt = $this->pdo->prepare($sql);

            foreach ($newData as $value) {
                $stmt->bindValue(1, $value);
            }

            $stmt->bindValue(count($newData) + 1, $id);

            if ($stmt->execute()) {
                return $this->read();
            }

            return ['error' => 'Failed to update item.'];
        }

        return ['error' => 'Index not found.'];
    }

    //update multi
    public function updateMulti($table, array $ids, array $newData) {
        

        if (empty($ids)) {
            return ['error' => 'No items selected for update.'];
        }

        // Generate a parameter placeholder string for the IN clause
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        // Update the items in the database based on multiple IDs
        $set = implode('=?, ', array_keys($newData)) . '=?';
        $sql = "UPDATE $table SET $set WHERE id IN ($placeholders)";
        $stmt = $this->pdo->prepare($sql);

        // Bind each new data value to the prepared statement
        $index = count($newData) + 1;
        foreach ($newData as $value) {
            $stmt->bindValue($index, $value);
            $index++;
        }

        // Bind each ID value to the prepared statement
        foreach ($ids as $index => $id) {
            $stmt->bindValue($index + 1, $id);
        }

        if ($stmt->execute()) {
            return $this->read($table);
        }

        return ['error' => 'Failed to update items.'];
    }
    //Delete multi 
    public function deleteMulti($table, array $ids) {
        

        if (empty($ids)) {
            return ['error' => 'No items selected for deletion.'];
        }

        // Generate a parameter placeholder string for the IN clause
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        // Delete the items from the database based on multiple IDs
        $sql = "DELETE FROM $table WHERE id IN ($placeholders)";
        $stmt = $this->pdo->prepare($sql);

        // Bind each ID value to the prepared statement
        foreach ($ids as $index => $id) {
            $stmt->bindValue($index + 1, $id);
        }

        if ($stmt->execute()) {
            return $this->read($table);
        }

        return ['error' => 'Failed to delete items.'];
    }
    //delete one
    public function delete($table, $id) {
        // Check if table name is provided
        if (!$table) {
            return ['error' => 'Table name not set.'];
        }

        // Delete the item from the database
        $sql = "DELETE FROM $table WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);

        if ($stmt->execute()) {
            return $this->read($table);
        }

        return ['error' => 'Failed to delete item.'];
    }


    private function findIndexById($id, $table) {
        $data = $this->read($table);

        foreach ($data as $index => $item) {
            if ($item['id'] == $id) {
                return $index;
            }
        }

        return null;
        // $index = $this->findIndexById($id, 'your_table_name');

    }

    private function dataExists($table, $data, $uniqueColumns) {
        $conditions = [];

        foreach ($uniqueColumns as $column) {
            $conditions[] = "$column = ?";
        }

        $whereClause = implode(' AND ', $conditions);

        $sql = "SELECT COUNT(*) as count FROM $table WHERE $whereClause";
        $stmt = $this->pdo->prepare($sql);

        $index = 1;
        foreach ($uniqueColumns as $column) {
            $stmt->bindValue($index++, $data[$column]);
        }

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'] > 0;
    }
}
