<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Default password for XAMPP
$dbname = "aadhaar_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$resident_type = $_POST['resident_type'];
$pre_enrolment_id = $_POST['pre_enrolment_id'];
$aadhaar_number = $_POST['aadhaar_number'];
$update_fields = isset($_POST['update_fields']) ? implode(", ", $_POST['update_fields']) : "";
$full_name = $_POST['full_name'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$verification_type = $_POST['verification_type'];
$poi = $_POST['poi'];
$poa = $_POST['poa'];
$pan_number = $_POST['pan_number'];
$voter_id_number = $_POST['voter_id_number'];

// Insert into database
$sql = "INSERT INTO form_applications (resident_type, pre_enrolment_id, aadhaar_number, update_fields, full_name, gender, dob, address, mobile, email, verification_type, poi, poa, pan_number, voter_id_number)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssssss", $resident_type, $pre_enrolment_id, $aadhaar_number, $update_fields, $full_name, $gender, $dob, $address, $mobile, $email, $verification_type, $poi, $poa, $pan_number, $voter_id_number);

if ($stmt->execute()) {
    echo "<script>alert('Form submitted successfully!'); window.location.href = 'aadhaar_update.html';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
