<?php
// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Function to sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $name     = isset($_POST['user_name']) ? sanitize_input($_POST['user_name']) : '';
    $email    = isset($_POST['user_email']) ? sanitize_input($_POST['user_email']) : '';
    $contact  = isset($_POST['user_contact']) ? sanitize_input($_POST['user_contact']) : '';
    $message  = isset($_POST['user_message']) ? sanitize_input($_POST['user_message']) : '';

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        echo 'error: Please fill in all required fields.';
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'error: Invalid email format.';
        exit();
    }

    // Prepare the email
    $email_to = 'techedmy@gmail.com';
    $subject  = "New Contact Form Submission from $name";
    $headers  = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Create the email content
    $email_message = "
    <html>
    <head>
        <title>Contact Form Submission</title>
    </head>
    <body>
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Contact Number:</strong> {$contact}</p>
        <p><strong>Message:</strong><br>{$message}</p>
    </body>
    </html>
    ";

    // Attempt to send the email
    if (mail($email_to, $subject, $email_message, $headers)) {
        echo 'sent';
    } else {
        echo 'error: Unable to send email. Please try again later.';
    }
} else {
    echo 'error: Invalid request method.';
}
?>
