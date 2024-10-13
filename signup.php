<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <!-- Load Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="container">
        <h2>Business Sign Up</h2>
        <form action="signup.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <!-- Google reCAPTCHA widget -->
            <div class="form-group">
              <!--site key-->
                <div class="g-recaptcha" data-sitekey="6LcQL2AqAAAAAHNUOzxVGGvGoepJ7w6iBlzmYlQB"></div>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Sign Up</button>
            </div>
        </form>
    </div>
</body>
</html>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Replace with your reCAPTCHA secret key
    $secretKey = '6LcQL2AqAAAAAF3d2vTOmFWwtxKg6KdwXkHK2Edh';

    // Google reCAPTCHA response
    $captchaResponse = $_POST['g-recaptcha-response'];

    // Check if reCAPTCHA was completed
    if (!$captchaResponse) {
        echo "Please complete the CAPTCHA.";
        exit;
    }

    // Verifying the reCAPTCHA response
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captchaResponse");
    $responseKeys = json_decode($response, true);

    if ($responseKeys["success"]) {
        // reCAPTCHA passed, process the form
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

        // Here you can add code to insert the data into the database

        echo "Sign up successful! Welcome, $name.";
    } else {
        // reCAPTCHA failed
        echo "CAPTCHA verification failed. Please try again.";
    }
}
?>
