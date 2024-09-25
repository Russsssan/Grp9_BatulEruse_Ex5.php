<?php
header('Content-Type: application/json');

// Array to hold validation errors
$errors = [];
$response = ['success' => false, 'errors' => $errors];

// Sanitize and validate username
if (empty($_POST['username'])) {
    $errors['username'] = 'Username is required.';
} elseif (strlen($_POST['username']) < 3) {
    $errors['username'] = 'Username must be at least 3 characters.';
}

// Sanitize and validate email
if (empty($_POST['email'])) {
    $errors['email'] = 'Email is required.';
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid email format.';
}

// Sanitize and validate password
if (empty($_POST['password'])) {
    $errors['password'] = 'Password is required.';
} elseif (strlen($_POST['password']) < 6) {
    $errors['password'] = 'Password must be at least 6 characters.';
}

// Check if there are any errors
if (empty($errors)) {
    // If no errors, set success to true
    $response['success'] = true;
} else {
    // Otherwise, pass errors to the response
    $response['errors'] = $errors;
}

// Return JSON response
echo json_encode($response);
?>
