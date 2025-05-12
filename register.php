<?php
// Database connection settings
$servername = "localhost"; // Your server name, e.g., 'localhost'
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "registrationDB"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $salutation = $_POST['salutation'];
    $fullName = $_POST['fullName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $mobileNumber = $_POST['mobileNumber'];
    $otp = $_POST['otp'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security
    $acceptDeclaration = isset($_POST['acceptDeclaration']) ? 1 : 0;

    // Handle file upload for photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = "uploads/" . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $photo);
    } else {
        $photo = ''; // If no photo uploaded, set it as an empty string
    }

    // Handle file upload for identity proof
    if (isset($_FILES['identityProof']) && $_FILES['identityProof']['error'] == 0) {
        $identityProof = "uploads/" . basename($_FILES["identityProof"]["name"]);
        move_uploaded_file($_FILES["identityProof"]["tmp_name"], $identityProof);
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO registrations (salutation, fullName, dob, gender, address, city, state, pincode, mobileNumber, otp, username, password, photo, identityProof, acceptDeclaration) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssssi", $salutation, $fullName, $dob, $gender, $address, $city, $state, $pincode, $mobileNumber, $otp, $username, $password, $photo, $identityProof, $acceptDeclaration);

    // Execute the query
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
