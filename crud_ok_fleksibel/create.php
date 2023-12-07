<?php
// Assume you have a CRUD class with necessary methods
// including uploadImage and createRecordWithCheck
require_once 'Load.php';


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assume you have a function to sanitize input data
    $createData = [
        'nama_dokter' => sanitize($_POST['nama_dokter']),
        'spesialisasi' => sanitize($_POST['spesialisasi']),
        'photo' => $_FILES['photo'],
    ];

    // Specify the directory where you want to upload images
    $uploadDir = 'assets/uploads/';
    $condition = ['nama_dokter']; // Specify your condition field

    // Upload image and get the file path
    $imagePath = $crud->uploadImage($createData['photo'], $uploadDir);

    if ($imagePath) {
        $createData['photo'] = $imagePath;

        // Create a record with a condition check
        $result = $crud->createRecordWithCheck('k_dokter', $createData, $condition);

        // Display result message
        echo $result;
    } else {
        echo 'Image upload failed.';
    }
}

function sanitize($data) {
    // Add your sanitation logic here based on your requirements
    return htmlspecialchars($data);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>

    <h2>Create User</h2>

    <form method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="nama_dokter" required>

        <label for="spesialisasi">spesialisasi:</label>
        <textarea name="spesialisasi" required></textarea>

        <label for="image">Image:</label>
        <input type="file" name="photo" accept="image/*" required>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
