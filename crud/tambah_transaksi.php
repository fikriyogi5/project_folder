<?php
// Include kelas Crud
require_once 'GenericCrud.php';

// Buat objek Crud
$crud = new Crud();

// Jika formulir disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $debit = $_POST['debit'];
    $kredit = $_POST['kredit'];

    // Validasi data jika diperlukan

    // Simpan transaksi ke dalam database
    $data = [
        'tanggal' => $tanggal,
        'keterangan' => $keterangan,
        'debit' => $debit,
        'kredit' => $kredit,
    ];

    $crud->createRecord("transactions", $data);

    // Redirect atau tampilkan pesan berhasil
    header("Location: tambah_transaksi.php?success=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
</head>
<body>
    <h1>Tambah Transaksi</h1>

    <?php
    // Tampilkan pesan berhasil jika ada
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<p style="color: green;">Transaksi berhasil ditambahkan!</p>';
    }
    ?>

    <!-- Formulir Tambah Transaksi -->
    <form action="tambah_transaksi.php" method="post">
        <label for="tanggal">Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" required>
        <br>

        <label for="keterangan">Keterangan:</label>
        <input type="text" id="keterangan" name="keterangan" required>
        <br>

        <label for="debit">Debit:</label>
        <input type="number" id="debit" name="debit" min="0" step="0.01" required>
        <br>

        <label for="kredit">Kredit:</label>
        <input type="number" id="kredit" name="kredit" min="0" step="0.01" required>
        <br>

        <button type="submit">Tambah Transaksi</button>
    </form>
</body>
</html>
