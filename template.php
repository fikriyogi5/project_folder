<?php

require_once 'Template.php';

// Example usage for an admin user
$template = new Template('admin');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>

    <?php
        // Render header, menu, and footer for the admin user
        $template->renderHeader();
        $template->renderMenu();
    ?>

    <div>
        <!-- Your page content goes here -->
        <h1>Welcome, Admin!</h1>
    </div>

    <?php
        $template->renderFooter();
    ?>

</body>
</html>