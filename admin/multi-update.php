<?php
// Include the FlexibleCRUD class and set up the database connection
require_once 'class/class.crud.php';


try {
    $pdo = new PDO("mysql:host=localhost;dbname=desaku", "root", "");

    $crud = new FlexibleCRUD($pdo);
    $crud->setTableName('warga');

    // Handle form submission for updating selected items
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['archive'])) {
        $selectedIds = isset($_POST['selected_ids']) ? $_POST['selected_ids'] : [];

        // Define the new data for the update (e.g., set 'archived' to true)
        $newData = ['archived' => true];

        $result = $crud->updateMulti('warga', $selectedIds, $newData);
        print_r($result);
    }

    // Fetch and display data for the page
    $data = $crud->read('warga');
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Items Page</title>
</head>
<body>

<!-- Display items with checkboxes -->
<form method="post" action="">
    <h2>Archive Items</h2>

    <?php foreach ($data as $item): ?>
        <label>
            <input type="checkbox" name="selected_ids[]" value="<?= $item['id'] ?>">
            <?= $item['nama'] ?> (ID: <?= $item['id'] ?>)
        </label><br>
    <?php endforeach; ?>

    <input type="submit" name="archive" value="Archive Selected">
</form>

</body>
</html>
