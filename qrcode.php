<?php
include('libs/QRCode/qrlib.php'); // Sesuaikan path dengan lokasi penyimpanan pustaka

// Data yang akan dienkripsi dalam QR Code
$data = 'https://www.example.com';

// Nama file QR Code yang akan disimpan
$filename = 'qrcode.png';

// Membuat QR Code
QRcode::png($data, $filename);

// Menampilkan QR Code
echo '<img src="'.$filename.'" />';
?>
