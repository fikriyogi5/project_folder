<?php
// Include or require your class definition file here
require_once 'Autoloader.php';


// Start the session



// Check if the user is logged in
if ($userAuth->isLogin()) {
    // User is logged in, retrieve user data
    $userId = $_SESSION['user_id']; // Assuming 'user' is the session variable storing the user ID
    $userData = $userAuth->getUserDataById($userId);

    // Check if user data is retrieved successfully
    if (!$userData) {
        // Handle the case where user data is not available
        echo "Error: Unable to retrieve user data.";
        exit();
    }
} else {
    // User is not logged in, show the login form or redirect to the login page
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Include your CSS stylesheets or link to a framework like Bootstrap if you're using one -->
</head>
<body>

    <h1>Welcome to the Dashboard, <?php echo htmlspecialchars($userData['username']); ?>!</h1>
    <!-- Display other dashboard content here -->
    <?= $setting->getSetting('otp_enabled') ?>

    <a href="logout.php">Logout</a>

</body>
</html>
