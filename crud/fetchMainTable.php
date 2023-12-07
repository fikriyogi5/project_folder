<?php
// Include kelas Crud
require_once 'GenericCrud.php';

// Buat objek Crud
$crud = new Crud();

// Ambil semua pengguna
$users = $crud->readAllRecords("users", PDO::FETCH_ASSOC);

// Bangun tabel HTML
$html = '<thead><tr><th>ID</th><th>Username</th><th>Action</th></tr></thead><tbody>';
foreach ($users as $user) {
    $html .= '<tr>';
    $html .= '<td>' . $user['id'] . '</td>';
    $html .= '<td><a href="#" onclick="showModal(\'' . $user['id'] . '\')">' . $user['username'] . '</a></td>';
    $html .= '<td><a href="delete.php?id=' . $user['id'] . '">Delete</a></td>';
    $html .= '</tr>';
}
$html .= '</tbody>';

// Mengirimkan HTML tabel sebagai respons
echo $html;
?>
