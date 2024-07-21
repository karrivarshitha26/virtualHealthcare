<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location:welcome.html");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Signin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<header class="header">

    <a href="index.html" class="logo"> <i class="fas fa-heartbeat"></i> medcare. </a>

    <nav class="navbar">
        <a href="index.html">home</a>
        <a href="#services">services</a>
        <a href="#about">about</a>
        <a href="index.html">logout</a>
        <a href="#review">review</a>

    </nav>

    <div id="menu-btn" class="fas fa-bars"></div>

</header>
<body>
        <div class="form-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h1>Please Sign in here...</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <input type="text" placeholder="Email" name="username" required><br><br>
                <input type="password" placeholder="Password" name="password" required><br><br>
                <a href="signup.php">Don't have an account? Sign Up</a>
                <button type="submit" value="Login">Sign In</button>
            </form>
        </div>
</body>
</html>
