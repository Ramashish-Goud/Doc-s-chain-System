<?php
// DB connection
$conn = new mysqli("localhost", "root", "", "mps_portal");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form data
$fullname = $_POST['fullname'];
$fathername = $_POST['fathername'];
$mothername = $_POST['mothername'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$address = $_POST['address'];
$state = $_POST['state'];
$city = $_POST['city'];
$pin = $_POST['pin'];

// Upload files
$id_proof = $_FILES['id_proof']['name'];
$address_proof = $_FILES['address_proof']['name'];
$photo = $_FILES['photo']['name'];

move_uploaded_file($_FILES['id_proof']['tmp_name'], "uploads/" . $id_proof);
move_uploaded_file($_FILES['address_proof']['tmp_name'], "uploads/" . $address_proof);
move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/" . $photo);

// Generate unique Ticket ID
$ticket_id = uniqid("TKT_");

// Insert into DB
$sql = "INSERT INTO aadhar_applications (ticket_id, fullname, fathername, mothername, dob, gender, mobile, email, address, state, city, pin, id_proof, address_proof, photo)
        VALUES ('$ticket_id', '$fullname', '$fathername', '$mothername', '$dob', '$gender', '$mobile', '$email', '$address', '$state', '$city', '$pin', '$id_proof', '$address_proof', '$photo')";

if ($conn->query($sql) === TRUE) {
    // Redirect with Ticket ID
    header("Location: payment.html?ticket_id=" . $ticket_id);
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
