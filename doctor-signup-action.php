<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miniproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data

$username = $_POST['username'];
$docemail = $_POST['docemail'];
$password = $_POST['password'];


// Insert doctor into database
$sql = "INSERT INTO doctors (username,docemail, password) VALUES ('$username','$docemail', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Doctor signed up successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
