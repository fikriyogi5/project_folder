<?php
// Include or require your class/file containing the create function
require_once 'YourClassOrFile.php';

// Instantiate your class (assuming it has a database connection)
$yourClass = new FlexibleCRUD();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $hobi = isset($_POST['hobi']) ? implode(', ', $_POST['hobi']) : ''; // Convert array to comma-separated string

    // Call create function, assuming 'photo' is the name attribute in the file input
    $result = $yourClass->createWithUpload('your_table_name', [
        'nama' => $nama,
        'username' => $username,
        'alamat' => $alamat,
        'jenis_kelamin' => $jenis_kelamin,
        'hobi' => $hobi,
    ], 'photo');

    // Check the result and handle accordingly
    if (isset($result['error'])) {
        echo 'Error: ' . $result['error'];
    } else {
        echo 'User created successfully!';
    }
}
?>
