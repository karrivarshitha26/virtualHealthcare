<?php
// Establish connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "miniproject";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Include PHPMailer autoload file
require 'mailsend\mailsend\PHPMailer\src\Exception.php';
require 'mailsend\mailsend\PHPMailer\src\PHPMailer.php';
require 'mailsend\mailsend\PHPMailer\src\SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$doctor = $_POST['doctor']; // Assuming 'doctor' represents the doctor's name
$docemail = $_POST['docemail'];
$medical_problem = $_POST['medical_problem'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];

$sql_count = "SELECT COUNT(*) AS count FROM appointments WHERE doctor='$doctor' AND docemail='$docemail' AND appointment_date='$appointment_date'";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$count = $row_count['count'];
$sql_same_time = "SELECT COUNT(*) AS same_time_count FROM appointments WHERE doctor='$doctor' AND docemail='$docemail' AND appointment_date='$appointment_date' AND appointment_time='$appointment_time'";
$result_same_time = $conn->query($sql_same_time);
$row_same_time = $result_same_time->fetch_assoc();
$same_time_count = $row_same_time['same_time_count'];

if ($same_time_count >= 1) {
    echo "<script>alert('Sorry, appointment for the same time has been booked by others. Please choose another time.');</script>";
}
else if ($count >= 5) {
    echo "<script>alert('Sorry, appointments for today are fully booked. Please choose another date.');</script>";
} else {
    // Prepare SQL statement to insert data into appointments table
    $sql = "INSERT INTO appointments (name, email, doctor, docemail, medical_problem, appointment_date, appointment_time)
            VALUES ('$name', '$email', '$doctor', '$docemail', '$medical_problem', '$appointment_date', '$appointment_time')";

    if ($conn->query($sql) === TRUE) {
        // Appointment successfully booked
        echo "<script>alert('Appointment booked successfully!');</script>";

        // Construct email notification message
        $message = "Hello Doctor,\n\nYou have new appointments:\n\n";
        // Send email notification
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'manjunadth2003@gmail.com'; // Doctor's email
            $mail->Password   = 'fwky shzt nsmk duri'; // Doctor's email password
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('manjunadth2003@gmail.com', 'Appointments');
            $mail->addAddress($docemail); // Doctor's email

            // Content
            $mail->isHTML(false);
            $mail->Subject = 'New Appointments';
            $mail->Body    = $message;

            $mail->send();
            echo 'Email notification sent successfully!';
        } catch (Exception $e) {
            echo "Email notification could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        // Error occurred while booking appointment
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
