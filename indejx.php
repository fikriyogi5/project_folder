<?php
include 'class/Database/Database.php';
// Membuat objek database
$dbConfig = array(
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'desaku',
);

$database = new Database($dbConfig);
// Menggunakan fetchAll()
$dataArray = $database->read('warga', '', null, true);

// Menggunakan fetch()
// $dataRow = $database->read('warga', '', null, false);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Example</title>
</head>
<body>
    <h1>CRUD Example</h1>
    
    <!-- Form untuk membuat pengguna -->
    <h2>Create User</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="email" name="email" placeholder="Email">
        <button type="submit" name="create">Create</button>
    </form>

    <!-- Daftar Pengguna -->
    <h2>Users</h2>
    <ul>
        <?php foreach ($dataArray as $user): ?>
                <?php echo $user['username']; ?> (<?php echo $user['email']; ?>)
                
        <?php endforeach; ?>
    </ul>
</body>
</html>
