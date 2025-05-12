<?php
// Database connection details
$host = "localhost";
$db = "maha_services"; // Use your actual database name
$user = "root"; // Use your actual database username
$pass = ""; // Use your actual database password

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

// Get the Tracking ID from the request
$tracking_id = $_POST['tracking_id'] ?? '';

if ($tracking_id) {
    // Query to check if the Tracking ID exists in the database
    $stmt = $pdo->prepare("SELECT * FROM payments WHERE tracking_id = ?");
    $stmt->execute([$tracking_id]);

    if ($stmt->rowCount() > 0) {
        echo "found"; // Record found
    } else {
        echo "not found"; // Record not found
    }
}
?>
