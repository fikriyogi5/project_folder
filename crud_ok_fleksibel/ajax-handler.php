<?php
require_once 'Load.php'; // Replace with your database connection class


// Include the CRUD class or functions here

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Handle AJAX request to fetch records

    $table = $_GET['table'] ?? '';
    if (empty($table)) {
        echo 'Invalid table name.';
        exit;
    }

    if (isset($_GET['action']) && $_GET['action'] === 'edit') {
        $id = $_GET['id'] ?? 0;
        $record = $crud->getRecordById($table, $id);

        // Include a form for editing the record here
        echo '<form id="editRecordForm">';
        echo '<input type="hidden" name="id" value="' . $record['id'] . '">';
        echo '<input type="text" name="username" value="' . $record['username'] . '">';
        echo '<input type="text" name="email" value="' . $record['email'] . '">';
        echo '<input type="text" name="password" value="' . $record['password'] . '">';
        echo '<button type="submit">Save Changes</button>';
        echo '</form>';
    } else {
        $records = $crud->viewRecords($table, PDO::FETCH_ASSOC);

        // Render records as a table
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Field 1</th>';
        echo '<th>Field 2</th>';
        echo '<th>Field 3</th>';
        echo '<th>Actions</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($records as $record) {
            echo '<tr>';
            echo '<td>' . $record['id'] . '</td>';
            echo '<td>' . $record['username'] . '</td>';
            echo '<td>' . $record['email'] . '</td>';
            echo '<td>' . $record['password'] . '</td>';
            echo '<td>';
            echo '<a href="#" class="edit-link" data-id="' . $record['id'] . '">Edit</a> | ';
            echo '<a href="#" class="delete-link" data-id="' . $record['id'] . '">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle AJAX request to add, edit, or delete a record

    $action = $_POST['action'] ?? '';
    $table = $_POST['table'] ?? '';

    if (empty($table)) {
        echo 'Invalid table name.';
        exit;
    }

    if ($action === 'delete') {
        $id = $_POST['id'] ?? 0;
        $result = $crud->deleteRecord($table, $id);

        if ($result === true) {
            echo 'Record deleted successfully!';
        } else {
            echo 'Error deleting record.';
        }
    } elseif ($action === 'update') {
        $id = $_POST['id'] ?? 0;
        $data = $_POST['data'] ?? [];
        $result = $crud->updateRecord($table, $data, $id);

        if ($result === true) {
            echo 'Record updated successfully!';
        } else {
            echo 'Error updating record.';
        }
    } else {
        $data = $_POST['data'] ?? [];
        $result = $crud->createRecordWithCheck($table, $data);

        if ($result === true) {
            echo 'Record added successfully!';
        } else {
            echo $result; // Error message if record creation fails
        }
    }
}

// Add similar blocks for handling other CRUD operations (update, delete, etc.) as needed.
?>
