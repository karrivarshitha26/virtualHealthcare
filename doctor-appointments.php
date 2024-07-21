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
$sentence = "Hello ";
$hmm=" !";

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
        /* Custom styles */
        .navbar-brand img {
            max-width: 40px;
            margin-right: 10px;
        }
        .container {
            padding-top: 50px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Doctor details -->
            <a class="navbar-brand" href="doctor-appointments.php">
                <img src="doc-2.jpg" alt="Doctor Profile Image">
                <?php echo $sentence.$modified_username.$hmm; ?>
            </a>
            <!-- Logout button -->
            <form class="form-inline ml-auto" action="doclogout.php" method="post">
                <button type="submit" class="btn btn-outline-light mr-2">Logout</button>
            </form>
            <a href="abc.php" class="btn btn-outline-light">videocall</a>
            <!-- Send email button -->
            <a href="mailsend\mailsend\mailsend.php" class="btn btn-outline-light">Send Email</a>
        </div>
    </nav>
    
    <!-- Main content -->
    <div class="container mt-5">
        <!-- Doctor details -->
        <h2>Doctor Details</h2>
        <!-- Display doctor details here -->
        
        <!-- Appointments table -->
        <h2 class="mt-5">Appointments</h2>
        <?php if ($result->num_rows > 0) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Doctor</th>
                        <th>medical_problem</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["doctor"]; ?></td>
                            <td><?php echo $row["medical_problem"]; ?></td>
                            <td><?php echo $row["appointment_date"]; ?></td>
                            <td><?php echo $row["appointment_time"]; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No appointments found.</p>
        <?php endif; ?>
        <!-- Add appointment form -->
        <div>
        <form action="mailsend\mailsend\mail.php" method="post" enctype="multipart/form-data">
            <h2>Send email to patient</h2>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
            </div>

            <div class="form-group">
                <label for="uname">User Name</label>
                <input type="text" name="uname" id="uname" class="form-control" placeholder="User Name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" class="form-control" rows="5" placeholder="Message"></textarea>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Send</button>
        </form>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

