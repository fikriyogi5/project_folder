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

        $message = "User added successfully!";
    } else {
        $message = "Error uploading image.";
    }

    // Ambil data pengguna yang baru saja ditambahkan
    $lastInsertedUser = $crud->readAllRecords("users", PDO::FETCH_ASSOC, "", "ORDER BY id DESC", "LIMIT 1")[0];

    // Tampilkan pesan status dan data pengguna yang baru ditambahkan di dalam modal
    echo '<p>' . $message . '</p>';
    echo '<h2>New User Details</h2>';
    echo '<p>ID: ' . $lastInsertedUser['id'] . '</p>';
    echo '<p>Username: ' . $lastInsertedUser['username'] . '</p>';
    echo '<p>Email: ' . $lastInsertedUser['email'] . '</p>';
    echo '<img src="' . $lastInsertedUser['image_path'] . '" alt="Profile Image">';
    
    // Keluar untuk menghentikan eksekusi lebih lanjut
    exit();
}
?>
