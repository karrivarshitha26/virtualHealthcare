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
        <a href="doclogout.php">logout</a>
        <a href="#review">review</a>

    </nav>

    <div id="menu-btn" class="fas fa-bars"></div>

</header>
<body>
<div class="form-container">
    <form action="doctor-login-action.php" method="post">
        <h1>Doctor Please Login !!!</h1>
        <div class="social-container">
            <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
            <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <!-- <span>or use your account</span> -->
        <input type="text" placeholder="username" name="username" required><br><br>
        <input type="password" placeholder="password" name="password" required><br><br>
        <button type="submit" value="Login">Sign In</button>
    </form>
</body>
</html>
