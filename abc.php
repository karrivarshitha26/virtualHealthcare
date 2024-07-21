<?php
session_start();

// Check if doctor is logged in
if (!isset($_SESSION['doctor_username'])) {
    header("Location: doctor-login.php");
    exit;
}

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

// Get appointments for the logged-in doctor
$doctor_username = $_SESSION['doctor_username'];


$doctor_username = $_SESSION['doctor_username'];
$len = strlen($doctor_username);

// Since indexing starts at 0, use $len - 1 to get the last character
$last_char = $doctor_username[$len - 1];

// Capitalize the last character
$capitalized_last_char = ucfirst($last_char);

// If you want to replace the whole string with just the capitalized last character
$modified_username = substr($doctor_username, 0, $len - 1) . $capitalized_last_char;
$sentence = " you have entered your video conferencing portal&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;";

$sql = "SELECT * FROM appointments WHERE doctor='$doctor_username'";
$result = $conn->query($sql);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointments</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
   
h1 {
    margin: 0;
}
.button-container {
      gap: 10px; /* Space between buttons */
      font-family: 'Montserrat', sans-serif;
      background: #f6f5f7;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 50vh;
}
button {
    border-radius: 20px;
    border: 1px solid #16a085;
    background: #16a085;
    color: #fff;
    /* font-weight: bold; */
    padding: 10px 20px;
    font-size: 16px;
    /* font-size: 12px;
    padding: 12px 45px; */
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: transform 80ms ease-in;
}

button:active {
    transform: scale(.95);
}

button:focus {
    outline: none;
}

button.ghost {
    background: transparent;
    border-color: #fff;
}
.navbar-brand img {
    max-width: 40px;
    margin-right: 10px;
}
.container {
    padding-top: 50px;
}
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Doctor details -->
            <a class="navbar-brand" href="doctor-appointments.php">
                <img src="images\doc-2.jpg" alt="Doctor Profile Image">
                <?php echo $modified_username.$sentence; ?>
            </a>
            <!-- <a href="abc.php" class="btn btn-outline-light">videocall</a> -->
            <!-- Send email button -->
            <a href="mailsend\mailsend\mailsend.php" class="btn btn-outline-light">Send Prescription</a>
        </div>
    </nav>
    <br><br>
    <div class="button-container">
      <button onclick="redirectToLink()">Click here to Start VIDEO CALL</button>
      <button onclick="redirectToLink2()">Click here to extract prescription </button>
    </div>
    </div>
    <script>
      function redirectToLink() {
        window.location.href = 'https://1ca93764bf2aab17770f-sandhyas-projects-149cc88f.vercel.app/9b394f9f-cc76-4a3e-b31a-6348157acab5';
      }
      function redirectToLink2() {
        window.location.href = 'http://127.0.0.1:5000/';
      }
    </script>
  </body>
</html>