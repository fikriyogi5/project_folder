<?php
// actions.php
require '../config/actions.php';


// Dalam file actions.php, setelah membuat instance User dan Database
$userInfo = $user->getUserInfo(1); // Mengambil pengguna dengan ID 1


// ...

// Tampilkan informasi pengguna dengan ID 1 (jika ada)
if ($userInfo) {
    echo 'User ID: ' . $userInfo['id'] . '<br>';
    echo 'Username: ' . $userInfo['username'] . '<br>';
    echo 'Email: ' . $userInfo['password'] . '<br>';
} else {
    echo 'User with ID 1 not found.';
}