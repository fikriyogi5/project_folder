<?php
require_once 'db.php';

class Validator {
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function isPasswordStrong($password) {
        // Check if the password is at least 8 characters long and contains at least one uppercase letter, one lowercase letter, one number, and one special character.
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
    }

    public function isEmailValid($email) {
        // Check if the email is valid.
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function isUsernameValid($username) {
        // Check if the username contains only alphanumeric characters and underscores, and is at least 3 characters long.
        return preg_match('/^[a-zA-Z0-9_]{3,}$/', $username);
    }

    public function isNameValid($name) {
        // Check if the name contains only letters and spaces.
        return preg_match('/^[a-zA-Z\s]+$/', $name);
    }

    public function doPasswordsMatch($password, $confirmPassword) {
        // Check if the password and confirm password match.
        return $password === $confirmPassword;
    }

    public function isUsernameUnique($username) {
        // Check if the username is unique in the database.
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn() == 0;
    }

    public function isEmailUnique($email) {
        // Check if the email is unique in the database.
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn() == 0;
    }

    // Add other validation methods as needed

}

// Example usage
$pdo = new PDO("mysql:host=localhost;dbname=your_database", "your_username", "your_password");
$validator = new Validator($pdo);

// Example usage
$password = "StrongPassword1!";
$email = "user@example.com";
$confirmPassword = "StrongPassword1!";
$username = "user123";
$name = "John Doe";

if ($validator->isPasswordStrong($password) &&
    $validator->isEmailValid($email) &&
    $validator->doPasswordsMatch($password, $confirmPassword) &&
    $validator->isUsernameValid($username) &&
    $validator->isNameValid($name) &&
    $validator->isUsernameUnique($username) &&
    $validator->isEmailUnique($email)) {
    // All validations passed, proceed with registration or other actions
    echo "Validations passed!";
} else {
    // Handle validation errors
    echo "Validation failed!";
}

?>