<?php
// Include or require your class definition file here
require_once 'Autoloader.php';


// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];

    // Check if the "otp" key is set before trying to access it
    if (isset($_POST["digit1"], $_POST["digit2"], $_POST["digit3"], $_POST["digit4"], $_POST["digit5"], $_POST["digit6"])) {
        $otp = $_POST["digit1"] . $_POST["digit2"] . $_POST["digit3"] . $_POST["digit4"] . $_POST["digit5"] . $_POST["digit6"];

        $otpVerificationResult = $userAuth->verifyOTP($username, $otp);

        if ($otpVerificationResult) {
            // OTP verification successful, set session variable or perform other actions
            $_SESSION['user'] = $userAuth->checkData('username', $username);
            header("Location: dashboard.php");
            exit();
        } else {
            // OTP verification failed, display an error message or redirect back to the OTP entry page
            echo "OTP verification failed. Please try again.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Entry</title>
    <!-- Include your CSS stylesheets or link to a framework like Bootstrap if you're using one -->
    <style>
        input[type="text"] {
            width: 2em; /* Set the width to accommodate one digit */
            text-align: center; /* Center the text in the input */
            margin: 0 0.2em; /* Add some spacing between inputs */
        }
    </style>
</head>
<body>

    <form action="" id="otpForm" method="post">
        <input type="hidden" name="username" value="<?php echo isset($_GET['username']) ? htmlspecialchars($_GET['username']) : ''; ?>">

        <label for="otp">Enter OTP:</label>
        <input type="text" id="digit1" name="digit1" maxlength="1" required autofocus>
        <input type="text" id="digit2" name="digit2" maxlength="1" required>
        <input type="text" id="digit3" name="digit3" maxlength="1" required>
        <input type="text" id="digit4" name="digit4" maxlength="1" required>
        <input type="text" id="digit5" name="digit5" maxlength="1" required>
        <input type="text" id="digit6" name="digit6" maxlength="1" required>

        <input type="submit" value="Submit OTP">
    </form>

    <script>
        document.getElementById('otpForm').addEventListener('input', function() {
            var inputs = document.querySelectorAll('input[type="text"]');
            var allFilled = true;

            function moveToNext(currentInput) {
                var maxLength = parseInt(currentInput.maxLength, 10);
                var inputLength = currentInput.value.length;

                if (inputLength >= maxLength) {
                    var nextInput = currentInput.nextElementSibling;

                    if (nextInput) {
                        nextInput.focus();
                    }
                }
            }

            inputs.forEach(function(input) {
                if (input.value === '') {
                    allFilled = false;
                } else {
                    moveToNext(input);
                }
            });

            if (allFilled) {
                document.getElementById('otpForm').submit();
            }
        });
    </script>

</body>
</html>
