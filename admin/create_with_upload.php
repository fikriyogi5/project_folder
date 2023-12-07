<?php
// Include or require your class/file containing the createWithUpload and dataExists functions
require_once 'YourClassOrFile.php';

// Instantiate your class (assuming it has a database connection)
$yourClass = new YourClass();

// Specify the table name, data, file input name, and unique columns
$tableName = 'your_table_name'; // Replace with your actual table name
$data = [
    'nama' => 'John Doe',
    'username' => 'johndoe',
    'alamat' => '123 Main Street',
    // ... other data fields
];
$fileInputName = 'photo'; // Replace with your actual file input name
$uniqueColumns = ['username']; // Replace with the actual unique columns

// Call the createWithUpload function
$result = $yourClass->createWithUpload($tableName, $data, $fileInputName, $uniqueColumns);

// Check the result and handle accordingly
if (isset($result['error'])) {
    echo 'Error: ' . $result['error'];
} else {
    echo 'Item created successfully!';
}
?>
