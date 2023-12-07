<?php
// Include kelas Crud
require_once 'GenericCrud.php';

// Buat objek Crud
$crud = new Crud();

// Ambil ID pengguna dari parameter URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = $_GET['id'];

    // Periksa apakah pengguna aktif atau tidak
    $userData = $crud->readAllRecords("users", PDO::FETCH_ASSOC, "id = $userId");

    if (!empty($userData) && is_array($userData)) {
        // Toggle status aktif/nonaktif
        $isActive = ($userData[0]['status'] == 'aktif') ? 'nonaktif' : 'aktif';

        // Update status pengguna
        $crud->updateRecord("users", ['status' => $isActive], ['id' => $userId]);

        // Redirect atau tampilkan pesan berhasil
        header("Location: user_list.php?success=1");
        exit();
    }
}

// Jika ID tidak valid atau tidak ada ID, kembali ke halaman sebelumnya
header("Location: user_list.php");
exit();
?>
