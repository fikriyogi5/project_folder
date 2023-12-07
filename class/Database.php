<?php

// namespace class;

// use PDO;
// use PDOException;
// include __DIR__ . '/config/config.php';
require_once dirname( __DIR__ ) . '/config/config.php';

class Database {
    private $pdo;

    public function __construct() {
        // Your database connection details
        $host = DB_HOST;
        $dbname = 'app';
        $username = 'root';
        $password = null;

        // Establish a PDO connection
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Handle the exception, log, or return an error message
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    // public function checkInstaller() {

    //     $fileToCheck = 'config-sample.php'; // Replace with the actual path and filename

    //     if (file_exists($fileToCheck)) {
    //         // File exists, redirect to another page
    //         header("Location: form-wizard.php");
    //         exit();
    //     } else {
    //         // File does not exist, you can handle this case or perform other actions
    //         // echo "File does not exist.";
    //         header("Location: index.php");
    //         exit();
    //     }

    // }
}
