<?php
require_once 'GenericCrud.php';

// Buat objek Crud
$crud = new Crud();

// Ambil id pengguna dari parameter URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Hapus pengguna
    $crud->deleteRecord("users", $userId);

    // Redirect ke halaman tampil setelah penghapusan
    header("Location: index.php");
    exit();
} else {
    // Redirect ke halaman tampil jika parameter id tidak ditemukan
    header("Location: index.php");
    exit();
}
?>
