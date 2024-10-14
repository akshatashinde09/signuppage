<?php
// Replace 'YOUR_SECRET_KEY' with your actual Google reCAPTCHA secret key
$secretKey = '6Ld5bmEqAAAAALKKCgKWehjkvTP21GWf4YdwjbsR';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get reCAPTCHA response
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verify reCAPTCHA
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $recaptchaResponse);
    $verifyResponse = json_decode($verifyResponse, true);

    if ($verifyResponse['success']) {
        // reCAPTCHA passed, process form data
        $business_name = $_POST['business_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Perform validation and database operations here

        echo "Signup successful!";
    } else {
        echo " reCAPTCHA verification failed. Please try again.";
    }
}
?>
