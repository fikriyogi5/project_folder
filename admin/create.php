
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Form</title>
</head>
<body>

<h2>Create User</h2>

<form action="" method="post" enctype="multipart/form-data">
    <!-- Input fields for non-file data -->
    <label for="nama">Nama:</label>
    <input type="text" name="nama" required>
    <br>

    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <br>

    <label for="alamat">Alamat:</label>
    <textarea name="alamat" required></textarea>
    <br>

    <!-- Input field for file upload -->
    <label for="photo">Photo:</label>
    <input type="file" name="photo" accept="image/*" required>
    <br>

    <!-- Radio buttons for gender -->
    <label for="jenis_kelamin">Jenis Kelamin:</label>
    <input type="radio" name="jenis_kelamin" value="Laki-laki" required> Laki-laki
    <input type="radio" name="jenis_kelamin" value="Perempuan" required> Perempuan
    <br>

    <!-- Checkboxes for hobbies -->
    <label for="hobi">Hobi:</label>
    <input type="checkbox" name="hobi[]" value="Membaca"> Membaca
    <input type="checkbox" name="hobi[]" value="Olahraga"> Olahraga
    <input type="checkbox" name="hobi[]" value="Musik"> Musik
    <!-- Add more hobbies as needed -->
    <br>

    <!-- Submit button -->
    <input type="submit" value="Create User">
</form>

</body>
</html>
