<?php
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['install'])) {
    try {
        // Create PDO connection
        $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create database
        $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
        echo "Database created successfully<br>";

        // Switch to the created database
        $pdo->exec("USE " . DB_NAME);
        echo "Connected to database successfully<br>";

        // Create a sample table (you can modify this based on your requirements)
        $pdo->exec("CREATE TABLE IF NOT EXISTS temp (
            id INT PRIMARY KEY,
            username VARCHAR(255),
            email VARCHAR(255)
        )");
        echo "Table created successfully<br>";

        // Send an email (you may want to enhance this with a proper mail library)
        mail(ADMIN_EMAIL, 'Installation Complete', 'Your PHP system installation is complete.');

        echo "Installation complete";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation</title>
</head>
<body>
    <h2>Installation</h2>
    <form method="post" action="">
        <p>Click the "Install" button to start the installation process:</p>
        <input type="submit" name="install" value="Install">
    </form>
</body>
</html>
