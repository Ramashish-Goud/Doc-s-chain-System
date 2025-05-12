<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "maha_services";

// Connect to DB
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
  die("❌ Database Connection Failed: " . $conn->connect_error);
}

$tracking_id = $_POST['tracking_id'] ?? '';

if (!empty($tracking_id)) {
  $stmt = $conn->prepare("INSERT INTO payments (tracking_id) VALUES (?)");
  $stmt->bind_param("s", $tracking_id);

  if ($stmt->execute()) {
    echo "✅ .";
  } else {
    echo "❌ .";
  }

  $stmt->close();
} else {
  echo "⚠️.";
}

$conn->close();
?>
