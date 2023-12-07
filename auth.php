<?php
// Check if the user is logged in
$userAuth = "";
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