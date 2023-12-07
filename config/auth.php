<?php
// Periksa jenis pengguna (user atau admin)
// $userType = 'user'; // Gantilah dengan logika periksa jenis pengguna sesuai kebutuhan

// // Tentukan template yang sesuai berdasarkan jenis pengguna
// if ($userType === 'user') {
//     include 'templates/user/header.php';
// } elseif ($userType === 'admin') {
//     include 'templates/admin/header.php';
// } else {
//     include 'includes/header.php'; // Default header
// }

// // Tampilkan konten halaman
// // ...

// // Sertakan footer yang sesuai
// if ($userType === 'user') {
//     include 'templates/user/footer.php';
// } elseif ($userType === 'admin') {
//     include 'templates/admin/footer.php';
// } else {
//     include 'includes/footer.php'; // Default footer

session_start(); // Mulai sesi jika belum dimulai

if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_type'])) {
    header('Location: ../index.php');
    exit;
}

