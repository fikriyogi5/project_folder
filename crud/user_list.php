<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>User List</h1>

    <?php
    // Tampilkan pesan berhasil jika ada
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<p style="color: green;">Status pengguna berhasil diperbarui!</p>';
    }
    ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            // Include kelas Crud
            require_once 'GenericCrud.php';

            // Buat objek Crud
            $crud = new Crud();
            // Ambil semua pengguna
            $users = $crud->readAllRecords("users", PDO::FETCH_ASSOC);

            foreach ($users as $user) :
            ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['status']; ?></td>
                    <td>
                        <a href="aktifkan_nonaktifkan_user.php?id=<?php echo $user['id']; ?>">
                            <?php echo ($user['status'] == 'aktif') ? 'Nonaktifkan' : 'Aktifkan'; ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
