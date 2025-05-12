<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'bosstrack_engineering');


// PHPMailer SMTP configuration
define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_USERNAME', 'techcourage1@gmail.com'); // your Gmail
define('MAIL_PASSWORD', 'ygkdzwckpqrymovx');       // Gmail app password
define('MAIL_PORT', 465);
define('MAIL_FROM_EMAIL', 'no-reply@bosstrack.com');
define('MAIL_FROM_NAME', 'Bosstrack Engineering');

// Create database connection
try {
    $conn = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
