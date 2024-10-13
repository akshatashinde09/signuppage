// validate.php

<?php

// Configuration
$secretKey = "6LdfoF8qAAAAADUgEfApJVF5r92Yd8BD89GlRzse";
$url = "https://www.google.com/recaptcha/api/siteverify";

// Get the form data
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$phone = $_POST["phone"];
$captcha = $_POST["g-recaptcha-response"];

// Validate the form data
if (empty($name) || empty($email) || empty($password) || empty($phone)) {
    echo "Please fill in all the fields.";
    exit;
}

// Validate the captcha
$verifyResponse = file_get_contents($url . "?secret=" . $secretKey . "&response=" . $captcha);
$responseData = json_decode($verifyResponse, true);

if (!$responseData["success"]) {
    echo "Invalid captcha.";
    exit;
}

// Save the form data to the database
// ...

echo "Sign up successful!";