<?php

include '../Autoloader.php';
// include '../../config/load.php';
// include '../config/auth.php';

// Check if the user is logged in
//$userAuth = "";
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



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otpEnabled = isset($_POST['otp_enabled']) ? $_POST['otp_enabled'] : '';
    $captchaEnabled = isset($_POST['captcha_enabled']) ? $_POST['captcha_enabled'] : '';
    $emailEnabled = isset($_POST['email']) ? $_POST['email'] : '';

    // Update settings in the database
    $setting->updateSetting('otp_enabled', $otpEnabled);
    $setting->updateSetting('captcha_enabled', $captchaEnabled);
    $setting->updateSetting('email', $emailEnabled);
}

// Retrieve current settings from the database
$otpEnabledValue = $setting->getSetting('otp_enabled');
$captchaEnabledValue = $setting->getSetting('captcha_enabled');
$emailValue = $setting->getSetting('email');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
</head>
<body>

    <h1>Settings</h1>

    <form method="post">
        <label for="otp_enabled">OTP Enabled:</label>
        <select name="otp_enabled" id="otp_enabled">
            <option value="true" <?= $otpEnabledValue === 'true' ? 'selected' : '' ?>>True</option>
            <option value="false" <?= $otpEnabledValue === 'false' ? 'selected' : '' ?>>False</option>
        </select>

        <br>

        <label for="captcha_enabled">CAPTCHA Enabled:</label>
        <select name="captcha_enabled" id="captcha_enabled">
            <option value="true" <?= $captchaEnabledValue === 'true' ? 'selected' : '' ?>>True</option>
            <option value="false" <?= $captchaEnabledValue === 'false' ? 'selected' : '' ?>>False</option>
        </select>

        <br>
        <label for="captcha_enabled">Email:</label>
        <input type="email" name="email" value="<?= $emailValue;?>">
        <br>

        <button type="submit">Save</button>
    </form>

    <a href="logout.php">Logout</a>
</body>
</html>
