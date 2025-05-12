<?php
require_once 'config.php'; // This file should define $conn (PDO connection)

// Return plain text (can be adjusted to JSON if needed)
header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize input
    $fullName = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validate required fields
    if (empty($fullName) || empty($email) || empty($phone) || empty($message)) {
        http_response_code(400);
        echo "All fields are required.";
        exit();
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Invalid email address.";
        exit();
    }

    try {
        $stmt = $conn->prepare("INSERT INTO contact_messages (full_name, email, phone, message)
                                VALUES (?, ?, ?, ?)");
        $stmt->execute([$fullName, $email, $phone, $message]);

        echo "Message sent successfully!";
    } catch (PDOException $e) {
        error_log("Contact form error: " . $e->getMessage(), 3, 'error_log.txt');
        http_response_code(500);
        echo "An error occurred while sending your message. Please try again.";
    }
} else {
    http_response_code(405);
    echo "Method not allowed.";
}



/*
// After successful database insertion
$to = "your@email.com";
$subject = "New Enquiry from Contact Form";
$message = "A new enquiry has been submitted:\n\n";
$message .= "Name: $fullName\n";
$message .= "Email: $email\n";
$headers = "From: noreply@yourdomain.com";

mail($to, $subject, $message, $headers);
*/
?>