<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form Validation with AJAX</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="form-container">
        <form id="myForm">
            <h2>Sign Up Form</h2>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
                <span id="usernameError" class="error"></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <span id="emailError" class="error"></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <span id="passwordError" class="error"></span>
            </div>
            <button type="submit">Submit</button>
            <span id="successMessage" class="success"></span>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#myForm').on('submit', function(event) {
                event.preventDefault(); // Prevent form submission

                $.ajax({
                    url: 'validate.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        // Clear any previous error messages
                        $('.error').text('');
                        $('#successMessage').text('');

                        if (response.success) {
                            $('#successMessage').text('Form submitted successfully!');
                        } else {
                            // Show error messages
                            if (response.errors.username) {
                                $('#usernameError').text(response.errors.username);
                            }
                            if (response.errors.email) {
                                $('#emailError').text(response.errors.email);
                            }
                            if (response.errors.password) {
                                $('#passwordError').text(response.errors.password);
