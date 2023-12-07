<?php
require_once 'GenericCrud.php';

$crud = new GenericCrud();

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $product = $crud->getRecord('products', $productId);
} else {
    // Handle error (redirect or show a message)
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateData = [
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'category' => $_POST['category'],
        'status' => $_POST['status']
    ];
    $crud->updateRecord('products', $updateData, $productId);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>
<body>
    <h2>Update Product</h2>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?= $product['name'] ?>" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required><?= $product['description'] ?></textarea><br>

        <label for="price">Price:</label>
        <input type="text" name="price" value="<?= $product['price'] ?>" required><br>

        <label for="category">Category:</label>
        <input type="text" name="category" value="<?= $product['category'] ?>" required><br>

        <label for="status">Status:</label>
        <input type="text" name="status" value="<?= $product['status'] ?>" required><br>

        <br>
        <input type="submit" value="Update Product">
    </form>
    <br>
    <a href="index.php">Back to List</a>
</body>
</html>
