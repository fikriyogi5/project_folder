<?php
// Include kelas Crud
require_once 'GenericCrud.php';

// Buat objek Crud
$crud = new Crud();

// Ambil id pengguna dari parameter URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Ambil detail pengguna
    $user = $crud->readAllRecords("users", PDO::FETCH_ASSOC, "id=$userId")[0];
    $userImages = $crud->readAllRecords("users_images", PDO::FETCH_ASSOC, "users_id=$userId");
} else {
    // Redirect ke halaman tampil jika parameter id tidak ditemukan
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Detail</title>
</head>
<body>
    <h1>User Detail</h1>

    <h2><?php echo $user['username']; ?></h2>
    <p>Email: <?php echo $user['email']; ?></p>

    <h3>Profile Images</h3>
    <ul>
        <?php foreach ($userImages as $image) : ?>
            <li>
                <img src="<?php echo $image['image_path']; ?>" alt="Profile Image">
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="index.php">Back to User List</a>
</body>
</html>
