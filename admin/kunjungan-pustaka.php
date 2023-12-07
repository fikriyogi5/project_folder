<?php
// Include kelas Crud
// require_once 'GenericCrud.php';
include dirname( __DIR__ ) . '/Autoloader.php';

// Buat objek Crud
$flexibleCRUD = new flexibleCRUD();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $id_anggota = $_POST['id_anggota'];
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];
    $waktu_masuk = $_POST['waktu_masuk'];
    $waktu_keluar = $_POST['waktu_keluar'];

    // Data yang akan disimpan
    $data = array(
        'ID_Anggota' => $id_anggota,
        'Tanggal_Kunjungan' => $tanggal_kunjungan,
        'Waktu_Masuk' => $waktu_masuk,
        'Waktu_Keluar' => $waktu_keluar
    );

    // Panggil metode create dari objek Crud
    // $result = $crud->create('Kunjungan', $data, ['ID_Anggota', 'Tanggal_Kunjungan']);
    $result = $flexibleCRUD->create('p_kunjungan', $data, ['ID_Anggota']);


    // Tampilkan pesan hasil operasi
    if (isset($result['error'])) {
        $message = $result['error'];
    } else {
        $message = 'Data berhasil ditambahkan.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Kunjungan</title>
</head>
<body>
    <h1>Form Tambah Kunjungan</h1>

    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="id_anggota">ID Anggota:</label>
        <input type="text" id="id_anggota" name="id_anggota" required>
        <br>

        <label for="tanggal_kunjungan">Tanggal Kunjungan:</label>
        <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan" required>
        <br>

        <label for="waktu_masuk">Waktu Masuk:</label>
        <input type="time" id="waktu_masuk" name="waktu_masuk" required>
        <br>

        <label for="waktu_keluar">Waktu Keluar:</label>
        <input type="time" id="waktu_keluar" name="waktu_keluar" required>
        <br>

        <button type="submit">Tambah Data</button>
    </form>
</body>
</html>
