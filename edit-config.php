<?php
// Load the existing configuration
require_once 'config/config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $newDbHost = $_POST['db_host'];
    $newDbUser = $_POST['db_user'];
    $newDbPassword = $_POST['db_password'];
    $newDbName = $_POST['db_name'];
    $newAdminEmail = $_POST['admin_email'];

    // Update the configuration file
    $configContent = "<?php\n";
    $configContent .= "define('DB_HOST', '$newDbHost');\n";
    $configContent .= "define('DB_USER', '$newDbUser');\n";
    $configContent .= "define('DB_PASSWORD', '$newDbPassword');\n";
    $configContent .= "define('DB_NAME', '$newDbName');\n";
    $configContent .= "define('ADMIN_EMAIL', '$newAdminEmail');\n";
    $configContent .= "?>";

    file_put_contents('config/config.php', $configContent);

    echo "Configuration updated successfully";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Configuration</title>
</head>
<body>
    <h2>Edit Configuration</h2>
    <form method="post" action="">
        <label for="db_host">Database Host:</label>
        <input type="text" name="db_host" value="<?= DB_HOST ?>"><br>

        <label for="db_user">Database User:</label>
        <input type="text" name="db_user" value="<?= DB_USER ?>"><br>

        <label for="db_password">Database Password:</label>
        <input type="text" name="db_password" value="<?= DB_PASSWORD ?>"><br>

        <label for="db_name">Database Name:</label>
        <input type="text" name="db_name" value="<?= DB_NAME ?>"><br>

        <label for="admin_email">Admin Email:</label>
        <input type="text" name="admin_email" value="<?= ADMIN_EMAIL ?>"><br>

        <input type="submit" value="Update Configuration">
    </form>
</body>
</html>
