<?php
// Include your database connection class and CRUD class here
require_once 'Load.php'; // Replace with your database connection class


// Handle search form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchKeyword = isset($_POST['search']) ? $_POST['search'] : '';

    if (!empty($searchKeyword)) {
        $searchQuery = "SELECT * FROM warga WHERE nama LIKE :searchKeyword";
        $searchParams = [':searchKeyword' => '%' . $searchKeyword . '%'];

        try {
            $searchResults = $crud->executeSQL($searchQuery, $searchParams);
        } catch (Exception $e) {
            $searchResults = ['error' => $e->getMessage()];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <!-- Include Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Search Page</h2>

    <!-- Search Form -->
    <form method="post">
        <div class="form-group">
            <label for="search">Search:</label>
            <input type="text" class="form-control" id="search" name="search" placeholder="Enter keyword">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <?php if (isset($searchResults)): ?>
        <!-- Display Search Results -->
        <h3>Search Results</h3>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Column 1</th>
                <th>Column 2</th>
                <!-- Add more columns as needed -->
            </tr>
            </thead>
            <tbody>
            <?php foreach ($searchResults as $result): ?>
                <tr>
                    <td><?php echo $result['id']; ?></td>
                    <td><?php echo $result['nama']; ?></td>
                    <td><?php echo $result['nik']; ?></td>
                    <!-- Add more columns as needed -->
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
