<?php

//class Autoloader {
//    public static function autoload($className) {
//        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
//        $file = __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
//
//        if (file_exists($file)) {
//            require $file;
//        }
//    }
//}
//
//spl_autoload_register('Autoloader::autoload');

// namespace class;

// Menggunakan namespace
// use class\Registrasi\UserAuth;
// use class\Database;
// use class\Setting;
require_once 'libs/PHPMailer/vendor/autoload.php';
// include 'congi.php';
include 'class/Database.php';
include 'class/Setting.php';
include 'class/UserAuth.php';
include 'class/FlexibleCRUD.php';
include 'class/RecaptchaVerifier.php';
include 'class/SearchEngine.php';
include 'class/Menu.php';



// Membuat objek dari kelas
$database = new Database();
$setting = new Setting();
$userAuth = new UserAuth();
$SearchEngine = new SearchEngine();
$Menu = new Menu();

$flexibleCRUD = new FlexibleCRUD();
$recaptchaVerifier = new RecaptchaVerifier();

// Cek installer jika belum di install
// $database->checkInstaller();

// require_once 'config/functions.php';
