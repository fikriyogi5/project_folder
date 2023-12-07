<?php

require_once 'class/class.UserAuth.php';

// Create an instance of UserAuth
$userAuth = new UserAuth();

// Example: User Registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($userAuth->register($username, $email, $password)) {
        echo 'Registration successful!<br>';
    } else {
        echo 'Registration failed!<br>';
    }
}

// Example: User Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($userAuth->login($username, $password)) {
        echo 'Login successful!<br>';
    } else {
        echo 'Login failed!<br>';
    }
}

// Example: Forgot Password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['forgot_password'])) {
    $email = $_POST['email'];

    if ($userAuth->forgotPassword($email)) {
        echo 'Password reset link sent to your email!<br>';
    } else {
        echo 'Failed to send password reset link.<br>';
    }
}

// Example: Change Password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    // Assuming the user is logged in, you would typically get the user ID from the session
    $userId = 1; // Replace with the actual user ID
    $newPassword = $_POST['new_password'];

    if ($userAuth->changePassword($userId, $newPassword)) {
        echo 'Password changed successfully!<br>';
    } else {
        echo 'Failed to change password.<br>';
    }
}

// Example: Logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    $userAuth->logout();
    echo 'Logged out successfully!<br>';
}

// Example: Checking if the User is Logged In
if ($userAuth->isLogin()) {
    echo 'User is logged in.<br>';
} else {
    echo 'User is not logged in.<br>';
}

// Example: Checking Page Credentials
if ($userAuth->checkPageCredentials('admin')) {
    echo 'User has admin access.<br>';
} else {
    echo 'User does not have admin access.<br>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Authentication Example</title>
</head>
<body>

<!-- Registration Form -->
<form method="post" action="">
    <h2>Registration</h2>
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    <input type="submit" name="register" value="Register">
</form>

<!-- Login Form -->
<form method="post" action="">
    <h2>Login</h2>
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    <input type="submit" name="login" value="Login">
</form>

<!-- Forgot Password Form -->
<form method="post" action="">
    <h2>Forgot Password</h2>
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
    <input type="submit" name="forgot_password" value="Send Reset Link">
</form>

<!-- Change Password Form -->
<form method="post" action="">
    <h2>Change Password</h2>
    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" required><br>
    <input type="submit" name="change_password" value="Change Password">
</form>

<!-- Logout Form -->
<form method="post" action="">
    <h2>Logout</h2>
    <input type="submit" name="logout" value="Logout">
</form>

</body>
</html>
<?php

// Assume a user with ID 1 wants to upgrade their membership level
$userId = 1;
$userAuth = new UserAuth($pdo);

// Process payment (assuming payment successful)
$amountPaid = 10; // Example amount
$userAuth->processPayment($userId, $amountPaid);

// Upgrade membership level
$newLevel = 2; // Example new level
$userAuth->upgradeMembershipLevel($userId, $newLevel);

// Increase drive size based on the new membership level
$additionalSize = 1024 * 1024 * 100; // Example additional size (100 MB)
$userAuth->increaseDriveSize($userId, $additionalSize);

// ... (other actions or redirects)
?>