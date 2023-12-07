<?php
include 'Load.php';




// Example usage:
##############################################################################

// // Example data for the create operation
// $createData = [
//     'name' => 'Example Name',
//     'description' => 'Example Description',
//     'image' => $_FILES['image'], // Assuming you have a file input named 'image' in your HTML form
// ];

// // Specify the directory where you want to upload images
// $uploadDir = 'uploads/';

// // Upload image and get the file path
// $imagePath = $crud->uploadImage($createData['image'], $uploadDir);

// if ($imagePath) {
//     $createData['image'] = $imagePath;
//     $crud->createRecord('table1', $createData);
// }


/*<form id="userForm" enctype="multipart/form-data">
    <input type="hidden" name="userId" value="<?php echo isset($userData['id']) ? $userData['id'] : ''; ?>">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo isset($userData['name']) ? $userData['name'] : ''; ?>" required>
    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo isset($userData['email']) ? $userData['email'] : ''; ?>" required>
    <br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="<?php echo isset($userData['password']) ? $userData['password'] : ''; ?>" required>
    <br>

    <!-- File upload for image -->
    <label for="image">Image:</label>
    <input type="file" id="image" name="image">
    <br>

    <button type="submit">Save User</button>
</form>
*/
// ##############################################################################
// with check
// Check if the email already exists in the users table
// $condition = ['email'];
// $result = $crud->createRecordWithCheck('users', $createData, $condition);
// // Display result message
// echo $result;
// ##############################################################################

// // Example data for the update operation
// $updateData = [
//     'name' => 'Updated Name',
//     'description' => 'Updated Description',
//     'image' => $_FILES['updatedImage'], // Assuming you have a file input named 'updatedImage' in your HTML form
// ];

// // Specify the ID of the record you want to update
$recordId = 3;

// // Upload updated image and get the file path
// $updatedImagePath = $crud->uploadImage($updateData['image'], $uploadDir);

// if ($updatedImagePath) {
//     $updateData['image'] = $updatedImagePath;
//     $crud->updateRecord('table1', $updateData, $recordId);
// }

##############################################################################
// Assuming $crud is an instance of your CRUD class

// Fetch a specific record by ID
// $idValue = 123;
// $dataByID = $crud->viewRecords('your_table', PDO::FETCH_ASSOC, ['id' => $idValue]);

// // Fetch records based on multiple conditions
// $conditions = ['column1' => 'value1', 'column2' => 'value2'];
// $dataWithConditions = $crud->viewRecords('your_table', PDO::FETCH_ASSOC, $conditions);

// // Fetch all records
// $allData = $crud->viewRecords('your_table', PDO::FETCH_ASSOC);


// View records example
// Fetch all user records
$allUsers = $crud->viewRecords('users', PDO::FETCH_ASSOC);
// Fetch records where 'nik' is a specific value
$conditions = ['nik' => '1401051804910001']; // Replace with the actual NIK value
$dataWithConditions = $crud->viewRecords('warga', PDO::FETCH_ASSOC, $conditions);
##############################################################################

// // Delete record example
// $recordIdToDelete = 1;
// $crud->deleteRecord('table1', $recordIdToDelete);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h2>All Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
        </tr>

        <?php
        // Display all user records in the table
        foreach ($allUsers as $user) {
            echo "<tr>";
            echo "<td>{$user['id']}</td>";
            echo "<td>{$user['username']}</td>";
            echo "<td>{$user['email']}</td>";
            echo "<td>{$user['password']}</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Specific User by ID</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
        </tr>

        <?php
        // Display the specific user record in the table
        if (!empty($specificUser)) {
            echo "<tr>";
            echo "<td>{$specificUser['id']}</td>";
            echo "<td>{$specificUser['nama']}</td>";
            echo "<td>{$specificUser['nik']}</td>";
            echo "<td>{$specificUser['kk']}</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Records with Conditions</h2>

        <?php if (!empty($dataWithConditions)): ?>
            <table border="1">
                <thead>
                    <tr>
                        <?php foreach (array_keys($dataWithConditions[0]) as $column): ?>
                            <th><?= $column ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataWithConditions as $row): ?>
                        <tr>
                            <!-- Only display specific columns (e.g., 'nama' and 'nik') -->
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['nik'] ?></td>
                            <!-- Add more columns as needed -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No records found with the specified conditions.</p>
        <?php endif; ?>

</body>

</html>