<?php
// Include or require your class/file containing the delete function
require_once 'YourClassOrFile.php';

// Instantiate your class (assuming it has a database connection)
$yourClass = new YourClass();

// Specify the table name and the ID you want to delete
$tableName = 'your_table_name'; // Replace with your actual table name
$itemId = 123; // Replace with the actual ID you want to delete

// Call the delete function
$result = $yourClass->delete($tableName, $itemId);

// Check the result and handle accordingly
if (isset($result['error'])) {
    echo 'Error: ' . $result['error'];
} else {
    echo 'Item deleted successfully!';
}
?>
