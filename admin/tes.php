<?php
// index.php (or wherever your authentication and menu display logic is)
session_start();
include dirname( __DIR__ ) . '/Autoloader.php';

// Include your User and Menu classes here

$authenticatedUser = $_SESSION['user_id'];
$roleId =  $_SESSION['user_role'];
$Menu->displayMenu($roleId);
