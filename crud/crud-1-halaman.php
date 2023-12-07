<?php
// Include kelas Crud
require_once 'GenericCrud.php';

// Buat objek Crud
$crud = new Crud();

// Handling operasi CREATE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['createUser'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Validasi form input lainnya sesuai kebutuhan

    $data = [
        'username' => $username,
        'email' => $email,
        // Tambahkan kolom-kolom lain sesuai kebutuhan
    ];

    // Operasi CREATE
    $crud->createRecord("users", $data);

    // Redirect atau tampilkan pesan berhasil
    header("Location: crud.php?success=create");
    exit();
}

// Handling operasi READ
$users = $crud->readAllRecords("users", PDO::FETCH_ASSOC);

// Handling operasi UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUser'])) {
    $userId = $_POST['userId'];
    $newUsername = $_POST['newUsername'];
    $newEmail = $_POST['newEmail'];

    // Validasi form input lainnya sesuai kebutuhan

    $data = [
        'username' => $newUsername,
        'email' => $newEmail,
        // Tambahkan kolom-kolom lain sesuai kebutuhan
    ];

    // Operasi UPDATE
    $crud->updateRecord("users", $data, ['id' => $userId]);

    // Redirect atau tampilkan pesan berhasil
    header("Location: crud.php?success=update");
    exit();
}

// Handling operasi DELETE
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['deleteUser'])) {
    $userId = $_GET['deleteUser'];

    // Operasi DELETE
    $crud->deleteRecord("users", ['id' => $userId]);

    // Redirect atau tampilkan pesan berhasil
    header("Location: crud.php?success=delete");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Example</title>
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan */
    </style>
</head>
<body>
    <h1>CRUD Example</h1>

    <!-- Formulir Create User -->
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <!-- Tambahkan input untuk kolom-kolom lain sesuai kebutuhan -->

        <button type="submit" name="createUser">Create User</button>
    </form>

    <hr>

    <!-- Tabel untuk menampilkan data pengguna -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <!-- Tambahkan header kolom lain sesuai kebutuhan -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <!-- Tambahkan kolom lain sesuai kebutuhan -->
                    <td>
                        <a href="?deleteUser=<?php echo $user['id']; ?>">Delete</a>
                        <a href="?updateUser=<?php echo $user['id']; ?>">Update</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Formulir Update User -->
    <?php if (isset($_GET['updateUser'])) : ?>
        <?php
        $userIdToUpdate = $_GET['updateUser'];
        $userToUpdate = $crud->readRecord("users", ['id' => $userIdToUpdate], PDO::FETCH_ASSOC);
        ?>

        <form method="POST" action="">
            <input type="hidden" name="userId" value="<?php echo $userIdToUpdate; ?>">

            <label for="newUsername">New Username:</label>
            <input type="text" id="newUsername" name="newUsername" value="<?php echo $userToUpdate['username']; ?>" required>
            <br>

            <label for="newEmail">New Email:</label>
            <input type="email" id="newEmail" name="newEmail" value="<?php echo $userToUpdate['email']; ?>" required>
            <br>

            <!-- Tambahkan input untuk kolom-kolom lain sesuai kebutuhan -->

            <button type="submit" name="updateUser">Update User</button>
        </form>
    <?php endif; ?>

</body>
</html>
