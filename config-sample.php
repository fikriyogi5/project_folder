<?php
$fileToCheck = 'config-sample.php'; // Replace with the actual path and filename

if (file_exists($fileToCheck)) {
    // File exists, redirect to another page
    header("Location: another_page.php");
    exit();
} else {
    // File does not exist, you can handle this case or perform other actions
    echo "File does not exist.";
}