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

    // Tampilkan detail pengguna
    echo '<h2>User Details</h2>';
    echo '<p>ID: ' . $user['id'] . '</p>';
    echo '<p>Username: ' . $user['username'] . '</p>';
    echo '<p>Email: ' . $user['email'] . '</p>';
} else {
    // Jika parameter id tidak ditemukan, keluar
    exit();
}
?>
