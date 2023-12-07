<?php 
function getBaseUrl() {
    // Construct and return the base URL dynamically
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $script = dirname($_SERVER['SCRIPT_NAME']);
    return "$protocol://$host$script";
}
echo getBaseUrl();
// echo __DIR__ . '/wp-load.php';









 function encryptBlock($x)
    {
        $y = ''; // 16-byte string
        // place input x into the initial state matrix in column order
        for ($i = 0; $i <4*self::$Nb; $i++) {
            // we want integerger division for the second index
            $this->s[$i%4][($i-$i%self::$Nb)/self::$Nb] = ord($x[$i]);
        }
        // add round key
        $this->addRoundKey(0);
        for ($i = 1; $i < $this->Nr; $i++) {
            // substitute bytes
            $this->subBytes();
            // shift rows
            $this->shiftRows();
            // mix columns
            $this->mixColumns();
            // add round key
            $this->addRoundKey($i);
        }
        // substitute bytes
        $this->subBytes();
        // shift rows
        $this->shiftRows();
        // add round key
        $this->addRoundKey($i);
        // place state matrix s into y in column order
        for ($i = 0; $i < 4*self::$Nb; $i++) {
            $y .= chr($this->s[$i%4][($i-$i%self::$Nb)/self::$Nb]);
        }
        return $y;
    }
    /** Decrypts the 16-byte cipher text.
    *   @params 16-byte ciphertext string
    *   @returns 16-byte plaintext string
    **/
     function decryptBlock($y)
    {
        $x = ''; // 16-byte string
        // place input y into the initial state matrix in column order
        for ($i = 0; $i < 4*self::$Nb; $i++) {
            $this->s[$i%4][($i-$i%self::$Nb)/self::$Nb] = ord($y[$i]);
        }
        // add round key
        $this->addRoundKey($this->Nr);
        for ($i = $this->Nr-1; $i > 0; $i--) {
            // inverse shift rows
            $this->invShiftRows();
            // inverse sub bytes
            $this->invSubBytes();
            // add round key
            $this->addRoundKey($i);
            // inverse mix columns
            $this->invMixColumns();
        }
        // inverse shift rows
        $this->invShiftRows();
        // inverse sub bytes
        $this->invSubBytes();
        // add round key
        $this->addRoundKey($i);
        // place state matrix s into x in column order
        for ($i = 0; $i < 4*self::$Nb; $i++) {
            // Used to remove filled null characters.
            $x .= chr($this->s[$i%4][($i-$i%self::$Nb)/self::$Nb]);
        }
        return $x;
    }

    echo encryptBlock('tes');