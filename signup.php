<?php
// Configuration
$siteKey = '6LdfoF8qAAAAABhDmrq6CGqXeO7CtCIfSgJXIjgK';
$secretKey = '6LdfoF8qAAAAADUgEfApJVF5r92Yd8BD89GlRzse';

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
