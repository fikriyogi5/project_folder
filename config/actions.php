<?php
// actions.php
require '../includes/config.php';

// Buat instance Database
$db = new \Database\Database();

// Buat instance User dengan injeksi dependensi Database
$user = new \User\User($db);
// $database = new Login();

if (isset($_POST['login'])) {
    // code...
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Gantilah 'users' dengan nama tabel pengguna Anda
    $user = $users->read('users', "username = '$username'");

    if ($user && password_verify($password, $user[0]['password'])) {
        // Login berhasil, set session dan alihkan ke halaman beranda

        $_SESSION['user_id'] = $user[0]['username'];
        $_SESSION['user_type'] = $user[0]['role'];

        if ($user[0]['role']=="admin") {
            header('Location: ../admin/');
            exit;
        } else {
            header('Location: ../user/');
            exit;
        }
        
    } else {
        // Login gagal, tampilkan pesan error
        // Login failed, show the snackbar using JavaScript
        echo 'Login failed. Please check your username and password';
    }
}