<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Sign Up</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container" id="container">
    <div class="form-container">
    <h2>Doctor Sign Up</h2>
    <form action="doctor-signup-action.php" method="post">
        <input type="text" placeholder="username" name="username" required><br><br>
        <input type="email" placeholder="email" name="docemail" required><br><br>
        <input type="password" placeholder="password" name="password" required><br><br>
        <input type="submit" value="Sign Up">
    </form>
</body>
</html>
