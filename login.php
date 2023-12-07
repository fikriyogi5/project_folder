<?php
// Include or require your class definition file here
// require_once 'class/class.userAuth.php';
// Mengaktifkan autoloader
require_once 'Autoloader.php';

// Check if the user is already authenticated
if ($userAuth->isLogin()) {
    header("Location: dashboard.php"); // Redirect to the dashboard if the user is already authenticated
    exit();
}



// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($setting->getSetting('captcha_enabled') ==  'true') {


        $recaptchaResponse = $_POST['g-recaptcha-response'];

        $verificationResult = $recaptchaVerifier->verify($recaptchaResponse);

        if ($verificationResult) {
            // The reCAPTCHA was successful, process the form
            // Call the login method
            $loginResult = $userAuth->login($username, $password);

            if ($loginResult) {
                // The user is successfully logged in and redirected to the OTP entry page
                header("Location: otp-entry.php?username=" . urlencode($username));
                exit(); // Ensure no further code is executed after the redirection
            } else {
                $loginError = "Login failed. Please check your credentials.";
            }
        } else {
            // The reCAPTCHA failed, handle accordingly
            $loginError = "Captcha salah.";
        }
    } else {
        // The reCAPTCHA was successful, process the form
        // Call the login method
        $loginResult = $userAuth->login($username, $password);

        if ($loginResult) {
            // The user is successfully logged in and redirected to the OTP entry page
            header("Location: otp-entry.php?username=" . urlencode($username));
            exit(); // Ensure no further code is executed after the redirection
        } else {
            $loginError = "Login failed. Please check your credentials.";
        }
    }
// Example usage:




}








?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!--    <div class="g-recaptcha" data-sitekey="6LdGQRMpAAAAAOH9E7W6TNY-DtdDv3fD2BJLe8yU"></div>-->
    <script src="https://www.google.com/recaptcha/api.js?render=6LdGQRMpAAAAAOH9E7W6TNY-DtdDv3fD2BJLe8yU"></script>

    <title>Login</title>
    <!-- Include your CSS stylesheets or link to a framework like Bootstrap if you're using one -->
</head>
<body>

    <h2>Login</h2>

    <?php
    // Display login error if any
    if (isset($loginError)) {
        echo "<p style='color: red;'>$loginError</p>";
    }
    ?>

    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <?php
        // Display reCAPTCHA only if it's enabled (assuming 'recaptcha_enabled' is a setting)
//        $recaptchaEnabled = (new Setting())->getSetting('captcha_enabled');
        $recaptchaEnabled = ($setting->getSetting('captcha_enabled'));
        if ($recaptchaEnabled == 'true') {
            echo '<div class="g-recaptcha" data-sitekey="'.$setting->getSetting('recaptcha_site_key').'"></div>';
        }
        ?>

        <input type="submit" value="Login">
    </form>
    <a href="forgot-password.php">Lupa Password</a>

</body>
</html>
