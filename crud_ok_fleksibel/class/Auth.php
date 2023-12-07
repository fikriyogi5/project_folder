<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// use Registrasi\Database;
// use PDO;
// use PDOException;
// require_once '../libs/PHPMailer/vendor/autoload.php';

class Auth {
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Autolog
    public function autoLog($user_id, $activity_type, $activity_detail) {
        try {
            $verificationToken = bin2hex(random_bytes(32));
            // Get the user's IP address
            $userIP = $_SERVER['REMOTE_ADDR'];

            // Create the API URL
            $apiUrl = "https://ipinfo.io/{$userIP}/json";

            // Make a request to the API
            $response = file_get_contents($apiUrl);

            // Decode the JSON response
            $data = json_decode($response, true);

            // Extract location information
            $city = $data['city'];
            $region = $data['region'];
            $country = $data['country'];

            $activity_details = $activity_detail . 'User logged in from IP: ' . $_SERVER['REMOTE_ADDR'] . 'Location : ' . $city . $region . $country ;

            $stmt = $this->db->prepare("INSERT INTO user_activities (user_id, activity_type, activity_details) VALUES (:user_id, :activity_type, :activity_details)");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':activity_type', $activity_type, PDO::PARAM_STR);
            $stmt->bindParam(':activity_details', $activity_details, PDO::PARAM_STR);

            $stmt->execute();
        } catch (\PDOException $e) {
            // Handle the exception, log, or return an error message
            return false;
        }
    }

    // Autolog
    // public function searchLog($user_id, $kata_kunci) {
    //     try {
    //         $verificationToken = bin2hex(random_bytes(32));
    //         // Get the user's IP address

    //         $stmt = $this->db->prepare("INSERT INTO riwayat_pencarian (user_id, kata_kunci) VALUES (:user_id, :kata_kunci, :activity_details)");
    //         $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    //         $stmt->bindParam(':kata_kunci', $kata_kunci, PDO::PARAM_STR);

    //         $stmt->execute();
    //     } catch (\PDOException $e) {
    //         // Handle the exception, log, or return an error message
    //         return false;
    //     }
    // }
    // Register a new user
    public function register($username, $email, $password) {
        try {
            if ($this->isUsernameExists($username) || $this->isEmailExists($email)) {
                return false; // Username or email already exists
            }

            $initialDriveSize = 10 * 1024 * 1024; // 10 MB in bytes

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $verificationToken = bin2hex(random_bytes(32));
            $verificationCreatedAt = date('Y-m-d H:i:s'); // Current timestamp

            $stmt = $this->db->prepare("INSERT INTO users (username, email, password, drive_size, verification_token, verification_created_at) VALUES (:username, :email, :password, :drive_size, :verification_token, :verification_created_at)");

            $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, \PDO::PARAM_STR);
            $stmt->bindParam(':drive_size', $initialDriveSize, \PDO::PARAM_INT);
            $stmt->bindParam(':verification_token', $verificationToken, \PDO::PARAM_STR);
            $stmt->bindParam(':verification_created_at', $verificationCreatedAt, \PDO::PARAM_STR);

            $result = $stmt->execute();

            if ($result) {
                $this->sendVerificationEmail($email, $verificationToken);
                return true; // Registration successful
            } else {
                return false; // Registration failed
            }
        } catch (\PDOException $e) {
            // Handle the exception, log, or return an error message
            return false;
        }
    }
    
    public function verifyEmail($verificationToken) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE verification_token = :verification_token");
            $stmt->bindParam(':verification_token', $verificationToken, \PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($user && $this->isTokenValid($user['verification_created_at'])) {
                // Mark the user as verified
                $this->markUserAsVerified($user['id']);
                // Remove the verification token from the user record (if desired)
                $this->removeVerificationToken('id', $user['id']);
                return true;
            } else {
                return false; // Invalid verification token or expired
            }
        } catch (\PDOException $e) {
            // Handle the exception, log, or return an error message
            return false;
        }
    }
    // Add this method to your UserAuth class
    public function updateVerificationToken($email, $newVerificationToken, $newVerificationCreatedAt) {
        try {
            $stmt = $this->db->prepare("UPDATE users SET verification_token = :newVerificationToken, verification_created_at = :newVerificationCreatedAt WHERE email = :email");
            $stmt->bindParam(':newVerificationToken', $newVerificationToken, \PDO::PARAM_STR);
            $stmt->bindParam(':newVerificationCreatedAt', $newVerificationCreatedAt, \PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);

            return $stmt->execute();
        } catch (\PDOException $e) {
            // Handle the exception, log, or return an error message
            return false;
        }
    }


    // Add this method to your UserAuth class
    private function isTokenValid($createdAt) {
        // Calculate the expiration time (1 minute)
        $expirationTime = strtotime($createdAt) + 60; // Add 60 seconds for 1 minute

        // Check if the current time is before the expiration time
        return (time() < $expirationTime);
    }

    // Add this method to your UserAuth class
    private function removeVerificationToken($data, $userId) {
        try {
            $updateStmt = $this->db->prepare("UPDATE users SET verification_token = NULL WHERE $data = :user_id");
            $updateStmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
            $updateStmt->execute();
        } catch (\PDOException $e) {
            // Handle the exception, log, or return an error message
        }
    }

    private function markUserAsVerified($userId) {
        $updateStmt = $this->db->prepare("UPDATE users SET verified = 1 WHERE id = :user_id");
        $updateStmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
        $updateStmt->execute();
    }



    private function isUsernameExists($username) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public function isEmailExists($email) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    // Authenticate user login
    public function login($username, $password) {
        try {
            // Prepare SQL statement to retrieve user data by username
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            // Fetch user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the password
            if ($user && password_verify($password, $user['password'])) {
                // Check OTP if provided
                // You can set session variables or perform other login actions here
                
                // Check if OTP is verified
                if ($user['verified'] == 1) {
                    $this->autoLog($user['id'], 'Login', 'User Login at ');
                    

                    $settings = new Setting($this->db);

                    // Check OTP setting using the Settings class
                    if ($settings->getSetting('otp_enabled') == 'true') {
                        // Redirect to OTP page
                        $this->generateAndSendOTP($user['email']); // Use the email for OTP generation
                        $this->autoLog($user['id'], 'Login', $this->generateAndSendOTP($user['email']));
                        // Redirect the user to the OTP entry page
                        header("Location: otp-entry.php?username=" . urlencode($username));
                        exit();
                    } else {
                        // Redirect based on user role
                        // OTP is verified, set session variables or perform other login actions
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user_role'] = $user['user_role']; // Assuming 'user_role' is the column in the users table

                        $this->redirectBasedOnUserRole($user['user_role']);
                        exit();
                    }
                } else {
                    // OTP not verified, show a notification
                    echo "Please verify your email, check your mail to complete the login process.";
                    return false;
                }
            } else {
                // Login failed
                return false;
            }
        } catch (PDOException $e) {
            // Handle the exception, log, or return an error message
            return false;
        }
    }


    // Adjust the method to use email consistently
    public function generateAndSendOTP($email) {
        // Generate a random OTP (you can customize the length and characters)
        $otp = mt_rand(100000, 999999);

        // Store the OTP in the database for the user
        $stmt = $this->db->prepare("UPDATE users SET otp = :otp WHERE email = :email");
        $stmt->bindParam(':otp', $otp, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Send the OTP to the user's email
        $this->sendEmail($email, 'OTP', $otp);

        // Return true if OTP is generated and sent successfully
        return true;
    }

    // Adjust the method to use email consistently
    public function verifyOTP($username, $enteredOTP) {
        try {
            // Prepare SQL statement to retrieve user data by username
            $stmt = $this->db->prepare("SELECT otp, user_role FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            // Fetch user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the entered OTP against the stored OTP
            if ($user && $user['otp'] === $enteredOTP) {
                // OTP is verified, set session variables or perform other login actions
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['user_role']; // Assuming 'user_role' is the column in the users table

                $this->redirectBasedOnUserRole($user['user_role']);
                return true;
            } else {
                // Incorrect OTP or user not found
                return false;
            }
        } catch (PDOException $e) {
            // Handle the exception, log, or return an error message
            return false;
        }
    }
    public function getUserDataById($userId) {
            try {
                // Prepare SQL statement to retrieve user data by user ID
                $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :userId");
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->execute();

                // Fetch user data
                $userData = $stmt->fetch(PDO::FETCH_ASSOC);

                return $userData;
            } catch (PDOException $e) {
                // Handle the exception, log, or return an error message
                return null;
            }
        }

    // Adjust the method to use email consistently
    public function checkData($data, $isi) {
        try {
            // Prepare SQL statement to retrieve user ID by data
            $stmt = $this->db->prepare("SELECT * FROM users WHERE $data = :isi");
            $stmt->bindParam(':isi', $isi, PDO::PARAM_STR);
            $stmt->execute();

            // Fetch user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if the user was found
            if ($user) {
                return $user['id'];
            } else {
                // User not found
                return null;
            }
        } catch (PDOException $e) {
            // Handle the exception, log, or return an error message
            return null;
        }
    }



    // Send a password reset link to the user's email
    public function forgotPassword($email) {
    try {
        // Generate and store a verification token in the database
        $verificationToken = $this->generatePasswordResetLink();
        $stmt = $this->db->prepare("UPDATE users SET verification_token = :verification_token WHERE email = :email");
        $stmt->bindParam(':verification_token', $verificationToken, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->rowCount() === 0) {
            // No user found with the provided email
            return false;
        }

        // Construct the password reset link
        $resetLink = 'http://localhost/project_folder/change-password.php?token=' . $verificationToken;
        $emailBody = "Click the following link to reset your password: $resetLink";

        // Send the password reset link via email
        $emailSent = $this->sendEmail($email, "Password Reset", $emailBody);

        return $emailSent;
    } catch (PDOException $e) {
        // Handle the exception, log, or return an error message
        return false;
    }
}

    // Generate a random password reset link (sample function)
    private function generatePasswordResetLink() {
        // Implement logic to generate a unique and secure reset link
        // For simplicity, we'll generate a random string here
        return bin2hex(random_bytes(32));
    }


    // Change user password
    public function changePassword($token, $newPassword) {
        try {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Prepare SQL statement to update user password by ID
            $stmt = $this->db->prepare("UPDATE users SET password = :password WHERE verification_token = :token");
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':token', $token, PDO::PARAM_INT);

            // Execute the statement
            $result = $stmt->execute();

            if ($result) {
                // Password change successful
                $this->removeVerificationToken('verification_token', $token);
                return true;
            } else {
                // Password change failed
                return false;
            }
        } catch (PDOException $e) {
            // Handle the exception, log, or return an error message
            return false;
        }
    }

    // Log out the user (destroy session or perform necessary actions)
    public function logout() {
        session_start();
        session_destroy();
    }

    // Check if the user is logged in
    public function isLogin() {
        // Check if the user is logged in
        // Return true if logged in, false otherwise
        // Sample code: Check if the user has a session
        session_start();
        return isset($_SESSION['user_id']);
    }
    
    

    public function uploadFile($userId, $fileInputName) {
        // Assuming you have the user's drive size from the database
        $userDriveSize = $this->getUserDriveSize($userId);

        // Calculate the size of the uploaded file
        $uploadedFileSize = $_FILES[$fileInputName]['size'];

        // Check if the user has enough space
        if ($userDriveSize >= $uploadedFileSize) {
            // Update user's drive size in the database
            $newDriveSize = $userDriveSize - $uploadedFileSize;
            $this->updateUserDriveSize($userId, $newDriveSize);

            // Continue with file upload logic (e.g., move_uploaded_file)
            $uploadDir = 'uploads/';
            $uploadedFile = $uploadDir . basename($_FILES[$fileInputName]['name']);

            if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $uploadedFile)) {
                echo "File uploaded successfully.";
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Insufficient drive space.";
        }
    }

    private function getUserDriveSize($userId) {
        // Fetch the user's drive size from the database
        $stmt = $this->db->prepare("SELECT drive_size FROM users WHERE id = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['drive_size'] : 0;
    }

    private function updateUserDriveSize($userId, $newDriveSize) {
        // Update the user's drive size in the database
        $stmt = $this->db->prepare("UPDATE users SET drive_size = :newDriveSize WHERE id = :userId");
        $stmt->bindParam(':newDriveSize', $newDriveSize, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Check user's role for page access control
    public function checkPageCredentials($requiredRole) {
        // Implement role-based access control logic here
        // Check if the user has the required role to access the page
        // Return true if authorized, false otherwise
        // Sample code: Check if the user is an admin
        session_start();
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }
    
    public function processPayment($userId, $amount) {
        // Implement payment processing logic here
        // For simplicity, just update payment_status to 1
        $stmt = $this->db->prepare("UPDATE users SET payment_status = 1 WHERE id = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function upgradeMembershipLevel($userId, $newLevel) {
        // Implement membership level upgrade logic here
        $stmt = $this->db->prepare("UPDATE users SET membership_level = :newLevel WHERE id = :userId");
        $stmt->bindParam(':newLevel', $newLevel, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function increaseDriveSize($userId, $additionalSize) {
        // Implement drive size increase logic here
        $stmt = $this->db->prepare("UPDATE users SET drive_size = drive_size + :additionalSize WHERE id = :userId");
        $stmt->bindParam(':additionalSize', $additionalSize, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public function sendVerificationEmail($email, $verificationToken) {
        try {
            // Create a new PHPMailer instance
            $mail = $this->configureMailer();

            // Add recipient email address
            $mail->addAddress($email);

            // Set email subject
            $mail->Subject = 'Email Verification';

            // Construct the verification link
            $verificationLink = "http://localhost/project_folder/verify.php?token=$verificationToken";
            $resendLink = "http://localhost/project_folder/resend_verification.php?email=$email";
            $mail->Body = "Click the following link to verify your email: $verificationLink\nIf the token has expired, you can resend the verification email: $resendLink";

            // Send the email
            if ($mail->send()) {
                return true; // Email sent successfully
            } else {
                return false; // Email sending failed
            }
        } catch (Exception $e) {
            // Handle PHPMailer exceptions, log, or return an error message
            return false;
        }
    }


    private function sendEmail($to, $subject, $body) {
        try {
            $mail = $this->configureMailer();
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $body;

            return $mail->send(); // Return the result of sending the email
        } catch (Exception $e) {
            // Handle PHPMailer exceptions, log, or return an error message
            return false;
        }
    }

    private function configureMailer() {
        $settings = new Setting($this->db);

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $settings->getSetting('email_host'); // Set your SMTP host
        $mail->Port = $settings->getSetting('email_port'); // Use the appropriate port for your SMTP configuration
        $mail->SMTPAuth = true;
        $mail->Username = $settings->getSetting('email');
        $mail->Password = $settings->getSetting('email_pass');
        $mail->setFrom($settings->getSetting('email'), $settings->getSetting('app_name'));
        return $mail;
    }
    private function redirectBasedOnUserRole($userRole) {
        if ($userRole == 'admin') {
            // Redirect to admin dashboard
            header("Location: admin/admin-dashboard.php");
        } else {
            // Redirect to user dashboard
            header("Location: user-dashboard.php");
        }
        exit();
    }



    
}