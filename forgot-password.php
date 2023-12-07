<?php
// Include or require your class definition file here
require_once 'Autoloader.php';

// Assuming the class is named YourClass

if (isset($_POST['forgot_password'])) {
    $email = $_POST['email'];

    if(!$userAuth->checkData('email', $email)) {
    	echo 'Email tidak terdaftar di database';
    } else {
    	if ($userAuth->forgotPassword($email)) {
	        echo 'Password reset link sent to your email!<br>';
	    } else {
	        echo 'Failed to send password reset link.<br>';
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
	Forgot your password?
	You have requested to reset your password
	We cannot simply send you your old password. A unique link to reset your password has been generated for you. To reset your password, click the following link and follow the instructions.

    <form method="post" action="">
        <input type="email" name="email" placeholder="Email">
        <button type="submit" name="forgot_password">Reset password</button>
    </form>
    Have an account already? <a href="login.php"> Masuk</a>
</body>
</html>
