<?php

// Example Usage
try {
    $pdo = new PDO("mysql:host=localhost;dbname=your_database", "your_username", "your_password");

    $crud = new FlexibleCRUD($pdo);
    $crud->setTableName('your_table_name');

    // Use the CRUD operations as needed
    $newItem = ['id' => 3, 'name' => 'Bob Smith', 'age' => 40];
    $result = $crud->create($newItem);
    print_r($result);
  
  // Example: Create item with specific table and data
    $newItemData = ['name' => 'Alice', 'age' => 25];
    $result = $crud->create('your_table_name', $newItemData);
    print_r($result);

    // Example: Read items with specific table, condition, and where clause
    $condition = 'age > ?';
    $where = ['ORDER BY age ASC', 'LIMIT 5'];
    $result = $crud->read('your_table_name', $condition, $where);
    print_r($result);

    // Read
    $allData = $crud->read();
    print_r($allData);

    // Update
    $idToUpdate = 1;
    $newData = ['name' => 'John Updated', 'age' => 31];
    $result = $crud->update($idToUpdate, $newData);
    print_r($result);

    // Delete
    $idToDelete = 2;
    $result = $crud->delete($idToDelete);
    print_r($result);

    // Read after modifications
    $updatedData = $crud->read();
    print_r($updatedData);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


?>