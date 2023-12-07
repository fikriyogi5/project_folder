<?php
// Sertakan koneksi database dan kelas DatabaseManager di sini
// include '../../class/Database/Database.php';
include '../../Autoloader.php';

// Ambil parameter yang dikirim melalui permintaan AJAX
$table = $_POST['table'];
$filterField = $_POST['filterField'];
$filterValue = $_POST['filterValue'];

// Panggil fungsi filterData
$result = $SearchEngine->filterData($table, $filterField, $filterValue);

// Mengembalikan hasil sebagai respons JSON
header('Content-Type: application/json');
echo json_encode($result);
?>
