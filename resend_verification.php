<!-- resend_verification.php -->

<?php
require_once 'class/class.userAuth.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $userAuth = new UserAuth(); // Adjust the namespace accordingly

    // Check if the user exists
    if ($userAuth->isEmailExists($email)) {
        // Generate a new verification token
        $newVerificationToken = bin2hex(random_bytes(32));
        $newVerificationCreatedAt = date('Y-m-d H:i:s'); // Current timestamp

        // Update the user's record with the new verification token and timestamp
        $updateResult = $userAuth->updateVerificationToken($email, $newVerificationToken, $newVerificationCreatedAt);

        if ($updateResult) {
            // Resend the verification email with the new token
            $userAuth->sendVerificationEmail($email, $newVerificationToken);
            echo "Verification email resent successfully.";
        } else {
            echo "Error updating verification token. Please try again.";
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request. Please provide an email address.";
}
?>
