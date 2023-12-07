<?php
// Include kelas Crud
require_once 'GenericCrud.php';


// Buat objek Crud
$crud = new Crud();

// Pesan status untuk tampilkan hasil operasi
$message = "";

// Cek apakah formulir dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Cek apakah pengguna sudah ada berdasarkan username atau email
    // $existingUser = $crud->readAllRecords("users", PDO::FETCH_ASSOC, "username='$username' OR email='$email'");

    // if (empty($existingUser)) {
        // Cek apakah file gambar diunggah
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);

            // Pindahkan file gambar ke direktori yang diinginkan
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);

            // Buat data untuk dimasukkan ke dalam tabel users
            $userData = [
                "username" => $username,
                "email" => $email
            ];

            // Panggil metode createRecord untuk menambahkan pengguna ke dalam tabel users
            $crud->createRecord("users", $userData, $uploadFile);

            // $message = "User added successfully!";
        } else {
            $message = "Error uploading image.";
        }
    // } else {
    //     $message = "User with the same username or email already exists.";
    // }
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
    <h1>Create User</h1>

    <!-- Tampilkan pesan status -->
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <!-- Formulir Create User -->
    <form action="" method="post" enctype="multipart/form-data">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>

        <label for="image">Profile Image:</label>
        <input type="file" name="image" accept="image/*" required>
        <br>

        <button type="submit">Create User</button>
    </form>

    <a href="index.php">Back to User List</a>
</body>
</html>
