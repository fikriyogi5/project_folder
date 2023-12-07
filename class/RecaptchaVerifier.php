<?php
require_once 'Database.php';
require_once 'Setting.php';

class RecaptchaVerifier {
    private $pdo;
    private $secretKey;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();

        // Get the reCAPTCHA secret key from the database
        $setting = new Setting($this->pdo);
        $this->secretKey = $setting->getSetting('recaptcha_secret_key');
    }

    public function verify($response) {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = [
            'secret' => $this->secretKey,
            'response' => $response,
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ],
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === false) {
            // Handle error when unable to contact reCAPTCHA server
            return false;
        }

        $result = json_decode($result, true);

        return $result['success'];
    }
}
