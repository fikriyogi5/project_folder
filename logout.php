<?php
// Include or require your class definition file here
require_once 'Autoloader.php';


// Call the logout method
$userAuth->logout();

// Redirect the user to the login page after logging out
header("Location: login.php");
exit();
?>
