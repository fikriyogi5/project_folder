<?php

class EncryptionHelper {
    private $cipher = 'AES-256-CBC'; // Choose a strong encryption algorithm and mode
    private $key; // Store your encryption key securely

    public function __construct($key) {
        $this->key = $key;
    }

    public function encrypt($data) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
        $encryptedData = openssl_encrypt($data, $this->cipher, $this->key, 0, $iv);

        // Concatenate the IV with the encrypted data
        $result = base64_encode($iv . $encryptedData);

        return $result;
    }

    public function decrypt($data) {
        $data = base64_decode($data);
        $ivSize = openssl_cipher_iv_length($this->cipher);
        $iv = substr($data, 0, $ivSize);
        $encryptedData = substr($data, $ivSize);

        $decryptedData = openssl_decrypt($encryptedData, $this->cipher, $this->key, 0, $iv);

        return $decryptedData;
    }
}

// Example Usage
$key = 'your_strong_encryption_key'; // Replace with a strong, unique key
$encryptionHelper = new EncryptionHelper($key);

// Encrypt data
$plaintext = 'Hello, World!';
$encryptedData = $encryptionHelper->encrypt($plaintext);
echo "Encrypted Data: $encryptedData\n";

// Decrypt data
$decryptedData = $encryptionHelper->decrypt($encryptedData);
echo "Decrypted Data: $decryptedData\n";

?>