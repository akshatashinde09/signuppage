<?php
// Configuration
$siteKey = '6LcQL2AqAAAAAHNUOzxVGGvGoepJ7w6iBlzmYlQB';
$secretKey = '6LcQL2AqAAAAAF3d2vTOmFWwtxKg6KdwXkHK2Edh';

// Validate form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Validate Google Captcha
  $captchaResponse = $_POST['g-recaptcha-response'];
  $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captchaResponse}&remoteip={$_SERVER['REMOTE_ADDR']}");
  $responseData = json_decode($verifyResponse, true);
  if ($responseData['success']) {
    // Validate form fields
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate form fields
    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
      $error = 'Please fill in all fields.';
    } elseif ($password != $confirmPassword) {
      $error = 'Passwords do not match.';
    } else {
      // Insert into database (not implemented in this example)
      // ...
      $success = 'Sign up successful!';
    }
  } else {
    $error = 'Invalid Captcha response.';
  }
}

// Display error or success message
if (isset($error)) {
  echo '<p class="error">' . $error . '</p>';
} elseif (isset($success)) {
  echo '<p class="success">' . $success . '</p>';
}
?>
