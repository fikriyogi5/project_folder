<?php
// Include or require your class definition file here
require_once 'class/class.userAuth.php';

// Assuming the class is named YourClass
$userAuth = new userAuth();

// Check if the email parameter is missing
if (!isset($_GET['token'])) {
    echo 'Invalid link. Please provide a valid email link.';
    exit();
}

// Example: Change Password
$token = $_GET['token'];
if(!$userAuth->checkData('verification_token', $token)) {
    	echo 'Token tidak valid';
    } else {
    	if (isset($_POST['change_password'])) {
    	    // Assuming the user is logged in, you would typically get the user ID from the session
    	    $newPassword = $_POST['new_password'];

    	    if ($userAuth->changePassword($token, $newPassword)) {
    	        echo 'Password changed successfully!<br>';
    	    } else {
    	        echo 'Failed to change password.<br>';
    	    }
    	}

    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>
    <form method="post" action="">
        <h2>Change Password</h2>
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required><br>
        <input type="submit" name="change_password" value="Change Password">
    </form>
</body>
</html>
