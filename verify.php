
<!-- verify.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>

<?php
require_once 'class/class.userAuth.php';
// Check if the verification token is provided in the URL
if (isset($_GET['token'])) {
    $verificationToken = $_GET['token'];
    $userAuth = new UserAuth(); // Adjust the namespace accordingly

    // Call the verifyEmail method to handle the verification
    $verificationResult = $userAuth->verifyEmail($verificationToken);

    if ($verificationResult) {
        // Verification successful
        echo "Email verification successful. You can now <a href='login.php'>login</a>.";
    } else {
        // Verification failed
        echo "Invalid verification token or user not found.";
    }
} else {
    // Token not provided in the URL
    echo "Invalid request. Please provide a verification token.";
}
?>

</body>
</html>
